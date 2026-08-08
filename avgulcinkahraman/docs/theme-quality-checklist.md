# Tema kalite kontrol listesi

Bu belge `gulcin-kahraman` blok temasının Aşama 3 kabul kontrolüdür. Bir madde gerçek tarayıcı veya WordPress testi yapılmadan tamamlanmış sayılmaz.

## Test koşulları

- WordPress Studio yerel sitesi ve temiz SQLite veritabanı kullanılır.
- `gulcin-kahraman` teması etkin olmalıdır.
- Tarayıcı yakınlaştırması önce `%100`, erişilebilirlik kontrolünde `%200` olmalıdır.
- Klavye testi fare/trackpad kullanılmadan yapılır.
- Chrome veya Edge güncel sürümüne ek olarak mümkünse Firefox ile kısa uyumluluk turu yapılır.
- Yerel ortam `noindex` kalır; test sırasında canlı site veya gerçek iletişim alıcıları kullanılmaz.

## Responsive test matrisi

| Genişlik | Temel beklenti | Header / navigasyon | İçerik ve dosya omurgası | Mobil sabit çubuk |
|---:|---|---|---|---|
| 375 px | Tek sütun, yatay taşma yok, metin büyütmede kırpılma yok | Mobil menü düğmesi görünür; açılan menü ekrana sığar | Dosya etiketi/çizgisi yatay; sekiz hizmet bağlantısı okunur ve dokunma hedefleri en az 44×44 px | `Ara · WhatsApp · Yol Tarifi` görünür, içerik sonunu örtmez |
| 768 px | Tablet boşlukları dengeli, gereksiz dar kart yok | Menü seçilen tablet davranışında tutarlı; odak sırası görsel sırla aynı | Omurga geçiş noktasında etiket veya bağlantı kesilmez | Tasarım kararına göre görünürlük tutarlı; görünürse üç eylem eşit erişilebilir |
| 1024 px | 12 sütunlu düzen devreye girer; içerik genişliği sınırlı | Masaüstü navigasyonu sığar, logo ve eylemler çakışmaz | Omurga masaüstü dikey düzeninde başlık/listeden anlamlı ayrılır | Masaüstü kabuğunda gizli olmalı; aynı eylemler header/footer'da bulunur |
| 1440 px | İçerik sonsuz genişlemez; geniş kenar boşlukları dengeli | Header hizaları, maksimum genişlik ve sticky davranış doğru | Dikey pirinç çizgi ve mono etiket kontrollü; liste satırları aşırı uzamaz | Gizli olmalı |

Her genişlikte ayrıca şu sayfalar kontrol edilir: ana sayfa, uzun başlıklı hizmet sayfası, makale listesi, tekil makale, iletişim ve 404.

## Klavye ve odak

- [ ] Sayfanın ilk anlamlı odağı “İçeriğe geç” bağlantısıdır ve etkinleştirildiğinde ana içeriğe gider.
- [ ] Header, masaüstü menüsü, mobil menü, dosya omurgası bağlantıları, footer ve formlar yalnız `Tab`/`Shift+Tab` ile kullanılabilir.
- [ ] Odak sırası DOM ve görsel okuma sırasıyla aynıdır.
- [ ] Her etkileşimli öğede arka plandan açıkça ayrılan görünür `:focus-visible` stili vardır.
- [ ] Odak göstergesi sticky header, mobil çubuk veya `overflow` nedeniyle kesilmez.
- [ ] Mobil menü düğmesi `Enter` ve `Space` ile açılır/kapanır; `aria-expanded` durumu doğru değişir.
- [ ] Mobil menü açıldığında odak anlaşılır biçimde menüye alınır; kapanınca düğmeye döner.
- [ ] `Escape` mobil menüyü kapatır.
- [ ] Gizli menü bağlantıları kapalıyken odağa girmez.
- [ ] Aynı hedefe giden bağlantı metinleri bağlam dışında da anlaşılır; “buraya tıklayın” kullanılmaz.

## Mobil sabit iletişim çubuğu

- [ ] Sıra ve etiketler tam olarak `Ara`, `WhatsApp`, `Yol Tarifi` şeklindedir.
- [ ] Her eylem gerçek `tel:`, `https://wa.me/` veya harita/yol tarifi URL'sine gider.
- [ ] İkon varsa görünür metni tekrarlamaz; dekoratif ikon `aria-hidden="true"` olur.
- [ ] Dokunma hedefleri en az 44×44 px ve aralarında yanlış dokunmayı önleyecek boşluk vardır.
- [ ] Çubuk ekranın güvenli alanını (`env(safe-area-inset-bottom)`) hesaba katar.
- [ ] Sayfa alt dolgusu, çubuğun footer, form düğmesi veya son paragrafı örtmesini engeller.
- [ ] Klavye açıldığında ve 200% yakınlaştırmada kritik alanları kapatmaz.
- [ ] 1024 ve 1440 px masaüstü görünümlerinde gizlidir; eşdeğer iletişim yolları header/footer'da bulunur.

