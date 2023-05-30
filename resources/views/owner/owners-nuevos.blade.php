<x-app-layout>
    <head>
        <!-- Vincular el archivo CSS -->
        <link href="{{ asset('css/formcita.css') }}" rel="stylesheet">

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
            <h1>Crear de Nuevo Cliente</h1>
            </header>

            <div class="formdiv">
                <form action="{{ route('owners.store') }}" method="POST" onsubmit="return confirmarGuardar(event)">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                            </div>
                            <input name="name" id="name" class="form-control" rows="3" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="age">Edad</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            <input name="age" type="number" id="age"  class="form-control" min="18" rows="3" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dui">DUI:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-card-o"></i></span>
                            </div>
                            <input name="dui" id="dui" class="form-control" rows="3" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefono:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            </div>
                            <input name="phone" id="phone" class="form-control" rows="3" required>
                        </div>
                    </div>

                    <div class="setfooter">
                        <button id="back" type="button">Cancelar</button>
                        <button id="next" type="submit"  class="btn">Guardar</button>
                    </div>
                </form>
            </div>
            <script>
                function confirmarGuardar(event) {
                    if (!confirm('¿Estás seguro de que deseas crear este cliente?')) {
                        event.preventDefault(); // Evita el envío del formulario si se cancela la confirmación
                        return false;
                    }
                    return true; // Permite el envío del formulario si se confirma la confirmación
                }
            </script>
            <script>
                document.getElementById("back").addEventListener("click", function() {
                    window.location.href = "{{ route('owner.dashboard') }}";
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
