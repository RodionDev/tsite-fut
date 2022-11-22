@extends('layouts/base')
@section('site-title', 'Tournament')
@section('js', 'pages/cud-tournament')
@section('content')
<section id="new-team">
    @if($creating)
    <h1 class="title">Tournament Toevoegen</h1>
    @else
<a href="{{ route('delete.tournament.route', $tournament->id) }}" class="btn right">Verwijderen</a>
    <h1 class="title">Tournament Aanpassen</h1>
    @endif
    @if($creating)
    <form method="POST" action="{{ route('create.tournament') }}" enctype="multipart/form-data">
    @else
    <form method="POST" action="{{ route('edit.tournament') }}" enctype="multipart/form-data">
        <input type="text" class="hide" name="id" value="{{ $tournament->id or '' }}" />  
    @endif
        @csrf
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 input-field">
                        <input id="name" type="text" class="validate" name="name" value="{{ $tournament->name or '' }}" required />
                        <label for="name">Tournament Naam</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een naam in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="start-date" type="date" class="validate" name="start_date" value="{{ $tournament->start_date or '' }}" required />
                        <label for="start-date">Start Datum</label>
                        <span class="helper-text" data-error="Vul een correcte datum in." data-success="">Vul een datum in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="end-date" type="date" class="validate" name="end_date" value="{{ $tournament->end_date or '' }}" />
                        <label for="end-date">Eind Datum</label>
                        <span class="helper-text" data-error="Vul een correcte datum in." data-success="">Vul een datum in.</span>
                    </div>
                    <div class="col s12 m4 input-field">
                        <input id="pools-amount" type="number" class="validate" min="1" name="pools_amount" required />
                        <label for="pools-amount">Aantal Poules</label>
                        <span class="helper-text" data-error="Vul een correct aantal in (min 1)." data-success="">Vul een aantal poules in.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="col s12 input-field">
                                <input id="team" type="text" class="search-input" />  
                                <ul data-search-input="team" data-search-output="teams-list" class="collection z-depth-3 search-results hide"></ul> 
                                <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een team's naam in.</span>
                                <label for="player">Teams Toevoegen</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <ul id="teams-list" class="collection">
                                </ul>
                            </div>
                        </div>
                    <div class="col s12 input-field">
                        @if($creating)
                        <button type="submit" class="waves-effect waves-light btn">
                            Aanmaken
                        </button>
                        @else
                        <button type="submit" class="waves-effect waves-light btn">
                            Aanpassen
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
