<div>
    <div class="m-4 pt-4">
        <h1>Get</h1>
        <hr>
        <button wire:click="getCartouches()" type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-primary">Primary</button>
    </div>
    <div class="display-json border rounded m-4">
        @if (empty($this->json))
            <p class="text-muted text-center m-4">Cliquez sur un bouton pour afficher le contenu de la requète.</p>
        @else
            {{json_encode($this->json)}}
        @endif
    </div>

</div>
