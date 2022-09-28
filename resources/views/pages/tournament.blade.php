@extends('layouts/base')
@section('site-title', 'Toernooi')
@section('css', 'pages/tournament')
@section('js', 'pages/tournament')
@section('content')
    @include('components/upcoming-match', ['id' => $id, 'match' => $match])
    @include('components/pool-classification', ['id' => $id])
    @include('components/matches-list', ['id' => $id])
@endsection
