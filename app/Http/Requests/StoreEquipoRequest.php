<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'          => 'required|string|max:255',
            'tipo'            => 'required|string|max:100',
            'cantidad_total'  => 'required|integer|min:0',
            'estado'          => 'required|in:disponible,mantenimiento,inactivo',
            'descripcion'     => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'         => 'El nombre del equipo es obligatorio.',
            'tipo.required'           => 'El tipo de equipo es obligatorio.',
            'cantidad_total.required' => 'La cantidad total es obligatoria.',
            'cantidad_total.integer'  => 'La cantidad debe ser un número entero.',
            'estado.required'         => 'El estado del equipo es obligatorio.',
            'estado.in'               => 'El estado debe ser: disponible, mantenimiento o inactivo.',
        ];
    }
}
