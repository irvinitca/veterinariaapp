<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Type;
use App\Models\Breed;


class SelectAnidado extends Component
{
    public $selectedType = null;
    public $selectedBreed = null;
    public $breeds = null;

    public function render()
    {
        //dd($this->selectedType, $this->selectedBreed);
        return view('livewire.select-anidado', [
            'types' => Type::all()
        ]);
    }

    public function updatedSelectedType($type_id)
    {
        $this->breeds = Breed::where('type_id', $type_id)->get();
    }

    public function submit()
    {
        Livewire.log();
        // Valida que los campos select estén seleccionados
        $this->validate([
            'selectedType' => 'required',
            'selectedBreed' => 'required',
        ]);

        // Emitir evento con los valores seleccionados
        $this->emit('selectsSubmitted', [
            'type' => $this->selectedType,
            'breed' => $this->selectedBreed,
        ]);

        Livewire::dispatchBrowserEvent('submitForm');
    }
}


