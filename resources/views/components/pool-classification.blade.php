<section id="pool-classification">
    <h1 class="title">
        Poule Indeling 
        <a id="pool-button" class="waves-effect waves-light btn">Alle Poules</a>
    </h1>
    <div class="row flex">
        @foreach($pools as $pool)
        @if ($loop->first)
        <div class="col s12 current-pool">
        @else
        <div class="col s12 m6 other-pool hide">
        @endif
            <div class="card hoverableard">
                <div class="card-content">
                    <span class="card-title">Groep {{ range('A', 'Z')[$pool->number-1] }}</span>
                    <ul>
                        @foreach($pool->teams as $team)
                        <li>
                            <span class="team-info"><img class="team-logo vertical-centre-image" src="{{ $team->logo or asset('images\image-missing.png') }}">{{ $team->name }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </section>
