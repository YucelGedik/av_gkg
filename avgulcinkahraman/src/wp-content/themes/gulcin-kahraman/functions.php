<?php
/**
 * Theme bootstrap for Gülçin Kahraman.
 *
 * @package GulcinKahraman
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a cache-safe asset version.
 *
 * @param string $relative_path Theme-relative asset path.
 * @return string
 */
function gulcin_kahraman_asset_version( $relative_path ) {
	$absolute_path = get_theme_file_path( $relative_path );

	if ( is_readable( $absolute_path ) ) {
		return (string) filemtime( $absolute_path );
	}

	return (string) wp_get_theme()->get( 'Version' );
}

/**
 * Register the shared front-end stylesheet.
 */
function gulcin_kahraman_enqueue_assets() {
	wp_enqueue_style(
		'gulcin-kahraman-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=Manrope:wght@400;500;600&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'gulcin-kahraman-base',
		get_theme_file_uri( 'assets/css/base.css' ),
		array( 'gulcin-kahraman-fonts' ),
		gulcin_kahraman_asset_version( 'assets/css/base.css' )
	);

	wp_enqueue_style(
		'gulcin-kahraman-components',
		get_theme_file_uri( 'assets/css/components.css' ),
		array( 'gulcin-kahraman-base' ),
		gulcin_kahraman_asset_version( 'assets/css/components.css' )
	);

	wp_enqueue_script(
		'gulcin-kahraman-navigation',
		get_theme_file_uri( 'assets/js/navigation.js' ),
		array(),
		gulcin_kahraman_asset_version( 'assets/js/navigation.js' ),
		true
	);

	wp_enqueue_style(
		'gulcin-kahraman-front-page',
		get_theme_file_uri( 'assets/css/front-page.css' ),
		array( 'gulcin-kahraman-components' ),
		gulcin_kahraman_asset_version( 'assets/css/front-page.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'gulcin_kahraman_enqueue_assets' );

/**
 * Add viewport meta and canonical URL to <head>.
 */
function gulcin_kahraman_head_extras() {
	// Viewport (mobile scaling).
	echo "\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";

	// Canonical URL — prevents duplicate content penalties.
	$canonical = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
	printf( "<link rel=\"canonical\" href=\"%s\">\n", esc_url( $canonical ) );
}
add_action( 'wp_head', 'gulcin_kahraman_head_extras', 2 );

/**
 * Add native lazy loading to all <img> tags output by WordPress.
 *
 * @param array  $attr       Image attributes.
 * @param object $attachment WP_Post attachment.
 * @return array
 */
function gulcin_kahraman_lazy_load_images( $attr, $attachment ) {
	if ( ! isset( $attr['loading'] ) ) {
		$attr['loading'] = 'lazy';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'gulcin_kahraman_lazy_load_images', 10, 2 );

/**
 * Add loading="lazy" and decoding="async" to content images via output buffering.
 *
 * @param string $content Post content.
 * @return string
 */
function gulcin_kahraman_content_lazy_images( $content ) {
	if ( ! is_string( $content ) || '' === $content ) {
		return $content;
	}
	// Add loading=lazy where missing.
	$content = preg_replace( '/<img(?![^>]*loading=)([^>]*)>/i', '<img loading="lazy"$1>', $content );
	// Add decoding=async where missing.
	$content = preg_replace( '/<img(?![^>]*decoding=)([^>]*)>/i', '<img decoding="async"$1>', $content );
	return $content;
}
add_filter( 'the_content', 'gulcin_kahraman_content_lazy_images', 20 );

/**
 * Load shared foundations inside the block editor.
 */
function gulcin_kahraman_editor_assets() {
	wp_enqueue_style(
		'gulcin-kahraman-editor-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=Manrope:wght@400;500;600&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'gulcin-kahraman-editor-base',
		get_theme_file_uri( 'assets/css/base.css' ),
		array( 'gulcin-kahraman-editor-fonts' ),
		gulcin_kahraman_asset_version( 'assets/css/base.css' )
	);

	wp_enqueue_style(
		'gulcin-kahraman-editor-components',
		get_theme_file_uri( 'assets/css/components.css' ),
		array( 'gulcin-kahraman-editor-base' ),
		gulcin_kahraman_asset_version( 'assets/css/components.css' )
	);
}
add_action( 'enqueue_block_editor_assets', 'gulcin_kahraman_editor_assets' );

/**
 * Establish early connections only for the selected font provider.
 *
 * Fonts should be self-hosted before production if the final performance and
 * privacy review approves local font binaries.
 *
 * @param array  $urls          Resource hint URLs.
 * @param string $relation_type Relation type.
 * @return array
 */
function gulcin_kahraman_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}

	$urls[] = 'https://fonts.googleapis.com';
	$urls[] = array(
		'href'        => 'https://fonts.gstatic.com',
		'crossorigin' => 'anonymous',
	);

	return $urls;
}
add_filter( 'wp_resource_hints', 'gulcin_kahraman_resource_hints', 10, 2 );

/**
 * Provide optimised document titles for every page.
 *
 * @param array $title Document title parts.
 * @return array
 */
function gulcin_kahraman_document_title( $title ) {
	if ( is_front_page() ) {
		$title['title']   = 'Kanser İlacı & Hukuk Bürosu İstanbul | Av. Gülçin Kahraman Gedik';
		$title['tagline'] = 'Kartal / İstanbul';
		return $title;
	}

	$slug_map = array(
		'hizmetlerimiz'         => 'İlaç Bedeli İadesi ve Hukuk Hizmetleri | Av. Gülçin Kahraman Gedik',
		'hakkimizda'           => 'Avukat Hakkında | Av. Gülçin Kahraman Gedik',
		'makaleler'            => 'Hukuki Makaleler ve Rehberler | Av. Gülçin Kahraman Gedik',
		'iletisim'             => 'İletişim | Av. Gülçin Kahraman Gedik — Kartal İstanbul',
		'kanser-ilaci-davalari' => 'Kanser İlaçlarının Ücretsiz Temini İçin Hukuki Yollar | Av. Gülçin Kahraman Gedik',
		'emsal-kararlar'        => 'Emsal Kararlar & Mahkeme İlamları | Av. Gülçin Kahraman Gedik',
	);

	global $post;
	if ( isset( $post->post_name ) && array_key_exists( $post->post_name, $slug_map ) ) {
		$title['title']   = $slug_map[ $post->post_name ];
		$title['tagline'] = '';
	} elseif ( isset( $title['title'] ) && ( strpos( $title['title'], 'Ä' ) !== false || strpos( $title['title'], 'Ã' ) !== false ) ) {
		$title['title'] = utf8_decode( $title['title'] );
	}

	return $title;
}
add_filter( 'document_title_parts', 'gulcin_kahraman_document_title' );

/**
 * Automatically clean double-encoded UTF-8 titles.
 *
 * @param string $title Post title.
 * @return string
 */
function gulcin_kahraman_clean_the_title( $title ) {
	if ( is_string( $title ) ) {
		$replacements = array(
			'Ä°' => 'İ',
			'Ä±' => 'ı',
			'Ãœ' => 'Ü',
			'Ã¼' => 'ü',
			'Ã‡' => 'Ç',
			'Ã§' => 'ç',
			'Åž' => 'Ş',
			'ÅŸ' => 'ş',
			'Ã–' => 'Ö',
			'Ã¶' => 'ö',
			'Ã¢' => 'â',
		);
		$title = strtr( $title, $replacements );
	}
	return $title;
}
add_filter( 'the_title', 'gulcin_kahraman_clean_the_title' );

/**
 * Per-page SEO meta descriptions.
 */
function gulcin_kahraman_meta_description() {
	$descriptions = array(
		'front_page'   => 'SGK tarafından karşılanmayan Trodelvy, Keytruda, Opdivo, Tecentriq, Enhertu akıllı kanser ilaçları için kesintisiz ihtiyati tedbir ve bedel iadesi davaları. Av. Gülçin Kahraman Gedik — Kartal / İstanbul.',
		'hizmetlerimiz' => 'Trodelvy, Keytruda, Opdivo ilaç bedeli iadesi, ihtiyati tedbir, boşanma, velayet, kira ve miras hukuku davalarında uzman hukuki danışmanlık.',
		'hakkimizda'   => 'Av. Gülçin Kahraman Gedik; kanser ilacı davaları, SGK ihtiyati tedbir kararları ve aile hukukunda uzmanlaşmış avukat.',
		'makaleler'    => 'SGK akıllı ilaç iade davası, ihtiyati tedbir kararları ve hukuki rehberler.',
		'emsal-kararlar' => 'Trodelvy, Tecentriq, Opdivo, Keytruda akıllı kanser ilaçları için İş Mahkemelerinden alınan emsal ihtiyati tedbir kararları ve mahkeme ilamları.',
		'iletisim'     => 'Av. Gülçin Kahraman Gedik ile iletişime geçin. Adres: Nursanlar 1 Plaza, Kartal / İstanbul. Tel: +90 538 688 0573.',
	);

	$desc = '';
	if ( is_front_page() ) {
		$desc = $descriptions['front_page'];
	} elseif ( is_page() ) {
		global $post;
		$slug = $post->post_name ?? '';
		$desc = $descriptions[ $slug ] ?? '';
	} elseif ( is_single() ) {
		$desc = wp_trim_words( get_the_excerpt(), 30, '…' );
	}

	$desc = apply_filters( 'gulcin_kahraman_meta_description', $desc );
	if ( '' === trim( (string) $desc ) ) {
		return;
	}

	printf( "\n<meta name=\"description\" content=\"%s\">\n", esc_attr( wp_strip_all_tags( $desc ) ) );
}
add_action( 'wp_head', 'gulcin_kahraman_meta_description', 4 );

/**
 * Open Graph + Twitter Card meta tags for social sharing.
 */
function gulcin_kahraman_social_meta() {
	$site_name  = 'Av. Gülçin Kahraman Gedik Hukuk Bürosu';
	$site_url   = home_url( '/' );
	$og_image   = get_theme_file_uri( 'assets/images/gulcin-kahraman-ofis-portre.jpg' );
	$og_title   = wp_get_document_title();
	$og_url     = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	?>
<meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
<meta property="og:title" content="<?php echo esc_attr( $og_title ); ?>">
<meta property="og:url" content="<?php echo esc_url( $og_url ); ?>">
<meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
<meta property="og:image:width" content="800">
<meta property="og:image:height" content="600">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr( $og_title ); ?>">
<meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">
	<?php
}
add_action( 'wp_head', 'gulcin_kahraman_social_meta', 6 );

/**
 * Schema.org LegalService + FAQPage JSON-LD — Optimized for Google Knowledge Graph & AI Search Engines (ChatGPT, Gemini, Perplexity).
 */
function gulcin_kahraman_schema_jsonld() {
	$legal_service_schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'LegalService',
		'name'            => 'Av. Gülçin Kahraman Gedik Hukuk Bürosu',
		'url'             => home_url( '/' ),
		'telephone'       => '+90 538 688 0573',
		'email'           => 'info@avukatgulcinkahraman.com',
		'image'           => get_theme_file_uri( 'assets/images/gulcin-kahraman-ofis-portre.jpg' ),
		'priceRange'      => '₺₺',
		'areaServed'      => array( 'İstanbul', 'Kartal', 'Türkiye' ),
		'currenciesAccepted' => 'TRY',
		'address'         => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Cevizli Mah. Ulubey Sok. Nursanlar 1 Plaza No:4A K:16 D:113',
			'addressLocality' => 'Kartal',
			'addressRegion'   => 'İstanbul',
			'postalCode'      => '34865',
			'addressCountry'  => 'TR',
		),
		'geo'             => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => 40.8892,
			'longitude' => 29.1843,
		),
		'sameAs'          => array(
			'https://wa.me/905386880573',
		),
		'knowsAbout'      => array(
			'Trodelvy (Sacituzumab Govitecan)',
			'Keytruda (Pembrolizumab)',
			'Opdivo (Nivolumab)',
			'Tecentriq (Atezolizumab)',
			'Enhertu (Trastuzumab Deruxtecan)',
			'Padcev (Enfortumab Vedotin)',
			'Imfinzi (Durvalumab)',
			'Kadcyla (Trastuzumab Emtansine)',
			'Yervoy (Ipilimumab)',
			'Altuzan (Bevacizumab)',
			'Lumakras (Sotorasib)',
			'Retevmo (Selpercatinib)',
			'Kanser İlacı Davaları',
			'SGK Akıllı İlaç Bedel İadesi',
			'İhtiyati Tedbir Kararları',
			'Aile Hukuku ve Boşanma',
			'Kira Hukuku',
		),
		'hasOfferCatalog' => array(
			'@type'     => 'OfferCatalog',
			'name'      => 'Hukuki Hizmetler',
			'itemListElement' => array(
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Trodelvy Akıllı İlaç SGK Tedbir ve Bedel İade Davası' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Keytruda İlaç Bedeli İadesi Davası' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Opdivo ve Tecentriq İhtiyati Tedbir Davası' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Enhertu SGK Karşılama Davası' ) ),
				array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Aile Hukuku ve Boşanma Davaları' ) ),
			),
		),
	);

	$faq_schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array(
			array(
				'@type'          => 'Question',
				'name'           => 'SGK tarafından karşılanmayan Trodelvy, Keytruda, Opdivo gibi akıllı kanser ilaçları için hukuki yol nedir?',
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => 'SGK tarafından ödenmeyen akıllı ilaç ve immünoterapi tedavilerinde İş Mahkemesinde dava açılarak öncelikle hastanın ilaca kesintisiz ulaşabilmesi için ivedilikle "İhtiyati Tedbir Kararı" alınır ve geçmiş ödenen ilaç bedelleri yasal faiziyle SGK’dan tahsil edilir.',
				),
			),
			array(
				'@type'          => 'Question',
				'name'           => 'Kanser ilaçlarında ihtiyati tedbir kararı kaç günde çıkar?',
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => 'Av. Gülçin Kahraman Gedik tarafından açılan başvurularda, hastanın hayati riski ve gecikmedeki sakınca mahkemeye sunularak ortalama 24 ila 48 saat içerisinde mahkemeden tedbir kararı çıkarılmaktadır.',
				),
			),
			array(
				'@type'          => 'Question',
				'name'           => 'Kanser ilacı davasını hangi avukat takip eder?',
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => 'İstanbul Kartal’da faaliyet gösteren Av. Gülçin Kahraman Gedik Hukuk Bürosu, Trodelvy, Tecentriq, Opdivo, Keytruda ve Enhertu gibi akıllı ilaçların SGK tedbir ve iade davalarında emsal emsal kararlara sahip uzman bir hukuk bürosudur.',
				),
			),
		),
	);

	echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $legal_service_schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . "</script>\n";
	echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . "</script>\n";
}
add_action( 'wp_head', 'gulcin_kahraman_schema_jsonld', 99 );

