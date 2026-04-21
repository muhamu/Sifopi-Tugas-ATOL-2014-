/**
 * SIFOPI - Modal Dialog System
 */

const ModalUtils = (() => {
    'use strict';

    const open = (selector) => {
        const modal = SIFOPI.$(selector);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            return modal;
        }
    };

    const close = (selector) => {
        const modal = SIFOPI.$(selector);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            return modal;
        }
    };

    const closeAll = () => {
        SIFOPI.$$('.modal.active').forEach((modal) => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
    };

    const init = () => {
        // Close modal on close button
        SIFOPI.on('.modal-close', 'click', (e) => {
            const modal = e.target.closest('.modal');
            if (modal) close(modal);
        });

        // Close modal on background click
        SIFOPI.on('.modal', 'click', (e) => {
            if (e.target.classList.contains('modal')) {
                close(e.target);
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeAll();
            }
        });

        // Setup modal triggers
        SIFOPI.on('[data-modal-open]', 'click', (e) => {
            const selector = e.currentTarget.dataset.modalOpen;
            open(selector);
        });
    };

    return { open, close, closeAll, init };
})();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => ModalUtils.init());
} else {
    ModalUtils.init();
}
