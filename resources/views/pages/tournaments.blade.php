@extends('layouts/base')
@section('site-title', 'Tournaments')
@section('css', 'pages/tournaments')
@section('content')
<section id="tournaments">
    <h1 class="title">
        <a href="#" class="btn right">Nieuw</a>
        Huidige Toernooien
    </h1>
    @foreach($current_tournaments as $tournament)
    <div class="col s12 m7">
        <div class="card horizontal">
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
                            <span class="font-size-6">
                                {{ $date }}
                                @if(!$loop->last) - @endif 
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <h1 class="title">
        Komende Toernooien
    </h1>
    @foreach($upcoming_tournaments as $tournament)
    <div class="col s12 m7">
        <div class="card horizontal">
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
                            <span class="font-size-6">
                                {{ $date }}
                                @if(!$loop->last) - @endif 
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <h1 class="title">
        Beëindigde toernooien
    </h1>
    @foreach($finished_tournaments as $tournament)
    <div class="col s12 m7">
        <div class="card horizontal">
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
                            <span class="font-size-6">
                                {{ $date }}
                                @if(!$loop->last) - @endif 
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection
