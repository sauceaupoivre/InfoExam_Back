@extends('../layouts/template')
@section('title', 'Modifier | Épreuve')

@section('content')


<form action="{{route('salles.update',$salle->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="card mt-4">
        <!-- CHOIX FORMAT -->
        <div class="card-header card-header-blue">
            <h3 class="text-center text-light m-0">Modifier la salle {{$salle->nom}}</h3>
        </div>

        <div class="card-body">
            <div class="overflow-auto "style="max-height:45vh;">
                <div class="input-group mb-2">
                    <span class="input-group-text">Nom : </span>
                    <input id="nom" type="text" name="nom" placeholder="{{$salle->nom}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Modifer</button>
        </div>
    </div>
</form>

@stop

