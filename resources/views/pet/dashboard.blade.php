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
            <h2>Mascotas</h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pet.pets-nuevos') }}" class="button-33">Nueva Mascota</a>
        </div>
    </div>

</div>
    <div class="table-wrapper">
        <table class="fl-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Peso</th>
                <th>Tipo de Mascota</th>
                <th>Raza</th>
                <th>Edad</th>
                <th>Dueño o Encargado</th>
                <th>Editar-Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->weight }} lbs.</td>
                    <td>{{ $pet->type }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ $pet->age }} años</td>
                    <td>{{ $pet->owner->name }}</td>
                    <td>
                        <form id="form-eliminar-{{ $pet->id }}" action="{{ route('pets.destroy', $pet->id) }}" method="POST">
                        <a href="/citas-nuevas/{{$pet->id}}" class="btn btn-primary iconbtn">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </a>

                        <a href="/pets/{{$pet->id}}/edit" class="btn btn-primary iconbtn">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta mascota?')" class="btn btn-secondary iconbtn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </td>
                    </tr>

            @endforeach
        </tbody>
    </table>

    {{ $pets->links() }}

</div>
</x-app-layout>
