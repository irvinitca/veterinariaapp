@php
    use Carbon\Carbon;
@endphp
<x-app-layout>

    <head>
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">
    </head>
    <div class="container">

        <div class="signup-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-container">
                        <img class="logovet" src="{{ asset('logo/cio-logo.png') }}" alt="Logo de CIO">
                            @if ($histories->isNotEmpty())
                            <h1>Historial de diagnósticos de '{{ $histories->first()->appointment->pet->name }}'</h1>
                        @else
                            <h1>Paciente -{{$appointment->pet->name}}- sin diagnósticos </h1>
                        @endif


                        <div class="table-responsive">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr >
                                        <th>#CITA</th>
                                        <th>DIAGNOSTICO</th>
                                        <th>FECHA</th>
                                        <th>VET</th>
                                        <th>DETALLES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $history)

                                        <tr>
                                            <td>{{ $history->appointment_id }}</td>
                                            <td>{{ $history->diagnostic }}</td>
                                            <td>{{ Carbon::parse($history->date_resolved)->format('d-m-Y') }}</td>
                                            <td>{{ $history->appointment->user->name }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary iconbtn open-modal" data-appointment-id="{{ $history->appointment->id }}">
                                                    <i class="fa-sharp fa-eye"></i>
                                                </a>
                                            </td>

                                            <td></td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-container">
                        <header>
                            <h1>Diagnóstico de Paciente</h1>
                        </header>
                        <div class="formdiv">
                            @if ($histories->contains('appointment_id', $appointment->id))
                            <div class="alert alert-danger">Ya existe un diagnóstico para esta cita.</div>
                            <button id="back" class="btn btn-outline-dark" type="button">Regresar</button>
                            <br><br>
                         @else
                         <br>
                            <form action="{{ route('vet.diagnostico-nuevo', ['appointment_id' => $appointment->id]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="pet_name">Mascota:</label>
                                    <input type="text" name="pet_name" id="pet_name" class="code-highlight" value="{{ $appointment->pet->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="diagnostic">Diagnóstico:</label>
                                    <textarea name="diagnostic" id="diagnostic" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="services">Servicios:</label><br>
                                    <select name="services" id="services">
                                        <option value="" disabled selected>Seleccione servicio</option>
                                        <option value="consulta">Consulta</option>
                                        <option value="emergencia">Emergencia</option>
                                        <option value="grooming" disabled>Grooming</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="indications">Indicaciones:</label>
                                    <textarea name="indications" id="indications" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="medicaments">Medicamentos:</label>
                                    <textarea name="medicaments" id="medicaments" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="appointment_id"></label>
                                   <input type="hidden" name="appointment_id" id="appointment_id" class="form-control" value="{{ $appointment->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="date_resolved"></label>
                                    <input type="hidden" name="date_resolved" id="date_resolved" value="{{ date('Y-m-d') }}" class="form-control"
                                        required>
                                </div>
                                <div class="setfooter">
                                    <button id="back" type="button">Cancelar</button>
                                    <button id="next" type="submit" class="btn btn-secondary">Guardar</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("back").addEventListener("click", function() {
            window.location.href = "/dashboard";
        });
    </script>
    <script>
         var baseUrl = "{{ config('app.base_url') }}";
        $(document).ready(function() {
            $('.open-modal').click(function(e) {
                e.preventDefault();

                var appointmentId = $(this).data('appointment-id');

                // Realizar una petición AJAX al controlador para obtener los datos del diagnóstico
                $.ajax({
                    url: baseUrl+ 'vet/diagnostico-nuevo/' + appointmentId + '/details',
                    method: 'GET',
                    success: function(response) {
                        // aqui se crea el contenido del modal con los datos obtenidos
                        var modalContent = '<h5># Cita: ' + response.id + '</h5>' +
                                    '<div class="container">' +
                                    '<div class="row">' +
                                    '<div class="col-md-6">' +
                                    '<p><strong>Fecha:</strong></p>' +
                                    '<p>' + response.date_resolved + '</p>' +
                                    '</div>' +
                                    '<div class="col-md-6">' +
                                    '<p><strong>Diagnóstico:</strong></p>' +
                                    '<p>' + response.diagnostic + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                    '<div class="col-md-6">' +
                                    '<p><strong>Servicios:</strong></p>' +
                                    '<p>' + response.services + '</p>' +
                                    '</div>' +
                                    '<div class="col-md-6">' +
                                    '<p><strong>Indicaciones:</strong></p>' +
                                    '<p>' + response.indications + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                    '<div class="col-md-6">' +
                                    '<p><strong>Medicamentos:</strong></p>' +
                                    '<p>' + response.medicaments + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<button id="printButton" class="btn btn-primary">Imprimir</button>';
                        // Mostrar el modal con el contenido cargado
                        $('#modal-body').html(modalContent);
                        $('#myModal').modal('show');
                    }
                });
            });
                $('#myModal').on('shown.bs.modal', function() {
                $('#printButton').on('click', function() {
                    var modalContent = $('#modal-body').html(); // Obtener el contenido del modal

                    var printWindow = window.open('', '_blank'); // Abrir una ventana emergente
                    printWindow.document.open();
                    printWindow.document.write('<html><head><title>Detalles del diagnóstico</title></head><body>' + modalContent + '</body></html>'); // Escribir el contenido del modal en la ventana emergente
                    printWindow.document.close();
                    printWindow.print(); // Imprimir la ventana emergente
                });
            });
        });
    </script>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });

        });
    </script>
                <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detalles del diagnóstico - {{$appointment->pet->name}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <!-- Contenido del modal -->
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
