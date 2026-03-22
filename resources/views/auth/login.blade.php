<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Admin VocaMate</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --primary-dark: #1e40af;
            --accent: #6366f1;
            --text-main: #0f172a;
            --text-secondary: #64748b;
            --bg-page: #f1f5f9;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --border: #e2e8f0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #e2e8f0 0%, #f1f5f9 100%);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--text-main);
            padding: 2rem 0;
            box-sizing: border-box;
        }

        /* Decorative backgrounds */
        .bg-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary-light);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.6;
        }

        .blob-1 { top: -100px; right: -100px; background: #dbeafe; }
        .blob-2 { bottom: -100px; left: -100px; background: #e0e7ff; }

        .login-container {
            width: 100%;
            max-width: 440px;
            perspective: 1000px;
        }

        .login-card {
            background: var(--glass-bg);
            padding: 3rem;
            border-radius: 2rem;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.05),
                0 10px 10px -5px rgba(0, 0, 0, 0.02),
                inset 0 0 0 1px rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.025em;
        }

        p {
            color: var(--text-secondary);
            font-size: 0.9375rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            margin-bottom: 0.625rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }



        input {
            width: 100%;
            padding: 1rem 1.25rem;
            background-color: white;
            border: 1.5px solid var(--border);
            border-radius: 1.25rem;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--text-main);
            display: block;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
            background-color: white;
        }

        input:focus + i {
            color: var(--primary);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            color: white;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            filter: brightness(1.1);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid transparent;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border-color: #fee2e2;
        }

        .footer {
            margin-top: 2.5rem;
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.8125rem;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem;
                margin: 1rem;
                border-radius: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-box">
                    <i data-lucide="book-open" style="width: 32px; height: 32px;"></i>
                </div>
                <h1>Portal Admin</h1>
                <p>Kelola konten VocaMate Anda</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <i data-lucide="alert-circle" style="width: 18px; height: 18px;"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin@vocamate.com" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Masuk ke Portal</span>
                    <i data-lucide="arrow-right" style="width: 18px; height: 18px;"></i>
                </button>
            </form>

            <div class="footer">
                &copy; 2026 Admin Portal VocaMate &bull; Versi 1.0.0
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
