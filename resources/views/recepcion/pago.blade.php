@php
    use Carbon\Carbon;
@endphp
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
            <h1>Pago De Cita </h1>
            <h2>Detalle De Cita </h1>
            </header>
            <div class="formdiv">
              <form action="{{ route('appointments.pay') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label  for="pet_id">Mascota(Paciente):</label>
                    <label>{{$appointment->pet->name}}</label>
                </div>




                <div class="form-group">
                    <label for="date_start">Fecha y Hora Consulta:</label>
                    <label>{{ Carbon::parse($appointment->date_start)->format('d M y H:i:s')}}</label>

                </div>

                <div class="form-group">
                <label for="type">Tipo:</label>
                <label>{{$appointment->type}}</label>
            </div>
                <div class="form-group">
                    <label for="reason">Motivo:</label>
                    <label>{{$appointment->reason}}</label>
                </div>



                <div class="form-group">
                    <label for="user_id">Veterinario:</label>
                    <label>{{$appointment->user->name}}</label>
                </div>
                @if($appointment->history != null)
                <div class="form-group">
                    <label for="reason">Diagnostico:</label>
                    <label>{{$appointment->history->diagnostic}}</label>
                </div>
                <div class="form-group">
                    <label for="reason">Indicaciones:</label>
                    <label>{{$appointment->history->indications}}</label>
                </div>
                <div class="form-group">
                    <label for="reason">Medicamentos:</label>
                    <label>{{$appointment->history->medicaments}}</label>
                </div>
            @endif
            <label for="number">Monto:</label>
            <br/>
            <div class="input-group">
               
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                </div>
                <input type="number" name="total" id="total" autocomplete="off" class="form-control" rows="3" required>
              <input type="hidden" id="appointmentId" name="appointmentId" value={{$appointment->id}}/>
            </div>
            <br/>
            
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
                <div class="setfooter">
                  <button id="back" type="button">Cancelar</button>
                  <button id="next" type="submit" class="btn btn-secondary">Cobrar</button>
                </div>
            </form>
            </div>
            <script>
                 var baseUrl = "{{ config('app.base_url') }}";
                document.getElementById("back").addEventListener("click", function() {
                    window.location.href = baseUrl+"dashboard";
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
</div>

<script>
    $(document).ready(function () {
        $('.select2').select2({  width: '100%' });

    });
</script>
</x-app-layout>
