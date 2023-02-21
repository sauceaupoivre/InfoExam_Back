<x-guest-layout>
    <h4 style="text-align:center" class="m-auto pt-4">Connexion</h4>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="bg-light rounded border w-50 m-auto p-4 shadow-sm">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text">Email :</span>
                    <input class="form-control" id="email"  type="email" name="email" :value="old('email')" required autofocus>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Mot de passe : </span>
                    <input class="form-control" id="password" type="password" name="password" required autocomplete="current-password">
                </div>



                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                    </label>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-3">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 text-dark" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary ms-3">Se connecter</button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
