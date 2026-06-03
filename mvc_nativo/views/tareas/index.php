<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataAuditLabs - Mis Tareas</title>
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
        .navbar a {
            color: #e74c3c;
            text-decoration: none;
            font-size: 0.9rem;
            margin-left: 1rem;
        }
        .navbar a:hover { text-decoration: underline; }
        .container { max-width: 960px; margin: 2rem auto; padding: 0 1rem; }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .top-bar h2 { color: #2c3e50; }
        .btn-crear {
            background: #27ae60;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.95rem;
            transition: background 0.2s;
        }
        .btn-crear:hover { background: #1e8449; }
        .alert-error {
            background: #fdecea;
            color: #c0392b;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border-left: 4px solid #c0392b;
        }
        .alert-success {
            background: #eafaf1;
            color: #1e8449;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border-left: 4px solid #1e8449;
        }
        .empty {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .empty p { font-size: 1.1rem; margin-bottom: 1rem; }
        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-collapse: collapse;
            overflow: hidden;
        }
        thead { background: #2c3e50; color: white; }
        th, td { padding: 0.9rem 1rem; text-align: left; font-size: 0.9rem; }
        tr:not(:last-child) td { border-bottom: 1px solid #f0f2f5; }
        tr:hover td { background: #f9f9f9; }
        .badge {
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-pendiente  { background: #fef9e7; color: #d68910; }
        .badge-completada { background: #eafaf1; color: #1e8449; }
        .actions a, .btn-estado {
            padding: 0.3rem 0.7rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            margin-right: 0.3rem;
            cursor: pointer;
            border: none;
        }
        .btn-editar   { background: #3498db; color: white; }
        .btn-editar:hover { background: #2980b9; }
        .btn-eliminar { background: #e74c3c; color: white; }
        .btn-eliminar:hover { background: #c0392b; }
        .btn-estado   { background: #f39c12; color: white; font-family: inherit; }
        .btn-estado:hover { background: #d68910; }
        .btn-estado:disabled { opacity: 0.6; cursor: not-allowed; }

        /* Toast de notificación */
        #toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 0.8rem 1.4rem;
            border-radius: 8px;
            color: white;
            font-size: 0.95rem;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 999;
        }
        #toast.show { opacity: 1; }
        #toast.success { background: #27ae60; }
        #toast.error   { background: #e74c3c; }
    </style>
</head>
<body>

<nav class="navbar">
    <h1>DataAuditLabs</h1>
    <div>
        <span>Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
        <a href="/DataAuditLabs/mvc_nativo/?url=auth/logout">Cerrar sesión</a>
    </div>
</nav>

<div class="container">
    <div class="top-bar">
        <h2>Mis Tareas</h2>
        <a href="/DataAuditLabs/mvc_nativo/?url=tareas/crear" class="btn-crear">+ Nueva Tarea</a>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($exito)): ?>
        <div class="alert-success"><?= htmlspecialchars($exito) ?></div>
    <?php endif; ?>

    <?php if (empty($tareas)): ?>
        <div class="empty">
            <p>No tienes tareas aún.</p>
            <a href="/DataAuditLabs/mvc_nativo/?url=tareas/crear" class="btn-crear">Crear primera tarea</a>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?>
                <tr id="fila-<?= $tarea['id'] ?>">
                    <td><?= $tarea['id'] ?></td>
                    <td><?= htmlspecialchars($tarea['titulo']) ?></td>
                    <td><?= htmlspecialchars($tarea['descripcion'] ?? '-') ?></td>
                    <td>
                        <span class="badge badge-<?= $tarea['estado'] ?>" id="badge-<?= $tarea['id'] ?>">
                            <?= ucfirst($tarea['estado']) ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($tarea['created_at'])) ?></td>
                    <td class="actions">
                        <button
                            class="btn-estado"
                            onclick="cambiarEstado(<?= $tarea['id'] ?>, this)"
                            id="btn-<?= $tarea['id'] ?>">
                            Cambiar
                        </button>
                        <a href="/DataAuditLabs/mvc_nativo/?url=tareas/editar&id=<?= $tarea['id'] ?>"
                           class="btn-editar">Editar</a>
                        <a href="/DataAuditLabs/mvc_nativo/?url=tareas/eliminar&id=<?= $tarea['id'] ?>"
                           class="btn-eliminar"
                           onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Toast -->
<div id="toast"></div>

<script>
function cambiarEstado(id, btn) {
    // Deshabilitar botón mientras se procesa
    btn.disabled = true;
    btn.textContent = '⏳ Cargando...';

    fetch('/DataAuditLabs/ajax/cambiar_estado.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Actualizar badge sin recargar
            const badge = document.getElementById('badge-' + id);
            badge.className = 'badge badge-' + data.nuevoEstado;
            badge.textContent = data.nuevoEstado.charAt(0).toUpperCase() + data.nuevoEstado.slice(1);

            mostrarToast('Estado cambiado a: ' + data.nuevoEstado, 'success');
        } else {
            mostrarToast('Error: ' + data.message, 'error');
        }
    })
    .catch(() => {
        mostrarToast('Error de conexión', 'error');
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = 'Cambiar';
    });
}

function mostrarToast(mensaje, tipo) {
    const toast = document.getElementById('toast');
    toast.textContent = mensaje;
    toast.className = 'show ' + tipo;
    setTimeout(() => { toast.className = ''; }, 3000);
}
</script>

</body>
</html>