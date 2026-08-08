# Medya envanteri ve taşıma seçkisi

Tarih: 8 Ağustos 2026  
Kaynak: `runtime/restore-source/public_html/wp-content/uploads/`  
Durum: Salt okunur inceleme; bu aşamada hiçbir medya taşınmadı, yeniden adlandırılmadı veya optimize edilmedi.

## Kapsam ve sayılar

- Toplam 410 dosya, 38.989.275 bayt ve 53 dizin incelendi.
- 284 görsel dosyası bulundu: 224 JPG, 5 JPEG, 48 PNG, 5 WebP ve 2 SVG.
- Dosya adındaki WordPress `-GENİŞ LİKxYÜKSEKLİK` kalıbına göre 209 dosya otomatik thumbnail/türev, 75 dosya orijinal görsel olarak sınıflandırıldı.
- Kalan 126 dosya medya değil; ağırlıkla Astra şablon JSON cache'i, UAG derlenmiş CSS/JS, form eklentisi çıktıları, log ve içe aktarma dosyalarıdır.
- Seçilen ve koşullu aday orijinallerin makinece okunabilir kaydı `content/media-manifest.csv` dosyasındadır.

## Sınıflandırma kararları

| Sınıf | Karar | Örnekler |
|---|---|---|
| Gerçek portre | Seç/koşullu seç | `2025/12/PHOTO-2025-12-01-11-15-14.jpg`, `2024/09/Remove-bg.ai_1725995637743.png` |
| Logo/wordmark | Koşullu seç; vektör yeniden çizim kararı bekler | `2024/07/Ekran-Alintisi.png`, `2024/08/Gulcin-Kahraman-Gedik-Photoroom-1.png` |
| Hizmet/makale görseli | Koşullu seç; lisans/kaynak kontrolü gerekir | 2024/12 kanser, kira ve aile hukuku görselleri |
| WordPress thumbnail | Taşıma | Adı `-150x150`, `-300x...`, `-768x...`, `-1024x...` ile biten dosyalar |
| Tema demosu | Taşıma | `2021/05/` ve `2021/06/` altındaki hero, customer, gallery, client-logo ve CTA seti; `2022/08/demo-screenshot*` |
| Sahte/demo marka ve kişi | Taşıma | `logoipsum-logo-*`, `man*`, `woman*`, `customer-*`, `client-logo-*` |
| Jenerik stok hukuk/tıp | Varsayılan olarak taşıma | `stock-photo-judges-gavel-and-law-books*`, `topuz*`, `tanrica-themis*`, `desktop-wallpaper-4-medicine-medical-logo*`, uzun hash adlı stoklar |
| Builder/cache | Taşıma | `ast-block-templates-json/`, `astra-sites/`, `astra-docs/`, `uag-plugin/`, `st-importer/`, `ai-builder/` |
| Form cache/derlenmiş dosya | Taşıma | `forminator/`, `wpforms/cache/`, `wpforms/themes/` |
| Form kullanıcı yüklemesi | Bulunmadı | Uploads ağacında gerçek başvuru eki veya form kullanıcısı dosyası saptanmadı |

## Seçki

### 1. Ana portre

`2025/12/PHOTO-2025-12-01-11-15-14.jpg` birincil portredir. 1334×1536 piksel, JPEG ve 119.080 bayttır. Ofis ortamı, doğrudan bakış ve güncel görünüm nedeniyle ana sayfa hero ile Hakkımızda için en güçlü kaynaktır. Hero için 4:5 kadraj korunmalı; yüz ve kollar mobil kırpmada kesilmemelidir.

`2024/09/Remove-bg.ai_1725995637743.png` 960×1280 piksel şeffaf PNG'dir. Cübbe portresi olduğu için profil bağlamında kullanılabilir ancak daha eski görünüyor ve 1.424.325 bayttır. Ana portre yerine otomatik kullanılmamalı; kullanıcı onayı ve optimizasyon gerekir.

### 2. Logo

