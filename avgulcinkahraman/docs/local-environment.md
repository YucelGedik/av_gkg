# Yerel geliştirme ortamı

Son doğrulama: 8 Ağustos 2026

## Karar

Birincil yerel çalışma ortamı **WordPress Studio CLI + SQLite** olacaktır. Temiz WordPress kurulumu `runtime/wordpress/` altında tutulur. SQLite yalnız yerel geliştirme içindir; yayın öncesinde Hostinger staging ortamında PHP ve MariaDB ile zorunlu uyumluluk testi yapılır.

Doğrulanan yerel çalışma zamanı: WordPress 7.0.2, PHP 8.3, `http://localhost:8881`.

## Sistem denetimi

| Bileşen | Durum | Karar |
|---|---|---|
| Node.js | 24.13.0 | Kullanılabilir |
| npm | 11.6.2 | Kullanılabilir |
| Docker Desktop | 29.6.2 | WSL Windows bileşeni eksik olduğu için motor başlatılamıyor; Aşama 2 için kullanılmayacak |
| Docker Compose | 5.3.1 | Docker motoruna bağlı olduğu için şu anda kullanılamıyor |
| Sistem PHP | Kurulu değil | Studio kendi çalışma zamanını sağlayacak |
| MySQL/MariaDB | Kurulu değil | Yerelde SQLite; staging ortamında MariaDB doğrulaması |
| WP-CLI | Sistem genelinde kurulu değil | Studio CLI üzerinden kullanılacak |
| Composer | Kurulu değil | Bu aşama için gerekli değil |

## Docker hatasının nedeni

Docker Desktop kurulmuş olsa da Windows Subsystem for Linux isteğe bağlı bileşeni etkin değil. Docker bu nedenle Linux motorunu başlatamıyor. `wsl --install --no-distribution` ile etkinleştirme mümkündür fakat yönetici yetkisi ve çoğunlukla yeniden başlatma ister. Mevcut aşamayı kesintiye uğratmamak için bu işlem ertelenmiştir.

## Ortam sınırları

- Canlı site veya canlı veritabanı yerel geliştirmede kullanılmaz.
- Gerçek parola, SMTP anahtarı ve API anahtarı depoya yazılmaz.
- Yerel ve staging ortamlarında arama motoru indekslemesi kapalı tutulur.
- Yerel e-posta gönderimi gerçek alıcılara yönlendirilmez.
- SQLite ile çalışan her tema ve eklenti davranışı yayın öncesinde MariaDB üzerinde yeniden sınanır.

## Alternatifler

Ayrıntılı seçenek analizi ve geri dönüş yolu `docs/local-runtime-options.md` belgesindedir. Somut bir SQLite uyumsuzluğu görülürse taşınabilir PHP + MariaDB ortamı değerlendirilecektir. Docker seçeneği ancak WSL kurulumu ve yeniden başlatma kullanıcı için uygun olduğunda tekrar ele alınacaktır.
