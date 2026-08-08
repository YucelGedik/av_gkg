# Ana sayfa içerik inceleme kaydı

İncelenen editoryal kaynak: `content/pages/anasayfa.md`

## Kaynaklarla çapraz kontrol

| Ana sayfa unsuru | Dayanak | Sonuç |
|---|---|---|
| Kanonik isim | `rules.md` teknik ürün kararı 11 | Her bölümde **Av. Gülçin Kahraman Gedik** kullanıldı. |
| Konum bağlamı | `docs/design-direction.md` amacı; eski site envanteri | Kartal / İstanbul hero ve iletişim bağlamında kullanıldı; tam adres placeholder bırakıldı. |
| Tasarım bölümleri | `docs/design-direction.md` | Hero, gerçek portre, dosya etiketi, asimetrik makale yaklaşımı ve mobil hızlı eylemler için içerik sağlandı. |
| Hizmet kapsamı | Eski Primary Menu ve `migration/database-inventory.md` | Sekiz hizmet adı gerçek URL hedefleriyle eşleştirildi. |
| Öncelikli hizmetler | `migration/content-inventory.csv` | Kanser İlacı, Aile Hukuku ve Kira Tespit/Tahliye mevcut URL'leri korundu. |
| Makale durumu | `migration/database-inventory.md` | Gerçek makale bulunmadığı için kartlar “planlanan” olarak işaretlendi; demo yazı kullanılmadı. |
| Profil | Eski `/hakkimizda/` varlığı ve kanonik isim | Yalnız genel, ölçülü çalışma yaklaşımı kullanıldı; baro, sicil, eğitim ve yıl doğrulamaya bırakıldı. |
| İletişim | Eski `/iletisim/` ve form varlığı | Telefon, WhatsApp, e-posta, tam adres, saatler ve harita URL'si açık placeholder; gerçekmiş gibi veri üretilmedi. |
| Görsel | Medya envanterindeki portre adayları | Dosya seçimi yapılmadı; kullanıcı onaylı güncel portre zorunlu tutuldu. |

## İddia ve dil kontrolü

Metinde şu iddialar kullanılmadı:

- “Uzman”, “en iyi”, “lider”, “başarılı” veya üstünlük bildiren sıfatlar
- Kazanma, kabul, geri ödeme ya da sonuç garantisi
- Başarı oranı, müvekkil sayısı, dava sayısı veya deneyim yılı
- 7/24 ulaşılabilirlik
- Ücretsiz görüşme
- Doğrulanmamış baro, sicil, eğitim, mezuniyet derecesi veya yabancı dil bilgisi
- Türkiye'nin her yerinde hizmet veya benzeri doğrulanmamış coğrafi kapsam

“Takip edilir”, “değerlendirilir” ve “planlanır” ifadeleri çalışma sürecini anlatır; somut sonuç vaadi olarak kullanılmamıştır.

## Dönüşüm akışı kontrolü

| Bölüm | Birincil hedef | İkincil hedef | Durum |
|---|---|---|---|
| Hero | `/iletisim/` | `/hizmetlerimiz/` | Gerçek iç URL |
| Kanser ilacı vurgusu | `/kanser-ilaci-davalari/` | `/iletisim/` | Gerçek iç URL |
| Hizmetler | Sekiz hizmet detayı | `/hizmetlerimiz/` | Üç mevcut + beş oluşturulacak hedef |
| Profil | `/hakkimizda/` | — | Mevcut URL |
| Makaleler | Tekil yazılar | `/makaleler/` | Tekil yazılar yayımlanana kadar gizlenmeli |
| İletişim | Form anchor | Telefon / WhatsApp / yol tarifi | İç URL hazır; dış eylemler doğrulama bekliyor |

## URL çapraz kontrolü

Mevcut ve korunacak hedefler:

- `/`
- `/hizmetlerimiz/`
- `/hakkimizda/`
- `/iletisim/`
- `/kanser-ilaci-davalari/`
- `/aile-hukuku/`
- `/kira-tespit-ve-tahliye/`
- `/makaleler/`

Yeni oluşturulması gereken hizmet hedefleri:

- `/miras-hukuku/`
- `/is-ve-sosyal-guvenlik-hukuku/`
- `/idare-hukuku/`
- `/gayrimenkul-hukuku/`
- `/tuketici-hukuku/`

Ana sayfa kaynağı `/aile-hukuku-2/`, `/blog/`, eski GUID, `http://` medya URL'si veya `#` hedef kullanmaz.

## Açık doğrulama listesi

- [ ] Güncel ve yayında kullanılacak telefon numarası
- [ ] WhatsApp numarası ve `wa.me` URL'si
- [ ] Yayında kullanılacak e-posta adresi
- [ ] Tam büro adresi
- [ ] Google Maps yol tarifi URL'si
- [ ] Çalışma günleri ve saatleri
- [ ] Bağlı olunan baro ve sicil numarası
- [ ] Eğitim ve mesleğe başlangıç bilgilerinin kullanılacak kesin biçimi
- [ ] Varsa yabancı dil ve ek eğitim bilgileri
- [ ] Güncel portre ve sosyal paylaşım görseli
- [ ] Form alanları, veri saklama/iletim yöntemi ve başarı/hata akışı
- [ ] İlk üç gerçek makalenin başlığı, slug'ı, özeti ve yayın tarihi

## Editoryal uygulama notları

1. Placeholder metinleri WordPress ön yüzüne kopyalanmaz; ilgili bileşen doğrulama tamamlanana kadar gizlenir veya yalnız güvenli iç bağlantı gösterilir.
2. Ana sayfa ayrıntılı hukuki açıklama yerine ziyaretçiyi doğru hizmet sayfasına yönlendirir.
3. Hizmet açıklamaları aynı cümleyi çoğaltmaz; detay, belge ve SSS içerikleri hizmet sayfalarında ele alınır.
4. Makale sorgusu yalnız yayımlanmış gerçek `post` kayıtlarını göstermeli; sonuç yoksa demo kart basmamalıdır.
5. İletişim eylemlerinin görünür metni, erişilebilir adı ve gerçek hedefi yayın öncesinde birlikte test edilir.
6. Meta açıklamadaki Kartal / İstanbul ifadesi sayfadaki görünür konum bağlamıyla tutarlıdır.

## Sonuç

Ana sayfa metin kaynağı, mevcut site envanterindeki gerçek içerik sınırları ve “Marmara Dosyası” yerleşimiyle uyumludur. Metin ölçülü bir dönüşüm akışı kurar; doğrulanmamış başarı, uzmanlık veya sonuç iddiası içermez. Yayın için temel engeller gerçek iletişim bilgilerinin, özgeçmiş ayrıntılarının, güncel portrenin ve ilk makale URL'lerinin kullanıcı tarafından doğrulanmasıdır.
