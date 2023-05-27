<x-app-layout>
    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">

    </head>
    <div class="container">
    <div class="signup-container">
        <div class="left-container">
          <h1>
            <img class="logovet" src="{{ asset('logo/cio-logo.png') }}" alt="Logo de CIO">
            VeterinariaCIO
          </h1>
          <div class="puppy">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png"/>
          </div>
        </div>
        <div class="right-container">
          <header>
            <h1>Creacion De Cita </h1>
            </header>
            <div class="formdiv">
              <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label  for="pet_id">Mascota(Paciente):</label>
                    <select name="pet_id" class="form-control select2">
                        @foreach ($pets as $pet)
                            <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                        @endforeach
                    </select>
                </div>




                <div class="form-group">
                    <label for="date_start">Fecha y Hora Consulta:</label>
                    <input type="datetime-local" name="date_start" id="date_start" class="form-control" required>
                </div>


                <label for="type">Tipo:</label>
                <select name="type" id="type" class="form-control">
                    <option value="Consulta">Consulta</option>
                    <option value="Emergencia">Emergencia</option>
                </select>

                <div class="form-group">
                    <label for="reason">Motivo:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" required style="max-height: 8rem"></textarea>
                </div>

                <div class="form-group">

                <div class="form-group">
                    <label for="user_id">Veterinario:</label>
                    <select name="user_id" id="user_id" class="form-control select2">
                        <option value="">Sin asignar</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="setfooter">
                  <button id="back" type="button">Cancelar</button>
                  <button id="next" type="submit" class="btn btn-secondary">Guardar</button>
                </div>
            </form>
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
        $('.select2').select2();

    });
</script>
</x-app-layout>
