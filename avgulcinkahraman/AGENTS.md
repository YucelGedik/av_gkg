# Proje çalışma kuralları

Bu klasör Av. Gülçin Kahraman web sitesi için tek kanonik çalışma alanıdır. Geçici Claude/Codex çıktı yollarındaki dosyalar doğrudan üretim kaynağı sayılmaz; onaylanan girdiler önce bu proje içine alınır.

## Zorunlu ilk adım

Bu proje üzerinde çalışan her ana ajan, alt ajan veya dış ajan herhangi bir inceleme, komut ya da dosya değişikliğinden önce kökteki `rules.md` dosyasının tamamını okumalıdır. Görev sahipliği ve dosya kapsamı `rules.md` içinde belirlenmeden düzenleme yapılamaz. Çelişki halinde kullanıcı talimatları ve üst düzey talimatlardan sonra `rules.md` uygulanır.

## Yetki ve koordinasyon

- Ana entegrasyon, mimari ve kalite kararları ana Codex ajanı tarafından koordine edilir.
- Alt ajanlar kendilerine verilen sınırlı işi yürütür ve bulgularını ana ajana iletir.
- Aynı dosyada paralel düzenleme yapılmaz; görev sahipliği önceden belirlenir.
- Kullanıcının mevcut dosyaları ve ham yedekleri korunur.

## Dizin sınırları

- `references/`: Salt okunur tasarım ve marka girdileri.
- `backups/`: Ham yedekler; açılmaz, düzenlenmez ve Git'e eklenmez.
- `src/`: Üretim WordPress tema ve özel site kodu.
- `content/`: Editoryal kaynaklar ve kontrollü import verileri.
- `runtime/`: Yerel çalışma çıktıları; Git'e eklenmez.
- `docs/` ve `migration/`: Kararlar, kontrol listeleri ve göç haritaları.

## Teknik ilkeler

- Canlı sitede doğrudan geliştirme yapılmaz.
- Üç domain içeren hosting arşivi topluca geri yüklenmez.
- Avukatlık sitesinin doğru veritabanı `u852346668_ZyDUq.20260722143455.sql.gz` dosyasıdır.
- Prototip tek parça Custom HTML olarak WordPress'e yapıştırılmaz.
- WordPress çekirdeği, üçüncü taraf eklentiler, uploads, cache, log ve gerçek ortam sırları Git'e alınmaz.
- Mobil navigasyon, klavye odağı, çalışan form ve telefon/WhatsApp bağlantıları tamamlanmadan özellik bitmiş sayılmaz.
- Eşinizin makale girişi WordPress'in doğal yazı editörü üzerinden kolay yapılabilmelidir.
