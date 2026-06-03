@extends('layouts.app')

@section('content')
<style>
    .card { background: white; padding: 2rem; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); max-width: 600px; margin: 0 auto; }
    .card h2 { color: #2c3e50; margin-bottom: 1.5rem; }
    .alert { background: #fdecea; color: #c0392b; padding: 0.75rem 1rem;
             border-radius: 6px; margin-bottom: 1rem; border-left: 4px solid #c0392b; }
    .form-group { margin-bottom: 1.2rem; }
    label { display: block; margin-bottom: 0.4rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem; }
    input, textarea, select { width: 100%; padding: 0.65rem 0.9rem; border: 1px solid #ddd;
                               border-radius: 6px; font-size: 0.95rem; font-family: inherit; }
    input:focus, textarea:focus, select:focus { outline: none; border-color: #3498db; }
    textarea { resize: vertical; min-height: 100px; }
    .btn-group { display: flex; gap: 1rem; margin-top: 0.5rem; }
    .btn-guardar { flex: 1; padding: 0.75rem; background: #3498db; color: white;
                   border: none; border-radius: 6px; font-size: 1rem; cursor: pointer; }
    .btn-guardar:hover { background: #2980b9; }
    .btn-cancelar { flex: 1; padding: 0.75rem; background: #95a5a6; color: white;
                    border-radius: 6px; font-size: 1rem; text-decoration: none; text-align: center; }
    .btn-cancelar:hover { background: #7f8c8d; }
</style>

<div class="card">
    <h2>Editar Tarea</h2>

    @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Título *</label>
            <input type="text" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" required>
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estado">
                <option value="pendiente"  {{ $tarea->estado == 'pendiente'  ? 'selected' : '' }}>Pendiente</option>
                <option value="completada" {{ $tarea->estado == 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn-guardar">Actualizar Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection