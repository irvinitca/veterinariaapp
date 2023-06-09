@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Otras etiquetas y metadatos -->
    </head>
    <div class="container">

    <div class="signup-container">
        <div class="left-container">
          <h1>
            <img class="logovet" src="{{ asset('logo/cio-logo.png') }}" alt="Logo de CIO">
            Veterinaria CIO
          </h1>
            <!-- aqi mostrando los diagnósticos ya Cerrados del paciente -->
        <div class="left-container">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>CITA</th>
                        <th>FECHA</th>
                        <th>DIAGNOSTICO</th>
                        <th>SERVICIO</th>
                        <th>MEDICAMENTOS</th>
                        <th>VER DETALLES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>{{ $history->appointment_id }}</td>
                            <td>{{ Carbon::parse($history->date_resolved)->format('Y-m-d') }}</td>
                            <td>{{ $history->diagnostic }}</td>
                            <td>{{ $history->services }}</td>
                            <td>{{ $history->indications }}</td>
                            <td>{{ $history->medicaments }}</td>
                            <td>
                                <a href="" class="btn btn-secondary iconbtn">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </a>
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="right-container">
        <header>
          <h1>Diagnóstico de Paciente</h1>
        </header>
        <div class="formdiv">
          <form action="{{ route('vet.diagnostico-nuevo') }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="appointment_id">Cita:</label>
              <select type="hidden" name="appointment_id" class="form-control select2">
               {{--   @foreach ($appointments as $appointment)
                  <option value="{{ $appointment->id }}">{{ $appointment->id }}</option>
                @endforeach --}}
              </select>
            </div>

            <div class="form-group">
              <label for="date_resolved">Fecha Resuelto:</label>
              <input type="date" name="date_resolved" id="date_resolved" class="form-control" required>
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
        </div>
      </div>

    <!-- Resto del código de la vista -->
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
    $(document).ready(function () {
        $('.select2').select2({  width: '100%' });

    });
</script>
</x-app-layout>














