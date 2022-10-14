@extends('layouts/base')
@section('site-title', 'Wedstrijd')
@section('js', 'pages/cud-tournament')
@section('content')
<section id="new-team">
    <a href="{{ route('match.delete.route', $match->id) }}" class="btn right">Verwijderen</a>
    <h1 class="title">Wedstrijd Aanpassen</h1>
    <form method="POST" action="{{ route('match.edit') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" class="hide" name="id" value="{{ $match->id or '' }}" />  
        @if($permission >= 50)
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 input-field">
                        <input id="date" type="date" class="validate" name="date" value="{{ $start_date or '' }}" />
                        <label for="date">Start Datum</label>
                        <span class="helper-text" data-error="Vul een correcte datum in." data-success="">Vul een datum in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="time" type="time" class="validate" name="time" value="{{ $start_time or '' }}" />
                        <label for="time">Start Tijd</label>
                        <span class="helper-text" data-error="Vul een correcte tijd in." data-success="">Vul een tijd in.</span>
                    </div>
                    <div class="col s12 input-field">
                        <input id="field" type="number" class="validate" name="field" value="{{ $match->field or 1 }}" />
                        <label for="field">Speel veld</label>
                        <span class="helper-text" data-error="Vul een correct getal in." data-success="">Vul het veld nummer in.</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <h1 class="title">Scores</h1>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m6">
                        <span>
                            <img class="px52 vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                            {{ $match->result1->team->name}}
                        </span></br>
                        <input name="score1" type="number" value="{{ $match->result1->score or 0 }}"></input>
                    </div>
                    <div class="col s12 m6">
                        <span>
                            <img class="px52 vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                            {{ $match->result2->team->name}}
                        </span></br>
                        <input name="score2" type="number" value="{{ $match->result2->score or 0 }}"></input>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn">
            Opslaan
        </button>
    </form>
</section>
@endsection
