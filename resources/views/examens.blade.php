@extends('../layouts/template')
@section('title', 'Gestion | Examens')

@section('content')
<script>
    $(document).ready(function () {
        $('#formations').change(function () {
            var formation_id = $(this).val();
            if (formation_id !== '') {
                $.ajax({
                    url: $("#url").val()+'/formations/' + formation_id + "/epreuves",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#epreuve').empty();
                        $.each(data, function (key, value) {
                            $('#epreuve').append('<option value="' + value.id + '">' + value.epreuve + "-" + value.matiere + '</option>');
                        });
                        $('#epreuve').prop('disabled', false);
                    }
                });
            }
            else
            {
                $('#epreuve').empty();
                $('#epreuve').prop('disabled', true);
            }
        });
    });
    $(document).ready(function () {
        $('#formationsModif').change(function () {
            var formation_id = $(this).val();
            if (formation_id !== '') {
                $.ajax({
                    url: $("#url").val()+'/formations/' + formation_id + "/epreuves",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#epreuveModif').empty();
                        $.each(data, function (key, value) {
                            $('#epreuveModif').append('<option value="' + value.id + '">' +value.epreuve + "-" +value.matiere + '</option>');
                        });
                        $('#epreuveModif').prop('disabled', false);
                    }
                });
            }
            else
            {
                $('#epreuveModif').empty();
                $('#epreuveModif').prop('disabled', true);
            }
        });
    });
    $(document).ready(function () {
        $('#formationsModifSearch').change(function () {
            var formation_id= $(this).val();
            if (formation_id !== '') {
                $.ajax({
                    url: $("#url").val()+'/formations/' + formation_id + "/epreuves",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#epreuveModifSearch').empty();
                        $.each(data, function (key, value) {
                            $('#epreuveModifSearch').append('<option value="' + value.id + '">' + value.epreuve + "-" + value.matiere +'</option>');
                        });
                        $('#epreuveModifSearch').prop('disabled', false);
                    }
                });
            }
            else
            {
                $('#epreuveModifSearch').empty();
                $('#epreuveModifSearch').prop('disabled', true);
            }
        });
    });
    $(document).ready(function () {
        $('#formationsSearch').change(function () {
            var formation_id = $(this).val();
            if (formation_id !== '') {
                $.ajax({
                    url: $("#url").val()+'/formations/' + formation_id + "/epreuves",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#epreuveSearch').empty();
                        $.each(data, function (key, value) {
                            $('#epreuveSearch').append('<option value="' + value.id + '">' + value.epreuve + "-" + value.matiere + '</option>');
                        });
                        $('#epreuveSearch').prop('disabled', false);
                    }
                });
            }
            else
            {
                $('#epreuveSearch').empty();
                $('#epreuveSearch').prop('disabled', true);
            }
        });
    });
