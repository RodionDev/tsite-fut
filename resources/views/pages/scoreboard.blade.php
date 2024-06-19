@extends('layouts/base')
@section('site-title', 'Scoreboard')
@section('content')
    <table id="scoreboard">
        <thead>
            <tr>
                <td></td>
                <th>Team</th>
                <th>PNT</th>
                <th>WIN</th>
                <th>VERL</th>
                <th>GLK</th>
                <th>GV</th>
                <th>GT</th>
                <th>GS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $key => $team)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="white-space: nowrap">{{ $team->name }}</td>
                    <td>{{ $team->points }}</td>
                    <td>{{ $team->won }}</td>
                    <td>{{ $team->lost }}</td>
                    <td>{{ $team->tied }}</td>
                    <td>{{ $team->goals }}</td>
                    <td>{{ $team->countergoals }}</td>
                    <td>{{ $team->saldo}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
