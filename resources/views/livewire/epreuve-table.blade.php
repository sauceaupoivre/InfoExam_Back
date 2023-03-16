<div>
      <!-- AddModal -->
      <div class="modal fade" id="addepreuve" tabindex="-1" aria-labelledby="addepreuve" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('epreuves.store')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une épreuve</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-2">
                            <span class="input-group-text">Examen/Concours : </span>
                            <input id="examen_concours" type="text" name="examen_concours" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Épreuve : </span>
                            <input id="epreuve" type="text" name="epreuve" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Matière : </span>
                            <input id="matiere" type="text" name="matiere" class="form-control" required>
                        </div>

                        <h1 class="modal-title fs-5 mt-4" id="exampleModalLabel">Sélection des formations</h1>
                        <hr>
                        <div class="d-flex justify-content-around flex-wrap p-2 mt-1" style="max-height: 200px;overflow-y:auto">

                            @forelse ($formations as $formation)
                                <div>
                                    <label >{{$formation->nom}}</label>
                                    <input type='checkbox' name='formations[]' value='{{$formation->id}}' />
                                </div>
                            @empty
                                <div>
                                    <p>Pas de formations enregistrées</p>
                                </div>
                            @endforelse
                        </div>

                        <hr>

                        <div class="input-group mb-2">
                            <span class="input-group-text">Description: </span>
                            <input class="form-control" id="description" type="text" name="description">
                        </div>

                        <!-- Heures -->
                        <div class="input-group mb-2">
                            <span class="input-group-text">Mise en loge : </span>
                            <input type="time" id="loge" name="loge" value="02:00" class="form-control" min="00:00" max="24:00" required>
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

        <div class="d-flex align-items-center justify-content-between">
            <!-- Trigger AddModal -->
            <div>
                <button type="button" class="btn btn-primary ms-4 mb-2" data-bs-toggle="modal" data-bs-target="#addepreuve">
                    Ajouter une épreuve <i class="bi bi-plus-square"></i>
                </button>
            </div>
            <!-- Search bar -->
            <div class="input-group mb-2 w-50 me-4">
                <span class="input-group-text" id="Recherche">Recherche</span>
                <input wire:model.debounce.400ms="search" type="text" class="form-control" placeholder="Matière...">
            </div>
        </div>
        <div class="card ">
            <div class="card-header card-header-blue">
                <h4 class="text-center mb-0 text-white">LISTE DES ÉPREUVES</h4>
            </div>
            <div class="card-body">
                <!-- Debut Table -->
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Examen/Concours</th>
                        <th scope="col">Épreuve</th>
                        <th class="sort-th" wire:click="sortBy('matiere')" scope="col">Matière <i class="bi bi-arrow-down-up"></i></th>
                        <th class="sort-th" wire:click="sortBy('loge')" scope="col">Mise en loge <i class="bi bi-arrow-down-up"></i></th>
                        <th class="sort-th" wire:click="sortBy('description')" scope="col">Description <i class="bi bi-arrow-down-up"></i></th>
                        <th scope="col">Formations</th>
                        <th scope="col">Modifier/Supprimer</th>
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($epreuves as $e)
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal-{{$e->id}}" tabindex="-1" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">{{$e->matiere}}</h1>
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
                            <td>{{$e->examen_concours}}</td>
                            <td>{{$e->epreuve}}</td>
                            <td>{{$e->matiere}}</td>
                            <td>{{date("H",strtotime($e->loge))."h".date("i",strtotime($e->loge))}}</td>
                            <td>
                                <small class="text-muted">
                                    @if ($e->description == '')
                                        Pas de description
                                    @else
                                    {{$e->description}}
                                    @endif

                                </small>
                            </td>
                            <td >
                                @forelse ($e->formations as $formation)
                                    <span class="badge text-bg-secondary m-1">{{$formation->nom}}</span>
                                @empty
                                    <small class="text-muted">Pas de formations associées</small>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{route('epreuves.show',$e->id)}}"><button class="btn btn-primary btn-small"><i class="bi bi-pencil-square"></i></button></a>
                                <button class="btn btn-danger btn-small" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$e->id}}">
                                    <i class="bi bi-x-square"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted">Pas d'épreuves</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
                <!-- Fin Table -->
            </div>
            <div class="card-footer">
                {{ $epreuves->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
