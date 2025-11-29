<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DISTRINORT</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logoicono.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logoicono.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logoicono.ico') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 60px 50px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .logo-container {
            margin-bottom: 40px;
        }

        .logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #1a1a1a;
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #4a4a4a;
            font-size: 14px;
            margin-bottom: 0;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
            text-align: left;
        }

        .input-group label {
            display: block;
            color: #1a1a1a;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-wrapper:hover {
            background: rgba(255, 255, 255, 1);
        }

        .input-wrapper i {
            width: 50px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(100, 150, 220, 0.3);
            color: #1e3a8a;
            font-size: 18px;
            flex-shrink: 0;
        }

        .input-wrapper input {
            flex: 1;
            padding: 16px;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #333;
        }

        .input-wrapper input::placeholder {
            color: #999;
        }

        .input-wrapper input:focus {
            outline: none;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            cursor: pointer;
            accent-color: #2563eb;
        }

        .remember-me label {
            color: #1a1a1a;
            cursor: pointer;
            margin: 0;
            font-size: 13px;
        }

        .forgot-password {
            color: #2563eb;
            text-decoration: none;
            font-size: 13px;
        }

        .forgot-password:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: rgba(30, 50, 100, 0.9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-btn:hover {
            background: rgba(30, 50, 100, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .error-message {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid rgba(255, 100, 100, 0.8);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                padding: 40px 30px;
                max-width: 350px;
            }

            .logo {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/Logo.jpg') }}" alt="Logo DISTRINORT">
            </div>
        </div>

        <div class="form-header">
            <h2>Iniciar Sesión</h2>
            <p>Ingresa tus credenciales para continuar</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ filament()->getLoginUrl() }}">
            @csrf

            <div class="input-group">
                <label for="email">Correo electrónico</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="nombre@correo.com"
                        value="{{ old('email') }}"
                        required 
                        autofocus
                    >
                </div>
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••••••"
                        required
                    >
                </div>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Recuérdame</label>
                </div>
                @if (filament()->hasPasswordReset())
                    <a href="{{ filament()->getRequestPasswordResetUrl() }}" class="forgot-password">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="login-btn">
                Iniciar Sesión
            </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>
