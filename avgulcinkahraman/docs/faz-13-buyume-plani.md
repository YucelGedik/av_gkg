# Faz 13 — Sürekli içerik ve büyüme planı

Son güncelleme: 9 Ağustos 2026. Bu doküman canlıya geçiş sonrası siteyi büyütmek için
dört rutini tanımlar: içerik takvimi, iç bağlantı, aylık raporlama ve bakım/yedekleme.

---

## 1. İlk 12 haftalık makale takvimi

Odak: kanser ilacı davaları (birincil, en yüksek arama niyeti ve dönüşüm) + destekleyici
hizmet alanları. Her makale bir hizmet sayfasını ve mümkünse bir emsal kararı destekler.
Hedef: haftada 1 makale, ~800–1200 kelime, tek net H1, öne çıkan görsel, kategori, iç bağlantı.

| Hafta | Makale başlığı (öneri) | Kategori | Hedef arama niyeti | Bağlanacak sayfa |
|---|---|---|---|---|
| 1 | SGK Karşılamadığı Kanser İlacı İçin Dava Nasıl Açılır? | Sağlık Hukuku | "sgk kanser ilacı ödemiyor ne yapmalıyım" | /kanser-ilaci-davalari/ |
| 2 | İhtiyati Tedbir Nedir? Kanser Tedavisinde Neden Hayati? | Sağlık Hukuku | "ilaç için ihtiyati tedbir" | /emsal-kararlar/ |
| 3 | Endikasyon Dışı İlaç Onayı Reddi ve İptal Davası (TİTCK) | Sağlık Hukuku | "endikasyon dışı ilaç onayı reddi" | /kanser-ilaci-davalari/ |
| 4 | Cepten Ödenen İlaç Bedeli SGK'dan Faiziyle Nasıl Geri Alınır? | Sağlık Hukuku | "ilaç parası geri alma sgk" | /emsal-kararlar/ |
| 5 | Keytruda / Opdivo / Tecentriq İçin SGK Dava Süreci | Sağlık Hukuku | ilaç adı + "sgk dava" | /kanser-ilaci-davalari/ |
| 6 | İş Mahkemesi mi İdare Mahkemesi mi? Doğru Dava Yolu | Sağlık Hukuku | "ilaç davası hangi mahkeme" | /emsal-kararlar/ |
| 7 | Anlaşmalı Boşanmada Protokol Nasıl Hazırlanır? | Aile Hukuku | "anlaşmalı boşanma protokolü" | /aile-hukuku/ |
| 8 | Velayet Davasında Çocuğun Üstün Yararı İlkesi | Aile Hukuku | "velayet nasıl alınır" | /aile-hukuku/ |
| 9 | Nafaka Türleri ve Miktarı Nasıl Belirlenir? | Aile Hukuku | "yoksulluk nafakası şartları" | /aile-hukuku/ |
| 10 | Kira Tespit Davası ve %25 Sınırı | (Kira Hukuku) | "kira tespit davası" | /kira-tespit-ve-tahliye/ |
| 11 | Tahliye Taahhüdü ile Kiracı Nasıl Çıkarılır? | (Kira Hukuku) | "tahliye taahhüdü" | /kira-tespit-ve-tahliye/ |
| 12 | Mirasta Saklı Pay ve Tenkis Davası | (Miras Hukuku) | "saklı pay tenkis" | /miras-hukuku/ |

Not: 10–12 için önce ilgili kategoriler (Kira, Miras) oluşturulmalı.

## 2. İç bağlantı rutini

Her yeni makale yayımlanırken:

1. Makale gövdesinde **en az 1 hizmet sayfasına** ve **1 emsal karara/ilgili makaleye** bağlantı ver.
2. İlgili hizmet sayfasına dönüp, yeni makaleye **geri bağlantı** ekle ("İlgili makaleler" bölümü).
3. Bağlantı metni (anchor) genel değil, hedefi tarif eden anahtar kelime olsun
   (kötü: "buraya tıklayın"; iyi: "kanser ilacı davası süreci").
4. Her makale sonunda net bir eylem: WhatsApp danışma veya iletişim formu.
5. Ayda bir kırık bağlantı taraması yap (Faz 10 aracı).

## 3. Aylık rapor şablonu

Her ayın ilk haftası doldurulur (kaynak: Search Console + Analytics — canlı sonrası bağlanacak):

```
AY: ____________
- Toplam ziyaretçi / oturum:        ____  (önceki ay: ____ , %değişim: ____)
- Organik arama trafiği:            ____
- En çok görüntülenen 5 sayfa:      1)__ 2)__ 3)__ 4)__ 5)__
- En çok tık getiren 5 arama sorgusu:1)__ 2)__ 3)__ 4)__ 5)__
- Dönüşümler (WhatsApp tık / form gönderimi / telefon tık): ____
- Yeni yayımlanan makale sayısı:    ____
- Ortalama sıralama değişen sorgular: ____
- Aksiyonlar (gelecek ay):          ____
```

## 4. Yedekleme ve bakım takvimi

| Sıklık | İş |
|---|---|
| Haftalık | Tam site + veritabanı yedeği (Hostinger otomatik + manuel kontrol); yeni makale yayını |
| Aylık | WordPress çekirdek, tema ve eklenti güncellemeleri (önce staging'de test); kırık bağlantı taraması; aylık raporun doldurulması |
| 3 Aylık | Düşük performanslı sayfaları güncelle; eski makaleleri tazeleyip tarih güncelle; güvenlik/erişilebilirlik gözden geçirme; form spam kontrolü |
| Yıllık | SSL/alan adı yenileme kontrolü; tüm hizmet içeriğinin mevzuat güncelliği; tam performans (Lighthouse) denetimi |

Kritik ilke: Güncellemeler **önce staging'de** denenir, sonra canlıya alınır; her büyük
değişiklik öncesi ayrı yedek alınır (Faz 4 güvenli çalışma ilkeleri).
