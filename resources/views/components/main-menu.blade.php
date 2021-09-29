<section id="main-menu">
    <nav class="nav-extended"  style="background-color: {{ Colour::instance()->primaryColour() }}">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">
                <img class="vertical-centre-image" src="/images/logo.png">
                <span class="hide-on-small-only">{{ env('APP_NAME', 'FCH') }}</span>
                <h5 class="hide-on-med-and-up">{{ env('APP_NAME', 'FCH') }}</h5>
            </a>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="/">Huidig</a></li>
                <li class="tab"><a href="/toernooien">Toernooien</a></li>
                <li class="tab"><a href="/teams">Teams</a></li>
                <li class="tab"><a href="/manofthematch">MOTM</a></li>
                <li class="tab"><a href="/profiel">Profiel</a></li>
                <li class="tab disabled"><a href="/beheer">Beheer</a></li>
            </ul>
        </div>
    </nav>
</section>
