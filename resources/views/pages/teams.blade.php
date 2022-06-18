@extends('layouts/base')
@section('site-title', 'Teams')
@section('css', 'pages/teams')
@section('content')
<section id="teams">
        <h1 class="title">
            Teams
            <a href="#" class="btn right">Nieuw</a>
        </h1>
        <ul class="collapsible">
            @foreach($teams as $team)
            <li>
                <div class="collapsible-header">
                    <div class="row">
                        <div class="col s12 m2">
                                <img class="header-logo vertical-centre-image" src="{{ $team->logo or asset('images\image-missing.png') }}"></div>
                        <div class="col s9">
                            <span>
                                {{ $team->name }}
                            </span>
                        </div>
                        <div class="col s1"><i class="mdi mdi-36px mdi-menu-down center"></i></div>
                    </div>
                </div>
                <div class="collapsible-body">
                        <div class="row">
                            <div class="col s12">
                                <span><b>Naam:</b> {{ $team->name }}</span> </br>
                                <span><b>Logo:</b></br> <img class="hoverable avatar-preview" src="{{ $team->logo or asset('/images/image-missing.png') }}" /></span> </br>
                            </div>
                            <div class="col s12">
                                <h2 class="title">Leden</h2>
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="collection">
                                            @foreach($team->players as $user)
                                            <li class="collection-item">
                                                <img src="{{ $user->avatar or asset('/images/image-missing.png') }}" alt="" class="user-avatar circle vertical-centre-image">
                                                <span class="title">{{ $user->first_name . ' ' . $user->sur_name }}</span>
                                                <span href="#!" class="secondary-content">{{ $user->pivot->squad_number }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
@endsection
