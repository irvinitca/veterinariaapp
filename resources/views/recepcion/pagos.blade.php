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
            <h2>Pagos </h2>
        </div>
        
    </div>

</div>
    <div class="table-wrapper">
        <table class="fl-table">
        <thead>
            <tr>
                <th>Fecha de inicio</th>
                <th>Cliente</th>
                <th>Estado Consulta</th>
                <th>Monto</th>
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
                    <td>{{ $appointment->pet->name }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td>{{ $appointment->total }}</td>
                    <td>
                        <a href="#"  class="btn btn-primary iconbtn" onclick="confirmCancel({{ $appointment->id }})">
                            <i class="fas fa-dollar-sign"></i>
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
        title: '¿Esta seguro de pagar esta cita?',
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
         axios.put('/appointments/' + appointmentId + '/update')
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
