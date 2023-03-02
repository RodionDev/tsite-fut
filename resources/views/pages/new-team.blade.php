@extends('layouts/base')
@section('site-title', 'Team')
@section('js', 'pages/new-team')
@section('content')
<section id="new-team">
    @if($creating)
    <h1 class="title">Team Toevoegen</h1>
    @else
    <a href="{{ route('delete.team.route', $team->id) }}" class="btn right">Verwijderen</a>
    <h1 class="title">Team Aanpassen</h1>
    @endif
    @if($creating)
    <form method="POST" action="{{ route('create.team') }}" enctype="multipart/form-data">
    @else
    <form method="POST" action="{{ route('edit.team') }}" enctype="multipart/form-data">
    <input type="text" class="hide" name="id" value="{{ $team->id or '' }}" />  
    @endif
        @csrf
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 input-field">
                        <input id="name" type="text" class="validate" name="name" value="{{ $team->name or '' }}" required />
                        <label for="name">Team Naam</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een naam in.</span>
                    </div>
                    @if(!$creating && $team->logo)
                    <div class="col s12">
                        <img class="hoverable avatar-preview" src="{{ $team->logo }}" />
                    </div>
                    @endif
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
                                <input id="leader-id" type="text" class="hide" name="leader_id" value="{{ $team->leader->id or '' }}" />  
                                <input id="leader" type="text" class="validate search-input" name="leader" value="{{ $leader_name or '' }}" required />  
                                <ul data-search-input="leader" data-search-image="leader-image" data-search-output="leader-id" data-search-id=3 class="collection z-depth-3 search-results hide"></ul> 
                                <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een teamleider's naam in.</span>
                                <label for="leader">Teamleider</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
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
                                    @if(!empty($players))
                                    @foreach($team->players as $player)
                                    <li class="collection-item row">
                                        <div class="col s12 m2"><img class="px52" src="{{ $player->avatar or asset('images\image-missing.png') }}"></div>
                                        <div class="col s12 m10">
                                            <input name="users[]" type="checkbox" value="{{ $player->id }}" readonly checked />
                                            {{ $player->getFullName() }}
                                            <i class="mdi mdi-close-circle close clickable"></i>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
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
