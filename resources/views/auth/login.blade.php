<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; display: flex; align-items: center; height: 100vh; }
        .login-card { width: 100%; max-width: 350px; margin: auto; padding: 20px; border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="card login-card bg-white">
        <h4 class="fw-bold text-center mb-4">Admin Login</h4>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-primary w-100 fw-bold">Masuk</button>
            <a href="/" class="btn btn-link w-100 mt-2 text-muted text-decoration-none small">Kembali ke Katalog</a>
        </form>
    </div>
</body>
</html>