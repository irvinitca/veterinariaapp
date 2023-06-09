@php
    use Carbon\Carbon;
@endphp
<x-app-layout>

    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Otras etiquetas y metadatos -->
    </head>
    <div class="container">

        <div class="signup-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-container">
                        <img class="logovet" src="{{ asset('logo/cio-logo.png') }}" alt="Logo de CIO">

                          <h1>Historial de diagnosticos</h1>
                        <!-- Contenido del contenedor izquierdo (tabla) -->
                        <div class="table-responsive">
                            <table class="table table-striped table-dark">
                                <!-- Encabezado de la tabla -->
                                <thead>
                                    <tr >
                                        <th>#CITA</th>
                                        <th>PACIENTE</th>
                                        <th>FECHA</th>
                                        <th>DIAGNOSTICO</th>
                                        <th>VER DETALLES</th>
                                    </tr>
                                </thead>
                                <!-- Cuerpo de la tabla -->
                                <tbody>
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $history->appointment_id }}</td>
                                            <td></td>
                                            <td>{{ Carbon::parse($history->date_resolved)->format('Y-m-d') }}</td>
                                            <td>{{ $history->diagnostic }}</td>
                                            <td>
                                                <a href="{{ route('vet.diagnostico-nuevo', ['appointment_id' => $appointment->id]) }}" class="btn btn-primary iconbtn">
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
                        <!-- Contenido del contenedor derecho (formulario) -->
                        <header>
                            <h1>Diagnóstico de Paciente</h1>
                        </header>
                        <div class="formdiv">
                            <form action="/vet/dashboard/{{ $appointment->id }}" method="POST">
                                <!-- Resto del formulario -->
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="appointment_id">Cita:</label>
                                   <input type="text" name="appointment_id" id="appointment_id" class="form-control" value="{{ $appointment->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="date_resolved">Fecha Resuelto:</label>
                                    <input type="date" name="date_resolved" id="date_resolved" value="{{ date('Y-m-d') }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="diagnostic">Diagnóstico:</label>
                                    <textarea name="diagnostic" id="diagnostic" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="services">Servicios:</label>
                                    <textarea name="services" id="services" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="indications">Indicaciones:</label>
                                    <textarea name="indications" id="indications" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="medicaments">Medicamentos:</label>
                                    <textarea name="medicaments" id="medicaments" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                                </div>

                                <!-- Resto del código del formulario -->

                                <div class="setfooter">
                                    <button id="back" type="button">Cancelar</button>
                                    <button id="next" type="submit" class="btn btn-secondary">Guardar</button>
                                </div>
                            </form>
                            </form>
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



    </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>


    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });

        });
    </script>
</x-app-layout>
