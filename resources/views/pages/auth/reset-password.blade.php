@extends('layouts/base')
@section('site-title', 'Wachtwoord Aanpassen')
@if(!Auth::Check())
@section('header')
@include('components/header/header-no-menu')
@endsection
@endif
@section('content')
<section id="reset-password">
        @if($success)
        <div id="success-modal" class="modal modal-default-open">
            <div class="modal-content">
                <h4>Wachtwoord is gereset</h4>
                <p>
                    Je wachtwoord is succesvol aangepast.
                </p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect btn-flat">Sluiten</a>
            </div>
        </div>
        @endif
    <h1 class="title">Wachtwoord Resetten</h1>
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
                    <input type="text" name="token" class="hide" value="{{ $token or null }}" />
                    <input type="email" name="email" class="hide" value="{{ $email or null }}" />
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
                    @if($token)
                    <div class="col s12 input-field">
                        <input type="hidden" name="token" value="{{ $token }}">
                    </div>
                    @endif
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
