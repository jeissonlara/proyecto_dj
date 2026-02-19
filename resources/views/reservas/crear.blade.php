<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Reserva</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<h2>Crear Reserva</h2>

<form id="formReserva">

    <label>User ID:</label>
    <input type="number" id="user_id" value="1"><br><br>

    <label>Plan:</label>
    <select id="plan_id">
        <option value="">Seleccione un plan</option>
        @foreach($planes as $plan)
            <option value="{{ $plan->id }}">
                {{ $plan->nombre }} - ${{ $plan->precio }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Fecha del evento:</label>
    <input type="date" id="fecha_evento"><br><br>

    <label>Dirección del evento:</label>
    <input type="text" id="direccion_evento"><br><br>

    <button type="submit" id="btnReservar">Reservar</button>

    <p id="mensajeDisponibilidad" style="font-weight:bold;"></p>
    <p id="respuesta"></p>

</form>

<script>
const planInput = document.getElementById('plan_id');
const fechaInput = document.getElementById('fecha_evento');
const mensaje = document.getElementById('mensajeDisponibilidad');
const boton = document.getElementById('btnReservar');
const respuesta = document.getElementById('respuesta');

// 🔎 Verificar disponibilidad
async function verificar() {
    let plan = planInput.value;
    let fecha = fechaInput.value;

    if (!plan || !fecha) return;

    try {
        const res = await fetch(`/api/disponibilidad/${plan}/${fecha}`);
        const data = await res.json();

        if (data.disponible) {
            mensaje.innerHTML = "✅ " + data.mensaje;
            mensaje.style.color = "green";
            boton.disabled = false;
        } else {
            mensaje.innerHTML = "❌ " + data.mensaje;
            mensaje.style.color = "red";
            boton.disabled = true;
        }

    } catch (error) {
        mensaje.innerHTML = "❌ Error verificando disponibilidad";
        mensaje.style.color = "red";
        boton.disabled = true;
    }
}

planInput.addEventListener('change', verificar);
fechaInput.addEventListener('change', verificar);

// 📝 Crear reserva
document.getElementById('formReserva').addEventListener('submit', async function(e) {
    e.preventDefault();

    try {
        const res = await fetch('/api/reservar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                user_id: document.getElementById('user_id').value,
                plan_id: planInput.value,
                fecha_evento: fechaInput.value,
                direccion_evento: document.getElementById('direccion_evento').value
            })
        });

        const data = await res.json();

        if (data.error) {
            respuesta.innerHTML = "❌ " + data.error;
        } else {
            respuesta.innerHTML = "✅ " + data.message;
            verificar(); // vuelve a validar después de reservar
        }

    } catch (error) {
        respuesta.innerHTML = "❌ Error al crear la reserva";
    }
});
</script>

</body>
</html>


