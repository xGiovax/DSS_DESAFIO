<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', sans-serif; background: #0f1117; color: #e2e8f0; }
    .navbar {
        background: #1a1d2e;
        border-bottom: 1px solid #2d3748;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
    }
    .navbar-brand .logo-icon {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .navbar-brand span {
        color: #e2e8f0;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .navbar-brand small {
        color: #6366f1;
        font-size: 0.7rem;
        background: rgba(99,102,241,0.15);
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        margin-left: 0.5rem;
    }
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .user-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #252840;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.88rem;
        color: #a0aec0;
    }
    .user-badge .avatar {
        width: 26px;
        height: 26px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        color: white;
        font-weight: 700;
    }
    .btn-logout {
        background: rgba(245,101,101,0.15);
        color: #fc8181;
        border: 1px solid rgba(245,101,101,0.2);
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-size: 0.85rem;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-logout:hover { background: rgba(245,101,101,0.25); }
    .container { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem; }
</style>

<nav class="navbar">
    <a class="navbar-brand" href="/DataAuditLabs/mvc_nativo/?url=tareas/index">
        <div class="logo-icon"></div>
        <span>DataAuditLabs</span>
        <small>MVC</small>
    </a>
    <div class="navbar-right">
        <div class="user-badge">
            <div class="avatar"><?= strtoupper(substr($_SESSION['usuario_nombre'], 0, 1)) ?></div>
            <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
        </div>
        <a href="/DataAuditLabs/mvc_nativo/?url=auth/logout" class="btn-logout">Salir</a>
    </div>
</nav>