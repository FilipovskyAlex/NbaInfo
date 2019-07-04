@extends('layouts.main')

@section('content')
    <div class="row justify-content-center main-wrapper">
        @isset($likedTeams)
            @foreach($likedTeams as $team)
                <div class="col-sm-2">
                    <div class="card" style="width: 13rem;">
                        <p><img src="{{ $team->image }}" class="card-img-top" alt="{{ $team->abbreviation }}" style="width: 100px; height: auto"></p>
                        <div class="card-body">
                            <h5 class="card-title">{{ $team->full_name }}</h5>
                            <div>Conference: <span>{{ $team->conference }}</span></div>
                            <div>Division: <span>{{ $team->division }}</span></div>
                            <div>City: <span>{{ $team->city }}</span></div>
                            <div>Abbreviation: <span>{{ $team->abbreviation }}</span></div>
                            <a href="{{ $team->link }}" class="btn a-btn">More team info</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
        @empty($likedTeams)
            <h2>No Data Found</h2>
        @endempty
    </div>
@endsection
