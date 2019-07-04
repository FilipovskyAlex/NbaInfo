@extends('layouts.main')

@section('content')
    <div class="row justify-content-center single-player-wrapper">
        <div class="col-sm-10">
            <div class="row justify-content-center">
                <div class="col-sm-5 player">
                    <h2>Player</h2>
                    <div class="card" style="width: 26rem;">
                        {{--                        <p><img src="{{ $team->image }}" class="card-img-top" alt="{{ $team->abbreviation }}" style="width: 100px; height: auto"></p>--}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $player->first_name }} {{ $player->last_name }}</h5>
                            @isset($player->height_feet)<div>Feet: <span>{{ $player->height_feet }}</span></div>@endisset
                            @isset($player->height_inches)<div>Inches: <span>{{ $player->height_inches }}</span></div>@endisset
                            <div>Position: <span>{{ $player->position }}</span></div>
                            @isset($player->weight_pounds)<div>Weight(pounds): <span>{{ $player->weight_pounds }}</span></div>@endisset
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 team">
                    <h2>Team</h2>
                    <div class="card" style="width: 26rem;">
                        <p><img src="{{ $player->team->image }}" class="card-img-top" alt="{{ $player->team->abbreviation }}"></p>
                        <div class="card-body">
                            <h5 class="card-title">{{ $player->team->full_name }}</h5>
                            <div>Conference: <span>{{ $player->team->conference }}</span></div>
                            <div>Division: <span>{{ $player->team->division }}</span></div>
                            <div>City: <span>{{ $player->team->city }}</span></div>
                            <div>Abbreviation: <span>{{ $player->team->abbreviation }}</span></div>
                            <a href="{{ $player->team->link }}" class="btn a-btn">More team info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