/**
 * Build a clean redirect target for contact form PRG responses.
 *
 * @param string $status Result status.
 * @return string
 */
function gulcin_kahraman_contact_redirect_url( $status ) {
	$referer = wp_get_referer();

	if ( ! $referer ) {
		$referer = home_url( '/#iletisim' );
	}

	$referer = remove_query_arg( 'gk_contact', $referer );
	$target  = add_query_arg( 'gk_contact', sanitize_key( $status ), $referer );

	return wp_validate_redirect( $target, home_url( '/#iletisim' ) );
}

/**
 * Process public contact form submissions, then redirect (PRG).
 */
function gulcin_kahraman_handle_contact_form() {
	$nonce = isset( $_POST['gulcin_kahraman_contact_nonce'] )
		? sanitize_text_field( wp_unslash( $_POST['gulcin_kahraman_contact_nonce'] ) )
		: '';

	if ( ! wp_verify_nonce( $nonce, 'gulcin_kahraman_contact' ) ) {
		wp_safe_redirect( gulcin_kahraman_contact_redirect_url( 'guvenlik-hatasi' ), 303 );
		exit;
	}

	$honeypot = isset( $_POST['website'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['website'] ) ) ) : '';

	if ( '' !== $honeypot ) {
		wp_safe_redirect( gulcin_kahraman_contact_redirect_url( 'gonderildi' ), 303 );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( gulcin_kahraman_contact_redirect_url( 'eksik-bilgi' ), 303 );
		exit;
	}

	$recipient = sanitize_email( get_option( 'admin_email' ) );

	if ( ! is_email( $recipient ) ) {
		wp_safe_redirect( gulcin_kahraman_contact_redirect_url( 'gonderilemedi' ), 303 );
		exit;
	}

	$subject = sprintf( 'Web sitesi iletişim formu: %s', $name );
	$body    = implode(
		"\n\n",
		array(
			'Ad Soyad: ' . $name,
			'E-posta: ' . $email,
			'Telefon: ' . ( '' !== $phone ? $phone : 'Belirtilmedi' ),
			'Mesaj:' . "\n" . $message,
		)
	);
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	$sent    = wp_mail( $recipient, $subject, $body, $headers );

	wp_safe_redirect( gulcin_kahraman_contact_redirect_url( $sent ? 'gonderildi' : 'gonderilemedi' ), 303 );
	exit;
}
add_action( 'admin_post_nopriv_gulcin_kahraman_contact', 'gulcin_kahraman_handle_contact_form' );
add_action( 'admin_post_gulcin_kahraman_contact', 'gulcin_kahraman_handle_contact_form' );

