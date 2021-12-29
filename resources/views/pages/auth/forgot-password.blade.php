@extends('layouts/base')
@section('site-title', 'Email')
@section('content')
<section id="login">
    <h1 class="title">Wachtwoord vergeten.</h1>
    <div class="card">
        <div class="card-content">
            @if (session('status'))
                {{ session('status') }}
            @endif
            <form method="POST" action="{{ route('forgot.password') }}">
                </div class="row">
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
</section>
@endsection
