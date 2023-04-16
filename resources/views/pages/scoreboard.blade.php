@extends('layouts/base')
@section('site-title', 'Scoreboard')
@section('content')
    <table id="scoreboard">
        <thead>
            <tr>
                <th>Team naam</th>
                <th>Gewonnen</th>
                <th>Verloren</th>
                <th>Gelijk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <td>{{ $team->name }}</td>
                    <td>{{ $team->won }}</td>
                    <td>{{ $team->lost }}</td>
                    <td>{{ $team->tied }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
