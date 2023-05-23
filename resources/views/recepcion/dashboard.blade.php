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
    <h2>Citas </h2>
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            <x-button class="button-33" role="button">Programar Citas</x-button>
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
                <tr>
                    <td>{{ Carbon::parse($appointment->date_start)->format('Y-m-d') }}</td>
                    <td>{{ Carbon::parse($appointment->date_start)->format('H:i') }}</td>
                    <td>{{ $appointment->pet->name }}</td>
                    <td>{{ $appointment->type }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ $appointment->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $appointments->links() }}
</div>
</x-app-layout>
