# WordPress dosya sistemi envanteri

İnceleme tarihi: 8 Ağustos 2026  
Kaynak: `runtime/restore-source/public_html/`  
Veritabanı etkinlik kontrolü: `runtime/database/avukatgulcinkahraman-2026-07-22.sql` (salt okunur)

Bu rapor geri yüklenen çalışma kopyasının envanteridir. Kaynak dosyalar değiştirilmemiştir. Parola, anahtar, bağlantı belirteci, oturum bilgisi veya kullanıcıya ait gizli değer rapora alınmamıştır.

## Özet

- Kaynakta 22.413 dosya ve yaklaşık 479,5 MB veri vardır.
- WordPress çekirdeği 6.6.5'tir. Kaynak çekirdek minimum PHP 7.2.24 ve MySQL 5.5.5 bildirir.
- SQL'deki `template` ve `stylesheet` seçeneklerinin ikisi de `kubio` olduğundan etkin tema kesin olarak Kubio 1.0.25'tir.
- 16 eklenti dizini vardır. SQL'deki serileştirilmiş `active_plugins` kaydına göre 15'i etkindir; yalnız WP Mail SMTP etkin değildir.
- `wp-content` içinde eklentiler 17.576 dosya / 320,2 MB, temalar 1.441 dosya / 51,2 MB, uploads 410 dosya / 39,0 MB ve dil paketleri 297 dosya / 11,0 MB tutar.
- Yeni siteye çekirdek, eski tema, builder veya eklenti klasörleri topluca kopyalanmamalıdır. Temiz çekirdek ve `gulcin-kahraman` özel blok teması kullanılmalıdır.

Makinece okunabilir ayrıntılar `migration/filesystem-inventory.csv` dosyasındadır.

## WordPress çekirdeği

Kaynak sürüm 6.6.5'tir. Yeni çalışma ortamına bu çekirdeği kopyalamak yerine güncel ve temiz bir WordPress kurulumu yapılmalıdır. Eski `wp-admin` ve `wp-includes` ağaçları, kök PHP dosyaları, cache ve sunucuya özgü dosyalar taşınmamalıdır. İçerik ve onaylanmış medya seçilerek aktarılmalıdır.

## Temalar

| Tema | Sürüm | SQL etkinliği | Karar |
|---|---:|---|---|
| Kubio | 1.0.25 | Etkin | Taşıma; yeni özel blok temayla değiştir |
| Astra | 4.7.3 | Etkin değil | Taşıma |
| Lawyer Hub | 2.4 | Etkin değil | Taşıma |
| Legal Law Consulting | 1.5 | Etkin değil | Taşıma |
| Twenty Twenty-Four | 1.2 | Etkin değil | Taşıma |
| Twenty Twenty-Three | 1.5 | Etkin değil | Taşıma |
| Twenty Twenty-Two | 1.8 | Etkin değil | Taşıma |

Eski içeriğin Kubio, Elementor, Spectra veya Astra Starter Templates işaretlemesi içerebileceği kabul edilmelidir. Bu bağımlılıklar yeni temaya kopyalanmamalı; içerik temizlenerek WordPress çekirdek blokları ve proje desenleriyle yeniden kurulmalıdır.

## Eklentiler

SQL ile kesinleşen etkin eklentiler şunlardır:

- All in One SEO 4.6.9.1
- Starter Templates 4.3.8
- Broken Link Checker by AIOSEO 1.2.1
- Easy Table of Contents 2.0.69.1
- Elementor 3.23.2
- Forminator 1.34.1
- MonsterInsights 11.1.0
- Hostinger Easy Onboarding 2.1.17
- Hostinger Tools 3.0.65
- Kubio 2.3.2
- LiteSpeed Cache 7.6.2
- Omnisend 1.4.1
- OptinMonster 2.16.4
- Spectra 2.14.1
- WPForms Lite 1.9.0.2

WP Mail SMTP 4.1.1 dosya sisteminde vardır ancak SQL'de etkin değildir.

Eklenti dosyalarının hiçbiri yeni siteye doğrudan taşınmamalıdır. Gerçekten gerekli olanlar güncel ve temiz paketlerden kurulmalıdır. Builder/import/onboarding araçları içerik kaynağı olarak incelenebilir fakat yeni üretim bağımlılığı yapılmamalıdır. Aynı amaçlı iki form eklentisi (Forminator ve WPForms) bulunduğundan yeni sitede tek form çözümü seçilmelidir.

## Uploads envanteri

`wp-content/uploads` altında 410 dosya ve 38.989.275 bayt vardır. Yıllara göre dağılım:

| Yıl | Dosya | Boyut |
|---|---:|---:|
| 2021 | 35 | 1.206.988 bayt |
| 2022 | 5 | 185.695 bayt |
| 2024 | 239 | 16.595.894 bayt |
| 2025 | 6 | 356.642 bayt |
| 2026 | 0 | 0 bayt |

Dosya türlerinde 224 JPG, 48 PNG, 5 WebP, 5 JPEG ve 2 SVG görülür. Ayrıca 94 JSON, 13 CSS, 7 HTML, 5 `.htaccess`, 3 PHP, 2 JS, bir log ve bir XML bulunur. Bu ikinci grup büyük ölçüde editoryal medya değildir.

