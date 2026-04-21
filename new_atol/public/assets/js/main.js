/**
 * SIFOPI - Main JavaScript Module
 * Vanilla ES6+ utilities for common functionality
 */

const SIFOPI = (() => {
    'use strict';

    // Simple DOM selector wrapper
    const $ = (selector) => document.querySelector(selector);
    const $$ = (selector) => document.querySelectorAll(selector);

    // Event delegation
    const on = (selector, event, callback) => {
        document.addEventListener(event, (e) => {
            if (e.target.closest(selector)) {
                callback(e);
            }
        });
    };

    // API Request Helper
    const api = async (url, options = {}) => {
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            ...options,
        };

        try {
            const response = await fetch(url, defaultOptions);

            // Handle errors
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            // Try to parse JSON response
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return await response.json();
            }

            return response;
        } catch (error) {
            console.error('API Error:', error);
            throw error;
        }
    };

    // Notification/Toast System
    const notify = (message, type = 'info', duration = 5000) => {
        const toast = document.createElement('div');
        toast.className = `toast alert-${type} animate-slide-in`;
        toast.textContent = message;
        toast.setAttribute('role', 'status');
        toast.setAttribute('aria-live', 'polite');

        // Add some style
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            max-width: 400px;
            z-index: 10000;
            padding: 16px;
            border-radius: 6px;
        `;

        document.body.appendChild(toast);

        if (duration > 0) {
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s';
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }

        return toast;
    };

    // Confirmation Dialog
    const confirm = async (message) => {
        return new Promise((resolve) => {
            const modal = document.createElement('div');
            modal.className = 'modal active';
            modal.innerHTML = `
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Konfirmasi</h2>
                    </div>
                    <div class="modal-body">
                        <p>${message}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline" onclick="this.closest('.modal').remove()">Batal</button>
                        <button class="btn btn-danger" onclick="window.SIFOPI.__confirm_resolve(true)">Hapus</button>
                    </div>
                </div>
            `;

            window.SIFOPI.__confirm_resolve = (result) => {
                modal.remove();
                resolve(result);
            };

            document.body.appendChild(modal);

            // Close on escape key
            const handleEscape = (e) => {
                if (e.key === 'Escape') {
                    modal.remove();
                    document.removeEventListener('keydown', handleEscape);
                    resolve(false);
                }
            };
            document.addEventListener('keydown', handleEscape);
        });
    };

    // Toggle Class
    const toggleClass = (element, className) => {
        if (typeof element === 'string') {
            element = $(element);
        }
        if (element) {
            element.classList.toggle(className);
        }
    };

    // Add Class
    const addClass = (element, className) => {
        if (typeof element === 'string') {
            element = $(element);
        }
        if (element) {
            element.classList.add(className);
        }
    };

    // Remove Class
    const removeClass = (element, className) => {
        if (typeof element === 'string') {
            element = $(element);
        }
        if (element) {
            element.classList.remove(className);
        }
    };

    // Has Class
    const hasClass = (element, className) => {
        if (typeof element === 'string') {
            element = $(element);
        }
        return element && element.classList.contains(className);
    };

    // Show/Hide Element
    const show = (element) => {
        if (typeof element === 'string') {
            element = $(element);
        }
        if (element) {
            element.style.display = '';
        }
    };

    const hide = (element) => {
        if (typeof element === 'string') {
            element = $(element);
        }
        if (element) {
            element.style.display = 'none';
        }
    };

    // Format Currency
    const formatCurrency = (value) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(value);
    };

    // Format Date
    const formatDate = (date, locale = 'id-ID') => {
        return new Intl.DateTimeFormat(locale, {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        }).format(new Date(date));
    };

    // Format Date & Time
    const formatDateTime = (dateTime, locale = 'id-ID') => {
        return new Intl.DateTimeFormat(locale, {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        }).format(new Date(dateTime));
    };

    // URL Parameter Parser
    const getUrlParam = (param) => {
        const url = new URL(window.location);
        return url.searchParams.get(param);
    };

    // Local Storage Helper
    const storage = {
        get: (key) => {
            try {
                const item = localStorage.getItem(key);
                return item ? JSON.parse(item) : null;
            } catch (e) {
                return null;
            }
        },
        set: (key, value) => {
            try {
                localStorage.setItem(key, JSON.stringify(value));
            } catch (e) {
                console.error('Storage error:', e);
            }
        },
        remove: (key) => {
            localStorage.removeItem(key);
        },
        clear: () => {
            localStorage.clear();
        },
    };

    // Initialize
    const init = () => {
        // Setup CSRF token for fetch requests
        const csrfToken = $('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            window.SIFOPI.csrfToken = csrfToken;
        }

        // Setup global error handler
        window.addEventListener('error', (event) => {
            console.error('Global Error:', event.error);
            notify('Terjadi kesalahan', 'error');
        });

        // Setup unhandled promise rejection handler
        window.addEventListener('unhandledrejection', (event) => {
            console.error('Unhandled Promise Rejection:', event.reason);
            notify('Terjadi kesalahan', 'error');
        });
    };

    // Export public API
    return {
        $,
        $$,
        on,
        api,
        notify,
        confirm,
        toggleClass,
        addClass,
        removeClass,
        hasClass,
        show,
        hide,
        formatCurrency,
        formatDate,
        formatDateTime,
        getUrlParam,
        storage,
        init,
        // Keep private ref for confirm dialog
        __confirm_resolve: null,
    };
})();

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => SIFOPI.init());
} else {
    SIFOPI.init();
}
