@extends('layouts/base')
@section('site-title', 'Tournaments')
@section('css', 'pages/tournaments')
@section('content')
<section id="tournaments">
    <h1 class="title">
        @if($can_edit)
        <a href="{{ route('create.tournament.route') }}" class="btn right">Nieuw</a>
        @endif
        Huidige Toernooien
    </h1>
    <div class="row equal-height">
        @foreach($current_tournaments as $tournament)
        <div class="col s12 m6">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                @if($can_edit)
                                <a href="{{ route('edit.tournament.route', $tournament->id) }}" class="btn right">Aanpassen</a>
                                @endif
                                <a href="{{ route('tournament', $tournament->id) }}"><span class="title font-size-5">{{ $tournament->name }}</span></a> </br>
                            </div>
                            @foreach($tournament->getDutchDate(false) as $date)
                            <div class="col s12">
                                <span class="font-size-6 centre">
                                    {{ $date }}
                                    @if(!$loop->last) </br>- @endif 
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h1 class="title">
        Komende Toernooien
    </h1>
    <div class="row equal-height">
        @foreach($upcoming_tournaments as $tournament)
        <div class="col s12 m6">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                @if($can_edit)
                                <a href="{{ route('edit.tournament.route', $tournament->id) }}" class="btn right">Aanpassen</a>
                                @endif
                                <a href="{{ route('tournament', $tournament->id) }}"><span class="title font-size-5">{{ $tournament->name }}</span></a> </br>
                            </div>
                            @foreach($tournament->getDutchDate() as $date)
                            <div class="col s12">
                                <span class="font-size-6 centre">
                                    {{ $date }}
                                    @if(!$loop->last) </br>- @endif 
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h1 class="title">
        Beëindigde toernooien
    </h1>
    <div class="row equal-height">
        @foreach($finished_tournaments as $tournament)
        <div class="col s12 m6">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                @if($can_edit)
                                <a href="{{ route('edit.tournament.route', $tournament->id) }}" class="btn right">Aanpassen</a>
                                @endif
                                <a href="{{ route('tournament', $tournament->id) }}"><span class="title font-size-5">{{ $tournament->name }}</span></a> </br>
                            </div>
                            @foreach($tournament->getDutchDate() as $date)
                            <div class="col s12">
                                <span class="font-size-6 centre">
                                    {{ $date }}
                                    @if(!$loop->last) </br>- @endif 
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
