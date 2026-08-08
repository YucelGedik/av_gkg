# Av. Gülçin Kahraman web sitesi

Bu klasör, mevcut WordPress yedeği ile yeni tasarımın güvenli biçimde birlikte geliştirilmesi için düzenlenmiştir.

## Klasörler

- `references/`: Onaylanan prototip, marka ve görsel referansları. Üretim kodu değildir.
- `backups/`: Değiştirilmeyen ham hosting ve veritabanı yedekleri; Git dışında tutulur.
- `src/`: Git ile izlenecek yeni WordPress tema ve site kodu.
- `content/`: Hizmet, makale, SSS ve kontrollü içerik kaynakları.
- `docs/`: Tasarım sistemi, içerik eşlemesi ve teknik kararlar.
- `migration/`: Eski URL haritası, seçilmiş içerik ve medya göçü çıktıları.
- `runtime/`: Yerel WordPress, medya, veritabanı, önbellek ve log gibi Git dışı çalışma çıktıları.
- `scripts/`: Kurulum, göç ve test yardımcıları.
- `config/`: Gerçek parola içermeyen örnek ortam yapılandırmaları.

## Yedekler

- `backups/hosting-2026-07-22/u852346668.20260722143455.tar.gz`: Üç domain içeren hosting hesabı yedeği. Toplu olarak canlı sunucuya açılmamalıdır.
- `backups/hosting-2026-07-22/u852346668_ZyDUq.20260722143455.sql.gz`: `avukatgulcinkahraman.com` veritabanı.
- Diğer iki SQL yedeği avukatlık sitesine ait değildir.

## Çalışma ilkesi

Canlı site üzerinde doğrudan geliştirme yapılmaz. Yeni kod `src/` altında geliştirilir, `runtime/` içindeki yerel/staging WordPress üzerinde mobil, içerik, bağlantı, form ve performans kontrollerinden geçirilir; ardından kontrollü şekilde canlıya taşınır.
