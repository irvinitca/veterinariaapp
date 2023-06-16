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
          <div class="">
            <img  class="reportepng" src="/img/reporte-ingresos.png"/>
          </div>
        </div>
        <div class="right-container">
          <header>
            <h1>Reporte de Ingresos Mensuales</h1>
            </header>
            <div class="formdiv">
                <form action="{{ route('admin.generate-pdf-ingresos') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="month">Mes:</label>
                        <select name="month" id="month" class="form-control" required>
                            <option value="">Seleccionar mes</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="year">Año:</label>
                        <select name="year" id="year" class="form-control" required>
                            <option value="">Seleccionar año</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Tipo de Cita:</label>
                        <select name="type" id="type" class="form-control select2" required>
                            <option value="">Sin asignar</option>
                            @foreach ($appointments as $type)
                                <option value="{{$type}}">{{$type}}</option>
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
