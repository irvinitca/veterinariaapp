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
            <h2>Pacientes Asignados a Dr./Dra:   {{ auth()->user()->name }} </h2>
        </div>

    </div>

</div>
    <div class="table-wrapper">
        <table class="fl-table">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

                <tr>
                    <td></td>
                </tr>

        </tbody>
    </table>
</div>
</x-app-layout>
