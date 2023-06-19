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
                    VeterinariaCIO
                </h1>
                <div class="puppy">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png"/>
                </div>
            </div>
            <div class="right-container">
                <header>
                    <h1>Edición de Cita</h1>
                </header>
                <div class="formdiv">
                    <form action="{{ route('appointments.updatex', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="pet_id">Mascota (Paciente):</label>
                            <select name="pet_id" class="form-control select2">
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}" @if ($pet->id === $appointment->pet_id) selected @endif>{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date_start">Fecha y Hora Consulta:</label>
                            <input type="datetime-local" name="date_start" id="date_start" class="form-control" value="{{ $appointment->date_start }}" required>
                        </div>

                        <label for="type">Tipo:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="Consulta" @if ($appointment->type === 'Consulta') selected @endif>Consulta</option>
                            <option value="Emergencia" @if ($appointment->type === 'Emergencia') selected @endif>Emergencia</option>
                        </select>

                        <div class="form-group">
                            <label for="reason">Motivo:</label>
                            <textarea name="reason" id="reason" class="form-control" rows="3" required style="max-height: 8rem">{{ $appointment->reason }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Veterinario:</label>
                            <select name="user_id" id="user_id" class="form-control select2">
                                <option value="">Sin asignar</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id === $appointment->user_id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="setfooter">
                            <button id="back" type="button">Cancelar</button>
                            <button id="next" type="submit" class="btn btn-secondary">Guardar</button>
                        </div>
                    </form>
                </div>
                <script>
                    var baseUrl = "{{ config('app.base_url') }}";
                    document.getElementById("back").addEventListener("click", function() {
                        window.location.href = baseUrl + "dashboard";
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
            $('.select2').select2({  width: '100%' });
        });
    </script>
</x-app-layout>
