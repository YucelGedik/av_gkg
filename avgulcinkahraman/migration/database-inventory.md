# WordPress veritabanı envanteri

Kaynak: `runtime/database/avukatgulcinkahraman-2026-07-22.sql`

İnceleme tarihi: 8 Ağustos 2026

Bu belge salt okunur SQL incelemesinden üretilmiştir. Parola, hash, kullanıcı e-postası, API/SMTP anahtarı, token ve form alanı değeri kaydedilmemiştir. Satır bazındaki taşınabilir içerik listesi `migration/content-inventory.csv` dosyasındadır.

## Özet

| Varlık | Sayı | Not |
|---|---:|---|
| Sayfa | 11 | 10 yayında, 1 taslak |
| Yazı | 1 | WordPress demo yazısı |
| Medya | 76 | 54 JPEG, 18 PNG, 2 SVG, 1 WebP, 1 MIME türü boş |
| Klasik menü öğesi | 13 | `Primary Menu` |
| Blok navigasyonu | 1 | Eski bağlantılar içeriyor |
| Form tanımı | 2 | 1 yayında, 1 taslak |
| Revizyon | 339 | Göç için gerekli değil |
| Yorum | 108 | 107 onaysız, 1 onaylı; içerikleri incelenmedi/kaydedilmedi |

## Önemli site ayarları

| Ayar | Değer / durum |
|---|---|
| Site URL / ana URL | `https://avukatgulcinkahraman.com` |
| Site adı | `Hukuk Hizmetleri` |
| Açıklama | `Avukat Gülçin Kahraman` |
| Kalıcı bağlantı | `/%postname%/` |
| Ana sayfa | Statik sayfa, ID 135 (`home`) |
| Yazı sayfası | ID 1037 (`blog`) |
| Gizlilik sayfası | ID 3; taslak ve WordPress örnek metni |
| Arama motoru görünürlüğü | Açık (`blog_public=1`) |
| Üyelik | Kapalı |
| Varsayılan yorum | Açık |
| Varsayılan ping | Açık |
| Saat dilimi | Adlandırılmış saat dilimi boş, GMT farkı `0` |
| Tarih/saat biçimi | İngilizce varsayılan biçimler |
| Yükleme klasörleri | Yıl/ay düzeni açık |

Riskler: İstanbul için saat dilimi açıkça tanımlı değil; yorum ve ping varsayılanları yeni içerikte istenmeden açılabilir; site adı genel; tarih biçimleri Türkçe yayın akışına uygun değil.

## Aktif tema ve eklentiler

Aktif tema kesin olarak **Kubio** (`template=kubio`, `stylesheet=kubio`).

Aktif eklentiler (15):

- All in One SEO
- Astra Starter Templates
- AIOSEO Broken Link Checker
- Easy Table of Contents
- Elementor
- Forminator
- MonsterInsights / Google Analytics for WordPress
- Hostinger Easy Onboarding
- Hostinger
- Kubio
- LiteSpeed Cache
- Omnisend
- OptinMonster
- Spectra / Ultimate Addons for Gutenberg
- WPForms Lite

İçerikte Kubio ve Spectra blokları birlikte görülüyor; Elementor kitaplık kaydı da mevcut. Yeni özel blok temaya göçte builder çıktıları doğrudan taşınmamalı. Forminator ve WPForms birlikte etkin; tek form çözümüne indirgenmeli.

## Sayfa ve yazı envanteri

| ID | URL | Tür / durum | İçerik kalitesi ve göç kararı |
|---:|---|---|---|
| 135 | `/` (`home`) | Sayfa / yayında | 117 KB Kubio blok içeriği; placeholder var. Metin ve doğrulanmış iletişim bilgileri ayıklanıp yeniden kurulmalı. |
| 137 | `/hizmetlerimiz/` | Sayfa / yayında | İçerik boş. Yeni hizmet merkezi olarak yeniden kurulmalı. |
| 139 | `/hakkimizda/` | Sayfa / yayında | Kubio + Spectra karışık; temiz kişi/profil şablonunda yeniden kurulmalı. |
| 141 | `/iletisim/` | Sayfa / yayında | Kubio + Spectra karışık; çalışan form ve gerçek bağlantılarla yeniden kurulmalı. |
| 1037 | `/blog/` | Sayfa / yayında | İçerik boş, yazı arşivi olarak atanmış. `/makaleler/` hedefine 301 adayı. |
| 1302 | `/kanser-ilaci-davalari/` | Sayfa / yayında | Kullanılabilir konu içeriği Kubio bloklarından temizlenmeli; URL korunmalı. GUID eski `-2` yolunu gösteriyor ve yönlendirme test edilmeli. |
| 1356 | `/makaleler/` | Sayfa / yayında | 16 KB Kubio içerik; yeni makale arşivi olmalı. GUID eski `makaleler-2` yolunu gösteriyor. |
| 1427 | `/aile-hukuku-2/` | Sayfa / yayında | Yinelenen/ince içerik; `/aile-hukuku/` ile birleştirilip 301. |
| 1430 | `/aile-hukuku/` | Sayfa / yayında | Birincil hizmet URL'si; temiz şablonda yeniden kurulmalı. |
| 1432 | `/kira-tespit-ve-tahliye/` | Sayfa / yayında | URL korunmalı; Kubio içeriği temizlenmeli. |
| 3 | `/gizlilik-politikamiz/` | Sayfa / taslak | İngilizce WordPress örnek metni; yayımlanmadan tamamen yeniden yazılmalı. |
| 1 | `/hello-world/` | Yazı / yayında | Demo içerik; 410 veya içerik merkezine yönlendirme kararı gerekli. |

