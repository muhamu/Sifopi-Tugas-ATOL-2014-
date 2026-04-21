/**
 * SIFOPI - Authentication & Session Management
 */

const AuthUtils = (() => {
    'use strict';

    const SESSION_TIMEOUT = 1800 * 1000; // 30 minutes
    const WARNING_TIME = 300 * 1000; // 5 minutes before timeout
    let lastActivityTime = Date.now();
    let warningShown = false;

    // Check if user is logged in
    const isLoggedIn = () => {
        return SIFOPI.$('[data-user-id]') !== null;
    };

    // Update last activity
    const updateActivity = () => {
        lastActivityTime = Date.now();
        warningShown = false;
    };

    // Logout user
    const logout = () => {
        window.location.href = '/logout';
    };

    // Setup session timeout warning
    const setupSessionTimeout = () => {
        if (!isLoggedIn()) return;

        // Update activity on user interaction
        ['mousedown', 'keydown', 'scroll', 'click', 'touch'].forEach((event) => {
            document.addEventListener(event, updateActivity);
        });

        // Check session timeout periodically
        setInterval(() => {
            const inactiveTime = Date.now() - lastActivityTime;
            const timeToTimeout = SESSION_TIMEOUT - inactiveTime;

            // Show warning if approaching timeout and not already shown
            if (timeToTimeout <= WARNING_TIME && !warningShown) {
                warningShown = true;
                showTimeoutWarning(Math.floor(timeToTimeout / 1000));
            }

            // Log out if timeout exceeded
            if (inactiveTime > SESSION_TIMEOUT) {
                SIFOPI.notify('Sesi Anda telah berakhir. Silakan login kembali', 'warning');
                logout();
            }
        }, 30000); // Check every 30 seconds
    };

    // Show timeout warning modal
    const showTimeoutWarning = (seconds) => {
        const modal = document.createElement('div');
        modal.className = 'modal active';
        modal.id = 'session-timeout-warning';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">⏱️ Peringatan Timeout Sesi</h2>
                </div>
                <div class="modal-body">
                    <p>Sesi Anda akan berakhir dalam <strong id="timeout-seconds">${seconds}</strong> detik.</p>
                    <p>Klik tombol "Lanjutkan Sesi" untuk melanjutkan, atau Anda akan otomatis logout.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="window.location.href='/logout'">Logout Sekarang</button>
                    <button class="btn btn-primary" onclick="document.getElementById('session-timeout-warning').remove(); SIFOPI.notify('Sesi dilanjutkan', 'info');">Lanjutkan Sesi</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Update countdown
        let count = seconds - 1;
        const countdown = setInterval(() => {
            const el = document.getElementById('timeout-seconds');
            if (el) {
                el.textContent = count;
                count--;

                if (count < 0) {
                    clearInterval(countdown);
                }
            }
        }, 1000);
    };

    // Setup auto-logout warning
    const setupAutoLogoutWarning = () => {
        if (!isLoggedIn()) return;

        // Show message if visiting after being logged out
        const wasLoggedIn = SIFOPI.storage.get('was_logged_in');
        const isStillLoggedIn = isLoggedIn();

        if (wasLoggedIn && !isStillLoggedIn) {
            SIFOPI.notify('Sesi Anda telah berakhir. Silakan login kembali', 'warning');
            SIFOPI.storage.remove('was_logged_in');
        }

        SIFOPI.storage.set('was_logged_in', isStillLoggedIn);
    };

    // Setup logout confirmation
    const setupLogoutConfirmation = () => {
        SIFOPI.on('.btn-logout', 'click', async (e) => {
            e.preventDefault();

            const confirmed = await SIFOPI.confirm('Apakah Anda yakin ingin logout?');
            if (confirmed) {
                window.location.href = '/logout';
            }
        });
    };

    // Initialize auth features
    const init = () => {
        if (!isLoggedIn()) return;

        setupSessionTimeout();
        setupAutoLogoutWarning();
        setupLogoutConfirmation();
    };

    return {
        isLoggedIn,
        logout,
        updateActivity,
        init,
    };
})();

// Initialize auth on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => AuthUtils.init());
} else {
    AuthUtils.init();
}
