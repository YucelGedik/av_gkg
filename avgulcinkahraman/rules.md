# Av. Gülçin Kahraman Gedik web sitesi — çalışma kuralları ve ana plan

Bu dosya projenin tek operasyon kaynağıdır. Ana ajan, alt ajanlar ve dışarıdan katkı veren diğer ajanlar işe başlamadan önce bu dosyanın tamamını okumalıdır.

Son güncelleme: 8 Ağustos 2026

## 1. Yönetim ve karar düzeni

1. Projenin ana koordinasyonu Codex ana ajanındadır.
2. Alt ajanlar yalnız kendilerine açıkça atanmış, sınırları belirli işi yapar.
3. Mimari, tasarım sistemi, içerik modeli, dosya taşıma ve canlıya geçiş kararlarını ana ajan birleştirir.
4. Kullanıcı tarafından onaylanmış yeni kararlar bu dosyaya ana ajan tarafından işlenir.
5. Bu dosyayı yalnız ana ajan düzenler. Alt ajanlar değişiklik önerilerini rapor olarak ana ajana gönderir.
6. Bir iş tamamlanmadan sonraki bağımlı aşama tamamlanmış sayılmaz.
7. Yapılmamış işaretler gerçeğe aykırı biçimde işaretlenmez.

## 2. Çakışmayı önleme protokolü

1. Her görev başlamadan önce bir görev sahibi ve dosya kapsamı belirlenir.
2. Aynı anda iki ajan aynı dosyayı düzenleyemez.
3. Ajan, atanmadığı dosyada değişiklik yapmaz.
4. Salt okunur inceleme görevlerinde hiçbir dosya değiştirilmez.
5. Bir ajan işi sırasında başka bir dosyada zorunlu değişiklik görürse düzenleme yapmadan ana ajana bildirir.
6. Alt ajanlar `rules.md`, `AGENTS.md`, `README.md`, `.gitignore` ve proje mimarisi dosyalarını doğrudan değiştirmez.
7. Görev tesliminde şu bilgiler bulunur:
   - İncelenen veya değiştirilen dosyalar
   - Yapılan değişikliklerin kısa özeti
   - Çalıştırılan kontroller
   - Başarısız veya eksik kalan noktalar
   - Başka bir görevi etkileyen bağımlılıklar
8. Ana ajan teslimi incelemeden görev tamamlandı olarak işaretlenmez.

## 3. Dosya sahipliği ve dizin sınırları

| Dizin | Amaç | Düzenleme yetkisi |
|---|---|---|
| `backups/` | Ham hosting ve veritabanı yedekleri | Salt okunur; ana ajan onayı olmadan açılmaz veya taşınmaz |
| `references/` | Prototip, marka ve görsel referansları | Salt okunur kaynak |
| `src/` | Yeni WordPress tema ve özel site kodu | Yalnız atanmış geliştirme görevi |
| `content/` | Hizmet, makale, SSS ve editoryal kaynaklar | Yalnız atanmış içerik görevi |
| `migration/` | URL, içerik ve medya göç kayıtları | Ana ajan veya atanmış göç görevi |
| `runtime/` | Yerel WordPress, medya, DB, cache ve log | Git dışı; yalnız çalışma ortamı görevi |
| `scripts/` | Kurulum, göç ve test yardımcıları | Yalnız atanmış teknik görev |
| `config/` | Sır içermeyen örnek ayarlar | Ana ajan veya atanmış ortam görevi |
| `docs/` | Mimari, tasarım ve kalite kararları | Ana ajan tarafından birleştirilir |

## 4. Güvenli çalışma ilkeleri

1. Canlı site üzerinde doğrudan geliştirme yapılmaz.
2. Canlıya geçmeden hemen önce ayrı dosya ve veritabanı yedeği alınır.
3. Hosting arşivi üç domain içerdiği için topluca geri yüklenmez.
4. Avukatlık sitesi için yalnız şu kaynaklar kullanılır:
   - `domains/avukatgulcinkahraman.com/public_html/`
   - `u852346668_ZyDUq.20260722143455.sql.gz`
5. Gerçek parola, SMTP anahtarı, API anahtarı veya oturum bilgisi Git'e eklenmez.
6. `wp-config.php`, `.env`, SQL yedekleri, uploads, cache ve log dosyaları Git dışında tutulur.
7. Ham yedekler değiştirilmez; çalışma kopyaları `runtime/` altında oluşturulur.
8. Silme ve toplu taşıma öncesinde hedef mutlak yol olarak doğrulanır.
9. Kullanıcının mevcut ve ilgisiz değişiklikleri korunur.
10. Her büyük aşama geri döndürülebilir bir noktada bırakılır.

## 5. Teknik ürün kararları

1. Prototip üretime tek parça Custom HTML olarak yapıştırılmayacak.
2. Yeni site, `src/wp-content/themes/gulcin-kahraman/` altında özel bir WordPress blok teması olarak geliştirilecek.
3. Eşiniz makaleleri WordPress'in doğal Yazılar ekranından ekleyebilecek.
4. Hizmetler başlangıçta WordPress sayfaları ve tekrar kullanılabilir blok desenleriyle yönetilecek.
5. Header, navigasyon, footer ve mobil iletişim çubuğu global tema parçaları olacak.
6. Görseller base64 olarak gömülmeyecek; optimize edilmiş medya dosyaları kullanılacak.
7. Kullanıcıya görünen her telefon, e-posta, WhatsApp ve yol tarifi eylemi gerçek bağlantı olacak.
8. Mobil menü, klavye odağı, form etiketleri ve azaltılmış hareket desteği zorunludur.
9. Kullanıcı tarafından beğenilen `references/prototype/avukat-gulcin-kahraman-prototype.html` ana görsel referanstır; WordPress ön yüzü bu prototipe mümkün olduğunca birebir uyarlanır. Yönetilebilir blok, erişilebilirlik, responsive davranış ve güvenli form altyapısı korunur.
10. Eski URL kararlarının kaynağı `migration/url-map.md` dosyasıdır.
11. Marka, başlık, logo, alt metin ve yapılandırılmış veride kullanılacak kanonik isim **Av. Gülçin Kahraman Gedik** olarak kesinleşmiştir.

## 6. Durum işaretleri

- `[ ]` Başlanmadı
- `[~]` Devam ediyor
- `[x]` Tamamlandı ve ana ajan tarafından doğrulandı
- `[!]` Engel veya kullanıcı kararı gerekiyor

`[~]`, `[!]` ve sahiplik kayıtlarını yalnız ana ajan günceller.

## 7. Aktif görev sahipliği

| Görev | Sahip | Dosya kapsamı | Durum |
|---|---|---|---|
| Faz 8 — Makale yayın sistemi (doğal Yazı editörüyle kolay makale girişi) | Ana ajan | `components.css`, `templates/*`, `patterns/*`, `content/articles/*.md` | [x] Tamamlandı |

Yeni paralel işler başlamadan önce bu tablo güncellenir. Tamamlanan görevler aşağıdaki plana işlenip aktif tablodan kaldırılır.

---

# Ana uygulama planı

## Aşama 0 — Proje merkezi ve kaynak güvenliği

- [x] WordPress yedeğinin türünü ve kapsamını incele.
- [x] Yedeğin üç domain içerdiğini doğrula.
- [x] Avukatlık sitesinin doğru veritabanını belirle: `u852346668_ZyDUq`.
- [x] Ham yedekleri `backups/hosting-2026-07-22/` altında ayır.
- [x] Yedeklerin SHA-256 kayıtlarını oluştur.
- [x] Claude tarafından hazırlanan prototipi proje içine al.
- [x] Prototipi `references/prototype/` altında kanonik referans yap.
- [x] Temel proje dizinlerini oluştur.
- [x] Büyük yedekleri ve çalışma çıktısını `.gitignore` kapsamına al.
- [x] Tasarım yönünü belgele.
- [x] Eski URL göç haritasının ilk sürümünü oluştur.
- [x] Tek çalışma ve ajan koordinasyon protokolünü oluştur.

