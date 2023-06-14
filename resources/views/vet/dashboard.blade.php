@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <head>
        <link href="{{ asset('css/table.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

<div class="container">

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h2>Pacientes Asignados a Dr./Dra:   {{ auth()->user()->name }} </h2>
        </div>

    </div>

</div>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <tr>
                <th>#Cita</th>
                <th>Fecha de inicio</th>
                <th>Hora de inicio</th>
                <th>Mascota</th>
                <th>Tipo Consulta</th>
                <th>Motivo</th>
                <th>Veterinario</th>
                <th>DIAGNOSTICO</th>
                <th>HISTORIAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ Carbon::parse($appointment->date_start)->format('Y-m-d') }}</td>
                    <td>{{ Carbon::parse($appointment->date_start)->format('H:i') }}</td>
                    <td>{{ $appointment->pet->name }}</td>
                    <td>{{ $appointment->type }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ $appointment->user?->name }}</td>
                    <td>
                            <a href="{{ route('vet.diagnostico-nuevo', ['appointment_id' => $appointment->id]) }}" class="btn btn-primary iconbtn">
                                <i class="fa-sharp fa-pencil"></i>
                            </a>
                    </td>
                    <td>
                        <button class="btn btn-primary iconbtn" data-toggle="modal" data-target="#history-modal" data-pet-id="{{ $appointment->pet->id }}">
                            <i class="fa-regular fa-calendar-check"></i>
                       </button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
   <!-- Modal -->
   <div class="modal fade" id="history-modal" tabindex="-1" role="dialog" aria-labelledby="history-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="history-modal-label">Historial de la mascota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-wrapper bodyheight">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Diagnostico</th>
                            <th>Medicamento</th>
                            <th>Indicaciones</th>
                        </tr>
                    </thead>
                    <tbody id="history-modal-body" >
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Escuchar el evento 'show.bs.modal' para cargar los datos del historial de la mascota seleccionada
    $('#history-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var petId = button.data('pet-id'); // Obtener el ID de la mascota

        var modal = $(this);
        var modalBody = modal.find('#history-modal-body');
        
        // Limpiar el contenido anterior del modal
        modalBody.empty();

// Realizar la petición AJAX para obtener el historial de la mascota
$.ajax({
        url: '/pets/' + petId + '/history',
        method: 'GET',
        success: function (response) {
            console.log(response);
            // Actualizar el contenido del modal con el historial obtenido
            for (var i = 0; i < response.length; i++) {
                var history = response[i];
                var row = '<tr><td>' + history.date_resolved + '</td><td>' + history.diagnostic + '</td><td>'+history.medicaments+ '</td><td>'+history.indications+ '</td></tr>';
                modalBody.append(row);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});


    // Cerrar el modal al hacer clic en el botón de cerrar
    $('#history-modal').on('hide.bs.modal', function (event) {
        var modal = $(this);
        modal.find('#history-modal-body').empty(); // Limpiar el contenido del modal al cerrarlo
    });
</script>
</x-app-layout>
