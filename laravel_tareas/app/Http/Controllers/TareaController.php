<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller {

    public function index() {
        $tareas = Tarea::where('usuario_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create() {
        return view('tareas.crear');
    }

    public function store(Request $request) {
        $request->validate([
            'titulo'      => 'required|max:200',
            'descripcion' => 'nullable|string',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max'      => 'El título no puede tener más de 200 caracteres.',
        ]);

        Tarea::create([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado'      => 'pendiente',
            'usuario_id'  => Auth::id(),
        ]);

        return redirect()->route('tareas.index')
                         ->with('exito', 'Tarea creada exitosamente.');
    }

    public function edit($id) {
        $tarea = Tarea::where('id', $id)
                      ->where('usuario_id', Auth::id())
                      ->firstOrFail();
        return view('tareas.editar', compact('tarea'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'titulo'      => 'required|max:200',
            'descripcion' => 'nullable|string',
            'estado'      => 'required|in:pendiente,completada',
        ]);

        $tarea = Tarea::where('id', $id)
                      ->where('usuario_id', Auth::id())
                      ->firstOrFail();

        $tarea->update([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado,
        ]);

        return redirect()->route('tareas.index')
                         ->with('exito', 'Tarea actualizada correctamente.');
    }

    public function destroy($id) {
        $tarea = Tarea::where('id', $id)
                      ->where('usuario_id', Auth::id())
                      ->firstOrFail();
        $tarea->delete();

        return redirect()->route('tareas.index')
                         ->with('exito', 'Tarea eliminada correctamente.');
    }
}