# Av. Gülçin Kahraman Gedik — Proje Bağlamı ve Ajan Rehberi

## 🌐 Yerel Site Adresi
**http://localhost:8881/** — Bu adrese giderek siteyi canlı olarak gezebilirsin.

Sayfalar:
- Ana Sayfa: http://localhost:8881/
- Hizmetlerimiz: http://localhost:8881/hizmetlerimiz/
- Hakkımızda: http://localhost:8881/hakkimizda/
- Makaleler: http://localhost:8881/makaleler/
- İletişim: http://localhost:8881/iletisim/

---

## 📁 Proje Klasör Yapısı

```
c:/Users/yucel/Documents/ChatGPT/Av Gülçin Karaman/avgulcinkahraman/
│
├── src/                          ← WordPress kurulumu (burası çalışıyor)
│   ├── wp-content/
│   │   └── themes/
│   │       └── gulcin-kahraman/ ← Tüm tema dosyaları BURADADIR
│   │           ├── functions.php         ← SEO, meta, enqueue, form
│   │           ├── theme.json            ← Renk paleti, tipografi
│   │           ├── parts/
│   │           │   ├── header.html       ← Üst bar, ticker şeridi, nav menü
│   │           │   └── footer.html       ← Footer + yüzen iletişim butonu
│   │           ├── templates/
│   │           │   ├── front-page.html   ← Ana sayfa şablonu
│   │           │   ├── single.html       ← Makale detay şablonu
│   │           │   ├── index.html        ← Makale listesi
│   │           │   └── archive.html      ← Arşiv sayfası
│   │           └── assets/
│   │               ├── css/
│   │               │   ├── front-page.css   ← Ana sayfa stilleri + media queries
│   │               │   └── components.css   ← Header, footer, mobil stilleri
│   │               ├── js/
│   │               │   └── navigation.js    ← Hamburger menü + hızlı iletişim
│   │               └── images/              ← Logo, ilaç PNG görselleri
│   ├── sitemap.xml               ← Google için site haritası
│   └── robots.txt                ← Googlebot yönlendirmesi
│
└── scripts/
    └── smoke-test.ps1            ← 13 test içerir, hepsi PASS olmalı
```

---

## 🎨 Tasarım Sistemi (Marmara Paleti)

| Değişken | Renk | Kullanım |
|----------|------|----------|
| `--bg` | `#0f1317` | Sayfa arka planı |
| `--panel` | `#161d22` | Kart panelleri |
| `--gold` | `#c6a563` | Altın vurgular |
| `--gold2` | `#e2c98a` | Altın hover |
| `--tx` | `#e9e7e1` | Ana metin |
| `--mut` | `#9a988f` | İkincil metin |
| `--line` | `#252d34` | Sınır çizgileri |

**Tipografi:** Newsreader (başlıklar), Manrope (metin), IBM Plex Mono (kod)

---

## 👩‍⚖️ Müvekkil Bilgileri

- **Ad:** Av. Gülçin Kahraman Gedik
- **Büro:** Cevizli Mah. Ulubey Sok. Nursanlar 1 Plaza No:4A K:16 D:113 Kartal / İstanbul
- **Telefon:** +90 538 688 0573
- **E-posta:** info@avukatgulcinkahraman.com
- **WhatsApp:** https://wa.me/905386880573
- **Domain:** https://avukatgulcinkahraman.com (henüz canlı değil, lokal geliştirme)

---

## ✅ Tamamlanan Çalışmalar

1. **WordPress Blok Tema (FSE)** — Tamamen özgün, Marmara tasarım sistemi
2. **Ana Sayfa** — Hero, amblem, CTA butonları, öne çıkan alan, 4'lü hizmet kartları
3. **Kayan İlaç Ticker Şeridi** — 8 akıllı kanser ilacı PNG görsel + emsal kararlar, 140s hız
4. **Yüzen Hızlı İletişim Butonu** — WhatsApp / Mail / Telefon speed dial (sağ alt köşe)
5. **Hizmetlerimiz Sayfası** — 8 hizmet, 4 kolonlu kart grid
6. **Hakkımızda Sayfası** — Portre fotoğrafı, biyografi, ilkeler
7. **İletişim Sayfası** — Google Harita, form, iletişim bilgileri
8. **Makaleler Sistemi** — Kanser ilacı davası ve boşanma hukuku rehberleri
9. **Mobil & Tablet Uyum** — 1024px / 767px / 480px breakpoint'leri
10. **SEO Paketi** — Meta tags, Open Graph, Schema.org LegalService, sitemap.xml, robots.txt, lazy loading

---

## ⚙️ WP-CLI Kullanımı

```powershell
# Çalışma dizini:
cd "c:\Users\yucel\Documents\ChatGPT\Av Gülçin Karaman\avgulcinkahraman"

# WP-CLI komutu:
wp --path=src <komut>

# Örnek:
wp --path=src option get siteurl
wp --path=src post list
wp --path=src cache flush
```

---

## 🧪 Smoke Test

Her değişiklikten sonra çalıştır:
```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File scripts\smoke-test.ps1
```
**Beklenen sonuç:** `All smoke tests passed. (13/13 PASS)`

---

## 🔒 Dokunma — Risk Alanları

- `src/wp-config.php` — Veritabanı şifresi var, düzenleme
- `src/wp-content/uploads/` — Gerçek medya dosyaları
- **Sayfaları WP-CLI ile güncellerken** içeriği önce geçici dosyaya yaz, ardından `wp post update <id> <file>` kullan

---

## 📋 Sıradaki Açık İşler

- [ ] Canlı hosting'e taşıma / ZIP paketi hazırlama
- [ ] Google Search Console kaydı
- [ ] Google Business Profile oluşturma
