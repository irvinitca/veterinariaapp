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
              <form action="{{ route('admin.dashboard') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="reason">Motivo:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="reason">Motivo:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="reason">Motivo:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label  for="pet_id">Rol de Usuario:</label>
                    <select name="pet_id" class="form-control select2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $pet->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="setfooter">
                  <button id="back">Cancelar</button>
                  <button id="next" type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
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
