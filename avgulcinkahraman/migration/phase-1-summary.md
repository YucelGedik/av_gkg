# Aşama 1 tamamlanma özeti

Tarih: 8 Ağustos 2026

## Sonuç

Ham hosting yedeği değiştirilmeden yalnız `avukatgulcinkahraman.com` dosyaları `runtime/restore-source/public_html/` altına çıkarıldı. Diğer iki domain çalışma kopyasına alınmadı. Avukatlık sitesine ait doğru veritabanı çalışma kopyası `runtime/database/` altında açıldı.

## Doğrulanan çalışma kopyası

- WordPress dosyaları: 22.413 dosya, 3.073 dizin, yaklaşık 479,5 MB.
- WordPress sürümü: 6.6.5.
- SQL: 15.996.142 bayt.
- Ham hosting arşivi SHA-256 doğrulaması: başarılı.
- Ham avukatlık veritabanı SHA-256 doğrulaması: başarılı.
- Çalışma kopyasında başka domain dizini: yok.

## Üretilen envanterler

- `migration/filesystem-inventory.md`
- `migration/filesystem-inventory.csv`
- `migration/database-inventory.md`
- `migration/content-inventory.csv`
- `migration/media-inventory.md`
- `content/media-manifest.csv`

## Temel bulgular

- Aktif tema kesin olarak Kubio 1.0.25.
- 16 kurulu eklentinin 15'i aktif; WP Mail SMTP pasif.
- Kubio, Elementor ve Spectra birlikte kullanılmış; yeni siteye builder çıktıları topluca taşınmayacak.
- Forminator ve WPForms birlikte aktif; yeni sitede tek form çözümü seçilecek.
- Veritabanında 11 sayfa, 1 demo yazı, 76 medya, 13 klasik menü öğesi, 1 blok navigasyonu ve 2 Forminator form tanımı var.
- 339 revizyon ve 108 yorum yeni siteye taşınmayacak; yorum içerikleri envantere alınmadı.
- Forminator giriş tablosunda form başvurusu bulunmuyor.
- Uploads altında 410 dosya ve 284 görsel var; 209 görsel otomatik thumbnail, 75 görsel orijinal.
- Medya manifestine 7 kullanılabilir veya koşullu orijinal aday alındı.
- `create_autologin_jkzjtlkndmwef1o.php` yönetici oturumu oluşturabilen geçici Hostinger yardımcısıdır; staging veya üretime taşınmayacak.
- Eski SMTP, analitik, pazarlama, OAuth ve token değerleri yeni ortama aktarılmayacak; bağlantılar temiz ortamda yeniden kurulacak.

## Açık bağımlılıklar

1. Marka ve logo çalışmasında kullanılacak kanonik isim kullanıcı tarafından **Av. Gülçin Kahraman Gedik** olarak kesinleştirildi.
2. Birincil portre için 2025 ofis fotoğrafı önerildi; eski şeffaf cübbe portresinin ikincil kullanımı kullanıcı kararına bağlı.
3. Kanser, kira ve aile görsellerinin kaynak/lisans bilgisi yedekte bulunmuyor; yayımdan önce doğrulanmalı veya yeni görsellerle değiştirilmeli.
4. Diğer hizmetler için tutarlı yeni bir görsel seti gerekecek.
5. Eklenti uyumluluğu ve kaldırma kararları temiz yerel/staging kurulumunda test edilecek.

## Aşama 2'ye aktarım

Ham yedek artık geliştirme kaynağı değildir. Aşama 2; temiz ve tekrar kurulabilir WordPress çalışma ortamını `runtime/wordpress/` altında kuracak, gerçek sırları Git dışında tutacak ve yeni özel blok temayı bu ortamda çalıştıracaktır.
