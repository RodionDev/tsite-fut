@extends('layouts/base')
@section('site-title', 'Wedstrijd')
@section('js', 'pages/cud-tournament')
@section('content')
<section id="new-team">
    @if($permission >= 50 && $updating)
    <a href="{{ route('match.delete.route', $match->id) }}" class="btn right">Verwijderen</a>
    @endif
    @if($updating)
    <h1 class="title">Wedstrijd Aanpassen</h1>
    <form method="POST" action="{{ route('match.edit') }}" enctype="multipart/form-data">
    @else
    <h1 class="title">Wedstrijd Toevoegen</h1>
    <form method="POST" action="{{ route('match.create') }}" enctype="multipart/form-data">
    @endif
        @csrf
        <input type="text" class="hide" name="id" value="{{ $match->id or null }}" />  
        @if(!empty($tournament_id))
        <input type="text" class="hide" name="tournament_id" value="{{ $tournament_id or null }}" />  
        @endif
        @if($permission >= 50)
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 input-field">
                        <input id="date" type="date" class="validate" name="date" value="{{ $start_date or null }}" />
                        <label for="date">Start Datum</label>
                        <span class="helper-text" data-error="Vul een correcte datum in." data-success="">Vul een datum in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="time" type="time" class="validate" name="time" value="{{ $start_time or null }}" />
                        <label for="time">Start Tijd</label>
                        <span class="helper-text" data-error="Vul een correcte tijd in." data-success="">Vul een tijd in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="field" type="number" class="validate" name="field" value="{{ $match->field or null }}" />
                        <label for="field">Speel veld</label>
                        <span class="helper-text" data-error="Vul een correct getal in." data-success="">Vul het veld nummer in.</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($updating)
        <h1 class="title">Scores</h1>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m6">
                        <span>
                            <img class="px52 vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                            {{ $match->result1->team->name}}
                        </span></br>
                        <input name="score1" type="number" value="{{ $match->result1->score or null }}"></input>
                    </div>
                    <div class="col s12 m6">
                        <span>
                            <img class="px52 vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                            {{ $match->result2->team->name}}
                        </span></br>
                        <input name="score2" type="number" value="{{ $match->result2->score or null }}"></input>
                    </div>
                </div>
            </div>
        </div>
        @else
        <h1 class="title">Teams</h1>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="col s1">
                                <img id="team1-image" class="px52"></img>
                            </div>
                            <div class="col s11 input-field">
                                <input id="team1-id" type="text" class="hide" name="team1_id" />  
                                <input id="team1" type="text" class="validate search-input" name="team1" required />  
                                <ul data-search-input="team1" data-search-image="team1-image" data-search-output="team1-id" data-search-id=3 class="collection z-depth-3 search-results hide"></ul> 
                                <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een team's naam in.</span>
                                <label for="team1">Team 1</label>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="col s1">
                                <img id="team2-image" class="px52"></img>
                            </div>
                            <div class="col s11 input-field">
                                <input id="team2-id" type="text" class="hide" name="team2_id" />  
                                <input id="team2" type="text" class="validate search-input" name="team2" required />  
                                <ul data-search-input="team2" data-search-image="team2-image" data-search-output="team2-id" data-search-id=3 class="collection z-depth-3 search-results hide"></ul> 
                                <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een team's naam in.</span>
                                <label for="team2">Team 2</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <button type="submit" class="waves-effect waves-light btn">
            @if($updating)
            Opslaan
            @else
            Aanmaken
            @endif
        </button>
    </form>
</section>
@endsection
