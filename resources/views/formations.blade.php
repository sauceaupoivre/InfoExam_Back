@extends('../layouts/template')
@section('title', 'Gestion | Formations')

@section('content')
@if (!isset($formationsSecond))
<section class="Section1">
    <div>
        <div class="Section1DivBtn" class="mt-4">
            <button type="button" class="btn btn-primary create mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Créer une formation<i class="bi bi-plus-square" style="padding-left: 0.5vw;"></i></button>
            <form action="{{route("formationsSearch")}}"  method="post" class="mb-2 mt-4">
                @csrf
                <input type="text" class="form-control" id="recherche" name="recherche" pattern="[A-Za-z]{1,}.*" placeholder ="Recherche">
                <button type="submit" class="btn btn-primary" id="chercher">Rechercher<i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Créer une formation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('formations.create')}}">
                    @csrf
                    @method("GET")
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="name" name="nom"  pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 3 caractères" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Serie :</label>
                        <input type="text" class="form-control" id="message" rows="3" name="numeros" value="" pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 1 caractères" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Academie : </label>
                        <input type="text" class="form-control" id="message" rows="3" name="academie" pattern="[A-Za-z]{3,}.*" placeholder ="Minimum 3 caractères" required>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

<div class="card ">
    <div class="card-header card-header-blue">
        <h4 class="text-center mb-0 text-white">LISTE DES FORMATIONS</h4>
    </div>
    <div class="card-body epreuve-table">
        <table class="table text-center">
            <thead>
              <tr>
                <th scope="col">Formations</th>
                <th scope="col">Académie</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
                @forelse($formations as $lignes)
                <tr class="Section1TableLine">
                    <td>{{$lignes->nom}} {{$lignes->serie}}</td>
                    <td>{{$lignes->academie}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$lignes->id}}"><i class="bi bi-pencil-square"></i></button>
                        <div class="modal fade" id="exampleModal{{$lignes->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modifier{{$lignes->nom}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{route('formations.update', $lignes->id)}}">
                                    @csrf
                                    @method("PUT")
                                    <div class="mb-3">
                                      <label for="name" class="form-label">Nom :</label>
                                      <input type="text" class="form-control" id="name" name="nom" value="{{$lignes->nom}}"  pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 3 caractères" required>
                                    </div>
                                    <div class="mb-3">
                                      <label for="message" class="form-label">Serie : </label>
                                      <input type="text" class="form-control" id="message" rows="3" name="numeros" value="{{ isset($lignes->serie) ? $lignes->serie : 'Optionnel' }}" pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 1 caractères">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Académie : </label>
                                        <input type="text" class="form-control" id="message" rows="3" name="academie" value="{{$lignes->academie}}" pattern="[A-Za-z]{3,}.*" placeholder ="Minimum 3 caractères" required>
                                      </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir modifier cet élément ?')">Modifier</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$lignes->id}}">
                            <i class="bi bi-x-square"></i>
                        </button>
                    </td>
                </tr>
                    <div class="modal fade" id="deleteModal-{{$lignes->id}}" tabindex="-1" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">{{$lignes->nom}}</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûrs de vouloir supprimer cette formation ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="{{route("formations.destroy",$lignes->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-muted">Il n'existe pas de formation(s)</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</section>
@else
<section class="Section1">
    <div>
        <div class="Section1DivBtn mb-2 mt-4">
            <button type="button" class="btn btn-primary create" data-bs-toggle="modal" data-bs-target="#exampleModal">Créer une formation <i class="bi bi-plus-square"></i></button>
            <form action="{{route("formationsSearch")}}" method="post">
                @csrf
                <input type="text" class="form-control" id="recherche" name="recherche" pattern="[A-Za-z]{1,}.*" placeholder ="Recherche">
                <button type="submit" class="btn btn-primary" id="chercher">Rechercher<i class="bi bi-search""></i></button>
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Créer une formation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('formations.create')}}">
                    @csrf
                    @method("GET")
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="name" name="nom" pattern="[A-Za-z]{3,}.*" placeholder ="Minimum 3 caractères" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Serie :</label>
                        <input type="text" class="form-control" id="message" rows="3" name="numeros" value="" pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 1 caractères" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Academie : </label>
                        <input type="text" class="form-control" id="message" rows="3" name="academie" pattern="[A-Za-z]{3,}.*" placeholder ="Minimum 3 caractères" required>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
<div class="card ">
    <div class="card-header card-header-blue">
        <h4 class="text-center mb-0 text-white">LISTE DES FORMATIONS</h4>
    </div>
    <div class="card-body epreuve-table">
        <table class="table text-center">
            <thead>
              <tr>
                <th scope="col">Formations</th>
                <th scope="col">Académie</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($formationsSecond as $lignes)
                <tr class="Section1TableLine">
                    <td>{{$lignes->nom}} {{$lignes->serie}}</td>
                    <td>{{$lignes->academie}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$lignes->id}}"><i class="bi bi-pencil-square"></i></button>
                        <div class="modal fade" id="exampleModal{{$lignes->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modifier{{$lignes->nom}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{route('formations.update', $lignes->id)}}">
                                    @csrf
                                    @method("PUT")
                                    <div class="mb-3">
                                      <label for="name" class="form-label">Nom :</label>
                                      <input type="text" class="form-control" id="name" name="nom" value="{{$lignes->nom}}" pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 3 caractères" required>
                                    </div>
                                    <div class="mb-3">
                                      <label for="message" class="form-label">Serie : </label>
                                      <input type="text" class="form-control" id="message" rows="3" name="numeros" value="{{ isset($lignes->serie) ? $lignes->serie : 'Optionnel' }}" pattern="[A-Za-z]{1,}.*" placeholder ="Minimum 1 caractères">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Académie : </label>
                                        <input type="text" class="form-control" id="message" rows="3" name="academie" value="{{$lignes->academie}}" pattern="[A-Za-z]{3,}.*" placeholder ="Minimum 3 caractères" required>
                                      </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir modifier cet élément ?')">Modifier</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$lignes->id}}">
                            <i class="bi bi-x-square"></i>
                        </button>
                    </td>
                </tr>
                    <div class="modal fade" id="deleteModal-{{$lignes->id}}" tabindex="-1" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">{{$lignes->nom}}</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûrs de vouloir supprimer cette formation ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="{{route("formations.destroy",$lignes->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4"class="text-muted">Il n'existe pas de formation(s) : "{{$request->recherche}}"</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</section>
@endif
@stop

