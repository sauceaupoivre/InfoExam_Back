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
            $this->cartouches = Examen::where('date','like','%'.$this->date.'%')->get();
        }
    }

    public function render()
    {
        return view('livewire.alerte-send');
    }
}
