<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataAuditLabs</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        .navbar {
            background: #2c3e50;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 { color: white; font-size: 1.3rem; }
        .navbar span { color: #bdc3c7; font-size: 0.9rem; }
        .navbar a { color: #e74c3c; text-decoration: none; font-size: 0.9rem; margin-left: 1rem; }
        .navbar a:hover { text-decoration: underline; }
        .container { max-width: 960px; margin: 2rem auto; padding: 0 1rem; }
    </style>
</head>
<body>
<nav class="navbar">
    <h1>DataAuditLabs <small style="font-size:0.75rem; color:#95a5a6;">Laravel</small></h1>
    @auth
    <div>
        <span>Hola, {{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" style="background:none; border:none; color:#e74c3c; cursor:pointer; font-size:0.9rem;">
                Cerrar sesión
            </button>
        </form>
    </div>
    @endauth
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>