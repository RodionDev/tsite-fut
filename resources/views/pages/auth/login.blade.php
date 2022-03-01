@extends('layouts/base')
@section('site-title', 'Login')
@section('header')
@include('components/header/header-no-menu')
@endsection
@section('content')
<section id="login">
    <h1 class="title">Login</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="{{ route('login') }}">
                <div class="row">
                    @csrf
                    <div class="col s12 input-field">
                        <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus />
                        <label for="email">E-mailadres</label>
                        <span class="helper-text" data-error="Vul een juist e-mailadres in." data-success="">Vul een e-mail in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="password" type="password" class="validate" name="password" required />
                        <label for="password">Wachtwoord</label>
                        <span class="helper-text" data-error="Vul een juist wachtwoord in." data-success="">Vul een wachtwoord in.</span>
                    </div>
                    <div class="col s12">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                            <span>Onthoud Mij</span>
                        </label>
                    </div>
                    <div class="col s12 input-field">
                        <button type="submit" class="waves-effect waves-light btn">
                            Inloggen
                        </button>
                        <a class="waves-effect btn-flat" href="{{ route('forgot.password') }}">
                            Wachtwoord Vergeten
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
