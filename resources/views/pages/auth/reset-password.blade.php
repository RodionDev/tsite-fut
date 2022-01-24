@extends('layouts/base')
@section('site-title', 'Wachtwoord Aanpassen')
@section('content')
<section id="reset-password">
    <h1 class="title">Wachtwoord Vergeten</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="{{ route('reset.password') }}">
                <div class="row">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col s12 input-field">
                        <input id="email" type="email" class="validate" name="email" value="{{ $email ?? old('email') }}" required autofocus />
                        <label for="email">E-mailadres</label>
                        <span class="helper-text" data-error="Vul een juist e-mailadres in." data-success="">Vul een e-mail in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="password" type="password" class="validate" name="password" required />
                        <label for="password" class="col-md-4 col-form-label text-md-right">Wachtwoord</label>
                        <span class="helper-text" data-error="Vul een juist wachtwoord in." data-success="">Vul een wachtwoord in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="password-confirm" type="password" class="validate" name="password_confirmation" required />
                        <label for="password-confirm">Wachtwoord bevestigen</label>
                        <span class="helper-text" data-error="Vul een juist wachtwoord in." data-success="">Vul een wachtwoord in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input type="hidden" name="token" value="{{ $token }}">
                    </div>
                    <div class="col s12 input-field">
                        <button type="submit" class="waves-effect waves-light btn">
                            Wachtwoord aanpassen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