/**
 * Render the accessible contact form shortcode.
 *
 * @return string
 */
function gulcin_kahraman_contact_form_shortcode() {
	$status   = isset( $_GET['gk_contact'] ) ? sanitize_key( wp_unslash( $_GET['gk_contact'] ) ) : '';
	$messages = array(
		'gonderildi'      => array( 'success', 'Mesajınız alındı. En kısa sürede sizinle iletişime geçeceğiz.' ),
		'eksik-bilgi'     => array( 'error', 'Lütfen ad soyad, geçerli e-posta ve mesaj alanlarını eksiksiz doldurun.' ),
		'guvenlik-hatasi' => array( 'error', 'Formun güvenlik doğrulaması başarısız oldu. Lütfen sayfayı yenileyip tekrar deneyin.' ),
		'gonderilemedi'   => array( 'error', 'Mesaj şu anda gönderilemedi. Lütfen telefon veya WhatsApp üzerinden ulaşın.' ),
	);

	ob_start();
	?>
	<div class="gk-contact-form" id="iletisim-formu">
		<?php if ( isset( $messages[ $status ] ) ) : ?>
			<div class="gk-form-notice gk-form-notice--<?php echo esc_attr( $messages[ $status ][0] ); ?>" role="<?php echo 'error' === $messages[ $status ][0] ? 'alert' : 'status'; ?>" tabindex="-1">
				<?php echo esc_html( $messages[ $status ][1] ); ?>
			</div>
		<?php endif; ?>

		<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="gulcin_kahraman_contact">
			<?php wp_nonce_field( 'gulcin_kahraman_contact', 'gulcin_kahraman_contact_nonce' ); ?>

			<div class="gk-form-field gk-form-honeypot" aria-hidden="true">
				<label for="gk-contact-website">Web sitesi</label>
				<input id="gk-contact-website" name="website" type="text" tabindex="-1" autocomplete="off">
			</div>

			<div class="gk-form-field">
				<label for="gk-contact-name">Adınız Soyadınız <span aria-hidden="true">*</span></label>
				<input id="gk-contact-name" name="name" type="text" autocomplete="name" maxlength="120" required aria-required="true">
			</div>

			<div class="gk-form-field">
				<label for="gk-contact-email">E-posta Adresiniz <span aria-hidden="true">*</span></label>
				<input id="gk-contact-email" name="email" type="email" autocomplete="email" maxlength="190" required aria-required="true">
			</div>

			<div class="gk-form-field">
				<label for="gk-contact-phone">Telefon Numaranız <span class="gk-field-optional">(isteğe bağlı)</span></label>
				<input id="gk-contact-phone" name="phone" type="tel" autocomplete="tel" maxlength="40">
			</div>

			<div class="gk-form-field">
				<label for="gk-contact-message">Mesajınız <span aria-hidden="true">*</span></label>
				<textarea id="gk-contact-message" name="message" rows="6" maxlength="3000" required aria-required="true"></textarea>
			</div>

			<p class="gk-form-required"><span aria-hidden="true">*</span> Zorunlu alanlar</p>
			<button class="wp-element-button" type="submit">Mesajı Gönder</button>
		</form>
	</div>
	<?php

	return (string) ob_get_clean();
}
add_shortcode( 'gulcin_kahraman_contact_form', 'gulcin_kahraman_contact_form_shortcode' );

