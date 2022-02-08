@extends('layouts/base')
@section('site-title', 'Profiel')
@section('content')
<section id="profile">
        <h1 class="title">Profiel</h1>
        <div class="card">
            <div class="card-content">
                <a href="/profiel-aanpassen/" class="btn">Profiel wijzigen</a>
                <a href="/uitloggen/" class="btn">Uitloggen</a>
            </div>
        </div>
    </section>
@endsection
