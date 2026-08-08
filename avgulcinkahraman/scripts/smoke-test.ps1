[CmdletBinding()]
param()

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'
[Console]::OutputEncoding = [Text.Encoding]::UTF8
$OutputEncoding = [Text.Encoding]::UTF8

$projectRoot = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..'))
$sitePath = [IO.Path]::GetFullPath((Join-Path $projectRoot 'runtime\wordpress'))
$studioRoot = Join-Path $env:LOCALAPPDATA 'studio'
$studioNode = Join-Path $studioRoot 'bin\node.exe'
$studioCli = Join-Path $studioRoot 'cli\main.mjs'
$failures = [Collections.Generic.List[string]]::new()
$siteTitle = [Text.Encoding]::UTF8.GetString(
    [Convert]::FromBase64String('QXYuIEfDvGzDp2luIEthaHJhbWFuIEdlZGlr')
)

function Add-Result {
    param(
        [Parameter(Mandatory)]
        [string] $Name,

        [Parameter(Mandatory)]
        [bool] $Passed,

        [string] $Details = ''
    )

    if ($Passed) {
        Write-Host "[PASS] $Name" -ForegroundColor Green
    } else {
        Write-Host "[FAIL] $Name$(if ($Details) { ": $Details" })" -ForegroundColor Red
        $failures.Add($Name) | Out-Null
    }
}

function Invoke-StudioCapture {
    param(
        [Parameter(Mandatory)]
        [string[]] $Arguments
    )

    $output = & $studioNode $studioCli @Arguments
    if ($LASTEXITCODE -ne 0) {
        throw "studio $($Arguments -join ' ') exited with code $LASTEXITCODE."
    }
    return ($output | Out-String).Trim()
}

function Invoke-StudioWpCapture {
    param(
        [Parameter(Mandatory)]
        [string[]] $Arguments
    )

    return Invoke-StudioCapture -Arguments (@('wp', '--path', $sitePath) + $Arguments)
}

$cliReady = (Test-Path -LiteralPath $studioNode -PathType Leaf) -and
    (Test-Path -LiteralPath $studioCli -PathType Leaf)
Add-Result -Name 'WordPress Studio CLI files' -Passed $cliReady
if (-not $cliReady) {
    throw 'WordPress Studio CLI was not found; remaining tests cannot run.'
}

$coreFiles = @('index.php', 'wp-load.php', 'wp-config.php', 'wp-admin', 'wp-includes')
$missingCoreFiles = @($coreFiles | Where-Object {
        -not (Test-Path -LiteralPath (Join-Path $sitePath $_))
    })
Add-Result -Name 'WordPress core files' -Passed ($missingCoreFiles.Count -eq 0) -Details ($missingCoreFiles -join ', ')

$mailCatcher = Join-Path $sitePath 'wp-content\mu-plugins\local-mail-catcher.php'
if (Test-Path -LiteralPath $mailCatcher -PathType Leaf) {
    $mailCatcherSource = Get-Content -Raw -LiteralPath $mailCatcher
    $mailCatcherIsFailClosed = ($mailCatcherSource -match 'MAIL_CAPTURED') -and
        ($mailCatcherSource -match 'pre_wp_mail')
    Add-Result -Name 'Fail-closed local mail catcher' -Passed $mailCatcherIsFailClosed -Details 'Expected pre_wp_mail and MAIL_CAPTURED markers.'
} else {
    Add-Result -Name 'Fail-closed local mail catcher' -Passed $false -Details "Missing: $mailCatcher"
}

try {
    Invoke-StudioWpCapture -Arguments @('core', 'is-installed') | Out-Null
    Add-Result -Name 'WordPress database and install status' -Passed $true
} catch {
    Add-Result -Name 'WordPress database and install status' -Passed $false -Details $_.Exception.Message
}

$expectedOptions = [ordered]@{
    blogname               = $siteTitle
    admin_email            = 'admin@localhost.test'
    timezone_string        = 'Europe/Istanbul'
    blog_public            = '0'
    default_comment_status = 'closed'
    default_ping_status    = 'closed'
    permalink_structure    = '/%postname%/'
}

foreach ($entry in $expectedOptions.GetEnumerator()) {
    try {
        $actual = Invoke-StudioWpCapture -Arguments @('option', 'get', $entry.Key)
        Add-Result -Name "Ayar: $($entry.Key)" -Passed ($actual -eq $entry.Value) -Details "beklenen '$($entry.Value)', bulunan '$actual'"
    } catch {
        Add-Result -Name "Ayar: $($entry.Key)" -Passed $false -Details $_.Exception.Message
    }
}

try {
    $environmentType = Invoke-StudioWpCapture -Arguments @('config', 'get', 'WP_ENVIRONMENT_TYPE')
    Add-Result -Name 'WP_ENVIRONMENT_TYPE local' -Passed ($environmentType -eq 'local') -Details "bulunan '$environmentType'"
} catch {
    Add-Result -Name 'WP_ENVIRONMENT_TYPE local' -Passed $false -Details $_.Exception.Message
}

try {
    $homeUrl = Invoke-StudioWpCapture -Arguments @('option', 'get', 'home')
    $response = Invoke-WebRequest -Uri $homeUrl -UseBasicParsing -TimeoutSec 20 -MaximumRedirection 5
    Add-Result -Name 'Local home page HTTP response' -Passed ($response.StatusCode -eq 200) -Details "HTTP $($response.StatusCode)"
} catch {
    Add-Result -Name 'Local home page HTTP response' -Passed $false -Details $_.Exception.Message
}

if ($failures.Count -gt 0) {
    Write-Host ''
    Write-Host "$($failures.Count) smoke test(s) failed." -ForegroundColor Red
    exit 1
}

Write-Host ''
Write-Host 'All smoke tests passed.' -ForegroundColor Green
exit 0
