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
            <h1>Editar Mascota</h1>
            </header>

            <div class="formdiv">
                <form wire:submit.prevent="submit" action="{{ route('pets.update', ['id' => $pet->id]) }}" method="POST" onsubmit="return confirmarGuardar(event)">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-paw"></i></span>
                            </div>
                            <input name="name" id="name" autocomplete="off" class="form-control" rows="3" required value="{{ $pet->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-weight"></i></span>
                            </div>
                            <input name="weight" type="number" placeholder="libras" id="weight"  class="form-control" rows="3" required value="{{ $pet->weight }}">
                        </div>
                    </div>

                    <div>
                        <div>
                            <div class="form-group">
                                <label for="type">Tipo:</label>
                                <select wire:model="selectedType" name="selectedType" id="selectedType" class="form-control" required>
                                    <option value="">Selecciona el tipo</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $pet->type === $type->name ? 'selected' : '' }}>{{ $type->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @if(!is_null($breeds))
                        <div>
                            <div class="form-group">
                                <label for="breed">Razas:</label>
                                <select wire:model="selectedBreed" name="selectedBreed" id="selectedBreed" class="form-control select2" required>
                                    <option value="">Selecciona la raza</option>
                                    @foreach ($breeds as $breed)
                                    <option value="{{ $breed->id }}" {{ $pet->breed === $breed->name ? 'selected' : '' }}>{{ $breed->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="age">Edad</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            <input name="age" type="number" placeholder="ej.: 3" id="age"  class="form-control" rows="3" required value={{ $pet->age }}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="owner_id">Dueño o Encargado:</label>
                        <select name="owner_id" id="owner_id" class="form-control select2">
                            <option value="" disabled selected>Seleccione</option>
                            @isset($owners)
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}" {{ $pet->owner_id == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                                @endforeach
                            @endisset
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
                    if (!confirm('¿Estás seguro de que deseas editar esta mascota?')) {
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
