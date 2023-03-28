<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Epreuve;
use App\Models\Formation;
use Livewire\WithPagination;

class EpreuveTable extends Component
{
    use WithPagination;

    public $sort = 'id';
    public $sortDirection = 'asc';
    public $search = '';

    public $formations ;

    public function sortBy($column){
        if($this->sortDirection === 'asc'){
            $this->sortDirection = 'desc';
        }else{
            $this->sortDirection = 'asc';
        }
        $this->sort = $column;
    }

    public function updated(){

    }
    public function mounted()
    {

    }
    public function render()
    {
        $this->formations = Formation::all();
        return view('livewire.epreuve-table',[
            'epreuves' => Epreuve::where('matiere','Like','%'.$this->search.'%')->orWhere('examen_concours','Like','%'.$this->search.'%')->orWhere('epreuve','Like','%'.$this->search.'%')->orderBy($this->sort, $this->sortDirection)->paginate(10)
        ]);
    }


}
