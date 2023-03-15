@extends('../layouts/template')
@section('title', 'Modifier | Épreuve')

@section('content')


<form action="{{route('epreuves.update',$epreuve->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="card mt-4">
        <!-- CHOIX FORMAT -->
        <div class="card-header card-header-blue">
            <h3 class="text-center text-light m-0">Modifier une épreuve</h3>
        </div>

        <div class="card-body">

                <!-- UNIQUES DEMATERIALISE -->
                <div id="input-dematerialise" class="input-group mb-2">
                    <span class="input-group-text">Matière : </span>
                    <input id="matiere" type="text" name="matiere" class="form-control" value="{{$epreuve->matiere}}" placeholder="{{$epreuve->matiere}}">
                </div>

                <hr>

                <!-- Heures -->
                <div class="input-group mb-2">
                    <span class="input-group-text">Heure début : </span>
                    <input type="time" id="debut" name="debut" value="{{date('H:i',strtotime($epreuve->debut))}}" class="form-control" min="00:00" max="24:00" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Heure fin : </span>
                    <input type="time" id="fin" name="fin" value="{{date('H:i',strtotime($epreuve->fin))}}" class="form-control" min="00:00" max="24:00" required>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Mise en loge : </span>
                    <input type="time" id="loge" name="loge" value="02:00" class="form-control" min="00:00" max="24:00" required>
                </div>

            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Modifer</button>
        </div>
    </div>
</form>

@stop

