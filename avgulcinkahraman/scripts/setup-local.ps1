[CmdletBinding()]
param()

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

$projectRoot = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..'))
$sitePath = [IO.Path]::GetFullPath((Join-Path $projectRoot 'runtime\wordpress'))
$studioRoot = Join-Path $env:LOCALAPPDATA 'studio'
$studioNode = Join-Path $studioRoot 'bin\node.exe'
$studioCli = Join-Path $studioRoot 'cli\main.mjs'
$siteTitle = [Text.Encoding]::UTF8.GetString(
    [Convert]::FromBase64String('QXYuIEfDvGzDp2luIEthaHJhbWFuIEdlZGlr')
)
$studioSiteName = "$siteTitle Yerel"

function Assert-File {
    param(
        [Parameter(Mandatory)]
        [string] $Path,

        [Parameter(Mandatory)]
        [string] $Description
    )

    if (-not (Test-Path -LiteralPath $Path -PathType Leaf)) {
        throw "$Description not found: $Path"
    }
}

function Invoke-Studio {
    param(
        [Parameter(Mandatory)]
        [string[]] $Arguments
    )

    & $studioNode $studioCli @Arguments
    if ($LASTEXITCODE -ne 0) {
        throw "WordPress Studio CLI command failed (exit $LASTEXITCODE): studio $($Arguments -join ' ')"
    }
}

function Invoke-StudioWp {
    param(
        [Parameter(Mandatory)]
        [string[]] $Arguments
    )

    Invoke-Studio -Arguments (@('wp', '--path', $sitePath) + $Arguments)
}

Assert-File -Path $studioNode -Description 'WordPress Studio Node runtime'
Assert-File -Path $studioCli -Description 'WordPress Studio CLI'

if (-not (Test-Path -LiteralPath $sitePath -PathType Container)) {
    New-Item -ItemType Directory -Path $sitePath | Out-Null
}

$wpLoad = Join-Path $sitePath 'wp-load.php'
$wpConfig = Join-Path $sitePath 'wp-config.php'
$hasWordPress = (Test-Path -LiteralPath $wpLoad -PathType Leaf) -and
    (Test-Path -LiteralPath $wpConfig -PathType Leaf)

if (-not $hasWordPress) {
    $existingItems = @(Get-ChildItem -LiteralPath $sitePath -Force)
    if ($existingItems.Count -gt 0) {
        throw "Runtime directory is not empty and does not contain a complete WordPress install. Refusing to overwrite: $sitePath"
    }

    Write-Host 'Creating a clean WordPress Studio site...'
    Invoke-Studio -Arguments @(
        'create',
        '--path', $sitePath,
        '--name', $studioSiteName,
        '--wp', 'latest',
        '--php', '8.3',
        '--runtime', 'native',
        '--file-access', 'site-directory',
        '--admin-username', 'localadmin',
        '--admin-email', 'admin@localhost.test',
        '--start=false',
        '--skip-browser',
        '--skip-log-details'
    )
} else {
    Write-Host "Reusing the existing WordPress Studio site: $sitePath"
}

# `start` is safe to repeat for an already running site.
Invoke-Studio -Arguments @(
    'start',
    '--path', $sitePath,
    '--skip-browser',
    '--skip-log-details'
)

# Local settings are deterministic and contain no production secret or recipient.
Invoke-StudioWp -Arguments @('config', 'set', 'WP_ENVIRONMENT_TYPE', 'local', '--type=constant')
Invoke-StudioWp -Arguments @('option', 'update', 'blogname', $siteTitle)
Invoke-StudioWp -Arguments @('option', 'update', 'blogdescription', 'Local development environment')
Invoke-StudioWp -Arguments @('option', 'update', 'admin_email', 'admin@localhost.test')
Invoke-StudioWp -Arguments @('option', 'update', 'timezone_string', 'Europe/Istanbul')
Invoke-StudioWp -Arguments @('option', 'update', 'date_format', 'j F Y')
Invoke-StudioWp -Arguments @('option', 'update', 'time_format', 'H:i')
Invoke-StudioWp -Arguments @('option', 'update', 'blog_public', '0')
Invoke-StudioWp -Arguments @('option', 'update', 'default_comment_status', 'closed')
Invoke-StudioWp -Arguments @('option', 'update', 'default_ping_status', 'closed')
Invoke-StudioWp -Arguments @('rewrite', 'structure', '/%postname%/')
Invoke-StudioWp -Arguments @('rewrite', 'flush')

Write-Host ''
Write-Host 'Local WordPress setup is ready.'
Write-Host "Site directory: $sitePath"
Write-Host 'Verify: powershell -ExecutionPolicy Bypass -File scripts\smoke-test.ps1'