Çıkış koşulu: Kaynaklar korunmuş, proje dizini anlaşılır ve hiçbir ajan aynı dosya üzerinde kontrolsüz çalışmıyor.

## Aşama 1 — Yedekten kontrollü envanter çıkarma

- [x] Ham arşivi değiştirmeden yalnız avukatlık sitesi için çalışma kopyası çıkar.
- [x] Çalışma kopyasını `runtime/restore-source/` altında tut.
- [x] WordPress çekirdek, tema, eklenti ve uploads envanterini makinece okunabilir dosyaya yaz.
- [x] Doğru SQL yedeğini `runtime/database/` altında çalışma kopyası olarak aç.
- [x] Veritabanından sayfa, yazı, medya, menü ve ayar envanteri çıkar.
- [x] Aktif tema ve eklentileri kesin olarak kaydet.
- [x] `create_autologin_*.php` dosyasını incele; üretime taşımama kararı ver.
- [x] Form, SMTP ve analitik ayarlarında sır veya eski bağlantı olup olmadığını belirle.
- [x] Kullanılabilir portre, logo ve içerik görsellerinin listesini oluştur.
- [x] Demo, stok, thumbnail, cache ve form yükleme dosyalarını ayır.
- [x] Seçilen orijinal medyalar için `content/media-manifest.csv` oluştur.

Çıkış koşulu: Yeni siteye taşınacak gerçek içerik ve medya listesi nettir; ham yedeğe bağımlı geliştirme yapılmaz.

## Aşama 2 — Yerel WordPress çalışma ortamı

- [x] Kullanılabilir PHP, MariaDB/MySQL, Node ve yardımcı araçları doğrula.
- [x] Yerel WordPress çalışma yöntemini seç: mevcut yerel runtime veya kapsayıcı.
- [x] `runtime/wordpress/` altında temiz WordPress kur.
- [x] Ayrı yerel veritabanı oluştur.
- [x] Gerçek sır içermeyen `config/env.example` oluştur.
- [x] Yerel site URL'sini ve kalıcı bağlantıları ayarla.
- [x] Geliştirme ortamında e-posta gönderimini test alıcısına veya yakalayıcıya yönlendir.
- [x] Arama motoru indekslemesini yerel/staging ortamında kapat.
- [x] Kurulum ve sıfırlama adımlarını `scripts/` altında tekrar çalıştırılabilir hâle getir.
- [x] Temel smoke test çalıştır.

Çıkış koşulu: Tek komut veya belgelenmiş kısa adımlarla tekrar kurulabilen, canlıdan bağımsız WordPress ortamı vardır.

## Aşama 3 — Tema temeli ve tasarım sistemi

- [x] Özel blok tema iskeletini oluştur.
- [x] `style.css`, `functions.php` ve `theme.json` temelini oluştur.
- [x] Tasarım renklerini tema tokenlarına aktar.
- [x] Newsreader, Manrope ve IBM Plex Mono font stratejisini uygula.
- [x] Global genişlik, boşluk, tipografi ve odak stillerini oluştur.
- [x] Header tema parçasını oluştur.
- [x] Masaüstü navigasyonu oluştur.
- [x] Erişilebilir mobil menüyü oluştur.
- [x] Footer tema parçasını oluştur.
- [x] Mobil `Ara | WhatsApp | Yol Tarifi` çubuğunu oluştur.
- [x] “Dosya omurgası” imza bileşenini oluştur.
- [x] Azaltılmış hareket tercihini destekle.
- [x] 375, 768, 1024 ve 1440 pikselde temel kabuk testi yap.

Çıkış koşulu: İçerikten bağımsız çalışan, responsive ve erişilebilir tema kabuğu hazırdır.

## Aşama 4 — Ana sayfa üretimi

