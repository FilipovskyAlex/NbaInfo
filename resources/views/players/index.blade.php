@extends('layouts.main')

@section('content')
    <div class="row justify-content-center main-wrapper">
        <div class="col-sm-10">
            @isset($players)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 25%">Name</th>
                        <th scope="col">Feet</th>
                        <th scope="col">Inches</th>
                        <th scope="col">Position</th>
                        <th scope="col">Weight (pounds)</th>
                        <th scope="col">Teams</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $player)
                            <tr>
                                <th scope="row">{{ $player->id }}</th>
                                <td style="width: 25%">{{ $player->first_name }}&nbsp;{{ $player->last_name }}</td>
                                <td>{{ $player->height_feet }}</td>
                                <td>{{ $player->height_inches }}</td>
                                <td>{{ $player->position }}</td>
                                <td>{{ $player->weight_pounds }}</td>
                                <td><a href="{{ $player->teamLink }}">Team</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
            @empty($players)
                <h2>No Data Found</h2>
            @endempty
        </div>
    </div>
@endsection