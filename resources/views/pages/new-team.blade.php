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
                    <div class="col s12 input-field">
                            <input id="leader" type="text" class="validate search-input" name="leader" required />
                            <ul data-results-for="leader" class="collection search-results hide">
                            </ul>
                        <label for="leader">Teamleider</label>
                        <span class="helper-text" data-error="Vul een correcte naam in." data-success="">Vul een teamleider's naam in.</span>
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
