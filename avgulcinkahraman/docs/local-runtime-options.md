# Yerel WordPress çalışma ortamı seçenekleri

Değerlendirme tarihi: 8 Ağustos 2026

## Karar özeti

Bu proje için birincil yerel çalışma ortamı olarak **WordPress Studio CLI + SQLite**, üretim eşdeğerliği kapısı olarak ise **ayrı Hostinger staging + MariaDB** kullanılmalıdır.

Bu seçim mevcut Node.js/npm kurulumunu kullanır; Docker, WSL, sistem PHP'si, yerel servis veya yönetici yetkisi gerektirmez. Studio CLI kendi WordPress/PHP/WP-CLI çalışma bağlamını sağlar ve PowerShell betikleriyle tekrar üretilebilir. SQLite ile MariaDB arasındaki fark nedeniyle veritabanına duyarlı davranışların son doğrulaması mutlaka Hostinger staging üzerinde yapılır.

Portable PHP + MariaDB seçeneği üretime daha yakın olsa da bu aşamada önerilmez. Kurulum, servis yaşam döngüsü, portlar, PHP uzantıları, MariaDB veri dizini, güvenli başlangıç ve süreç temizliği için daha çok özel Windows otomasyonu gerektirir. Docker mevcut olsa bile WSL bileşeni ve çalışan motor olmadığından bu aşamada güvenilir seçenek değildir.

## Doğrulanmış başlangıç durumu

| Bileşen | Durum | Sonuç |
|---|---|---|
| Node.js | 24.13 | Kullanılabilir |
| npm | 11.6 | Kullanılabilir |
| Docker Desktop | 29.6.2 | Kurulu, motor çalışmıyor |
| Docker Compose | 5.3.1 | Kurulu, çalışan motora erişemiyor |
| WSL optional component | Yok | Docker Linux kapsayıcı yolu yeniden başlatma/sistem değişikliği olmadan kullanılamaz |
| PHP | Yok | Sistem PHP'sine dayalı yöntem kullanılamaz |
| MySQL/MariaDB | Yok | Yerel MySQL uyumlu sunucu hazır değil |
| WP-CLI | Yok | Studio CLI tarafından sağlanabilir |
| Composer | Yok | Tema temeli için zorunlu değil; ihtiyaç doğarsa proje-yerel kurulmalıdır |

## Seçenek karşılaştırması

| Seçenek | UAC/reboot | Tekrar üretilebilirlik | Hostinger/MariaDB benzerliği | Otomasyon | Ana risk | Karar |
|---|---|---:|---:|---:|---|---|
| WordPress Studio CLI + SQLite | Gerektirmez | Yüksek | Orta-düşük | Yüksek | SQL farkları ve bazı eklenti sorguları | **Birincil yerel ortam** |
| Portable PHP + MariaDB ZIP | Gerektirmez | Orta | Yüksek | Orta | Windows süreç/port/extension/veri dizini bakımı | Yedek seçenek |
| WordPress Studio + harici portable MariaDB | Gerektirmez | Orta | Yüksek | Orta | İki runtime'ın birlikte yönetimi | Yalnız DB-parite hatası çıkarsa |
| Local benzeri masaüstü uygulaması | Kuruluma göre değişir | Orta-düşük | Genellikle yüksek | Düşük-orta | GUI durumu, sürüm kayması, proje dışı konumlar | Önerilmez |
| WordPress Playground / SQLite | Gerektirmez | Yüksek | Düşük | Yüksek | Kalıcılık, eklenti ve sunucu farkları | Hızlı önizleme/CI yardımcı aracı |
| Docker Desktop | Mevcut durumda reboot/sistem özelliği ister | Çok yüksek | Yüksek | Çok yüksek | Motor çalışmıyor; WSL yok | Şimdilik kullanma |
| Doğrudan uzak Hostinger staging | Gerektirmez | Orta | Çok yüksek | Orta | Ağ bağımlılığı, daha yavaş geri bildirim | Zorunlu son doğrulama |

## Önerilen mimari

