@extends('../layouts/template')
@section('title', 'Gestion | Salles')

@section('content')

    <!-- AddModal salle -->
    <div class="modal fade" id="addepreuve" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('salles.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une salle</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- CHOIX NOM -->

                        <div class="input-group mb-2">
                            <span class="input-group-text">Nom : </span>
                            <input id="nom" type="text" name="nom" class="form-control">
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

    <!-- Table liste salles-->
    <div class="pt-4 pb-4">

        <!-- Trigger AddModal salle -->
        <button type="button" class="btn btn-primary ms-4 mb-2" data-bs-toggle="modal" data-bs-target="#addepreuve">
            Ajouter une salle <i class="bi bi-plus-square"></i>
        </button>

        <div class="card ">
            <div class="card-header card-header-blue">
                <h4 class="text-center mb-0 text-white">LISTE DES SALLES</h4>
            </div>
            <div class="card-body">
                <!-- Debut Table -->
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Modifier/Supprimer</th>
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($salles as $salle)
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal-{{$salle->id}}" tabindex="-1" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$salle->nom}}</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûrs de vouloir supprimer cette salle ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="{{ route('salles.destroy',$salle->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>

                        <tr>
                            <td>
                                {{$salle->id}}
                            </td>
                            <td>{{$salle->nom}}</td>
                            <td>
                                <a href="{{route('salles.show',$salle->id)}}"><button class="btn btn-primary btn-small"><i class="bi bi-pencil-square"></i></button></a>
                                <button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$salle->id}}">
                                    <i class="bi bi-x-square"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-muted">Pas de salles</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Fin Table -->
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>



@stop

