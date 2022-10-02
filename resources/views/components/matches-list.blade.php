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
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result1()->first()->team()->first()->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1()->first()->team()->first()->name}}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2()->first()->team()->first()->name}}
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result2()->first()->team()->first()->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                {{ date_format(date_create($match->start), "H:i") }}
                            </div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <div class="row">
                            <div class="col s6">
                                <span class="font-size-4">{{ $match->result1()->first()->score or 0 }}</span>
                            </div>
                            <div class="col s6">
                                <span class="font-size-4">{{ $match->result2()->first()->score or 0 }}</span>
                            </div>
                        </div>
                        <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                        <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
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
                @foreach($current_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col s1"></div>
                            <div class="col s10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result1()->first()->team()->first()->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1()->first()->team()->first()->name}}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2()->first()->team()->first()->name}}
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result2()->first()->team()->first()->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                {{ date_format(date_create($match->start), "H:i") }}
                            </div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                        <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
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
                @foreach($current_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col s1"></div>
                            <div class="col s10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result1()->first()->team()->first()->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1()->first()->team()->first()->name}}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2()->first()->team()->first()->name}}
                                            <img class="team-logo vertical-centre-image" src="{{ $match->result2()->first()->team()->first()->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                {{ date_format(date_create($match->start), "H:i") }}
                            </div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                        <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
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