`2024/07/Ekran-Alintisi.png` mevcut mavi `AVUKAT GÜLÇİN KAHRAMAN` wordmark kaynağıdır. 650×161 piksel olduğu için retina header kullanımında sınırlıdır. Nihai sitede ekran görüntüsünü taşımak yerine isim standardı kesinleştirilip tasarım sistemine uygun SVG yeniden çizim tercih edilmelidir.

`2024/08/Gulcin-Kahraman-Gedik-Photoroom-1.png` dosya adına rağmen portre değil, gümüş renkli bir monogram logodur. Koyu zeminde referans olabilir; 500×500 görselin içindeki el yazısı küçük header boyutunda okunmaz. Ancak favicon/monogram çalışmasına görsel kaynak olabilir.

`2021/05/logo.svg` ve `logo-black.svg` eski tema demo paketiyle aynı tarih ve varlık grubundadır; mevcut markanın kanıtlanmış logosu kabul edilmedi ve seçkiye alınmadı.

### 3. Hizmet ve makale görselleri

- Kanser İlacı Davaları: 896×896 piksellik `..._2-1-edited.jpg` konuya uygun ve teknik olarak yeterli bir kart kaynağıdır. Stok/AI illüstrasyon izlenimi nedeniyle lisans veya üretim kaynağı doğrulanmalıdır.
- Kira Tespit ve Tahliye: 1024×768 piksellik `kira.jpg` anahtar ve sözleşme anlatımıyla konuya uygundur; belirgin stok görsel olduğu için lisans kontrolü gerekir.
- Aile Hukuku: 512×346 piksellik `unnamed-1.jpg` mevcut içerikle ilişkilidir fakat çözünürlüğü düşük ve kompozisyonu klişedir. Yalnızca geçici küçük kart görseli olabilir; geniş hero için kullanılmamalıdır.

Diğer hizmet alanları için doğrulanabilir, tutarlı ve yeterli kalitede özgün görsel seti bulunmadı. Rastgele eski stokları sekiz hizmete dağıtmak yerine yeni bir tutarlı görsel sistem üretilmelidir.

## Teknik kalite ve taşıma notları

1. Manifestte yalnızca orijinal dosyalar bulunur; mevcut WordPress thumbnail türevleri taşınmaz. Yeni WordPress kurulumunun kendi boyutlarını üretmesi gerekir.
2. Bu aşamada base64, kopyalama veya optimizasyon yapılmadı. Seçilen dosyalar sonraki göç adımında SHA-256 ile doğrulanarak kopyalanmalıdır.
3. Fotoğraflar için responsive WebP/AVIF türevleri, orijinal JPEG/PNG korunarak ayrı aşamada üretilmelidir.
4. Logo için raster dosyanın büyütülmesi yerine SVG yeniden çizimi tercih edilmelidir.
5. Dekoratif logo tekrarlarında `alt=""`; anlam taşıyan portre ve makale görsellerinde manifestteki bağlama özgü alt metinler kullanılmalıdır. Alt metinlerde `görseli`, `fotoğrafı` gibi gereksiz sözcükler kullanılmamalıdır.
6. Stok/AI olabilecek görseller yayına alınmadan önce kullanıcıdan kaynak veya lisans bilgisi istenmelidir. Kaynağı doğrulanamayan dosyalar yeni özgün varlıklarla değiştirilmelidir.

## Bağımlılıklar ve karar gerektiren noktalar

- Sitede kullanılacak adın `Gülçin Kahraman` mı, `Gülçin Kahraman Gedik` mi olacağı logo yeniden çiziminden önce kesinleşmelidir.
- Ana portre için 2025 ofis fotoğrafı önerildi; cübbe portresinin ikincil kullanımı kullanıcı kararı gerektirir.
- Üç makale/hizmet görselinin lisans veya kaynak bilgisi yedekte bulunmuyor.
- Diğer beş hizmet alanı için yeni ve tutarlı görsel üretimi/seçimi gerekir.