```text
src/wp-content/themes/gulcin-kahraman/  -> Git ile izlenen ürün kodu
content/                                -> Git ile izlenen kontrollü içerik kaynakları
runtime/wordpress/                      -> Studio tarafından yönetilen yerel WordPress; Git dışı
runtime/tools/                          -> Proje-yerel/pinlenmiş araç cache'i; Git dışı
config/env.example                      -> Sır içermeyen ayar adları
scripts/setup-local.ps1                 -> İdempotent kurulum/başlatma
scripts/smoke-test.ps1                  -> Tekrarlanabilir yerel kontroller
staging.avukatgulcinkahraman.com        -> Ayrı dosya kökü ve MariaDB; parola + noindex
```

Yerel Studio veritabanı geçici geliştirme durumu kabul edilir. Kalıcı ürün kaynağı tema kodu, kontrollü içerik dosyaları ve göç manifestleridir. SQLite dosyası, `wp-config.php`, uploads, cache ve yerel kullanıcı bilgileri Git'e girmez.

## Neden WordPress Studio CLI?

WordPress Studio Windows'u destekler; Studio CLI bağımsız olarak veya npm paketi `wp-studio` üzerinden kurulabilir. CLI site oluşturma, başlatma, durdurma ve Studio bağlamında WP-CLI çalıştırma yeteneği sağlar. Böylece makinede ayrı PHP, veritabanı sunucusu veya WP-CLI kurulması gerekmez. Resmî belgeler: [Studio CLI](https://developer.wordpress.com/docs/developer-tools/studio/cli/) ve [yerel geliştirme kurulumu](https://developer.wordpress.com/docs/get-started/local-environment-setup/).

Önerilen kullanım ilkeleri:

1. Araç sürümü kurulum betiğinde açıkça pinlenir; `latest` sessizce kullanılmaz.
2. CLI mümkünse kullanıcı/proje kapsamına kurulur. Sistem PATH veya korumalı klasöre yazma gerektiren global kurulumdan kaçınılır.
3. `runtime/wordpress/` temiz site olarak üretilebilir; eski hosting çekirdeği buraya kopyalanmaz.
4. `src/wp-content/themes/gulcin-kahraman/` yerel sitenin tema yoluna junction veya kontrollü senkronizasyonla bağlanır. Tek kanonik kod kopyası `src/` altında kalır.
5. Kurulum betiği site URL'sini, permalink yapısını, `blog_public=0` değerini, yönetici hesabını ve seçilmiş içerik kurulumunu WP-CLI ile idempotent biçimde ayarlar.
6. Yerel e-posta dışarı gönderilmez; form testleri log/catcher çözümüne yönlendirilir.
7. Studio/WordPress.com hesabı yalnız preview gibi çevrimiçi özellikler için gerekebilir; temel yerel çalışma buna bağlanmamalıdır.

Studio içe/dışa aktarma işlevi tam site ve SQL dosyalarını destekler. Ancak bu projede eski siteyi bütünüyle Studio'ya alıp geliştirmeye devam etmek yerine temiz WordPress kurulumu ve seçici içerik göçü kullanılmalıdır. Resmî aktarım ayrıntıları: [Studio import/export](https://developer.wordpress.com/docs/developer-tools/studio/import-export/).

## SQLite sınırı ve üretim paritesi