Toplam uploads sayısı ile yıllık klasörlerin toplamı arasındaki fark; `astra-sites`, `ast-block-templates-json`, `st-importer`, `astra-docs`, `ai-builder`, `uag-plugin`, `forminator` ve `wpforms` gibi eklenti/import dizinleridir. Bunlar topluca taşınmamalıdır:

- Astra/Starter Templates JSON katalogları, import yedeği, WXR ve loglar demo/araç çıktısıdır.
- Spectra `uag-plugin` CSS/JS dosyaları yeniden üretilebilir varlıklardır.
- Forminator dizinindeki PHP koruma dosyaları ve üretilmiş CSS yeni forma kopyalanmamalıdır.
- WPForms cache, şablon ve tema dosyaları taşınmamalıdır.
- Gerçek portre, logo ve editoryal görseller ayrı medya manifestindeki onayla seçilmelidir; bu rapor görsel seçimi yapmaz.

## `create_autologin_*.php` incelemesi

Dosya: `create_autologin_jkzjtlkndmwef1o.php`  
Boyut: 4.373 bayt  
SHA-256: `4A0936784F447233CA921B197A1FAFE1256CB365D2CE2B18FC7B3AF33EDDF6FD`

Kod WordPress'i yükler, yönetici kullanıcıyla ilişkili bir otomatik giriş akışı yürütür, `wp_set_current_user()` ve `wp_set_auth_cookie()` ile oturum oluşturabilir, Hostinger hPanel alanına `wp_remote_post()` ile bildirim yapar ve kendi dosyasını silmeye yönelik mantık içerir. Kaynakta nonce veya `hash_equals` tabanlı bir istek doğrulaması görülmemiştir. Rastgele dosya adı erişim sırrı gibi davranmaktadır.

Bu dosya hosting sağlayıcısının geçici otomatik giriş yardımcısıyla uyumludur; buna rağmen bulunduğu sürece yönetici oturumu oluşturabildiği için yüksek etkili bir erişim yüzeyidir. Yeni staging veya üretim ortamına **asla taşınmamalıdır**. Canlı geçiş güvenlik kontrolü, web kökünde `create_autologin_*.php` kalıbıyla dosya bulunmadığını doğrulamalıdır. Raporda dosyanın içindeki kullanıcı veya bağlantı değerleri bilerek yer almamaktadır.

## Form, SMTP, analitik ve pazarlama bileşenleri

### Formlar

Forminator ve WPForms Lite aynı anda etkindir. Uploads altında her ikisine ait üretilmiş/cache dosyaları vardır. Yeni sitede tek form çözümü seçilmeli; eski formlar, gönderimler, bildirim alıcıları, webhook'lar ve spam ayarları topluca taşınmamalıdır. Gereken alanlar yeni ortamda yeniden kurulup test edilmelidir.

### SMTP

WP Mail SMTP kuruludur fakat yedek anında etkin değildir. Eski SMTP kullanıcı adı, parola, API anahtarı, OAuth belirteci, gönderen adresi veya bağlantı ayarı taşınmamalıdır. Staging e-postası yakalayıcı/test alıcısına yönlendirilmeli; üretim SMTP bağlantısı ayrı ve güncel bir secret ile kurulmalıdır.

### Analytics ve pazarlama

MonsterInsights, Omnisend ve OptinMonster etkindir. Eski Analytics bağlantısı, ölçüm kimliği, OAuth/account belirteci, pazarlama listesi ve kampanya bağlantısı otomatik taşınmamalıdır. Yeni ölçüm planı kapsamında Analytics sıfırdan bağlanmalı; Omnisend ve OptinMonster ancak açık ürün kararı varsa temiz kurulumla eklenmelidir. AIOSEO'dan yalnız doğrulanmış SEO metadata ihtiyacı seçilerek göç ettirilmelidir.

## Kontroller ve sınırlar

Yapılan kontroller:

- `wp-includes/version.php` üzerinden çekirdek ve minimum platform sürümleri okundu.
- Tema `style.css` başlıklarından ad ve sürümler çıkarıldı.
- Eklenti ana dosya başlıklarından ad ve sürümler çıkarıldı.
- SQL'deki `template`, `stylesheet` ve serileştirilmiş `active_plugins` seçenekleri salt okunur incelendi.
- Uploads dosya sayısı, boyutu, yıl ve uzantı dağılımı hesaplandı.
- Otomatik giriş yardımcısının hash'i, WordPress oturum işlevleri, uzak hedef alanı ve kendini silme davranışı incelendi; sırlar raporlanmadı.

Eksikler ve bağımlılıklar:

- Bu görev tema/builder içeriğini dönüştürmez ve hangi görsellerin kullanılacağına karar vermez.
- Form gönderim kayıtları, sayfa/yazı içeriği, SEO metadata değerleri ve kullanıcı hesapları veritabanı envanteri görevinin kapsamındadır.
- Aktif eklenti/tema bilgisi yedek tarihindeki SQL durumudur; güncel canlı siteyi temsil ettiği varsayılmamalıdır.
- Eklentilerin güncel WordPress/PHP uyumluluğu temiz staging kurulumu aşamasında yeniden doğrulanmalıdır.
- Medya taşıma kararı `content/media-manifest.csv` ve medya inceleme raporuna bağlıdır.
