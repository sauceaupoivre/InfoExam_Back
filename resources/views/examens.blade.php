@extends('../layouts/template')
@section('title', 'Gestion | Examens')

@section('content')
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
                            <label class="btn btn-outline-primary me-2" name="" for="option1">Dématerialisé</label>

                            <input type="radio" class="btn-check" name="estdematerialise" id="option2" value="0" autocomplete="off" required>
                            <label class="btn btn-outline-primary" for="option2">Manuscrit</label>
                        </div>
                        <hr>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Repère : </span>
                            <input type="text" class="form-control" name="repre" pattern="[A-Za-z]{6,}.*" placeholder="Minimum 6 caractères" required>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="commmentaire" pattern="[A-Za-z]{6,}.*" required></textarea>
                            <label for="exampleFormControlTextarea1">Commentaire</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="regle" pattern="[A-Za-z]{6,}.*" required></textarea>
                            <label for="exampleFormControlTextarea1">règle</label>
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
                            <span class="input-group-text">Choisir la formation : </span>
                            <select class="form-select" name="formation" aria-label="Default select example" required>
                                <option value="" disabled selected hidden>Formations</option>
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
                        <div class="input-group">
                            <span class="input-group-text">Choisir heure début : </span>
                            <input class="form-control" id="date" type="time" name="hd" value="" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Choisir heure fin : </span>
                            <input class="form-control" id="date" type="time" name="hf" value="" required>
                        </div>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="calculatrice" value="1" id="CheckCalculatrice" required>
                            <label class="form-check-label" for="CheckCalculatrice">Calculatrice autorisée</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="dictionnaire" value="1" id="CheckDictionnaire" required>
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
        <button type="button" class="btn btn-primary ms-4 mb-2" data-bs-toggle="modal" data-bs-target="#addepreuve">
            Créer un examen <i class="bi bi-plus-square"></i>
        </button>
        <div class="card ">
            <div class="card-header card-header-blue">
                <h4 class="text-center mb-0 text-white">LISTE DES EXAMENS</h4>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Dictionnaire</th>
                        <th scope="col">calculatrice</th>
                        <th scope="col">Dématérialisé</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Règles</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure Début</th>
                        <th scope="col">Heure Fin</th>
                        <th scope="col">Formation</th>
                        <th scope="col">Epreuve</th>
                        <th scope="col">Salle</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($examens as $e)
                        <div class="modal fade" id="deleteModal-{{$e->id}}" tabindex="-1" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Examen-{{$e->id}}</h1>
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
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                            <td>{{}}</td>
                        </tr>
                        @empty
                        <p class="text-muted">Pas d'examens</p>
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