Gerçek makale bulunmuyor. Yeni makaleler doğal WordPress `post` türü, kategori, yazar ve tarihle yayımlanmalı.

## Menü ve taksonomi

`Primary Menu` adlı klasik menü 13 öğe içeriyor:

1. Ana Sayfa
2. Kanser İlacı Davaları
3. Hizmetlerimiz
4. Aile Hukuku
5. Kira Tespit ve Tahliye Davaları
6. Miras Hukuku (`#`)
7. İş ve Sosyal Güvenlik Hukuku (`#`)
8. İdare Hukuku (`#`)
9. Gayrimenkul Hukuku (`#`)
10. Tüketici Hukuku (`#`)
11. Hakkımızda
12. İletişim
13. Makaleler

Beş hizmet öğesi işlevsiz `#` bağlantısıdır. Ayrıca bir `wp_navigation` kaydı eski `/about-us/`, `/contact/`, `/services/` ve yanlış etiketli bağlantılar içerir. Yeni menü temiz olarak kurulmalı; eski menü kayıtları göç kaynağı olarak kullanılmamalı.

Tek normal kategori `Uncategorized` ve yalnız demo yazıya bağlıdır. Gerçek makale kategori sistemi sıfırdan tasarlanmalı.

## Medya

MIME dağılımı:

- `image/jpeg`: 54
- `image/png`: 18
- `image/svg+xml`: 2
- `image/webp`: 1
- boş: 1 (`default.svg` kaydı)

Medya kütüphanesinde Kubio uzaktaki demo görselleri, Logoipsum logoları, müşteri/demo görselleri, kırpılmış türevler, stok görseller ve belirsiz dosya adları bulunuyor. Olası portre adayları arasında `Gülçin Kahraman Gedik`, iki `Gülçin Kahraman Gedik-Photoroom` kaydı ve `PHOTO-2025-12-01-11-15-14` var. Nihai seçim, dosya sistemi medya manifesti ve kullanıcı doğrulamasıyla yapılmalı.

`content-inventory.csv` her medya kaydını `candidate_portrait`, `exclude_demo`, `exclude_derived` veya `media_review` önerisiyle listeler. Bu öneriler otomatik sınıflandırmadır; silme talimatı değildir.

## Formlar, analitik ve sır riski

- Forminator: `Kubio Contact Form` yayında; `İletişim Formu` taslak.
- Forminator giriş tabloları mevcut ancak kayıt sayısı **0**. Kişisel alan değeri dışa aktarılmadı.
- WPForms kayıt/log/ödeme tabloları mevcut. Yapı varlığı kaydedildi; kişisel veya ödeme alanı okunmadı ve rapora alınmadı.
- MonsterInsights/analitik ayarları mevcut; değerler dışa aktarılmadı.
- LiteSpeed API/token adlı ayarlar bulunuyor. Değerleri dışa aktarılmadı; yeni ortama taşınmamalı, gerekiyorsa yeniden üretilmeli.
- SMTP ile ilişkili metin/ayar izi bulunuyor; gizli değerler raporlanmadı. Yeni ortamda kimlik bilgileri sıfırdan ve Git dışı tanımlanmalı.
- Omnisend ve OptinMonster etkin. Eski bağlantı/tokenlar aktarılmadan önce gereklilik doğrulanmalı.

Risk seviyesi: **yüksek** — SQL dosyası kullanıcı, oturum, eklenti ayarı ve potansiyel sır taşıyan bir üretim yedeğidir. Git dışında ve erişimi sınırlı tutulmalıdır.

## İçerik göçü kararları

1. Builder bloklarını olduğu gibi içe aktarmak yerine gerçek metin, bağlantı ve medya referanslarını ayıkla.
2. `/`, `/hizmetlerimiz/`, `/hakkimizda/`, `/iletisim/`, üç öncelikli hizmet URL'si ve `/makaleler/` korunmalı.
3. `/aile-hukuku-2/` doğrudan `/aile-hukuku/` hedefine; `/blog/` doğrudan `/makaleler/` hedefine 301 olmalı.
4. Eski GUID değerleri URL doğruluğu için kaynak kabul edilmemeli; `post_name` ve canlı yönlendirme testi esas alınmalı.
5. `http://` medya ve içerik referansları HTTPS olarak normalize edilmeli.
6. Demo yazı, demo medya, revizyon, eklenti cache/log ve pazarlama bağlantıları temiz siteye topluca taşınmamalı.
7. Form ve analitik bağlantıları eski ayarlarla değil, staging üzerinde yeni kimliklerle kurulup test edilmeli.

## Kontroller ve sınırlamalar

- SQL dosyası değişmeden okundu; tablo ve `INSERT` kayıtları ayrıştırıldı.
- Sayfa/yazı/medya sayıları, durumlar, ayarlar, aktif tema/eklentiler, menü öğeleri, yorum sayıları ve form tablo varlığı kontrol edildi.
- Hiçbir sır değeri, kullanıcı kimliği, e-posta, parola/hash veya form alanı çıktılara yazılmadı.
- Medya dosyalarının fiziksel varlığı ve görsel kalitesi bu veritabanı görevinde doğrulanmadı; medya görevinin manifestine bağımlıdır.
- Canlı URL HTTP durumları bu görevde test edilmedi; yönlendirmeler `migration/url-map.md` ile birleştirilmelidir.
