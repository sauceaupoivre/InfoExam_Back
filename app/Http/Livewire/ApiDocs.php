<?php

namespace App\Http\Livewire;

use App\Models\Examen;
use Livewire\Component;

class ApiDocs extends Component
{
    public $json = [];

    public function getCartouches(){
        $this->json = Examen::with('salle','alertes','formation','epreuve')->get();
    }
    public function render()
    {
        return view('livewire.api-docs');
    }
}
