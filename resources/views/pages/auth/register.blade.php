@extends('layouts/base')
@section('site-title', 'Registreren')
@section('content')
<section id="register">
    <h1 class="title">Registreren</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="{{ route('register') }}">
                <div class="row">
                    @csrf
                    <div class="col s12 input-field">
                        <input id="name" type="text" class="validate" name="name" required autofocus />
                        <label for="name">Naam</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een naam in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="email" type="email" class="validate" name="email" required />
                        <label for="email">E-mailadres</label>
                        <span class="helper-text" data-error="Vul een correct e-mailadres in." data-success="">Vul een e-mailadres in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <label for="password">Wachtwoord</label>
                        <input id="password" type="password" class="validate" name="password" required>
                        <span class="helper-text" data-error="Vul een correct e-mailadres in." data-success="">Vul een wachtwoord in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <label for="password-confirm">Wachtwoord Bevestigen</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        <span class="helper-text" data-error="Vul een correct wachtwoord in." data-success="">Vul je wachtwoord nog een keer in.</span>
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
