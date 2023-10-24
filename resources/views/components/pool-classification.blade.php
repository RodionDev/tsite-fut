@if(!empty($pools))
<section id="pool-classification">
    <h1 class="title">
    Poule Indeling
    @if(count($pools) > 2)
    <a id="pool-button" class="waves-effect waves-light btn">Alle Poules</a>
    @endif
    </h1>
    <div class="row flex">
        @foreach($pools as $pool)
        @if ($loop->first)
        <div class="col s12 current-pool">
        @else
        <div class="col s12 m6 other-pool hide">
        @endif
            <div class="card hoverable">
                <div class="card-content">
                    <span class="card-title">Groep {{ range('A', 'Z')[$pool->number -1] }}</span>
                    <ul>
                        @foreach($pool->teams as $team)
                        <li class="list-item">
                            <div class="team-info">
                                <div class="image-container"><img class="scale-image vertical-centre-image" data-image-size=40 src="{{ $team->logo or asset('images\image-missing.png') }}"></div>
                                <div>{{ $team->name }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif
