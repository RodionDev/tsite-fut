<section id="matches-list" >
    <h1 class="title">Wedstrijden</h1>
    <div class="row flex">
        <div class="col s12">
            <h5>Bezig</h5>
            <ul class="collapsible">
                @foreach($current_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col s1"></div>
                            <div class="col s10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1->team->name }}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2->team->name }}
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                @if($match->start)
                                {{ date_format(date_create($match->start), "H:i") }}
                                @else
                                Onbekend
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <div class="row">
                            <div class="col s6">
                                <span class="font-size-4">{{ $match->result1->score or 0 }}</span>
                            </div>
                            <div class="col s6">
                                <span class="font-size-4">{{ $match->result2->score or 0 }}</span>
                            </div>
                        </div>
                        <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                        @if($match->start)
                        <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
                        @else
                        <span class="font-size-5">Onbekend</span></br>
                        @endif
                        @if($permission == 20 || $permission >= 50)
                        <a class="waves-effect waves-light btn right" href="{{ route('match.edit.route', $match->id) }}">Wijzigen</a></br>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col s12">
            <h5>Komende</h5>
            <ul class="collapsible">
                @foreach($upcoming_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col s1"></div>
                            <div class="col s10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1->team->name }}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2->team->name }}
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                @if($match->start)
                                {{ date_format(date_create($match->start), "H:i") }}
                                @else
                                Onbekend
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                        @if($match->start)
                        <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
                        @else
                        <span class="font-size-5">Onbekend</span></br>
                        @endif
                        @if($permission == 20 || $permission >= 50)
                        <a class="waves-effect waves-light btn right" href="{{ route('match.edit.route', $match->id) }}">Wijzigen</a></br>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col s12">
            <h5>Geweest</h5>
            <ul class="collapsible">
                @foreach($finished_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col s1"></div>
                            <div class="col s10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1->team->name}}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2->team->name}}
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s1"></div>
                            <div class="col s5 center">
                                {{ $match->result1->score }}
                            </div>
                            <div class="col s5 center">
                                {{ $match->result2->score }}
                            </div>
                            <div class="col s1"></div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                        @if($match->start)
                        <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
                        @else
                        <span class="font-size-5">Onbekend</span></br>
                        @endif
                        <div class="row">
                            <div class="col s12 m6">
                                <img class="team-logo vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                            </div>
                        </div>
                        @if($permission == 20 || $permission >= 50)
                        <a class="waves-effect waves-light btn right" href="{{ route('match.edit.route', $match->id) }}">Wijzigen</a></br>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
