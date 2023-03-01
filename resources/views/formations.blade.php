@extends('../layouts/template')
@section('title', 'Gestion | Formations')

@section('content')
<section class="Section1">
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-top: 2.5vh;">Créer une formation </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('formations.create')}}">
                    @csrf
                    @method("GET")
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="name" name="nom">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Code : </label>
                        <input type="text" class="form-control" id="email" name="code">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Serie : </label>
                        <input type="text" class="form-control" id="message" rows="3" name="numeros">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Academie : </label>
                        <input type="text" class="form-control" id="message" rows="3" name="academie">
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
    <br>
    <div>
        <table class="table">
            <thead class="table-dark">
              <tr>
                <th scope="col">Formations</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($formations as $lignes)
                <tr class="Section1TableLine">
                    <td>{{$lignes->nom}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{route('formations.update', $lignes->id)}}">
                                    @csrf
                                    @method("PUT")
                                    <div class="mb-3">
                                      <label for="name" class="form-label">Nom :</label>
                                      <input type="text" class="form-control" id="name" name="nom" value="{{$lignes->nom}}">
                                    </div>
                                    <div class="mb-3">
                                      <label for="email" class="form-label">Code : </label>
                                      <input type="text" class="form-control" id="email" name="code" value="{{$lignes->code}}">
                                    </div>
                                    <div class="mb-3">
                                      <label for="message" class="form-label">Serie : </label>
                                      <input type="text" class="form-control" id="message" rows="3" name="numeros" value="{{$lignes->serie}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Académie : </label>
                                        <input type="text" class="form-control" id="message" rows="3" name="academie" value="{{$lignes->academie}}">
                                      </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                    <td>
                        <form action="{{route("formations.destroy",$lignes->id)}}" method="POST">
                            @csrf
                            @method("delete")
                            <input type="submit" value="Supprimer" class="btn btn-warning">
                        </form>
                    </td>
                <tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@stop

