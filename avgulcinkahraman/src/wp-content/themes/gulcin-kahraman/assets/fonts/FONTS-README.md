# Fontları self-host etme (gizlilik + performans)

Şu an fontlar Google Fonts'tan çekiliyor (`functions.php` içinde `fonts.googleapis.com`).
Self-host, KVKV/gizlilik açısından daha iyidir (ziyaretçi IP'si Google'a gitmez) ve
render'ı hızlandırır. Bu ortam Google'a erişemediği için font dosyaları **internet erişimi olan
bir makinede** indirilip buraya konmalıdır. Adımlar:

## 1. WOFF2 dosyalarını indir

En kolay yol: https://gwfh.mranftl.com (google-webfonts-helper).
Her aile için **Charsets: latin, latin-ext** (Türkçe için latin-ext şart) seçip WOFF2 indir:

- **Newsreader** — weights: 500, 600
- **Manrope** — weights: 400, 500, 600
- **IBM Plex Mono** — weights: 400, 500

İndirilen `.woff2` dosyalarını bu klasöre (`assets/fonts/`) şu adlarla koy:

```
newsreader-500.woff2  newsreader-600.woff2
manrope-400.woff2     manrope-500.woff2   manrope-600.woff2
ibm-plex-mono-400.woff2   ibm-plex-mono-500.woff2
```

## 2. Bu klasöre `fonts.css` ekle (aşağıdaki @font-face bloğu hazır)

`assets/fonts/fonts.css` dosyası oluşturulup içine şunlar yazılır:

```css
@font-face{font-family:'Newsreader';font-style:normal;font-weight:500;font-display:swap;src:url('./newsreader-500.woff2') format('woff2')}
@font-face{font-family:'Newsreader';font-style:normal;font-weight:600;font-display:swap;src:url('./newsreader-600.woff2') format('woff2')}
@font-face{font-family:'Manrope';font-style:normal;font-weight:400;font-display:swap;src:url('./manrope-400.woff2') format('woff2')}
@font-face{font-family:'Manrope';font-style:normal;font-weight:500;font-display:swap;src:url('./manrope-500.woff2') format('woff2')}
@font-face{font-family:'Manrope';font-style:normal;font-weight:600;font-display:swap;src:url('./manrope-600.woff2') format('woff2')}
@font-face{font-family:'IBM Plex Mono';font-style:normal;font-weight:400;font-display:swap;src:url('./ibm-plex-mono-400.woff2') format('woff2')}
@font-face{font-family:'IBM Plex Mono';font-style:normal;font-weight:500;font-display:swap;src:url('./ibm-plex-mono-500.woff2') format('woff2')}
```

## 3. `functions.php` değişikliği

`gulcin_kahraman_enqueue_assets()` ve `gulcin_kahraman_editor_assets()` içinde
`gulcin-kahraman-fonts` (Google Fonts) enqueue'sunu KALDIR; yerine:

```php
wp_enqueue_style(
    'gulcin-kahraman-fonts',
    get_theme_file_uri( 'assets/fonts/fonts.css' ),
    array(),
    gulcin_kahraman_asset_version( 'assets/fonts/fonts.css' )
);
```

Ayrıca `gulcin_kahraman_resource_hints()` fonksiyonundaki `fonts.googleapis.com` /
`fonts.gstatic.com` preconnect satırları kaldırılabilir (artık gerek yok).

## Not
Font dosyaları eklenmeden functions.php değiştirilirse site fontsuz kalır.
Bu yüzden sıra önemli: önce woff2 + fonts.css, sonra functions.php.
