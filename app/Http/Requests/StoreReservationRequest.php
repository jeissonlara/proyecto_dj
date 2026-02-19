<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plan_id'          => 'required|exists:planes,id',
            'fecha_evento'     => 'required|date|after:today',
            'direccion_evento' => 'required|string|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'observaciones'    => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'plan_id.required'          => 'Debes seleccionar un plan.',
            'plan_id.exists'            => 'El plan seleccionado no es válido.',
            'fecha_evento.required'     => 'La fecha del evento es obligatoria.',
            'fecha_evento.after'        => 'La fecha debe ser posterior al día de hoy.',
            'direccion_evento.required' => 'La dirección del evento es obligatoria.',
            'telefono_cliente.required' => 'El teléfono de contacto es obligatorio.',
            'observaciones.required'    => 'Las observaciones son obligatorias.',
        ];
    }
}