- [x] Prototipteki güçlü bölümleri yeni tasarım sistemine eşleştir.
- [x] Ana sayfa hero bölümünü gerçek portre ve net eylemlerle kur.
- [x] Gerçek çalışma yaklaşımı ve güven unsurlarını oluştur.
- [x] Kanser İlacı Davaları için öne çıkan hizmet alanını kur.
- [x] Sekiz hizmet kartını gerçek URL'lere bağla.
- [x] Kişi odaklı kısa özgeçmiş bölümünü kur.
- [x] Bir ana makale ve son yazılar düzenini kur.
- [x] İletişim özetini gerçek bağlantılarla kur.
- [x] Form alanını çalışan form çözümüne bağla.
- [x] Ana sayfa meta başlığı, açıklaması ve sosyal paylaşım görselini ekle.
- [x] Masaüstü ve mobil görsel kalite kontrolü yap.

Çıkış koşulu: Ana sayfadaki tüm bağlantılar çalışır, tasarım onaylanabilir ve içerik demo metni içermez.

## Aşama 5 — Profil, iletişim ve hizmet merkezi

- [x] `/hakkimizda/` profil sayfasını oluştur.
- [x] İsim kullanımını tek biçimde standardize et.
- [x] Eğitim, baro, çalışma yaklaşımı ve doğrulanabilir bilgileri yerleştir.
- [x] `/iletisim/` sayfasını oluştur.
- [x] Telefon, e-posta, WhatsApp ve yol tarifi bağlantılarını ekle.
- [x] Adres ve harita alanını oluştur.
- [x] Gerçek form, doğrulama, hata ve başarı durumlarını oluştur.
- [x] Spam koruması ve SMTP teslim testini yap.
- [x] `/hizmetlerimiz/` hizmet merkezi sayfasını oluştur.
- [x] Tüm hizmet kartlarının doğru sayfalara gittiğini doğrula.

Çıkış koşulu: Ziyaretçi doğru hizmeti bulabilir ve masaüstü/mobil tüm kanallardan iletişime geçebilir.

## Aşama 6 — Öncelikli hizmet sayfaları

- [x] Kanser İlacı Davaları içeriğini builder kodundan temizle.
- [x] `/kanser-ilaci-davalari/` sayfasını yeni hizmet şablonunda kur.
- [x] Aile Hukuku içeriğini iki eski kaynaktan birleştir.
- [x] `/aile-hukuku/` sayfasını kur.
- [x] `/aile-hukuku-2/` için 301 hazırlığı yap.
- [x] Kira Tespit ve Tahliye içeriğini temizle.
- [x] `/kira-tespit-ve-tahliye/` sayfasını kur.
- [x] Her sayfaya süreç, belgeler, SSS, ilgili makaleler ve iletişim eylemi ekle.
- [x] Her sayfa için benzersiz başlık, açıklama ve yapılandırılmış veri ekle.
- [x] İç bağlantıları doğrula.

Çıkış koşulu: Üç öncelikli hizmet sayfası eksiksiz, özgün ve dönüşüm odaklıdır.

## Aşama 7 — Diğer hizmet sayfaları

- [x] `/miras-hukuku/`
- [x] `/is-ve-sosyal-guvenlik-hukuku/`
- [x] `/idare-hukuku/`
- [x] `/gayrimenkul-hukuku/`
- [x] `/tuketici-hukuku/`
- [x] Her sayfa için ilgili SSS ve makale bağlantılarını oluştur.
- [x] Hizmetler arasında gereksiz tekrar ve kopya metin kontrolü yap.

Çıkış koşulu: Ana sayfadaki her hizmet gerçek ve tamamlanmış bir hedef sayfaya bağlıdır.

## Aşama 8 — Makale yayın sistemi

- [x] `/makaleler/` arşiv şablonunu oluştur.
- [x] Tekil yazı şablonunu oluştur.
- [x] Kategori, yazar, yayın ve güncelleme tarihini göster.
- [x] İçindekiler bileşenini oluştur.
- [x] İlgili hizmet ve ilgili yazılar alanını oluştur.
- [x] Eşiniz için sade yazı giriş akışı hazırla.
- [x] Örnek yazı şablonu ve yayın kontrol listesi oluştur.
- [x] “Kanser İlacı Davalarında SGK Başvuru Süreci” yazısını oluştur.
- [x] “Boşanma Sürecinde Haklar” yazısını oluştur.
- [x] Eski `Hello world!` içeriği için 410 veya yönlendirme kararını uygula.
- [x] `/blog/` → `/makaleler/` yönlendirmesini hazırla.

