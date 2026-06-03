<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataAuditLabs - Editar Tarea</title>
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
        .navbar a { color: #bdc3c7; text-decoration: none; font-size: 0.9rem; }
        .navbar a:hover { text-decoration: underline; }
        .container { max-width: 600px; margin: 2rem auto; padding: 0 1rem; }
        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .card h2 { color: #2c3e50; margin-bottom: 1.5rem; }
        .alert-error {
            background: #fdecea;
            color: #c0392b;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border-left: 4px solid #c0392b;
        }
        .form-group { margin-bottom: 1.2rem; }
        label {
            display: block;
            margin-bottom: 0.4rem;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
        }
        input, textarea, select {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: border 0.2s;
        }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #3498db; }
        textarea { resize: vertical; min-height: 100px; }
        .btn-group { display: flex; gap: 1rem; margin-top: 0.5rem; }
        .btn-guardar {
            flex: 1;
            padding: 0.75rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-guardar:hover { background: #2980b9; }
        .btn-cancelar {
            flex: 1;
            padding: 0.75rem;
            background: #95a5a6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background 0.2s;
        }
        .btn-cancelar:hover { background: #7f8c8d; }
    </style>
</head>
<body>

<nav class="navbar">
    <h1>📋 DataAuditLabs</h1>
    <a href="/DataAuditLabs/mvc_nativo/?url=tareas/index">← Volver a mis tareas</a>
</nav>

<div class="container">
    <div class="card">
        <h2>Editar Tarea</h2>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="/DataAuditLabs/mvc_nativo/?url=tareas/actualizar">
            <input type="hidden" name="id" value="<?= $tarea['id'] ?>">

            <div class="form-group">
                <label for="titulo">Título *</label>
                <input type="text" id="titulo" name="titulo"
                       value="<?= htmlspecialchars($tarea['titulo']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($tarea['descripcion'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado">
                    <option value="pendiente" <?= $tarea['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="completada" <?= $tarea['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
                </select>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn-guardar">Actualizar Tarea</button>
                <a href="/DataAuditLabs/mvc_nativo/?url=tareas/index" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>