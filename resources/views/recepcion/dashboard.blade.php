@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <head>
        <!-- Otras etiquetas y metadatos -->

        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/table.css') }}" rel="stylesheet">
      
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
            @php
        $currentTime = \Carbon\Carbon::now();
        $startTime = \Carbon\Carbon::parse($appointment->date_start);
        $endTime = \Carbon\Carbon::parse($appointment->date_end);
        $isCurrentTimeInRange = $currentTime->between($startTime, $endTime);
        $trClass = $isCurrentTimeInRange ? 'highlighted' : '';
    @endphp

                <tr class="{{ $trClass }}">
                    <td>{{ Carbon::parse($appointment->date_start)->format('d-m-Y') }}</td>
                    <td>{{ Carbon::parse($appointment->date_start)->format('H:i') }}</td>
                    <td>{{ $appointment->pet->name }}</td>
                    <td>{{ $appointment->type }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ $appointment->user?->name }}</td>
                    <td>
                        <a href="#"  class="btn btn-primary iconbtn">
                            <i class="fas fa-dollar-sign"></i>
                        </a>
                        <a href="#" onclick="confirmCancel({{ $appointment->id }})" class="btn btn-secondary iconbtn">
                            <i class="fas fa-ban"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $appointments->links() }}
</div>
<script>
    function confirmCancel(appointmentId) {
      
    

Swal.fire({
  title: '¿Esta seguro de cancelar esta cita?',
  text: "¡La accion no se podra revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#4FC3A1',
  cancelButtonColor: '#324960',
  cancelButtonText:'¡No!',
  confirmButtonText: '¡Si!'
}).then((result) => {
  if (result.isConfirmed) {
   // Realizar la petición al controlador para cancelar la cita
   axios.put('/appointments/' + appointmentId + '/cancel')
  .then((response) => {
    Swal.fire(
      '¡Cancelada!',
      response.data.message,
      'success'
    );
    setTimeout(() => {
      location.reload();
    }, 2000);
  })
  .catch((error) => {
    Swal.fire(
      'Error',
      error.response.data.error,
      'error'
    );
  });


    }
})
    }
    
</script>
</x-app-layout>