## Azaltılmış hareket

- [ ] `@media (prefers-reduced-motion: reduce)` altında dekoratif geçiş ve animasyonlar kaldırılır veya anlık hâle gelir.
- [ ] Smooth scroll devre dışı kalır.
- [ ] Menü, hover ve dosya omurgası etkileşimleri anlam kaybetmeden animasyonsuz çalışır.
- [ ] Otomatik kayan, dönen, yanıp sönen veya sürekli hareket eden içerik yoktur.
- [ ] İçerik görünürlüğü yalnız animasyonun tamamlanmasına bağlı değildir.

## Dosya omurgası pattern'i

- [ ] Pattern ekleyicide “Dosya omurgası — hizmet alanları” adıyla görünür.
- [ ] Yalnız bir açıklayıcı H2 vardır ve sayfadaki başlık hiyerarşisine uyar.
- [ ] Hizmetler sırasız liste semantiğiyle sunulur; sekiz bağlantının tamamı klavyeyle erişilebilir.
- [ ] URL'ler: kanser ilacı, aile, kira/tahliye, miras, iş ve sosyal güvenlik, idare, gayrimenkul ve tüketici hukuku hedeflerine gider.
- [ ] Son bağlantı `/hizmetlerimiz/` merkezine gider.
- [ ] Numaralar ve pirinç çizgi dekoratif olarak erişilebilirlik ağacından çıkarılmıştır.
- [ ] Renk tek anlam taşıyıcısı değildir; bağlantılar hover dışında da ayırt edilir.
- [ ] Uzun “İş ve Sosyal Güvenlik Hukuku” etiketi 375 ve 200% yakınlaştırmada taşmaz.
- [ ] Pattern terazi, tokmak, sütun, altın halka veya stok hukuk ikonları içermez.
- [ ] Editör ve ön yüz görünümleri aynı içerik sırasını korur.

## Blok tema doğrulaması

- [ ] Tema WordPress yönetiminde hata vermeden görünür ve etkinleşir.
- [ ] `theme.json` geçerli JSON'dur ve kullanılan renk/font/boşluk slug'ları kayıtlıdır.
- [ ] `style.css` tema başlığı geçerlidir; metin alanı ile çeviri çağrıları uyumludur.
- [ ] `functions.php` PHP fatal, warning veya notice üretmez.
- [ ] Header ve footer `parts/` altında blok tema parçaları olarak yüklenir.
- [ ] `templates/index.html` geçerli blok markup içerir ve Site Editor'da açılır.
- [ ] Pattern PHP dosyaları doğrudan erişimi gerektirmez, çıktı sırasında PHP uyarısı üretmez ve çeviriye hazır metin stratejisiyle uyumludur.
- [ ] Blok doğrulayıcı “unexpected or invalid content” uyarısı göstermez.
- [ ] Editörde kaydet/aç döngüsünden sonra bloklar bozulmaz.
- [ ] Global stiller editör ve ön yüzde aynı font, renk ve genişlikleri üretir.
- [ ] `wp_body_open`, `wp_head` ve `wp_footer` çıktıları tema yapısında kaybolmaz.
- [ ] Tema, Kubio/Elementor/Spectra etkin olmadan temel kabuğu ve pattern'leri çalıştırır.
- [ ] PHP hata günlüğü ve tarayıcı konsolu temizdir.

## Görsel ve içerik kalitesi

- [ ] Newsreader yalnız başlıklarda; Manrope gövde/arayüzde; IBM Plex Mono yalnız etiket, konum ve dosya metadatasında sınırlı kullanılır.
- [ ] Gece laciverti, mürekkep panel, Marmara, mat pirinç, kâğıt ve taş tokenları tasarım belgesiyle eşleşir.
- [ ] Normal metin kontrastı en az 4.5:1; büyük metin en az 3:1; odak göstergesi komşu renklere karşı yeterlidir.
- [ ] 200% yakınlaştırmada içerik veya eylem kaybolmaz; iki yönlü yatay kaydırma gerekmez.
- [ ] Görseller base64 değildir; boyutları tanımlı, responsive ve uygun alt metinlidir.
- [ ] Dekoratif görseller boş alt metniyle veya erişilebilirlik ağacı dışında sunulur.
- [ ] Demo metni, `#` bağlantı, sahte iletişim eylemi veya dekoratif hukuk klişesi yoktur.

## Kabul kaydı

Test turunda aşağıdaki bilgiler kaydedilir:

- WordPress ve PHP sürümü
- Tarayıcı ve işletim sistemi
- Test edilen commit
- Genişlik ve yakınlaştırma seviyesi
- Geçen/başarısız madde
- Ekran görüntüsü veya hata günlüğü yolu
- Düzeltme sahibi ve tekrar test sonucu

Aşama 3 ancak kritik klavye, mobil navigasyon, odak, yatay taşma, blok doğrulama veya PHP hatası kalmadığında kabul edilir.
