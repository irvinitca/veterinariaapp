<x-app-layout>
    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">
        <!-- CSS de select2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <!-- JavaScript de select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    </head>
    <div class="container">
    <div class="signup-container">
        <div class="left-container">
          <h1>
            <img class="logovet" src="{{ asset('logo/cio-logo.png') }}" alt="Logo de CIO">
            Veterinaria CIO
          </h1>
          <div class="puppy">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png"/>
          </div>
        </div>
        <div class="right-container">

          <header>
            <h1>Modificar Usuario</h1>
            </header>

            <div class="formdiv">
                <form action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="name" id="name" class="form-control" rows="3" required value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input name="email" id="email" class="form-control" rows="3" required value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input name="password" id="password" type="password" class="form-control" rows="3" required value="{{ $user->password }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" rows="3" required value="{{ $user->password }}">
                        </div>
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
                        <label for="role_id">Tipo de Usuario:</label>
                        <select name="role_id" id="role_id" class="form-control select2">
                            <option value="" disabled selected>Seleccione</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="setfooter">
                        <button id="back" type="button">Cancelar</button>
                        <button id="next" type="submit" class="btn">Guardar</button>
                    </div>
                </form>
            </div>

            <script>
                document.getElementById("back").addEventListener("click", function() {
                    window.location.href = "/dashboard";
                });
            </script>
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
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
</x-app-layout>
