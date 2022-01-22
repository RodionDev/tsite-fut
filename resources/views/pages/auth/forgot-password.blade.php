@extends('layouts/base')
@section('site-title', 'Wachtwoord Vergeten')
@section('content')
<section id="forgot-password">
    <h1 class="title">Wachtwoord vergeten.</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="{{ route('forgot.password') }}">
                <div class="row">
                    @csrf
                    <div class="col s12 input-field">
                        <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                        <label for="email">E-mailadres</label>
                    </div>
                    <div class="col s12 input-field">
                            <button type="submit" class="waves-effect waves-light btn">
                                Wachtwoord reset link versturen
                            </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if (session('status'))
    <div id="sent-modal" class="modal modal-default-open">
        <div class="modal-content">
            <h4>Check je email</h4>
            <p>
                Wij hebben een email naar je verstuurd. Klik op de knop in de email om je Wachtwoord aan te passen.</br>
                </br>
                Als je de e-mail niet ziet, controleer dan op andere plaatsen; zoals de spam map.
            </p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect btn-flat">Sluiten</a>
        </div>
    </div>
    @endif
</section>
@endsection
