# Entegrasyon planı

## Kaynaklar

1. Mevcut WordPress yedeğinden yalnız `domains/avukatgulcinkahraman.com/public_html/` kullanılacak.
2. Doğru veritabanı `u852346668_ZyDUq.20260722143455.sql.gz`.
3. Yeni tasarım kaynağı `references/prototype/avukat-gulcin-kahraman-prototype.html`.

## Uygulama yaklaşımı

- Prototip tek parça HTML olarak WordPress'e yapıştırılmayacak.
- Header, mobil navigasyon ve footer global şablon olacak.
- Hizmetler gerçek WordPress sayfaları olarak üretilecek.
- Makaleler WordPress `post` türü, kategori, yazar ve tarih bilgisiyle yönetilecek.
- İletişim bölümü çalışan bir form, telefon, e-posta ve WhatsApp bağlantıları kullanacak.
- Portre ve seçilmiş içerik görselleri medya kütüphanesine optimize edilerek aktarılacak.
- Uzun ömürlü özel WordPress blok teması `src/wp-content/themes/gulcin-kahraman/` altında geliştirilecek; eski Kubio, Elementor ve Spectra içerikleri yalnız içerik kaynağı olarak değerlendirilecek.

## İlk içerik önceliği

1. Ana sayfa
2. Av. Gülçin Kahraman / Hakkında
3. Kanser İlacı Davaları
4. Aile Hukuku
5. Kira Tespit ve Tahliye
6. Makaleler arşivi ve makale şablonu
7. İletişim

## Kalite kapıları

- 375, 768, 1024 ve geniş masaüstü görünümü
- Çalışan mobil menü
- Çalışan telefon, WhatsApp, e-posta ve form
- Benzersiz sayfa başlıkları ve açıklamalar
- Eski URL'ler için yönlendirme haritası
- Görsel boyutları, önbellek ve Core Web Vitals kontrolü
- Klavye odağı, form etiketleri ve temel erişilebilirlik kontrolü
