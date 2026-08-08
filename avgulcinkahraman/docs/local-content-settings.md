# Yerel WordPress içerik ve güvenlik ayarları

## Seçilen çalışma modeli

- Yerel geliştirme: WordPress Studio CLI ve SQLite.
- Yayın öncesi doğrulama: Hostinger üzerinde ayrı veritabanlı, parola korumalı staging ve MariaDB.
- Canlı site: doğrudan geliştirme hedefi değildir.

SQLite hızlı ve taşınabilir yerel çalışma içindir. MariaDB'ye özgü sorgu, eklenti davranışı, kalıcı bağlantı, form, SMTP ve cache sonuçları canlıya geçmeden önce staging üzerinde tekrar doğrulanır.

## Yerel adres

Kanonik yerel adres:

```text
http://localhost:8881
```

WordPress Studio farklı bir geçici adres üretirse `WP_HOME` ve `WP_SITEURL` aynı erişilebilir adres olacak şekilde birlikte güncellenir. İçerik içinde yerel adres elle yazılmaz; WordPress URL işlevleri ve göreli iç bağlantılar kullanılır. Böylece staging ve canlı geçişinde metin içi URL kalıntıları azaltılır.

Marka ve site adı her kullanıcıya görünen yerde kanonik biçimde **Av. Gülçin Kahraman Gedik** olmalıdır.

## Arama motoru görünürlüğü

Yerel ve staging ortamları indekslenmemelidir:

```text
WP_SEARCH_ENGINE_VISIBILITY=0
STAGING_SEARCH_ENGINE_VISIBILITY=0
```

WordPress karşılığı `blog_public=0` olmalıdır. Kurulum/sıfırlama betiği bu ayarı idempotent biçimde uygulamalı ve smoke test aşağıdakileri doğrulamalıdır:

1. `blog_public` değeri `0`.
2. Ön yüzde `noindex, nofollow` robots yönergesi.
3. Staging ayrıca HTTP kimlik doğrulamasıyla korunuyor.

Yalnız `robots.txt` engeli güvenlik önlemi değildir. Staging hem parola korumalı hem `noindex` olmalıdır. Canlıya geçişte `blog_public=1` ayrı ve bilinçli bir yayın adımıdır; yerel ayarlardan otomatik devralınmaz.

## Kalıcı bağlantılar

Hedef yapı:

```text
/%postname%/
```

Kurulumdan sonra rewrite kuralları yenilenir. Şu yollar en azından smoke testte kontrol edilir:

- `/`
- `/hizmetlerimiz/`
- `/hakkimizda/`
- `/iletisim/`
- `/kanser-ilaci-davalari/`
- `/aile-hukuku/`
- `/kira-tespit-ve-tahliye/`
- `/makaleler/`

Eski URL yönlendirmelerinin kaynağı `migration/url-map.md` dosyasıdır. SQLite üzerinde çalışan yönlendirmeler staging MariaDB ve Hostinger web sunucusunda yeniden test edilir.

## Dil, saat ve yayın varsayılanları

- Dil: `tr_TR`.
- Saat dilimi: `Europe/Istanbul`; sabit GMT farkı kullanılmaz.
- Tarih gösterimi: Türkçe içerik için `j F Y`.
- Saat gösterimi: `H:i`.
- Yeni kullanıcı kaydı: kapalı.
- Varsayılan yorum ve ping: kapalı.
- Ortam türü: yerelde `local`, staging'de `staging`.
- Yerel/staging hata gösterimi ziyaretçiye kapalı; hata günlüğü yalnız Git dışı runtime alanında tutulur.

## Güvenli e-posta yakalama

Yerel ortam hiçbir koşulda gerçek alıcıya e-posta göndermemelidir. Önerilen akış:

1. `wp-content/mu-plugins/local-mail-catcher.php`, `wp_mail` çağrılarını teslimden önce keser.
2. Alıcı adresi günlük kaydında `mail-catcher@invalid.example` olarak anonimleştirilir.
3. Hiçbir SMTP bağlantısı açılmaz ve gerçek müvekkil, avukat veya yönetici adresine teslim yapılmaz.
4. Smoke test, yakalayıcının `MAIL_CAPTURED` sonucu verdiğini doğrular.
5. Yerel veritabanına eski SMTP/API/token ayarları aktarılmaz.

Görsel posta kutusu gerektiğinde Mailpit veya eşdeğer bir yerel yakalayıcı daha sonra eklenebilir; varsayılan fail-closed kesici harici servise ihtiyaç duymaz.

Hostinger staging üzerinde e-posta davranışı ayrıca doğrulanır. Staging form testleri yalnız açıkça belirlenmiş test alıcısına yönlendirilir; üretim listeleri, otomasyonlar, Omnisend ve OptinMonster bağlantıları etkinleştirilmez. SMTP parolası ve API anahtarı yalnız Hostinger'ın gizli ortam ayarlarında tutulur.

## Örnek ortam dosyasının kullanımı

`config/env.example` yalnız anahtar adlarını ve zararsız varsayılanları içerir. Gerçek çalışma kopyası Git dışında tutulmalıdır.

Özellikle şu değerler repoya yazılmaz:

- WordPress yönetici parolası ve parola hash'i
- MariaDB kullanıcı/parolası
- WordPress salt değerleri
- SMTP kullanıcı/parolası
- Analitik, form, cache veya pazarlama API anahtarları ve tokenları
- Hostinger oturum veya otomatik giriş bilgileri

`REPLACE_IN_HOSTINGER` değerleri çalışır kimlik bilgisi değildir; staging kurulurken hosting gizli ayarlarında değiştirilir.

## Ortamlar arası doğrulama kapısı

Yerel SQLite testi başarılı olsa bile aşağıdakiler Hostinger staging + MariaDB üzerinde geçmeden canlıya çıkılmaz:

1. Temiz veritabanında kurulum ve tema etkinleştirme.
2. Türkçe karakterler, URL slug'ları ve kalıcı bağlantılar.
3. 301/410 davranışı ve 404 sonucu.
4. Form doğrulama, spam önlemi ve yalnız test alıcısına teslim.
5. `noindex` ve HTTP parola koruması.
6. Medya yükleme ve türev boyut üretimi.
7. Cache temizleme ve güncel sayfanın görüntülenmesi.
8. SQLite'a özel olmayan sorgu ve eklenti uyumluluğu.

## Bağımlılıklar

- WordPress Studio CLI'nin yerel siteyi oluşturması ve seçilen yerel adresi erişilebilir kılması.
- Kurulum betiğinin ortam değerlerini WordPress ayarlarına uygulaması.
- Yerel SMTP yakalayıcının kurulması veya mevcut olduğunun doğrulanması.
- Hostinger staging alanı, ayrı MariaDB veritabanı ve HTTP parola koruması.
- Smoke testin URL, `blog_public`, robots ve posta yakalayıcı kontrollerini içermesi.
