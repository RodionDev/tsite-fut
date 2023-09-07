@extends('layouts/base')
@if($registering)
    @section('site-title', 'Registreren')
    @section('header')
    @include('components/header/header-no-menu')
    @endsection
@else
    @section('site-title', 'Profiel Aanpassen')
@endif
@section('content')
<section id="register">
    @if($registering)
    <h1 class="title">Registreren</h1>
    @else
    <h1 class="title">Profiel Aanpassen</h1>
    @endif
    @if($registering)
    <form method="POST" action="/registreren" enctype="multipart/form-data">
    @else
    <form method="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 input-field">
                        <input id="first_name" type="text" value="{{ $user->first_name or '' }}" class="validate" name="first_name" required autofocus />
                        <label for="first_name">Voornaam*</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul je voornaam in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="sur_name" type="text" value="{{ $user->sur_name or '' }}" class="validate" name="sur_name" required />
                        <label for="sur_name">Achternaam*</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul je achternaam in.</span>
                    </div>
                    @if(!$registering)
                    <div class="col s12">
                        <img class="hoverable avatar-preview" src="{{ $user->avatar }}" />
                    </div>
                    @endif
                    <div class="col s12 input-field">
                        <div class="file-field input-field">
                            <div class="waves-effect waves-light btn">
                                <span>Upload</span>
                                <input type="file" name="avatar">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="avatar" class="file-path validate" type="text" placeholder="Profiel foto" />
                            </div>
                        </div>
                        <span class="helper-text" data-error="Selecteer een correcte afbeelding." data-success="">Upload een afbeelding.</span>
                    </div>
                    @if($registering)
                    <div class="col s12 input-field">
                        <label for="password">Wachtwoord*</label>
                        <input id="password" type="password" class="validate" name="password" required />
                        <span class="helper-text" data-error="Vul een correct wachtwoord in." data-success="">Vul een wachtwoord in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <label for="password-confirm">Wachtwoord Bevestigen*</label>
                        <input id="password-confirm" type="password" class="validate" name="password_confirmation" required />
                        <span class="helper-text" data-error="Vul een correct wachtwoord in." data-success="">Vul je wachtwoord nog een keer in.</span>
                    </div>
                    <div class="col s12 input-field hide">
                        <input id="token" type="text" name="token" value="{{ $register_token }}" required />
                    </div>
                    <div class="col s12 input-field">
                        <p>
                            <label>
                                <input name="terms-of-service" type="checkbox" required>
                                <span>Ja, ik accepteer de <a href="{{ route('terms.of.service') }}" target="_blank">Algemene Voorwaarden</a> en het <a href="{{ route('privacy.statement') }}" target="_blank">Privacybeleid</a> van mijntoernooien.nl <i>(links openen in een nieuw venster)</i>.</span>
                            </label>
                        </p>
                    </div>
                    @endif
                    <div class="col s12 input-field">
                        @if($registering)
                        <button type="submit" class="waves-effect waves-light btn">Registreren</button>
                        @else
                        <button type="submit" class="waves-effect waves-light btn">Updaten</button>
                        <a class="waves-effect btn-flat" href="{{ route('reset.password') }}">Wachtwoord aanpassen</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
