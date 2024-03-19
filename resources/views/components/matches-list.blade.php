<section id="matches-list" >
    <h1 class="title">
        <a class="waves-effect waves-light btn right" href="{{ route('match.create.route', $id) }}">Nieuw</a></br>
        Wedstrijden
    </h1>
    <div class="row flex">
        <div class="col s12">
            <h5>Geweest</h5>
            <ul class="collapsible">
                @foreach($finished_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col m1 hide-on-small-only"></div>
                            <div class="col s12 m10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="px52 vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1->team->name}}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2->team->name}}
                                            <img class="px52 vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 hide-on-small-only">
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
                        <div class="row">
                            <div class="col s12">
                                <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                                @if($match->start)
                                <span class="font-size-5">{{ $match->getDutchDate(false) }}</span>
                                <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
                                @else
                                <span class="font-size-5">Onbekend</span></br>
                                @endif
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
        <div class="col s12">
            <h5>Bezig</h5>
            <ul class="collapsible">
                @foreach($current_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col m1 hide-on-small-only"></div>
                            <div class="col s12 m10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="px52 vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1->team->name }}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2->team->name }}
                                            <img class="px52 vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col s1 hide-on-small-only">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                @if($match->start)
                                <span class="hide-on-small-only">{{ $match->getDutchDate(false) }} -</span>
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
                        <div class="row">
                            <div class="col s12">
                                <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                                @if($match->start)
                                <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
                                <span class="font-size-5">{{ $match->getDutchDate(false) }}</span>
                                @else
                                <span class="font-size-5">Onbekend</span></br>
                                @endif
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
        <div class="col s12">
            <h5>Komende</h5>
            <ul class="collapsible">
                @foreach($upcoming_matches as $match)
                <li>
                    <div class="collapsible-header">
                        <div class="row">
                            <div class="col m1 hide-on-small-only"></div>
                            <div class="col s12 m10">
                                <div class="row">
                                    <div class="col s6">
                                        <span>
                                            <img class="px52 vertical-centre-image" src="{{ $match->result1->team->logo or asset('images\image-missing.png') }}">
                                            {{ $match->result1->team->name }}
                                        </span>
                                    </div>
                                    <div class="col s6">
                                        <span class="right">
                                            {{ $match->result2->team->name }}
                                            <img class="px52 vertical-centre-image" src="{{ $match->result2->team->logo or asset('images\image-missing.png') }}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 hide-on-small-only">
                                <i class="mdi mdi-36px mdi-menu-down center"></i>
                            </div>
                            <div class="col s12 center">
                                @if($match->start)
                                <span class="hide-on-small-only">{{ $match->getDutchDate(false) }} -</span>
                                {{ date_format(date_create($match->start), "H:i") }}
                                @else
                                Onbekend
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="collapsible-body center">
                        <div class="row">
                            <div class="col s12">
                                <span class="font-size-2">Veld: {{ $match->field }}</span></br>
                                @if($match->start)
                                <span class="font-size-5">{{ date_format(date_create($match->start), "H:i") }}</span></br>
                                <span class="font-size-5">{{ $match->getDutchDate(false) }}</span>
                                @else
                                <span class="font-size-5">Onbekend</span></br>
                                @endif
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