Studio varsayılan olarak SQLite kullanır. Resmî Studio belgeleri, istenirse harici bir MySQL sunucusunun kullanılabileceğini de belirtir: [Studio FAQ](https://developer.wordpress.com/docs/developer-tools/studio/frequently-asked-questions/).

SQLite aşağıdaki işler için yeterlidir:

- özel blok tema geliştirme;
- şablon, desen ve global stil çalışması;
- navigasyon ve responsive davranış;
- yazı/sayfa editör akışı;
- temel WP sorguları ve tema testleri;
- hızlı, izole ve yeniden kurulabilir smoke test.

Şu alanlar yalnız SQLite sonucuyla onaylanmamalıdır:

- eklentilerin özel SQL sorguları ve tablo oluşturması;
- MariaDB collation, index uzunluğu ve veri tipi davranışı;
- büyük SQL import/export ve serialized veri dönüşümü;
- LiteSpeed, `.htaccess`, cron ve hosting dosya izinleri;
- gerçek SMTP, form teslimi, webhook ve analitik;
- cache, object cache ve üretim performansı;
- URL rewrite ve sunucuya özgü güvenlik kuralları.

Bu nedenle iki kapılı doğrulama uygulanmalıdır:

1. **Yerel kapı:** Studio/SQLite üzerinde kodlama, içerik, responsive ve hızlı işlev testi.
2. **Staging kapısı:** Hostinger/MariaDB üzerinde göç, eklenti, form, SMTP, cache, SSL, permalink ve performans testi.

SQLite'dan alınan veritabanı çıktısı canlı veritabanının sürekli kaynağı yapılmamalıdır. İlk kontrollü içerik aktarımından sonra staging/canlı veritabanları kendi ortamlarında yönetilmelidir. Studio'nun SQL dışa aktarabilmesi taşınabilirlik sağlar, ancak MariaDB staging testi zorunluluğunu kaldırmaz.

## Portable PHP + MariaDB seçeneği

Bu yöntem Windows ZIP paketlerini proje dışı veya `runtime/tools/` altında açarak servis kurmadan çalıştırılabilir. PHP'nin built-in sunucusu, MariaDB'nin özel `datadir` ve portu ve indirilen WP-CLI PHAR ile üretime daha yakın bir ortam oluşturulabilir.

Avantajları:

- MariaDB sorgu davranışı ve charset/collation açısından Hostinger'a daha yakın;
- standart `wp-config.php` ve WP-CLI akışı;
- SQLite uyumluluk katmanı yok;
- Docker/WSL gerektirmez.

Maliyet ve riskleri:

- PHP sürümü ve `mysqli`, `mbstring`, `curl`, `openssl`, `gd`/`imagick`, `zip`, `intl` gibi uzantılar açıkça yapılandırılmalıdır;
- MariaDB veri dizini başlatma, rastgele yerel parola, port çakışması ve temiz kapanış yönetilmelidir;
- yarım kalan `mysqld.exe` süreçleri ve kilit dosyaları sonraki çalışmayı bozabilir;
- Windows Defender/antivirüs indirilen çalıştırılabilirleri karantinaya alabilir;
- indirme URL'si, sürüm ve SHA-256 değerleri pinlenmeli ve doğrulanmalıdır;
- PHP built-in server Apache/Nginx değildir; `.htaccess` davranışı yine Hostinger staging'de test edilmelidir;
- MariaDB ve PHP güvenlik güncellemelerinin bakımı proje ekibine kalır.

Bu seçenek ancak Studio/SQLite nedeniyle gerçek bir uyumluluk engeli görülürse ikinci aşamada uygulanmalıdır. O durumda Studio, mevcut `wp-config.php` ile harici MySQL/MariaDB kullanabildiğinden tamamen yeni bir kullanıcı akışı kurmak yerine Studio + portable MariaDB hibriti tercih edilebilir.

## Local ve benzeri masaüstü uygulamaları

Local benzeri araçlar PHP, web sunucusu ve MySQL'i paketleyerek üretim benzerliği sağlar. Ancak çoğu GUI durumu, uygulama güncellemeleri, makineye özgü site kayıtları ve uygulama tarafından seçilen dizinlere dayanır. Sessiz ve idempotent kurulum ile ajan otomasyonu Studio CLI kadar açık değildir.

Bu nedenle kullanıcı özellikle görsel bir site yöneticisi istemedikçe proje standardı yapılmamalıdır. Kullanılırsa bile tema kodunun kanonik kopyası `src/` altında kalmalı ve ortam staging kapısını atlamamalıdır.

## WordPress Playground ve diğer SQLite yolları

Playground veya doğrudan SQLite Database Integration, hızlı demo, izole test ve ileride CI için yararlıdır. Fakat bu proje gerçek formlar, SMTP, medya, SEO eklentileri ve Hostinger davranışı gerektirdiği için tek başına ana ortam olamaz. Studio aynı düşük kurulum maliyetini daha kalıcı yerel site ve WP-CLI ergonomisiyle sunduğundan daha uygundur.

## Kurulum otomasyonu için kabul ölçütleri

Sonraki `setup-local.ps1` görevi şu özellikleri sağlamalıdır:

- yönetici yetkisi ve yeniden başlatma istememeli;
- indirme/araç sürümlerini açıkça pinlemeli;
- mevcut doğru kurulumu yeniden çalıştırıldığında bozmamalı;
- yalnız proje kökü ve kullanıcı kapsamındaki güvenli araç/cache yollarına yazmalı;
- `runtime/wordpress/` hedefini mutlak yol olarak doğrulamalı;
- mevcut runtime'ı silmeden önce ayrıca onay veya açık reset parametresi istemeli;
- temiz WordPress oluşturmalı; hosting yedeğinin `wp-admin`, `wp-includes`, eklenti veya tema ağacını kopyalamamalı;
- tema kaynağını `src/` altında tek kopya tutmalı;
- WP-CLI ile URL, permalink, `blog_public=0`, varsayılan içerik ve test yöneticisini kurmalı;
- gerçek SMTP/Analytics/API secret kullanmamalı;
- dış e-posta gönderimini kapatmalı veya catcher'a yönlendirmeli;
- sonunda sürüm, HTTP ana sayfa, wp-admin, REST API ve tema etkinliği smoke testlerini çalıştırmalı;
- reset ve yeniden kurulum yolunu belgelemeli.

## Staging kapısı

Hostinger staging ortamı canlıdan ayrı dosya kökü ve ayrı MariaDB veritabanı kullanmalıdır. HTTP kimlik doğrulaması veya eşdeğer erişim korumasıyla birlikte WordPress `noindex` ayarı uygulanmalıdır. Yerel ortamda başarılı olan kod staging'e yalnız tema/özel kod ve seçilmiş içerik olarak aktarılır; yerel SQLite dosyası canlıya kopyalanmaz.

Staging kabul testleri:

- Hostinger'ın gerçek PHP ve MariaDB sürümlerinde kurulum;
- migration URL ve serialized veri kontrolü;
- kalıcı bağlantılar, `.htaccess`, 404 ve yönlendirmeler;
- tek seçilmiş form çözümü, spam koruması ve test SMTP teslimi;
- Analytics olayları test/debug görünümünde;
- LiteSpeed yalnız hedef sunucu destekliyorsa temiz kurulum ve ayar;
- görsel işleme, uploads izinleri ve WebP/AVIF davranışı;
- cron, cache temizleme ve hata logları;
- mobil/masaüstü smoke test ve Lighthouse.

## Bilinen bağımlılıklar ve geri dönüş noktası

- Studio CLI'nin seçilecek kesin sürümü kurulum betiği yazılmadan önce gerçek komutla doğrulanmalı ve sabitlenmelidir.
- Studio'nun kullandığı PHP sürümü, hedef Hostinger PHP sürümüyle mümkün olduğunca eşleştirilmelidir.
- `config/env.example` gerçek sır içermeden yerel URL, admin adı ve staging değişken isimlerini tanımlamalıdır.
- Kurulum ve smoke test betikleri bu belge kararına göre hazırlanmalıdır.
- Her ortam yeniden üretilebilir olmalı; runtime silinmeden önce ürün kodunun yalnız `src/` altında olduğunun kontrolü yapılmalıdır.
- Docker, kullanıcı daha sonra WSL özelliğini etkinleştirip bilgisayarı yeniden başlatmayı kabul ederse yeniden değerlendirilebilir. O zamana kadar proje Docker'a bağımlı hâle getirilmemelidir.

## Son karar

**Şimdi:** WordPress Studio CLI'yi Node/npm üzerinden kullanıcı/proje kapsamında, sürümü pinlenmiş biçimde kullan; temiz WordPress'i `runtime/wordpress/` altında Studio/SQLite ile üret; tema ve içerik geliştirmesini burada yürüt.

**Yayın öncesi:** Ayrı Hostinger staging/MariaDB ortamında zorunlu uyumluluk, göç, form, SMTP, cache ve performans kapısını uygula.

**Yalnız ihtiyaç çıkarsa:** SQLite kaynaklı somut bir eklenti veya SQL uyumsuzluğu oluştuğunda portable MariaDB'yi Studio'ya harici veritabanı olarak bağla. Bu, ilk günden özel PHP+MariaDB yığını bakımına göre daha düşük riskli ve daha hızlıdır.
