@extends('../layouts/template')
@section('title', 'Modifier | Épreuve')

@section('content')


<form action="{{route('epreuves.update',$epreuve->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="card mt-4">
        <!-- CHOIX FORMAT -->
        <div class="card-header card-header-blue">
            <h3 class="text-center text-light m-0">Modifier une épreuve</h3>
        </div>

        <div class="card-body">

                <!-- UNIQUES DEMATERIALISE -->
                <div class="input-group mb-2">
                    <span class="input-group-text">Examen/Concours : </span>
                    <input id="examen_concours" type="text" name="examen_concours" class="form-control" value="{{$epreuve->examen_concours}}" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Épreuve : </span>
                    <input id="epreuve" type="text" name="epreuve" class="form-control" value="{{$epreuve->epreuve}}" required>
                </div>
                <div id="input-dematerialise" class="input-group mb-2">
                    <span class="input-group-text">Matière : </span>
                    <input id="matiere" type="text" name="matiere" required class="form-control" value="{{$epreuve->matiere}}" placeholder="{{$epreuve->matiere}}">
                </div>

                <h1 class="modal-title fs-5 mt-4" id="exampleModalLabel">Sélection des formations</h1>
                <hr>
                <div class="d-flex justify-content-around flex-wrap p-2 mt-1">
                    @foreach ($formations as $formation)
                        <div>
                            <label >{{$formation->nom}}</label>
                            <input type='checkbox' name='formations[]' value='{{$formation->id}}' {{ $epreuve->formations->contains($formation->id) ? 'checked' : ''  }}/>
                        </div>
                    @endforeach
                </div>
                <hr>

                <div class="input-group mb-2">

                    <span class="input-group-text">Durée (en heure): </span>
                    <input type="time" id="duree" name="duree" value="{{date("H",strtotime($epreuve->duree)).":".date("i",strtotime($epreuve->duree))}}" class="form-control" min="00:00" max="24:00" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Mise en loge : </span>
                    <input type="time" id="loge" name="loge" value="{{date("H",strtotime($epreuve->loge)).":".date("i",strtotime($epreuve->loge))}}" class="form-control" min="00:00" max="24:00" required>
                </div>

        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Modifer</button>
        </div>
    </div>

    </div>
</form>

@stop

