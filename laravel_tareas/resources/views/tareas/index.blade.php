@extends('layouts.app')

@section('content')
<style>
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .top-bar h2 { color: #2c3e50; }
    .btn-crear { background: #27ae60; color: white; padding: 0.6rem 1.2rem;
                 border-radius: 6px; text-decoration: none; font-size: 0.95rem; }
    .btn-crear:hover { background: #1e8449; }
    .alert-success { background: #eafaf1; color: #1e8449; padding: 0.75rem 1rem;
                     border-radius: 6px; margin-bottom: 1rem; border-left: 4px solid #1e8449; }
    .empty { text-align: center; padding: 3rem; color: #7f8c8d; background: white;
             border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .empty p { font-size: 1.1rem; margin-bottom: 1rem; }
    table { width: 100%; background: white; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-collapse: collapse; }
    thead { background: #2c3e50; color: white; }
    th, td { padding: 0.9rem 1rem; text-align: left; font-size: 0.9rem; }
    tr:not(:last-child) td { border-bottom: 1px solid #f0f2f5; }
    tr:hover td { background: #f9f9f9; }
    .badge { padding: 0.3rem 0.7rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .badge-pendiente  { background: #fef9e7; color: #d68910; }
    .badge-completada { background: #eafaf1; color: #1e8449; }
    .actions a { padding: 0.3rem 0.7rem; border-radius: 5px; text-decoration: none;
                 font-size: 0.85rem; margin-right: 0.3rem; }
    .btn-editar   { background: #3498db; color: white; }
    .btn-editar:hover { background: #2980b9; }
    .btn-eliminar { background: #e74c3c; color: white; }
    .btn-eliminar:hover { background: #c0392b; }
</style>

<div class="top-bar">
    <h2>Mis Tareas</h2>
    <a href="{{ route('tareas.create') }}" class="btn-crear">+ Nueva Tarea</a>
</div>

@if(session('exito'))
    <div class="alert-success">{{ session('exito') }}</div>
@endif

@if($tareas->isEmpty())
    <div class="empty">
        <p>No tienes tareas aún.</p>
        <a href="{{ route('tareas.create') }}" class="btn-crear">Crear primera tarea</a>
    </div>
@else
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
            @foreach($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->titulo }}</td>
                <td>{{ $tarea->descripcion ?? '-' }}</td>
                <td>
                    <span class="badge badge-{{ $tarea->estado }}">
                        {{ ucfirst($tarea->estado) }}
                    </span>
                </td>
                <td>{{ $tarea->created_at->format('d/m/Y') }}</td>
                <td class="actions">
                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn-editar">Editar</a>
                    <form method="POST" action="{{ route('tareas.destroy', $tarea->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="background:#e74c3c; color:white; border:none; padding:0.3rem 0.7rem;
                                   border-radius:5px; font-size:0.85rem; cursor:pointer;"
                            onclick="return confirm('¿Eliminar esta tarea?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection