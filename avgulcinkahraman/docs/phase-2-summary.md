# Aşama 2 teslim özeti

Tamamlanma tarihi: 8 Ağustos 2026

## Sonuç

Canlı siteden bağımsız temiz WordPress ortamı `runtime/wordpress/` altında kuruldu. Ortam WordPress Studio CLI, WordPress 7.0.2, PHP 8.3 ve ayrı SQLite veritabanıyla çalışır.

- Yerel URL: `http://localhost:8881`
- Site adı: Av. Gülçin Kahraman Gedik
- Dil: `tr_TR`
- Saat dilimi: `Europe/Istanbul`
- Kalıcı bağlantı: `/%postname%/`
- Arama görünürlüğü: kapalı (`blog_public=0`, ön yüzde `noindex`)
- Yorum ve ping varsayılanı: kapalı
- E-posta: `pre_wp_mail` üzerinden fail-closed yerel kesici; gerçek teslim yok

## Tekrarlanabilir komutlar

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File scripts\setup-local.ps1
powershell -NoProfile -ExecutionPolicy Bypass -File scripts\smoke-test.ps1
```

Kurulum betiği mevcut eksiksiz kurulumu korur; dolu fakat geçersiz runtime dizininin üstüne yazmayı reddeder. Smoke test WordPress çekirdeğini, veritabanını, ortam ayarlarını, posta kesicisini ve HTTP 200 yanıtını denetler.

## Son doğrulama

Smoke testte 13 kontrolün tamamı geçti. Ana sayfa HTTP 200 döndürdü ve `noindex` meta yönergesi görüldü. Deneme e-postası `MAIL_CAPTURED` sonucu verdi ve harici SMTP teslimi yapılmadı.

## Bilinen sınır

SQLite yalnız yerel geliştirme içindir. Tema, eklenti, form, yönlendirme, medya ve cache davranışları yayın öncesinde Hostinger staging + MariaDB üzerinde yeniden doğrulanacaktır. Docker Desktop, Windows WSL bileşeni eksik olduğu için bu aşamada kullanılmamıştır.
