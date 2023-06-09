<div>
    <div>
        <div class="form-group">
            <label for="type">Tipo:</label>
            <select wire:model="selectedType" name="selectedType" id="selectedType" class="form-control">
                <option value="">Selecciona el tipo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@if(!is_null($breeds))
    <div>
        <div class="form-group">
            <label for="breed">Razas:</label>
            <select wire:model="selectedBreed" name="selectedBreed" id="selectedBreed" class="form-control ">
                <option value="">Selecciona la raza</option>
                @foreach ($breeds as $breed)
                    <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

</div>
