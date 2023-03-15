@extends('../layouts/template')
@section('title', 'Gestion | Épreuves')

@section('content')

    <!-- AddModal -->
    <div class="modal fade" id="addepreuve" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('examens.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une épreuve</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- CHOIX FORMAT -->
                        <div class="d-flex justify-content-center" id="epreuve-format">
                            <input type="radio" class="btn-check" name="estdematerialise" id="option1" value="1" autocomplete="off" required>
                            <label class="btn btn-outline-primary me-2" name="" for="option1">Dématerialisé</label>

                            <input type="radio" class="btn-check" name="estdematerialise" id="option2" value="0" autocomplete="off">
                            <label class="btn btn-outline-primary" for="option2">Manuscrit</label>
                        </div>

                        <hr>
                        <!-- COMMUNS -->
                        <div class="input-group mb-2">
                            <span class="input-group-text">Session : </span>
                            <input type="number" class="form-control" name="session" min="1900" step="1" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Concours/Examen : </span>
                            <input type="text" class="form-control" name="examen_concours" value="{{ old('examen_concours') }}" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Spécialité/Option/Série/Section : </span>
                            <input type="text" class="form-control" name="serie" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Épreuve/Sous-épreuve : </span>
                            <input type="text" class="form-control" name="epreuve" required>
                        </div>

                        <!-- UNIQUES DEMATERIALISE -->
                        <div id="input-dematerialise" class="input-dematerialise input-group mb-2" style="display: none">
                            <span class="input-group-text">Matière : </span>
                            <input id="matiere" type="text" name="matiere" class="form-control">
                        </div>

                        <!-- UNIQUES MANUSCRITE -->
                        <div id="input-manuscrit" class="input-manuscrit input-group mb-2" style="display: none">
                            <span class="input-group-text">Académie : </span>
                            <input id="academie" type="text" name="academie" class="form-control">
                        </div>

                        <hr>

                        <!-- CHOIX SALLE FORMATION DATE -->
                        <div class="input-group mb-2">
                            <span class="input-group-text">Choisir une salle : </span>
                            <select class="form-select" name="salle" aria-label="Default select example" required>
                                <option value="" disabled selected hidden>Salles...</option>
                                @forelse ($salles as $s)
                                    <option value="{{$s->id}}">{{$s->nom}}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Choisir une formation : </span>
                            <select class="form-select" name="formation" aria-label="Default select example" required>
                                <option value="" disabled selected hidden>Formations...</option>
                                @forelse ($formations as $f)
                                    <option value="{{$f->id}}">{{$f->nom}}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Choisir une date : </span>
                            <input class="form-control" id="date" type="date" name="date" value="" required>
                        </div>

                        <hr>

                        <!-- Heures -->
                        <div class="input-group mb-2">
                            <span class="input-group-text">Heure début : </span>
                            <input type="time" id="debut" name="debut" value="" class="form-control" min="00:00" max="24:00" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Heure fin : </span>
                            <input type="time" id="fin" name="fin" value="" class="form-control" min="00:00" max="24:00" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Mise en loge : </span>
                            <input type="time" id="loge" name="loge" value="02:00" class="form-control" min="00:00" max="24:00" required>
                        </div>

                        <hr>

                        <!-- Règles -->
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table liste épreuves-->
    <div class="pt-4 pb-4">

        <!-- Trigger AddModal -->
        <button type="button" class="btn btn-primary ms-4 mb-2" data-bs-toggle="modal" data-bs-target="#addepreuve">
            Ajouter une épreuve <i class="bi bi-plus-square"></i>
        </button>

        <div class="card ">
            <div class="card-header card-header-blue">
                <h4 class="text-center mb-0 text-white">LISTE DES ÉPREUVES</h4>
            </div>
            <div class="card-body">
                <!-- Debut Table -->
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Début</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Formation</th>
                        <th scope="col">Épreuve</th>
                        <th scope="col">Cartouche</th>
                        <th scope="col">Modifier/Supprimer</th>
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($examens as $e)
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal-{{$e->id}}" tabindex="-1" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$e->epreuve->epreuve}} {{$e->formation->nom}}</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûrs de vouloir supprimer cette épreuve ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="{{ route('epreuves.destroy',$e->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                        </div>

                        <tr>
                            <td>{{date("d-m-Y",strtotime($e->date))}}</td>
                            <td>{{date("H",strtotime($e->epreuve->debut))."h".date("i",strtotime($e->epreuve->debut))}}</td>
                            <td>{{$e->salle->nom}}</td>
                            <td>
                                {{$e->formation->nom}}
                            </td>
                            <td>{{$e->epreuve->epreuve}}</td>
                            <td>
                                @if ($e->estdematerialise == 1)
                                    Dématérialisé
                                @else
                                    Manucrit
                                @endif
                            </td>
                            <td>
                                <a href="{{route('epreuves.show',$e->id)}}"><button class="btn btn-primary btn-small"><i class="bi bi-pencil-square"></i></button></a>
                                <button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$e->id}}">
                                    <i class="bi bi-x-square"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <p class="text-muted">Pas d'épreuves</p>
                        @endforelse
                    </tbody>
                </table>
                <!-- Fin Table -->
            </div>
            <div class="card-footer">
                {{ $examens->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>



@stop

