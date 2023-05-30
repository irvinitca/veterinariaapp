<x-app-layout>
    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">
    </head>
    <div class="container">
    <div class="signup-container">
        <div class="left-container">
            <img class="logovet" src="{{ asset('logo/cio-logo.png') }}" alt="Logo de CIO">
          <div class="puppy">
            <h1></h1>
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png"/>
            </h1>
        </div>
        </div>
        <div class="right-container">
          <header>
            <h1>Crear Nueva Mascota</h1>
            </header>

            <div class="formdiv">
                <form action="{{ route('pets.store') }}" method="POST" onsubmit="return confirmarGuardar(event)">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-paw"></i></span>
                            </div>
                            <input name="name" id="name" class="form-control" rows="3" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-weight"></i></span>
                            </div>
                            <input name="weight" type="number" placeholder="lbs." id="weight"  class="form-control" rows="3" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-cat"></i></span>
                            </div>
                            <input name="type" id="type" placeholder="ej. Canino, Felino, Ave, etc" class="form-control" rows="3" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breed">Raza:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dog"></i></span>
                            </div>
                            <input name="breed" id="breed" placeholder="ej. Bulldog, Labrador, etc" class="form-control" rows="3" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age">Edad</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            <input name="age" type="number" placeholder="ej.: 3" id="age"  class="form-control" rows="3" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="owner_id">Dueño o Encargado:</label>
                        <select name="owner_id" id="owner_id" class="form-control select2">
                            <option value="" disabled selected>Seleccione</option>
                            @foreach ($pets as $pet)
                                <option value="">{{ $pet->owner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="setfooter">
                        <button id="back" type="button">Cancelar</button>
                        <button id="next" type="submit"  class="btn">Guardar</button>
                    </div>
                </form>
            </div>
            <script>
                function confirmarGuardar(event) {
                    if (!confirm('¿Estás seguro de que deseas crear esta mascota?')) {
                        event.preventDefault();
                        return false;
                    }
                    return true;
                }
            </script>
            <script>
                document.getElementById("back").addEventListener("click", function() {
                    window.location.href = "{{ route('pet.dashboard') }}";
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
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

    });
</script>
</x-app-layout>
