@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <head>
        <!-- Otras etiquetas y metadatos -->

        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/table.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Otras etiquetas y metadatos -->
    </head>

<div class="container">

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h2>Diagnosticos</h2>
        </div>

    </div>

</div>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <tr>
                <th>#Cita</th>
                <th>Fecha</th>
                <th>Diagnostico</th>
                <th>Servicio</th>
                <th>Motivo</th>
                <th>Indicaciones</th>
                <th>Medicamento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->appointment_id }}</td>
                    <td>{{ Carbon::parse($history->date_resolved)->format('Y-m-d') }}</td>
                    <td>{{ Carbon::parse($history->date_resolved)->format('H:i') }}</td>
                    <td>{{ $history->diagnostic }}</td>
                    <td>{{ $history->services }}</td>
                    <td>{{ $history->indications }}</td>
                    <td>{{ $history->medicaments }}</td>
                    <td>
                        <a href="{{ route('vet.diagnostico-nuevo') }}" class="btn btn-primary iconbtn">
                            <i class="fa-sharp fa-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-secondary iconbtn">
                            <i class="fa-regular fa-calendar-check"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-app-layout>
