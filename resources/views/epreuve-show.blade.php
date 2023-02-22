@extends('../layouts/template')
@section('title', 'Modifier | Épreuve')

@section('content')


<form action="{{route('examens.update',$examen->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="card mt-4">
        <!-- CHOIX FORMAT -->
        <div class="card-header card-header-blue">
            <h3 class="text-center text-light m-0">Modifier une épreuve</h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-center" id="epreuve-format">
                <input type="radio" class="btn-check" name="estdematerialise" id="option1" value="1" autocomplete="off" required>
                <label class="btn btn-outline-primary me-2" for="option1">Dématerialisé</label>

                <input type="radio" class="btn-check" name="estdematerialise" id="option2" value="0" autocomplete="off">
                <label class="btn btn-outline-primary" for="option2">Manuscrit</label>
            </div>

            <hr>
            <div class="overflow-auto "style="max-height:45vh;">
                <!-- COMMUNS -->
                <div class="input-group mb-2">
                    <span class="input-group-text">Session : </span>
                    <input type="number" class="form-control" name="session" min="1900" step="1" value="{{$examen->epreuve->session}}" placeholder="{{$examen->epreuve->session}}" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Concours/Examen : </span>
                    <input type="text" class="form-control" name="examen_concours" value="{{$examen->epreuve->examen_concours}}" placeholder="{{$examen->epreuve->examen_concours}}" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Spécialité/Option/Série/Section : </span>
                    <input type="text" class="form-control" name="serie" value="{{$examen->formation->serie}}" placeholder="{{$examen->formation->serie}}" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Épreuve/Sous-épreuve : </span>
                    <input type="text" class="form-control" name="epreuve" value="{{$examen->epreuve->epreuve}}" placeholder="{{$examen->epreuve->epreuve}}" required>
                </div>

                <!-- UNIQUES DEMATERIALISE -->
                <div id="input-dematerialise" class="input-dematerialise input-group mb-2" style="display: none">
                    <span class="input-group-text">Matière : </span>
                    <input id="matiere" type="text" name="matiere" class="form-control" value="{{$examen->epreuve->matiere}}" placeholder="{{$examen->epreuve->matiere}}">
                </div>

                <!-- UNIQUES MANUSCRITE -->
                <div id="input-manuscrit" class="input-manuscrit input-group mb-2" style="display: none">
                    <span class="input-group-text">Académie : </span>
                    <input id="academie" type="text" name="academie" class="form-control" value="{{$examen->formation->academie}}" placeholder="{{$examen->formation->academie}}">
                </div>

                <hr>

                <!-- CHOIX SALLE FORMATION DATE -->
                <div class="input-group mb-2">
                    <span class="input-group-text">Choisir une salle : </span>
                    <select class="form-select" name="salle" aria-label="Default select example" required>
                        <option value="{{$examen->salle->id}}" selected >{{$examen->salle->nom}}</option>
                        @forelse ($salles as $s)
                            <option value="{{$s->id}}">{{$s->nom}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Choisir une formation : </span>
                    <select class="form-select" name="formation" aria-label="Default select example" required>
                        <option value="{{$examen->formation->id}}" selected >{{$examen->formation->nom}}</option>
                        @forelse ($formations as $f)
                            <option value="{{$f->id}}">{{$f->nom}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-text">Choisir une date : </span>
                    <input class="form-control" id="date" type="date" name="date" value="{{date('Y-m-d',strtotime($examen->date))}}" required>
                </div>

                <hr>

                <!-- Heures -->
                <div class="input-group mb-2">
                    <span class="input-group-text">Heure début : </span>
                    <input type="time" id="debut" name="debut" value="{{date('H:i',strtotime($examen->epreuve->debut))}}" class="form-control" min="00:00" max="24:00" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Heure fin : </span>
                    <input type="time" id="fin" name="fin" value="{{date('H:i',strtotime($examen->epreuve->fin))}}" class="form-control" min="00:00" max="24:00" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Mise en loge : </span>
                    <input type="time" id="loge" name="loge" value="02:00" class="form-control" min="00:00" max="24:00" required>
                </div>

                <hr>

                <!-- Règles -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="calculatrice" value="1" id="CheckCalculatrice" {{ $examen->calculatrice == '1' ? 'checked' : ''  }}>
                    <label class="form-check-label" for="CheckCalculatrice">Calculatrice autorisée</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dictionnaire" value="1" id="CheckDictionnaire" {{ $examen->dictionnaire == '1' ? 'checked' : ''  }}>
                    <label class="form-check-label" for="CheckDictionnaire">Dictionnaire autorisé</label>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Modifer</button>
        </div>
    </div>
</form>

@stop

