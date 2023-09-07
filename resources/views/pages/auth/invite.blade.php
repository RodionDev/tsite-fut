@extends('layouts/base')
@section('site-title', 'Uitnodigen')
@section('content')
<section id="register">
    @if($url)
    <h1 class="title">Uitnodigen Link</h1>
    <div class="card">
        <div class="card-content">
            <p class="break-word">{{ URL::to('/') . '/registreren/' . $url }}</p>
        </div>
    </div>
    @endif
    <h1 class="title">Uitnodigen</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="{{ route('invite') }}">
                <div class="row">
                    @csrf
                    <div class="col s12 input-field">
                        <input id="email" type="email" class="validate" name="email" required />
                        <label for="email">E-mailadres</label>
                        <span class="helper-text" data-error="Vul een correct e-mailadres in." data-success="">Vul een e-mailadres in.</span>
                    </div>
                    <div class="input-field col s12">
                        <select name="role">
                            <option value="" disabled selected>Kies een rol.</option>
                            @foreach( $roles as $role )
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 input-field">
                        <button type="submit" class="waves-effect waves-light btn">
                            Uitnodigen
                        </button>
                    </div>
                    <div class="col s12 input-field">
                        <label>
                            <input type="checkbox" name="request_url" />
                            <span>Laat uitnodigen URL zien</span>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