</script>
<input type="text" id="url" value="{{url('')}}" hidden/>
@if (!isset($examensSearch))
<div class="modal fade" id="addepreuve" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('examens.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un examen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center" id="epreuve-format">
                        <input type="radio" class="btn-check" name="estdematerialise" id="option1" value="1" autocomplete="off" required>
                        <label class="btn btn-outline-primary me-2" for="option1">Dématerialisé</label>

                        <input type="radio" class="btn-check" name="estdematerialise" id="option2" value="0" autocomplete="off" required>
                        <label class="btn btn-outline-primary" for="option2">Manuscrit</label>
                    </div>
                    <hr>
                    <div class="input-group mb-2">
                        <span class="input-group-text">Choisir la salle : </span>
                        <select class="form-select" name="salle" aria-label="Default select example" required>
                            <option value="" disabled selected hidden>Salles</option>
                            @forelse ($salles as $s)
                                <option value="{{$s->id}}">{{$s->nom}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">Choisir une formation : </span>
                        <select class="form-select" id="formations" name="formation" aria-label="Default select example" required>
                            <option value="" disabled selected hidden ></option>
                            @forelse ($formations as $f)
                                <option value="{{ $f->id }}">{{$f->nom . "-" . $f->serie}}</option>
                            @empty
                            @endforelse
                        </select>
                        <select class="form-select" name="epreuve" aria-label="Default select example" id="epreuve" required disabled>
                            <option value="" disabled selected hidden></option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">Choisir une date : </span>
                        <input class="form-control" id="date" type="date" name="date" required>
                        <script>
                            var today = new Date().toISOString().split('T')[0];
                            document.getElementById('date').setAttribute('min', today);
                          </script>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Choisir heure début : </span>
                        <input class="form-control" id="date" type="time" name="hd" required>
                    </div>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="calculatrice" value="1" id="CheckCalculatrice">
                        <label class="form-check-label" for="CheckCalculatrice">Calculatrice autorisée</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dictionnaire" value="1" id="CheckDictionnaire">
                        <label class="form-check-label" for="CheckDictionnaire">Dictionnaire autorisé</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="pt-4 pb-4">
    <div class="Section1DivBtn">
        <button type="button" class="btn btn-primary create mb-2" data-bs-toggle="modal" data-bs-target="#addepreuve">Créer un examen <i class="bi bi-plus-square"></i></button>
        <form action="{{route("examensSearch")}}" method="post" class="mb-2">
            @csrf
            <input type="text" class="form-control" id="recherche" name="recherche" pattern="[A-Za-z]{1,}.*" placeholder ="Recherche">
            <button type="submit" class="btn btn-primary" id="chercher">Rechercher&nbsp;<i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="card ">
        <div class="card-header card-header-blue">
            <h4 class="text-center mb-0 text-white">LISTE DES EXAMENS</h4>
        </div>
        <div class="card-body epreuve-table">
            <table class="table text-center">
                <thead>
                <tr>
                    <th scope="col">Epreuve</th>
                    <th scope="col">Formation</th>
                    <th scope="col">Date</th>
                    <th scope="col">Heure Début</th>
                    <th scope="col">Heure Fin</th>
                    <th scope="col">Règles</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Dictionnaire</th>
                    <th scope="col">Calculatrice</th>
                    <th scope="col">Format</th>
                    <th scope="col">Salle</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($examens as $e)
                    <div class="modal fade" id="deleteModal-{{$e->id}}" tabindex="-1" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Examen de : {{$e->formation->nom}} {{$e->epreuve->matiere}}</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûrs de vouloir supprimer cet examen ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="{{ route('examens.destroy',$e->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <tr>
                        <td>{{$e->formation->nom}}</td>
                        <td>{{$e->epreuve->matiere}}</td>
                        <td>{{date("d",strtotime($e->date))."/".date("m",strtotime($e->date))."/".date("y",strtotime($e->date))}}</td>
                        <td>{{date("H",strtotime($e->debut))."h".date("i",strtotime($e->debut))}}</td>
                        <td>{{date("H",strtotime($e->fin))."h".date("i",strtotime($e->fin))}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalregle-{{$e->id}}">Voir</button>
                              <div class="modal fade" id="exampleModalregle-{{$e->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Règles de l'examen de l'épreuve : {{$e->epreuve->epreuve}}</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($e->regle == null)
                                        <p style="font-style:italic; font-size:1em;"> Aucune règle(s)</p>
                                        @else
                                        <p>{{$e->regle}}</p>
                                      @endif
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalcommentaire-{{$e->id}}">Voir</button>
                              <div class="modal fade" id="exampleModalcommentaire-{{$e->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Commentaire de l'examen de l'épreuve : {{$e->epreuve->epreuve}}</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($e->commentaires == null)
                                        <p style="font-style:italic; font-size:1em;"> Aucun commentaire</p>
                                        @else
                                        <p>{{$e->commentaires}}</p>
                                      @endif
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </td>
                    <td>@if ($e->dictionnaire == 1)
                            OUI
                        @else
                            NON
                        @endif
                    </td>
                    <td>@if ($e->calculatrice == 1)
                            OUI
                        @else
                            NON
                        @endif
                    </td>
                    <td>@if ($e->estdematerialise == 1)
                            Dématérialisé
                        @else
                            Manuscrit
                        @endif
                    </td>
                        <td>{{$e->salle->nom}}</td>
                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$e->id}}"><i class="bi bi-pencil-square"></i></button></td>
                        <td><button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$e->id}}"><i class="bi bi-x-square"></i></button></td>
                    </tr>
                    <div class="modal fade" id="exampleModal{{$e->id}}" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('examens.update',$e->id)}}" method="POST">
                                @csrf
                                @method("put")
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'examen : {{$e->formation->nom}} {{$e->epreuve->matiere}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center" id="epreuve-formatmodif">
                                            <input type="radio" class="btn-check" name="estdematerialise" id="option1modif" value="1" autocomplete="off" @if($e->estdematerialise == 1) checked="checked" @endif required>
                                            <label class="btn btn-outline-primary me-2" for="option1modif">Dématerialisé</label>

                                            <input type="radio" class="btn-check" name="estdematerialise" id="option2modif" value="0" autocomplete="off"  @if($e->estdematerialise == 0) checked="checked" @endif required>
                                            <label class="btn btn-outline-primary" for="option2modif">Manuscrit</label>
                                        </div>
                                        <hr>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">Repère : </span>
                                            <input type="text" class="form-control"  value="{{$e->repere}}" name="repere" pattern="[A-Za-z]{6,}.*" placeholder="Minimum 6 caractères">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="exampleFormControlTextarea1Modif" style="resize: none; height: 10vh;" rows="3" name="commmentaire" pattern="[A-Za-z]{6,}.*">{{$e->commentaire}}</textarea>
                                            <label for="exampleFormControlTextarea1Modif">Commentaire</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="exampleFormControlTextarea1Modif" style="resize: none;height: 10vh;" rows="3" name="regle" pattern="[A-Za-z]{6,}.*"> {{$e->regle}}</textarea>
                                            <label for="exampleFormControlTextarea1Modif">règle</label>
                                        </div>
                                        <hr>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">Choisir la salle : </span>
                                            <select class="form-select" name="salle" aria-label="Default select example" required>
                                                <option value="{{$e->salle->id}}" disabled selected hidden>{{$e->salle->nom}}</option>
                                                <option value="{{$e->salle->id}}" style="display: none"></option>
                                                @forelse ($salles as $s)
                                                    <option value="{{$s->id}}">{{$s->nom}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">Choisir une formation : </span>
                                            <select class="form-select" id="formationsModif" name="formation" aria-label="Default select example" required>
                                                <option value="{{$e->formation->id}}"disabled selected hidden >{{$e->formation->nom . " - " . $e->formation->serie}}</option>
                                                @forelse ($formations as $f)
                                                    <option value="{{ $f->id }}">{{$f->nom . "-" . $f->serie}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <select class="form-select" name="epreuve" aria-label="Default select example" id="epreuveModif"required disabled>
                                                <option value="{{$e->epreuve_id}}" disabled selected hidden>{{$e->epreuve->epreuve. " - " . $e->epreuve->matiere}}</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">Choisir une date :</span>
                                            <input class="form-control" id="dateModif" type="date" name="date"  value="{{$e->date}}"required>
                                            <script>
                                                var todayModif = new Date().toISOString().split('T')[0];
                                                document.getElementById('dateModif').setAttribute('min', todayModif);
                                              </script>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Choisir heure début : </span>
                                            <input class="form-control" id="dateModif" type="time" name="hd" value="{{$e->debut}}"required>
                                        </div>
                                        <hr>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="calculatrice" value="1" id="CheckCalculatriceModif" @if($e->calculatrice == 1) checked="checked" @endif>
                                            <label class="form-check-label" for="CheckCalculatriceModif">Calculatrice autorisée</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dictionnaire" value="1" id="CheckDictionnaireModif" @if ($e->dictionnaire == 1) checked="checked" @endif>
                                            <label class="form-check-label" for="CheckDictionnaireModif">Dictionnaire autorisé</label>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @empty
                        <tr>
                            <td colspan="13" class="text-muted">Il n'existe pas d'examen"</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>




@else
    <div class="modal fade" id="addepreuveSearch" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('examens.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabelSearch">Créer un examen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center" id="epreuve-format">
                            <input type="radio" class="btn-check" name="estdematerialise" id="option1Search" value="1" autocomplete="off" required>
                            <label class="btn btn-outline-primary me-2" for="option1Search">Dématerialisé</label>

                            <input type="radio" class="btn-check" name="estdematerialise" id="option2Search" value="0" autocomplete="off" required>
                            <label class="btn btn-outline-primary" for="option2Search">Manuscrit</label>
                        </div>
                        <hr>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Choisir la salle : </span>
                            <select class="form-select" name="salle" aria-label="Default select example" required>
                                <option value="" disabled selected hidden>Salles</option>
                                @forelse ($salles as $s)
                                    <option value="{{$s->id}}">{{$s->nom}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Choisir une formation : </span>
                                <select class="form-select" id="formationsSearch" name="formation" aria-label="Default select example" required>
                                    <option value="" disabled selected hidden ></option>
                                    @forelse ($formations as $f)
                                        <option value="{{ $f->id }}">{{$f->nom . "-" . $f->serie}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <select class="form-select" name="epreuve" aria-label="Default select example" id="epreuveSearch"required disabled>
                                    <option value="" disabled selected hidden></option>
                                </select>
                            </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Choisir une date : </span>
                            <input class="form-control" id="dateSearch" type="date" name="date" required>
                            <script>
                                var todaySearch = new Date().toISOString().split('T')[0];
                                document.getElementById('dateSearch').setAttribute('min', todaySearch);
                              </script>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Choisir heure début : </span>
                            <input class="form-control" id="dateSearch" type="time" name="hd" required>
                        </div>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="calculatrice" value="1" id="CheckCalculatriceSearch">
                            <label class="form-check-label" for="CheckCalculatriceSearch">Calculatrice autorisée</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="dictionnaire" value="1" id="CheckDictionnaireSearch">
                            <label class="form-check-label" for="CheckDictionnaireSearch">Dictionnaire autorisé</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="pt-4 pb-4">
        <div class="Section1DivBtn">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addepreuveSearch">Créer un examen <i class="bi bi-plus-square"></i></i></button>
            <form action="{{route("examensSearch")}}" method="post" class="mb-2">
                @csrf
                <input type="text" class="form-control" id="recherche" name="recherche" pattern="[A-Za-z]{1,}.*" placeholder ="Recherche">
                <button type="submit" class="btn btn-primary" id="chercher">Rechercher<i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="card ">
            <div class="card-header card-header-blue">
                <h4 class="text-center mb-0 text-white">LISTE DES EXAMENS</h4>
            </div>
            <div class="card-body epreuve-table">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Epreuve</th>
                        <th scope="col">Formation</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure Début</th>
                        <th scope="col">Heure Fin</th>
                        <th scope="col">Règles</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Dictionnaire</th>
                        <th scope="col">Calculatrice</th>
                        <th scope="col">Format</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($examensSearch as $lignes )
                            <div class="modal fade" id="deleteModalSearch-{{$lignes->id}}" tabindex="-1" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabelSearch">Examen de : {{$lignes->formation->nom}} {{$lignes->epreuve->matiere}}</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûrs de vouloir supprimer cet examen ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="{{ route('examens.destroy',$lignes->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <tr>
                            <td>{{$lignes->formation->nom}}</td>
                            <td>{{$lignes->epreuve->matiere}}</td>
                            <td>{{date("m",strtotime($lignes->date))."/".date("d",strtotime($lignes->date))}}</td>
                            <td>{{date("H",strtotime($lignes->debut))."h".date("i",strtotime($lignes->debut))}}</td>
                            <td>{{date("H",strtotime($lignes->fin))."h".date("i",strtotime($lignes->fin))}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalregleSearch-{{$lignes->id}}">Voir</button>
                                  <div class="modal fade" id="exampleModalregleSearch-{{$lignes->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabelSearch">Règles de l'examen de l'épreuve : {{$lignes->epreuve->epreuve}}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($lignes->regle == null)
                                            <p style="font-style:italic; font-size:1em;"> Aucune règle(s)</p>
                                            @else
                                            <p>{{$lignes->regle}}</p>
                                          @endif
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalcommentaireSearch-{{$lignes->id}}">Voir</button>
                                  <div class="modal fade" id="exampleModalcommentaireSearch-{{$lignes->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabelSearch">Commentaire de l'examen de : {{$lignes->epreuve->epreuve}}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($lignes->commentaires == null)
                                            <p style="font-style:italic; font-size:0.1em;"> Aucun commentaire</p>
                                            @else
                                            <p>{{$lignes->commentaires}}</p>
                                          @endif
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </td>
                            <td>@if ($lignes->dictionnaire == 1)
                                OUI
                            @else
                                NON
                            @endif</td>
                            <td>@if ($lignes->calculatrice == 1)
                                OUI
                            @else
                                NOM
                            @endif</td>
                            <td>@if ($lignes->estdematerialise == 1)
                                Dématérialisé
                            @else
                                Manuscrit
                            @endif</td>
                            <td>{{$lignes->salle->nom}}</td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSearch{{$lignes->id}}"><i class="bi bi-pencil-square"></i></button></td>
                            <td><button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModalSearch-{{$lignes->id}}"><i class="bi bi-x-square"></i></button></td>
                        </tr>
                        <div class="modal fade" id="exampleModalSearch{{$lignes->id}}" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{route('examens.update',$lignes->id)}}" method="POST">
                                    @csrf
                                    @method("put")
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabelSearch">Modifier l'examen : {{$lignes->formation->nom}} {{$lignes->epreuve->matiere}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center" id="epreuve-formatmodifSearch">
                                                <input type="radio" class="btn-check" name="estdematerialise" id="option1modifSearch" value="1" @if($lignes->estdematerialise == 1) @checked(true)@endif autocomplete="off" required>
                                                <label class="btn btn-outline-primary me-2" for="option1modifSearch">Dématerialisé</label>

                                                <input type="radio" class="btn-check" name="estdematerialise" id="option2modifSearch" value="0" @if($lignes->estdematerialise == 0) @checked(true)@endif autocomplete="off" required>
                                                <label class="btn btn-outline-primary" for="option2modifSearch">Manuscrit</label>
                                            </div>
                                            <hr>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">Repère : </span>
                                                <input type="text" class="form-control"  value="{{$lignes->repere}}" name="repere" pattern="[A-Za-z]{6,}.*" placeholder="Minimum 6 caractères">
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="exampleFormControlTextarea1ModifSearch" style="resize: none; height: 10vh;" rows="3" name="commmentaire" pattern="[A-Za-z]{6,}.*">{{$lignes->commentaire}}</textarea>
                                                <label for="exampleFormControlTextarea1ModifSearch">Commentaire</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="exampleFormControlTextarea1ModifSearch" style="resize: none;height: 10vh;" rows="3" name="regle" pattern="[A-Za-z]{6,}.*"> {{$lignes->regle}}</textarea>
                                                <label for="exampleFormControlTextarea1ModifSearch">règle</label>
                                            </div>
                                            <hr>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">Choisir la salle : </span>
                                                <select class="form-select" name="salle" aria-label="Default select example" required>
                                                    <option value="{{$lignes->salle->id}}" disabled selected hidden>{{$lignes->salle->nom}}</option>
                                                    <option value="{{$lignes->salle->id}}" style="display: none"></option>
                                                    @forelse ($salles as $s)
                                                        <option value="{{$s->id}}">{{$s->nom}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">Choisir une formation : </span>
                                                <select class="form-select" id="formationsModifSearch" name="formation" aria-label="Default select example" required>
                                                    <option value="{{$lignes->formation_id}}" disabled selected hidden >{{$lignes->formation->nom . "-" . $lignes->formation->serie}}</option>
                                                    @forelse ($formations as $f)
                                                        <option value="{{ $f->id }}">{{$f->nom . "-" . $f->serie}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <select class="form-select" name="epreuve" aria-label="Default select example" id="epreuveModifSearch"required disabled>
                                                    <option value="{{$lignes->epreuve_id}}" disabled selected hidden>{{$lignes->epreuve->epreuve . "-" . $lignes->epreuve->matiere}}</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">Choisir une date :</span>
                                                <input class="form-control" id="dateModifSearch" type="date" name="date" value="{{$lignes->date}}"required>
                                                <script>
                                                    var todaySearchModif = new Date().toISOString().split('T')[0];
                                                    document.getElementById('dateModifSearch').setAttribute('min', todaySearchModif);
                                                </script>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">Choisir heure début : </span>
                                                <input class="form-control" id="dateModifSearch" type="time" name="hd" value="{{$lignes->debut}}"required>
                                            </div>
                                            <hr>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="calculatrice" value="1" id="CheckCalculatriceModifSearch" @if($lignes->calculatrice == 1) @checked(true)@endif>
                                                <label class="form-check-label" for="CheckCalculatriceModifSearch">Calculatrice autorisée</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="dictionnaire" value="1" id="CheckDictionnaireModifSearch" @if($lignes->dictionnaire == 1) @checked(true)@endif>
                                                <label class="form-check-label" for="CheckDictionnaireModifSearch">Dictionnaire autorisé</label>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                        @forelse ($examensSearch as $examenChoose)
                        @empty
                        <tr>
                            <td colspan="13" class="text-muted">Il n'existe pas d'examen(s) : "{{$request->recherche}}"</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@stop