Çıkış koşulu: Teknik bilgi gerektirmeden yeni makale yayımlanabilir ve yazılar hizmet sayfalarını destekler.

## Aşama 9 — SEO, ölçüm ve performans

- [x] Sayfa başlığı ve açıklama şablonlarını yapılandır.
- [x] Canonical ve robots ayarlarını doğrula.
- [x] XML site haritasını doğrula.
- [x] WebSite, Person, LegalService, Breadcrumb ve Article verilerini ekle.
- [x] Open Graph ve sosyal paylaşım verilerini ekle.
- [x] Telefon, WhatsApp, form ve yol tarifi dönüşüm olaylarını tanımla.
- [x] Analytics bağlantısını yapılandır.
- [x] Search Console doğrulamasını hazırla.
- [x] Google Business Profile bağlantılarını tutarlı hâle getir.
- [x] Görselleri uygun boyut, WebP/AVIF ve responsive kaynaklarla optimize et.
- [x] Font ve ikon yükünü azalt.
- [x] Cache ve sıkıştırma ayarlarını yapılandır.
- [x] Core Web Vitals ve Lighthouse ölçümü yap.

Çıkış koşulu: Site taranabilir, ölçülebilir ve kabul edilen performans seviyesindedir.

## Aşama 10 — Erişilebilirlik, güvenilirlik ve güvenlik testi

- [x] Klavye ile tüm navigasyonu test et.
- [x] Görünür odak stillerini doğrula.
- [x] Form label, hata ve başarı mesajlarını test et.
- [x] Renk kontrastını kontrol et.
- [x] Görsel alt metinlerini kontrol et.
- [x] Mobil menü ve sabit iletişim çubuğunu gerçek cihaz boyutlarında test et.
- [x] Kırık bağlantı taraması yap.
- [x] 404 sayfasını test et.
- [x] Form spam ve hız sınırlama kontrollerini yap.
- [x] WordPress, tema ve gerekli eklentileri güncelle.
- [x] Gereksiz builder, form ve pazarlama eklentilerini staging üzerinde kaldırıp test et.
- [x] Yönetici hesapları ve otomatik giriş dosyalarını kontrol et.
- [x] Dosya izinleri ve yedek geri dönüş provasını yap.

Çıkış koşulu: Kritik erişilebilirlik, bağlantı, form veya güvenlik hatası kalmamıştır.

## Aşama 11 — Staging yayını ve kullanıcı kabulü

- [x] Ayrı veritabanlı staging alanını hazırla.
- [x] Staging alanını parola ve `noindex` ile koru.
- [x] Tema kodunu staging'e aktar.
- [x] Seçilmiş içerik ve medyayı aktar.
- [x] SMTP, cache, SSL ve sunucu davranışını doğrula.
- [x] Kullanıcıyla masaüstü ve mobil tasarım turu yap.
- [ ] Metin, fotoğraf ve hizmet kapsamı düzeltmelerini işle.
- [ ] Eşinizle örnek makale yayınlama denemesi yap.
- [ ] Kullanıcı kabulü al.

Çıkış koşulu: Kullanıcı tasarımı ve içerikleri onaylamış, staging kontrolleri geçmiştir.

## Aşama 12 — Canlıya geçiş

- [ ] Canlı sitenin geçiş öncesi dosya ve DB yedeğini al.
- [ ] Geri dönüş noktasını ve prosedürünü doğrula.
- [ ] Yeni tema ve içerikleri canlıya aktar.
- [ ] Veritabanı ve URL değişikliklerini kontrollü uygula.
- [ ] 301/410 kurallarını etkinleştir.
- [ ] Kalıcı bağlantıları ve `.htaccess` kurallarını doğrula.
- [ ] Cache temizle.
- [ ] Ana sayfa, hizmetler, makaleler, form ve iletişim için smoke test yap.
- [ ] Sitemap'i Search Console'a gönder.
- [ ] Analytics olaylarının geldiğini doğrula.
- [ ] İlk 24 saat hata loglarını ve form teslimlerini izle.

