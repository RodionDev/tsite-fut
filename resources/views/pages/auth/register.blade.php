@extends('layouts/base')
@section('site-title', 'Registreren')
@section('header')
@include('components/header/header-no-menu')
@endsection
@section('content')
<section id="register">
    <h1 class="title">Registreren</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="/registreren/" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col s12 input-field">
                        <input id="first_name" type="text" class="validate" name="first_name" required autofocus />
                        <label for="first_name">Voornaam</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul je voornaam in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="sur_name" type="text" class="validate" name="sur_name" required />
                        <label for="sur_name">Achternaam</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul je achternaam in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <div class="file-field input-field">
                            <div class="waves-effect waves-light btn">
                                <span>Upload</span>
                                <input type="file" name="avatar">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="avatar" class="file-path validate" type="text" placeholder="Avatar" />
                            </div>
                        </div>
                        <span class="helper-text" data-error="Selecteer een correcte afbeelding." data-success="">Optioneel: upload een afbeelding.</span>
                    </div>
                    <div class="col s12 input-field">
                        <label for="password">Wachtwoord</label>
                        <input id="password" type="password" class="validate" name="password" required />
                        <span class="helper-text" data-error="Vul een correct wachtwoord in." data-success="">Vul een wachtwoord in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <label for="password-confirm">Wachtwoord Bevestigen</label>
                        <input id="password-confirm" type="password" class="validate" name="password_confirmation" required />
                        <span class="helper-text" data-error="Vul een correct wachtwoord in." data-success="">Vul je wachtwoord nog een keer in.</span>
                    </div>
                    <div class="col s12 input-field hide">
                        <input id="token" type="text" name="token" value="{{ $register_token }}" required />
                    </div>
                    <div class="col s12 input-field">
                        <button type="submit" class="waves-effect waves-light btn">
                            Registreren
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
