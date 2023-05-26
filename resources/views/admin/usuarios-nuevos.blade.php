<x-app-layout>
    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">

    </head>
    <div class="container">
    <div class="signup-container">
        <div class="left-container">
          <h1>
            <i class="fas fa-paw"></i>
            Veterinaria CIO
          </h1>
          <div class="puppy">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png"/>
          </div>
        </div>
        <div class="right-container">

          <header>
            <h1>Creacion de Nuevo Usuario</h1>
            </header>

            <div class="formdiv">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input name="name" id="name" class="form-control" rows="3" required value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input name="email" id="email" class="form-control" rows="3" required value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input name="password" id="password" type="password" class="form-control" rows="3" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" rows="3" required>
                    </div>
                    @if ($errors->has('password') || $errors->has('password_confirmation'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                @foreach ($errors->get('password_confirmation') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="role_id"></label>
                        <select name="role_id" id="role_id" class="form-control select2">
                                <option value="" disabled selected>Seleccionar tipo de Usuario</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="setfooter">
                        <button id="back">Cancelar</button>
                        <button id="next" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

             {{--   <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input name="name" id="name" class="form-control" rows="3" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input name="email" id="email" class="form-control" rows="3" required>
                </div>

                <div class="form-group">
                    <label for="password">password:</label>
                    <input name="password" id="password" class="form-control" rows="3" required>
                </div>

                <div class="form-group">
                    <label  for="role_id">Rol de Usuario:</label>
                    <select name="role_id" class="form-control select2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="setfooter">
                  <button id="back">Cancelar</button>
                  <button id="next" type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>--}}
            </div>

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


<script>
    $(document).ready(function () {
        $('.select2').select2();

    });
</script>
</x-app-layout>
