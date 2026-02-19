<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Models\Equipo;
use App\Services\AlertService;

class InventoryController extends Controller
{
    public function index()
    {
        $equipos = Equipo::paginate(15);
        return view('admin.inventory.index', compact('equipos'));
    }

    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(StoreEquipoRequest $request)
    {
        $data = $request->validated();
        $data['cantidad_disponible'] = $data['cantidad_total'];

        Equipo::create($data);

        AlertService::success('Equipo Registrado', 'El nuevo equipo ha sido ingresado al inventario.');
        return redirect()->route('admin.inventory.index');
    }

    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('admin.inventory.edit', compact('equipo'));
    }

    public function update(UpdateEquipoRequest $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->update($request->validated());

        AlertService::success('Inventario Actualizado', 'Los detalles del equipo han sido modificados.');
        return redirect()->route('admin.inventory.index');
    }

    public function destroy($id)
    {
        Equipo::destroy($id);

        AlertService::warning('Equipo Eliminado', 'El ítem ha sido removido del sistema permanentemente.');
        return redirect()->route('admin.inventory.index');
    }
}