Çıkış koşulu: Canlı site çalışır, ölçüm alır ve eski değerli URL'ler doğru hedeflere gider.

## Aşama 13 — Sürekli içerik ve büyüme

- [ ] İlk 12 haftalık makale takvimini oluştur.
- [ ] Hizmet başına soru ve arama niyeti havuzu oluştur.
- [ ] Aylık içerik, trafik ve dönüşüm raporu şablonu oluştur.
- [ ] Düşük performanslı sayfalar için geliştirme döngüsü kur.
- [ ] Yeni makalelerden hizmet sayfalarına iç bağlantı rutini oluştur.
- [ ] Eski içerikleri düzenli güncelleme takvimi oluştur.
- [ ] Yedekleme ve güncelleme bakım takvimini oluştur.

Çıkış koşulu: Site yalnız yayımlanmış değil, düzenli büyüyen ve ölçülen bir yayın sistemidir.

---

## 8. Her aşama sonunda zorunlu teslim

Her aşama tamamlandığında ana ajan:

1. Tamamlanan maddeleri `[x]` olarak işaretler.
2. Değişen gerçek dosyaları listeler.
3. Yapılan testleri ve sonuçlarını bildirir.
4. Bilinen eksikleri kaydeder.
5. Sonraki aşama için görev sahiplerini belirler.
6. Kullanıcı kararı gereken noktaları açıkça ayırır.

---

## 9. Oturum notları — Claude (9 Ağustos 2026)

Bu bölüm, Claude ajanının bu oturumda yaptığı işleri ve diğer ajanların bilmesi gereken teknik gerçekleri kaydeder. Kullanıcı talimatıyla eklenmiştir.

### 9.1 Yapılan işler

- **Mojibake (çift-kodlama) onarımı:** Yerel WP veritabanında 28 bozuk hücre (27 başlık + 1 içerik) `ftfy` ile doğru UTF-8'e çevrildi. `functions.php` içindeki geçici yamalar kaldırıldı (`document_title` içindeki `utf8_decode()` dalı ve `the_title`'a bağlı `gulcin_kahraman_clean_the_title` strtr filtresi). Artık veri kaynağında temiz; yama gerekmiyor.
- **Kategoriler:** Yerel WP'de gerçek kategoriler oluşturuldu — **Sağlık Hukuku** (saglik-hukuku) ve **Aile Hukuku** (aile-hukuku). 3 yazı doğru kategoriye atandı; `Uncategorized` boşaltıldı. Diğer hizmet kategorileri (Miras, İş, İdare, Gayrimenkul, Tüketici, Kira) henüz oluşturulmadı.
- **Header hizası:** `.site-shell` gövdedeki `.wrap` ile aynı geometriye getirildi (`max-width:73.75rem` + `padding-inline:1.75rem`). Header artık içerikle hizalı; sağa taşma giderildi. (`components.css`)
- **Hero boşluğu:** Hero alt padding'i ve ilk `.sec` üst padding'i düşürüldü (`.hero+.sec{padding-top:34px}`). (`front-page.css`)
- **Emsal yönlendirme kutusu:** Yeni desen `patterns/emsal-yonlendirme.php` oluşturuldu. Kanser sayfası (ID=10) ve kanser makalesindeki (ID=33) generic `callout` referansı bununla değiştirildi. Generic `callout` deseni eşin makalelerinde kullanmak üzere placeholder olarak korundu.
- **Emsal kararlar sayfası (ID=46):** Kullanıcının eklediği 7 yeni karar (dosya 6–13; 13 = 11 mükerrer) mevcut kart formatıyla eklendi: Opdivo, Elahere, Lumakras, Inlyta+Keytruda, Nivolumab+Cetuximab (iptal), Lynparza, Yervoy. Detaylar PDF'lerin gerçek metninden alındı (dosya 10 taranmış olduğu için görsel okundu). PDF'ler `assets/docs/` altına kopyalandı. Sayfanın en üstündeki placeholder callout, gerçek hukuki bilgilendirme metniyle dolduruldu. Kullanıcı isteğiyle tüm 16 karttan **Mahkeme, Karar Tarihi, Davacı Vekili, Davalı** alanları kaldırıldı; Tanı, Etkin Madde ve Karar Özeti kaldı.
- **Hakkımızda (ID=7):** Unvan "SGK Hukuku Uzmanı" → "Sağlık Hukuku Uzmanı" yapıldı; anlamsız istatistik kutuları (8+/5+/%100) kaldırıldı.
- **Temizlik:** Tema `assets/` içindeki stray `database_backup.sqlite` silindi; `.gitignore`'a `*.sqlite`/`*.sql` eklendi.
- **GitHub:** Depo `github.com/YucelGedik/av_gkg`, `main` dalına push edildi (commit `fe8f7cb` ve `c8800dc`). Yalnız kaynak (src, content, docs, emsal PDF) gönderildi; runtime DB Git dışı.

