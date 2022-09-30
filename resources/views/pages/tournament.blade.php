@extends('layouts/base')
@section('site-title', 'Toernooi')
@section('css', 'pages/tournament')
@section('js', 'pages/tournament')
@section('content')
    @include('components/upcoming-match')
    @include('components/pool-classification')
    @include('components/matches-list')
@endsection