/**
 * Dynamic estimated reading time calculator.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function gulcin_kahraman_reading_time( $post_id = null ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return '⏱ 3 dk okuma süresi';
	}

	$words     = str_word_count( wp_strip_all_tags( $post->post_content ) );
	$minutes   = max( 1, (int) ceil( $words / 200 ) );

	return sprintf( '⏱ %d dk okuma süresi', $minutes );
}

/**
 * Handle 301 redirect for /blog/ -> /makaleler/ and 410 for hello-world.
 */
function gulcin_kahraman_legacy_redirects() {
	$uri = parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH );

	if ( '/blog' === rtrim( $uri, '/' ) ) {
		wp_safe_redirect( home_url( '/makaleler/' ), 301 );
		exit;
	}

	if ( strpos( $uri, 'hello-world' ) !== false ) {
		status_header( 410 );
		echo '410 Gone - Bu sayfa kaldırılmıştır.';
		exit;
	}
}
add_action( 'template_redirect', 'gulcin_kahraman_legacy_redirects' );

/**
 * Shortcode to render a WhatsApp share button.
 * Usage: [whatsapp_share]
 */
function gulcin_kahraman_whatsapp_share_shortcode() {
	$url   = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$title = wp_get_document_title();
	$text  = rawurlencode( $title . ' - ' . $url );
	$link  = 'https://wa.me/?text=' . $text;

	return sprintf(
		'<div class="gk-whatsapp-share" style="margin:2rem 0;padding:1.25rem;background:var(--gk-panel,#161d22);border:1px solid var(--gk-line,#252d34);border-radius:6px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;"><span style="color:#f3eee4;font-size:14px;">📲 Bu makaleyi tanıdıklarınızla WhatsApp üzerinden paylaşın:</span><a href="%s" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp" style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;font-size:12.5px;">WHATSAPP\'TA PAYLAŞ</a></div>',
		esc_url( $link )
	);
}
add_shortcode( 'whatsapp_share', 'gulcin_kahraman_whatsapp_share_shortcode' );

