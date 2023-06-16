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
            <h2>Clientes</h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route('owner.owners-nuevos') }}" class="button-33">Nuevo Cliente</a>
        </div>
    </div>

</div>
    <div class="table-wrapper">
        <table class="fl-table">
        <thead>
            <tr>
                <th>Nombre de Cliente</th>
                <th>Edad</th>
                <th>DUI</th>
                <th># Contacto</th>
                <th>Editar-Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($owners as $owner)
                <tr>
                    <td>{{ $owner->name }}</td>
                    <td>{{ $owner->age }}  </td>
                    <td>{{ $owner->dui }}</td>
                    <td>{{ $owner->phone }}</td>
                    <td>
                    <form id="form-eliminar-{{ $owner->id }}" action="{{ route('owners.destroy', $owner->id) }}" method="POST">
                        <a href="{{ config('app.base_url') }}owners/{{$owner->id}}/edit" class="btn btn-primary iconbtn">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')" class="btn btn-secondary iconbtn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </td>
                    </tr>
                </form>
            @endforeach
        </tbody>
    </table>

    {{ $owners->links() }}

</div>
</x-app-layout>
