<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Reservas</title>
</head>
<body>

<h2>Reservas Registradas</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Plan</th>
        <th>Fecha Evento</th>
        <th>Dirección</th>
        <th>Estado</th>
        <th>Acción</th>
    </tr>

    @foreach($reservas as $reserva)
    <tr>
        <td>{{ $reserva->id }}</td>
        <td>{{ $reserva->user->name }}</td>
        <td>{{ $reserva->plan->nombre }}</td>
        <td>{{ $reserva->fecha_evento }}</td>
        <td>{{ $reserva->direccion_evento }}</td>
        <td>{{ $reserva->estado->nombre }}</td>
        <td>
            @if($reserva->estado_id != 2)
                <a href="{{ route('reservas.cancelar', $reserva->id) }}">
                    Cancelar
                </a>
            @endif
        </td>
    </tr>
    @endforeach

</table>

<br>
<a href="/reservas/crear">Nueva Reserva</a>

</body>
</html>
