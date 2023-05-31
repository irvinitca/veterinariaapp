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
            <h2>Registro de Usuarios</h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.usuarios-nuevos') }}" class="button-33">Nuevo Usuario</a>
        </div>
    </div>

</div>
    <div class="table-wrapper">
        <table class="fl-table">
        <thead>
            <tr>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Fecha de Creación</th>
                <th>Editar-Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                    <form id="form-eliminar-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                        <a href="/users/{{$user->id}}/edit" class="btn btn-primary iconbtn">
                            <i class="fa-solid fa-file-pen"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')" class="btn btn-secondary iconbtn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </td>
                    </tr>
                </form>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

</div>
</x-app-layout>
