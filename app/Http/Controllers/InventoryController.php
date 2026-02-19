<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $equipos = \App\Models\Equipo::all();
        return view('admin.inventory.index', compact('equipos'));
    }

    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'cantidad_total' => 'required|integer|min:0',
            // 'cantidad_disponible' => 'required|integer|min:0', // calculated or same as total initially?
            'estado' => 'required|in:disponible,mantenimiento,inactivo',
            'descripcion' => 'nullable'
        ]);
        
        $data['cantidad_disponible'] = $data['cantidad_total'];
        \App\Models\Equipo::create($data);
        
        \App\Services\AlertService::success('Equipo Registrado', 'El nuevo equipo ha sido ingresado al inventario.');
        return redirect()->route('admin.inventory.index');
    }

    public function edit($id)
    {
        $equipo = \App\Models\Equipo::findOrFail($id);
        return view('admin.inventory.edit', compact('equipo'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
         $data = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'cantidad_total' => 'required|integer|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
            'descripcion' => 'nullable',
            'estado' => 'nullable'
        ]);
        
        $equipo = \App\Models\Equipo::findOrFail($id);
        $equipo->update($data);

        \App\Services\AlertService::success('Inventario Actualizado', 'Los detalles del equipo han sido modificados.');
        return redirect()->route('admin.inventory.index');
    }

    public function destroy($id)
    {
        \App\Models\Equipo::destroy($id);

        \App\Services\AlertService::warning('Equipo Eliminado', 'El ítem ha sido removido del sistema permanentemente.');
        return redirect()->route('admin.inventory.index');
    }
}
