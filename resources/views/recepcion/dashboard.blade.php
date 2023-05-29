@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <head>
        <!-- Otras etiquetas y metadatos -->

        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/table.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Otras etiquetas y metadatos -->
    </head>

<div class="container">

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h2>Citas </h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route('citas.nueva') }}" class="button-33">Crear nueva cita</a>
        </div>

    </div>

</div>
    <div class="table-wrapper">
        <table class="fl-table">
        <thead>
            <tr>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Mascota</th>
                <th>Tipo Consulta</th>
                <th>Motivo</th>
                <th>Veterinario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ Carbon::parse($appointment->date_start)->format('Y-m-d') }}</td>
                    <td>{{ Carbon::parse($appointment->date_start)->format('H:i') }}</td>
                    <td>{{ $appointment->pet->name }}</td>
                    <td>{{ $appointment->type }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ $appointment->user?->name }}</td>
                    <td>
                        <a href="{{ route('citas.editar', ['id' => $appointment->id]) }}" class="btn btn-primary iconbtn">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        <a href="#" onclick="confirmCancel({{ $appointment->id }})" class="btn btn-secondary iconbtn">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $appointments->links() }}
</div>
<script>
    function confirmCancel(id) {
        if (confirm("¿Estás seguro de que deseas cancelar esta cita?")) {
            // Aquí puedes agregar la lógica para enviar una solicitud de eliminación al servidor
        }
    }
</script>
</x-app-layout>
