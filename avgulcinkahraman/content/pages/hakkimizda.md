<!-- wp:html -->
<style>
.about-hero-wrap {
  display: flex;
  align-items: flex-start;
  gap: 48px;
  margin-bottom: 48px;
}
.about-hero-photo {
  flex: 0 0 300px;
  position: relative;
}
.about-hero-photo img {
  width: 300px;
  border-radius: 14px;
  box-shadow: 0 24px 60px rgba(0,0,0,0.6);
  display: block;
}
.about-hero-photo::before {
  content: '';
  position: absolute;
  inset: -3px;
  border-radius: 16px;
  background: linear-gradient(135deg, var(--gold,#c6a563), transparent 60%);
  z-index: -1;
}
.about-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 16px;
  padding: 8px 18px;
  background: rgba(198,165,99,0.15);
  border: 1px solid rgba(198,165,99,0.4);
  border-radius: 30px;
  font-size: 12.5px;
  font-weight: 600;
  color: var(--gold,#c6a563);
  letter-spacing: 0.04em;
  width: 100%;
  justify-content: center;
  box-sizing: border-box;
}
.about-hero-text {
  flex: 1 1 0;
  min-width: 0;
}
.about-hero-name {
  font-size: 2rem;
  font-family: var(--wp--preset--font-family--display, Newsreader, serif);
  color: #f3eee4;
  margin: 0 0 4px 0;
  line-height: 1.2;
}
.about-hero-title {
  font-size: 0.95rem;
  color: var(--gold,#c6a563);
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  margin: 0 0 20px 0;
}
.about-hero-divider {
  width: 48px;
  height: 3px;
  background: linear-gradient(90deg, var(--gold,#c6a563), transparent);
  border-radius: 2px;
  margin-bottom: 22px;
}
.about-hero-bio {
  font-size: 1.08rem;
  line-height: 1.85;
  color: #d4cfc6;
  margin-bottom: 18px;
}
.about-stats-row {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  margin-top: 28px;
}
.about-stat-card {
  flex: 1 1 120px;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(198,165,99,0.25);
  border-radius: 10px;
  padding: 16px 20px;
  text-align: center;
}
.about-stat-number {
  font-size: 1.9rem;
  font-weight: 700;
  color: var(--gold,#c6a563);
  line-height: 1;
  margin-bottom: 6px;
}
.about-stat-label {
  font-size: 11.5px;
  color: #8a8478;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  font-weight: 600;
}
.about-principles-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin: 40px 0;
}
.about-principle-card {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.07);
  border-top: 3px solid var(--gold,#c6a563);
  border-radius: 10px;
  padding: 24px 20px;
  transition: transform 0.2s, box-shadow 0.2s;
}
.about-principle-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 40px rgba(0,0,0,0.4);
}
.about-principle-icon {
  font-size: 28px;
  margin-bottom: 12px;
  display: block;
}
.about-principle-title {
  font-size: 1rem;
  font-weight: 700;
  color: #f3eee4;
  margin-bottom: 8px;
}
.about-principle-desc {
  font-size: 13px;
  line-height: 1.7;
  color: #8a8478;
}
.about-credentials-row {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  margin: 0;
  padding: 0;
  list-style: none;
}
.about-cred-item {
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 8px;
  padding: 12px 18px;
  flex: 1 1 200px;
}
.about-cred-icon {
  font-size: 20px;
}
.about-cred-content {}
.about-cred-label {
  font-size: 11px;
  color: #6b675f;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  font-weight: 600;
}
.about-cred-value {
  font-size: 13.5px;
  color: #d4cfc6;
  font-weight: 500;
  line-height: 1.4;
}
.about-section-heading {
  font-size: 1.4rem;
  color: #f3eee4;
  font-family: var(--wp--preset--font-family--display, Newsreader, serif);
  margin: 40px 0 20px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.about-section-heading::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(255,255,255,0.08);
}
@media (max-width: 700px) {
  .about-hero-wrap { flex-direction: column; gap: 28px; }
  .about-hero-photo { flex: none; width: 100%; }
  .about-hero-photo img { width: 100%; max-width: 300px; margin: 0 auto; }
  .about-principles-grid { grid-template-columns: 1fr; }
}
</style>

<div class="about-hero-wrap">
  <div class="about-hero-photo">
    <img src="/wp-content/themes/gulcin-kahraman/assets/images/gulcin-kahraman-ofis-portre.jpg" alt="Avukat Gülçin Kahraman Gedik – İstanbul Kanser Hakları Avukatı">
    <div class="about-hero-badge">⚖️ İstanbul Barosu Kayıtlı Avukat</div>
  </div>
  <div class="about-hero-text">
    <h2 class="about-hero-name">Av. Gülçin Kahraman Gedik</h2>
    <p class="about-hero-title">Kanser Hastası Hakları &amp; Sağlık Hukuku Uzmanı</p>
    <div class="about-hero-divider"></div>
    <p class="about-hero-bio">2021 yılında, İstanbul Medeniyet Üniversitesi Hukuk Fakültesinden <strong style="color:#f3eee4;">onur öğrencisi</strong> olarak mezun olmuş; akabinde İstanbul Barosunda staj eğitimini tamamlayarak mesleğe başlamıştır.</p>
    <p class="about-hero-bio">Halen İstanbul ilinde, Avukat Gülçin Kahraman Hukuk Bürosu nezdinde serbest avukat olarak faaliyet göstermekte olup, avukatlık ortaklıkları aracılığıyla Türkiye'nin birçok ilinde kanser hastalarına <strong style="color:#f3eee4;">yaşamsal ilaç erişimi ve SGK davaları</strong> konusunda hukuki hizmet vermektedir.</p>
  </div>
</div>

<h3 class="about-section-heading">Temel Çalışma İlkelerimiz</h3>
<div class="about-principles-grid">
  <div class="about-principle-card">
    <span class="about-principle-icon">🔒</span>
    <div class="about-principle-title">Gizlilik ve Güven</div>
    <p class="about-principle-desc">Müvekkil sırlarının ve kişisel verilerin korunması en temel ilkemizdir. KVKK standartlarına tam uyum sağlanır.</p>
  </div>
  <div class="about-principle-card">
    <span class="about-principle-icon">💬</span>
    <div class="about-principle-title">Şeffaf İletişim</div>
    <p class="about-principle-desc">Dava ve başvuru süreçlerinin her aşamasında müvekkiller eksiksiz bilgilendirilir. Belirsizliğe yer bırakılmaz.</p>
  </div>
  <div class="about-principle-card">
    <span class="about-principle-icon">🔍</span>
    <div class="about-principle-title">Titiz Dosya İncelemesi</div>
    <p class="about-principle-desc">Her hukuki uyuşmazlık, güncel mevzuat ve Yargıtay/Danıştay içtihatları ışığında derinlemesine analiz edilir.</p>
  </div>
</div>

<h3 class="about-section-heading">Akademik ve Mesleki Detaylar</h3>
<ul class="about-credentials-row">
  <li class="about-cred-item">
    <span class="about-cred-icon">🎓</span>
    <div class="about-cred-content">
      <div class="about-cred-label">Lisans Eğitimi</div>
      <div class="about-cred-value">İstanbul Medeniyet Üni. Hukuk Fak.<br><em style="color:var(--gold,#c6a563);font-style:normal;">Onur Derecesi — 2021</em></div>
    </div>
  </li>
  <li class="about-cred-item">
    <span class="about-cred-icon">⚖️</span>
    <div class="about-cred-content">
      <div class="about-cred-label">Baro Kaydı</div>
      <div class="about-cred-value">İstanbul Barosu</div>
    </div>
  </li>
  <li class="about-cred-item">
    <span class="about-cred-icon">📍</span>
    <div class="about-cred-content">
      <div class="about-cred-label">Ofis Konumu</div>
      <div class="about-cred-value">Nursanlar 1 Plaza<br>Kartal / İstanbul</div>
    </div>
  </li>
</ul>
<!-- /wp:html -->
