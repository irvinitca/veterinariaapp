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
            Veterinaria CIO
          </h1>
          <div class="">
            <img  class="reportepng" src="/img/reporte-ingresos.png"/>
          </div>
        </div>
        <div class="right-container">
          <header>
            <h1>Reporte de Ingresos $ por Veterinario</h1>
            </header>
            <div class="formdiv">
              <form action="{{ route('admin.generate-pdf-ingresosvet') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="date_start">Desde:</label>
                    <input type="datetime-local" name="date_start" id="date_start" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_start">Hasta:</label>
                    <input type="datetime-local" name="date_end" id="date_end" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="user_id">Veterinario:</label>
                    <select name="user_id" id="user_id" class="form-control select2" required>
                        <option value="">Sin asignar</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="setfooter">
                <button id="back" type="button">Cancelar</button>
                <button id="next" type="submit" class="btn btn-secondary">Generar</button>
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
        $('.select2').select2({ width: '100%'});

    });
</script>
</x-app-layout>
