@extends('../layouts/template')
@section('title', "Gestion | Alertes")

@section('content')

<form action="{{route('alertes.store')}}" method="POST" enctype="multipart/form-data" class="mt-4">
    @csrf
    <h4 class="text-center mb-3">Veuillez choisir une date d'épreuve</h4>
    <div class="input-group m-auto w-50">
        <span class="input-group-text">Choisir une date : </span>
        <input class="form-control" id="date-alerte" type="date" name="date" value="" required>
    </div>

    <div id="div-epreuves" class="w-50 m-auto mt-3 mb-3" style="display: none">
        <div class="input-group">
            <span class="input-group-text">Choisir une épreuve : </span>
            <select id="epreuves" class="form-select" name="epreuves" required>
                <option value="" disabled selected hidden>Choisir une épreuve</option>
            </select>
        </div>
    </div>

    <div class="card text-bg-light mb-3 mt-4">
        <div class="card-header"><h4 class="text-center mb-0">ENVOYER UNE ALERTE</h4></div>
        <div class="card-body">

            <div class="overflow-auto" style="max-height:35vh">
                <div class="mb-3">
                    <input type="text" name="titre" class="form-control" placeholder="Titre" value="{{old('titre')}}" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="description" placeholder="Description..." rows="3" value="{{old('description')}}" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="ms-2 mb-1" for="pdf">Envoi de pdf &#40;Optionnel&#41; :</label>
                    <input type="file"  name="pdf" id="pdf" placeholder="Envoi pdf" accept=".pdf" class="form-control">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button class="btn btn-warning text-light" type="submit">Envoyer <i class="bi bi-send-exclamation"></i></button>
            </div>


        </div>
    </div>

</form>



@stop

