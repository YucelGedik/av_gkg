(() => {
    'use strict';

    const header = document.querySelector('[data-site-header]');
    if (!header) {
        return;
    }

    const toggle = header.querySelector('[data-menu-toggle]');
    const navigation = header.querySelector('[data-site-nav]');
    const desktopMedia = window.matchMedia('(min-width: 48rem)');

    if (!toggle || !navigation) {
        return;
    }

    let restoreFocusTo = null;

    const focusableSelector = [
        'a[href]',
        'button:not([disabled])',
        'input:not([disabled])',
        'select:not([disabled])',
        'textarea:not([disabled])',
        '[tabindex]:not([tabindex="-1"])'
    ].join(',');

    const isOpen = () => toggle.getAttribute('aria-expanded') === 'true';

    const closeMenu = ({ restoreFocus = false } = {}) => {
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Ana menüyü aç');
        navigation.hidden = true;
        document.body.classList.remove('has-open-menu');

        if (restoreFocus && restoreFocusTo instanceof HTMLElement) {
            restoreFocusTo.focus();
        }
        restoreFocusTo = null;
    };

    const openMenu = () => {
        restoreFocusTo = document.activeElement;
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Ana menüyü kapat');
        navigation.hidden = false;
        document.body.classList.add('has-open-menu');

        const firstFocusable = navigation.querySelector(focusableSelector);
        if (firstFocusable instanceof HTMLElement) {
            firstFocusable.focus();
        }
    };

    toggle.addEventListener('click', () => {
        if (isOpen()) {
            closeMenu({ restoreFocus: true });
        } else {
            openMenu();
        }
    });

    navigation.addEventListener('click', (event) => {
        if (!desktopMedia.matches && event.target.closest('a[href]')) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (!isOpen() || desktopMedia.matches) {
            return;
        }

        if (event.key === 'Escape') {
            event.preventDefault();
            closeMenu({ restoreFocus: true });
            return;
        }

        if (event.key !== 'Tab') {
            return;
        }

        const focusable = [toggle, ...navigation.querySelectorAll(focusableSelector)]
            .filter((element) => element instanceof HTMLElement && !element.hidden);
        if (focusable.length === 0) {
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    desktopMedia.addEventListener('change', (event) => {
        if (event.matches) {
            closeMenu();
        }
    });

    window.addEventListener('pageshow', () => {
        closeMenu();
    });

    // Floating Quick Contact Widget
    const quickContact = document.getElementById('gkQuickContact');
    if (quickContact) {
        const quickToggle = document.getElementById('gkQuickContactToggle');
        const quickMenu = document.getElementById('gkQuickContactMenu');

        if (quickToggle && quickMenu) {
            quickToggle.addEventListener('click', () => {
                const isExpanded = quickToggle.getAttribute('aria-expanded') === 'true';
                quickToggle.setAttribute('aria-expanded', !isExpanded);
                quickMenu.setAttribute('aria-hidden', isExpanded);
                quickContact.classList.toggle('gk-quick-contact--active', !isExpanded);
            });

            document.addEventListener('click', (e) => {
                if (!quickContact.contains(e.target)) {
                    quickToggle.setAttribute('aria-expanded', 'false');
                    quickMenu.setAttribute('aria-hidden', 'true');
                    quickContact.classList.remove('gk-quick-contact--active');
                }
            });
        }
    }

    // PDF Preview Modal Controller
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href$=".pdf"], a.js-pdf-preview, [data-pdf-url]');
        if (!link) return;

        const pdfUrl = link.dataset.pdfUrl || link.getAttribute('href');
        if (!pdfUrl) return;

        e.preventDefault();
        
        let modal = document.getElementById('pdfPreviewModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'pdfPreviewModal';
            modal.className = 'pdf-modal';
            modal.innerHTML = `
                <div class="pdf-modal__dialog" role="dialog" aria-modal="true">
                    <div class="pdf-modal__header">
                        <h4 class="pdf-modal__title">⚖️ Emsal Mahkeme Kararı Önizleme</h4>
                        <div class="pdf-modal__actions">
                            <a href="#" id="pdfModalDownload" target="_blank" rel="noopener noreferrer" class="pdf-modal__download">💾 İndir</a>
                            <button type="button" class="pdf-modal__close" id="pdfModalClose" aria-label="Kapat">✕</button>
                        </div>
                    </div>
                    <div class="pdf-modal__body">
                        <iframe id="pdfModalIframe" class="pdf-modal__iframe" src="" title="PDF Önizleme"></iframe>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);

            const closeBtn = modal.querySelector('#pdfModalClose');
            const closePdfModal = () => {
                modal.classList.remove('pdf-modal--active');
                const iframe = modal.querySelector('#pdfModalIframe');
                if (iframe) iframe.src = '';
                document.body.style.overflow = '';
            };

            closeBtn.addEventListener('click', closePdfModal);
            modal.addEventListener('click', (evt) => {
                if (evt.target === modal) closePdfModal();
            });

            document.addEventListener('keydown', (evt) => {
                if (evt.key === 'Escape' && modal.classList.contains('pdf-modal--active')) {
                    closePdfModal();
                }
            });
        }

        const iframe = modal.querySelector('#pdfModalIframe');
        const downloadBtn = modal.querySelector('#pdfModalDownload');
        
        if (iframe) iframe.src = pdfUrl;
        if (downloadBtn) downloadBtn.href = pdfUrl;

        modal.classList.add('pdf-modal--active');
        document.body.style.overflow = 'hidden';
    });
})();
