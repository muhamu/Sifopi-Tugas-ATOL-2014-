<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIFOPI</title>
    <link rel="stylesheet" href="/assets/css/theme.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            padding: 24px;
            background-image: url(https://lh3.googleusercontent.com/f6qHLMZmcHD3o1UcehWJuFW0xEMKWWv75dep_t02oJX3MUEBMA1SYrBi-oqxFn2o4WI_IurhAH8c3pPboI5wKpqaaIDM1jI=s1600);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: var(--font-family, 'Segoe UI', sans-serif);
        }

        /* ── Shared card shell ── */
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
            overflow: hidden;
            width: 100%;
        }

        /* ── Login card ── */
        .login-card {
            max-width: 400px;
            width: 100%;
        }

        .login-card__header {
            background: var(--color-primary, #0066CC);
            padding: 32px 32px 28px;
            text-align: center;
            color: #fff;
        }

        .login-card__logo {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.2);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 12px;
        }

        .login-card__title {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .login-card__subtitle {
            font-size: 13px;
            opacity: 0.85;
            margin-top: 4px;
        }

        .login-card__body {
            padding: 32px;
        }

        /* ── Alert ── */
        .alert {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }
        .alert-error   { background:#FFF0F0; color:#C0392B; border-color:#E74C3C; }
        .alert-warning { background:#FFFBF0; color:#B7770D; border-color:#F0A500; }
        .alert-info    { background:#F0F6FF; color:#1565C0; border-color:#2196F3; }
        .alert-success { background:#F0FFF4; color:#1B6B3A; border-color:#27AE60; }

        /* ── Form ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
            background: #F9FAFB;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--color-primary, #0066CC);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(0,102,204,.12);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            background: var(--color-primary, #0066CC);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: .3px;
            transition: background .2s, transform .1s;
        }

        .btn-login:hover  { background: #0052A3; }
        .btn-login:active { transform: scale(.98); }

        /* ── Footer inside login card ── */
        .login-card__footer {
            text-align: center;
            padding: 16px 32px 24px;
            font-size: 11.5px;
            color: #9CA3AF;
            border-top: 1px solid #F3F4F6;
            line-height: 1.7;
        }

        /* ── Credentials card ── */
        .cred-card {
            max-width: 400px;
            width: 100%;
        }

        .cred-card__body {
            padding: 14px 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .cred-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #6B7280;
            white-space: nowrap;
        }

        .cred-item {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #F3F4F6;
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 12.5px;
            font-family: 'Courier New', monospace;
            color: #111827;
            white-space: nowrap;
        }

        .cred-item span {
            font-size: 10px;
            font-family: 'Segoe UI', sans-serif;
            color: #9CA3AF;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <!-- ─── Login Card ──────────────────────────────── -->
    <div class="card login-card">
        <div class="login-card__header">
            <div class="login-card__logo">🎓</div>
            <div class="login-card__title">SIFOPI</div>
            <div class="login-card__subtitle">Sistem Informasi Akademik SMK PI</div>
        </div>

        <div class="login-card__body">
            <?php if ($flash): ?>
                <div class="alert alert-<?= safe($flash['type']) ?>">
                    <?= safe($flash['message']) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                           placeholder="Masukkan username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>

        <div class="login-card__footer">
            <div><?= safe(SCHOOL_NAME) ?></div>
            <div><?= safe(SCHOOL_ADDRESS) ?></div>
        </div>
    </div>

    <!-- ─── Credentials Card ────────────────────────── -->
    <div class="card cred-card">
        <div class="cred-card__body">
            <span class="cred-label">Akun Demo:</span>
            <div class="cred-item"><span>Admin</span> admin / password</div>
            <div class="cred-item"><span>Guru</span> guru_budi / password</div>
            <div class="cred-item"><span>Siswa</span> siswa_001 / password</div>
            <div class="cred-item"><span>TU</span> tata_usaha / password</div>
        </div>
    </div>

</body>
</html>
