@extends('layouts/base')
@section('site-title', 'Profiel')
@section('content')
<section id="profile">
        <h1 class="title">
            Profiel
            <a href="/profiel-aanpassen/" class="btn right">Profiel wijzigen</a>
        </h1>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 center">
                        <span class="font-size-3">{{ $user->first_name . " " . $user->sur_name}}</span>
                    </div>
                    <div class="col s12 center">
                        <img class="hoverable avatar-preview" src="{{ $user->avatar }}" />
                    </div>
                    <div class="col s12">
                        <span>{{ $user->email }}</span> </br>
                        @if($user->teams())
                        <span>
                            <b class="left">Teams:&nbsp;</b>
                            <ul class="comma-list">
                                @foreach($user->teams as $team)
                                    <li>{{ $team->name }}</li>
                                @endforeach
                            </ul>
                        </span>
                        @endif
                    </div>
                    <div class="col s12">
                        <h2 class="title">Man of the matches</h2>
                    </div>
                    <div class="col s12">
                        <a href="/uitloggen/" class="btn">Uitloggen</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
