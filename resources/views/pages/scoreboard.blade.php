@extends('layouts/base')
@section('site-title', 'Scoreboard')
@section('content')
    <table id="scoreboard">
        <thead>
            <tr>
                <th>Team naam</th>
                <th>Punten</th>
                <th>Gewonnen</th>
                <th>Verloren</th>
                <th>Gelijk</th>
                <th>Goals voor</th>
                <th>Goals tegen</th>
                <th>Goals saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <td>{{ $team->name }}</td>
                    <td>{{ $team->score }}</td>
                    <td>{{ $team->won }}</td>
                    <td>{{ $team->lost }}</td>
                    <td>{{ $team->tied }}</td>
                    <td>{{ $team->goals }}</td>
                    <td>{{ $team->countergoals }}</td>
                    <td>{{ $team->balance }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
