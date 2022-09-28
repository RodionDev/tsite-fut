<section id="upcoming-match">
    <h1 class="title">Eerstvolgende Wedstrijd</h1>
    <div class="card">
        <div class="card-content">
            <div class="row center equal-height">
                <div class="col s12">
                    <span class="font-size-2">{{ date_format(date_create($match->start), "H:i") }}</span>
                    </br>
                    <span class="font-size-5">{{ date_format(date_create($match->start), "d/m") }}</span>
                </div>
                <div class="col s12 m5 team-info">
                    <img class="team-logo" src="{{ $team1->logo or asset('images\image-missing.png') }}">
                    </br>
                    <span>{{ $team1->name }}</span>
                </div>
                <div class="col s12 m2 versus font-size-2 vertical-centre">
                    <div class="hide-on-small-only"><i class="mdi mdi-arrow-left-thick"></i></br><i class="mdi mdi-arrow-right-thick"></i></div>
                    <div class="hide-on-med-and-up">VS</div>
                </div>
                <div class="col s12 m5 team-info">
                    <img class="team-logo" src="{{ $team2->logo or asset('images\image-missing.png') }}">
                    </br>
                    <span>{{ $team2->name }}</span>
                </div>
                <div class="col s12">
                    <span class="font-size-3">Field: {{ $match->field }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
