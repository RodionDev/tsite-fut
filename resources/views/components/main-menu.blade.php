<section id="main-menu">
    <nav class="nav-extended">
        <div id="topbar" class="nav-wrapper">
            <a target="_self" href="#" class="brand-logo">
                <img class="vertical-centre-image" src="/images/logo.png">
                <span class="hide-on-small-only">{{ env('APP_NAME', 'FCH') }}</span>
                <h5 class="hide-on-med-and-up">{{ env('APP_NAME', 'FCH') }}</h5>
            </a>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a target="_self" href="/toernooi">Huidig</a></li>
                <li class="tab"><a target="_self" href="/toernooien">Toernooien</a></li>
                <li class="tab"><a target="_self" href="/teams">Teams</a></li>
                <li class="tab"><a target="_self" href="/manofthematch">MOTM</a></li>
                <li class="tab"><a target="_self" href="/profiel">Profiel</a></li>
                <li class="tab disabled"><a target="_self" href="/beheer">Beheer</a></li>
            </ul>
        </div>
    </nav>
</section>
