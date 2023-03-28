<?php

namespace App\Http\Livewire;

use App\Models\Examen;
use DateTime;
use Livewire\Component;

class AlerteSend extends Component
{
    public $date;
    public $cartouches;

    public function updated(){
        if($this->date != null){
            $cartouchesByDate = Examen::where('date','LIKE','%'.$this->date.'%')->get();

            $this->cartouches = $cartouchesByDate->load('salle')->pluck('salle')->unique();

        }
    }

    public function render()
    {
        return view('livewire.alerte-send');
    }
}
