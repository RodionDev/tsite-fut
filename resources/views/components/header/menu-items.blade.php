<div class="nav-content">
    <ul class="tabs tabs-transparent">
        <li class="tab"><a target="_self" href="/toernooien">Toernooien</a></li>
        <li class="tab"><a target="_self" href="/teams">Teams</a></li>
        <li class="tab"><a target="_self" href="/profiel">Profiel</a></li>
        @if(Auth::user()->role()->first()->permission >= 30)
        <li class="tab"><a target="_self" href="/uitnodigen">Beheer</a></li>
        @endif
    </ul>
</div>
