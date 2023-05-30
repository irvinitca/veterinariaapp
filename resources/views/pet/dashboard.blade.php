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
                <th>Tipo</th>
                <th>Raza</th>
                <th>Edad</th>
                <th>Dueño</th>
                <th>Editar-Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->weight }}  </td>
                    <td>{{ $pet->type }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ $pet->age }}</td>
                    <td>{{ $pet->owner_id }}</td>
                    <td></td>
                    <td>
                    <form id="form-eliminar-{{ $pet->id }}" action="{{ route('pets.destroy', $pet->id) }}" method="POST">
                        <a href="/pets/{{$pet->id}}/edit" class="btn btn-primary">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta mascota?')" class="btn btn-secondary">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </td>
                    </tr>
                </form>
            @endforeach
        </tbody>
    </table>

    {{ $pets->links() }}

</div>
</x-app-layout>
