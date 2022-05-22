@extends('layouts/base')
@section('site-title', 'Team Toevoegen')
@section('js', 'pages/new-team')
@section('content')
<section id="new-team">
    <h1 class="title">Team Toevoegen</h1>
    <div class="card">
        <div class="card-content">
            <form method="POST" action="{{ route('create.team') }}">
                <div class="row">
                    @csrf
                    <div class="col s12 input-field">
                        <input id="name" type="text" class="validate" name="name" required />
                        <label for="name">Team Naam</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een naam in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <div class="file-field input-field">
                            <div class="waves-effect waves-light btn">
                                <span>Upload</span>
                                <input type="file" name="logo">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="logo" class="file-path validate" type="text" placeholder="Logo" />
                            </div>
                        </div>
                        <span class="helper-text" data-error="Selecteer een correcte afbeelding." data-success="">Upload een afbeelding.</span>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="col s1">
                                <img id="leader-image" class="px52"></img>
                            </div>
                            <div class="col s11 input-field">
                                <input id="leader-id" type="text" class="hide" name="leader_id" />  
                                <input id="leader" type="text" class="validate search-input" name="leader" required />  
                                <ul data-search-input="leader" data-search-image="leader-image" data-search-output="leader-id" data-search-id=3 class="collection z-depth-3 search-results hide"></ul> 
                                <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een teamleider's naam in.</span>
                                <label for="leader">Teamleider</label>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s1">
                                <img id="player-image" class="px52"></img>
                            </div>
                            <div class="col s11 input-field">
                                <input id="player" type="text" class="search-input" />  
                                <ul data-search-input="player" data-search-output="players-list" class="collection z-depth-3 search-results hide"></ul> 
                                <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een speler's naam in.</span>
                                <label for="player">Speler</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <ul id="players-list" class="collection"> 
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 input-field">
                        <button type="submit" class="waves-effect waves-light btn">
                            Aanmaken
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
