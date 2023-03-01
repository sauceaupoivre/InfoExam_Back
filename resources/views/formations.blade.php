@extends('../layouts/template')
@section('title', 'Gestion | Formations')

@section('content')
<section class="Section1">
    <div>
        <p>Tableau des Formations</p>
    </div>
    <div>
        <table class="table">
            <thead class="thead-dark">
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Modifier</button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="myModalLabel">Modifier la formations</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{route('formations.update', $lignes->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                      <label for="nom">Nom :</label>
                                      <input type="text" class="form-control" id="nom" name="nom" value="{{ $lignes->nom }}">
                                    </div>
                                    <div class="form-group">
                                      <label for="code">Code :</label>
                                      <input type="text" class="form-control" id="code" name="code" value="{{ $lignes->code }}">
                                    </div>
                                    <div class="form-group">
                                      <label for="numeros">Serie :</label>
                                      <input type="text" class="form-control" id="numeros" name="numeros" value="{{ $lignes->serie }}">
                                    </div>
                                    <div class="form-group">
                                      <label for="academie">AcadÃ©mie :</label>
                                      <input type="text" class="form-control" id="academie" name="academie" value="{{ $lignes->academie }}">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                                      <button type="submit" class="btn btn-primary">Enregistrer</button>
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