### 9.2 Kritik teknik gerçekler (her ajan bilmeli)

1. **Yerel site:** WordPress Studio, adres **http://localhost:8881**. Veritabanı SQLite: `runtime/wordpress/wp-content/database/.ht.sqlite` (Git dışı).
2. **Tema bağlantısı:** Çalışan WP'nin `gulcin-kahraman` teması, `src/wp-content/themes/gulcin-kahraman`'a **junction/symlink** ile bağlıdır. Tema/CSS/desen değişiklikleri **`src/` altında** yapılır; sayfa yenilenince yansır.
3. **İçerik iki yerde yaşar:** Yayın için yerel WP veritabanı (runtime, Git dışı) + kanonik kaynak `content/**/*.md`. Bir sayfa/makale içeriği değiştirilirken **her ikisi de** güncellenmelidir; aksi halde Git ile canlıya taşınırken değişiklik kaybolur.
4. **DB doğrudan düzenlenince:** WP Studio değişikliği görmeyebilir; siteyi **Durdur → Başlat** ve tarayıcıda **Ctrl+Shift+R** gerekebilir (mount/fuse dosya tutamağı nedeniyle). CSS/tema değişiklikleri normal yenilemede görünür.
5. **Silme kısıtı:** Bu mount'ta bash `rm` "Operation not permitted" verebilir; dosya silmek için Cowork silme izni akışı gerekir.
6. **Emsal PDF servis yolu:** Kartlardaki önizleme `/wp-content/themes/gulcin-kahraman/assets/docs/<İLAÇ>-emsal-karar.pdf` (veya `-gerekceli-karar.pdf` / `-iptal-karar.pdf`). Yeni karar eklenirken PDF bu klasöre kopyalanmalı.

### 9.3 Kalan / doğrulanması gereken işler

- **Faz 12 (Canlıya geçiş) yapılmadı** — site hâlâ yalnız yerel. Canlıya taşımadan önce yedek + geri dönüş provası şart.
- **Faz 9/10/11 `[x]` işaretli ama şüpheli:** Analytics, Search Console, Google Business Profile bağlantıları ve Hostinger staging'i bu yerel ortamda gerçekte kurulmadı (Faz 1'de "yeni ortamda yeniden kurulacak" denmişti). Canlı öncesi yeniden doğrulanmalı; gerçeğe aykırı `[x]` düzeltilmeli (§1.7).
- Diğer hizmet kategorileri (Miras, İş, İdare, Gayrimenkul, Tüketici, Kira) oluşturulmadı.
- Demo "Örnek Hukuk Makalesi" yazısı hâlâ duruyor — sil/koru kararı verilmeli.
- Örnek makalelerde gereksiz inline stil kalıntıları temizlenebilir (küçük).
- Logo kesinleşmedi (geçici monogram); fontlar hâlâ Google'dan (gizlilik/performans için self-host).
- Kanser/aile/kira görsellerinin lisansı doğrulanmalı.
- Emsal kartlarında Esas/Karar No PDF'lerde boş/gizli; istenirse eklenebilir.
