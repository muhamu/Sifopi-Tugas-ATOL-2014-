<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="/assets/css/theme.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        }
        .error-container {
            text-align: center;
            background: white;
            border-radius: 12px;
            padding: 60px 40px;
            max-width: 500px;
            box-shadow: var(--shadow-lg);
        }
        .error-code {
            font-size: 100px;
            font-weight: var(--font-weight-bold);
            color: var(--color-primary);
            margin: 0;
            line-height: 1;
        }
        .error-title {
            font-size: 24px;
            margin: 20px 0 10px;
            color: var(--color-dark-text);
        }
        .error-message {
            color: var(--color-gray-600);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-message">Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan.</p>
        <a href="/dashboard" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</body>
</html>
