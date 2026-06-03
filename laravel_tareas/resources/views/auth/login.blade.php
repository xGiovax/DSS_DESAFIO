<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataAuditLabs - Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5;
               display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: white; padding: 2rem; border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #2c3e50; margin-bottom: 0.3rem; }
        .subtitle { text-align: center; color: #7f8c8d; margin-bottom: 1.5rem; font-size: 0.9rem; }
        .alert { background: #fdecea; color: #c0392b; padding: 0.75rem 1rem;
                 border-radius: 6px; margin-bottom: 1rem; border-left: 4px solid #c0392b; font-size:0.9rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.4rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem; }
        input { width: 100%; padding: 0.65rem 0.9rem; border: 1px solid #ddd;
                border-radius: 6px; font-size: 0.95rem; }
        input:focus { outline: none; border-color: #3498db; }
        button { width: 100%; padding: 0.75rem; background: #2c3e50; color: white;
                 border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; margin-top: 0.5rem; }
        button:hover { background: #1a252f; }
        .link { text-align: center; margin-top: 1.2rem; font-size: 0.9rem; color: #7f8c8d; }
        .link a { color: #3498db; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
<div class="card">
    <h1>DataAuditLabs</h1>
    <p class="subtitle">Inicia sesión en tu cuenta</p>

    @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="tucorreo@ejemplo.com" required>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <div class="link">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
    </div>
</div>
</body>
</html>