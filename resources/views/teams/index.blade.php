@extends('layouts.main')

@section('content')
    <div class="row justify-content-center main-wrapper">
        @isset($teams)
            @foreach($teams as $team)
                <div class="col-sm-2">
                    <div class="card" style="width: 13rem;">
                        <span><i class="fas fa-heart {{ $team->activeProp }}"></i></span>
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
        @empty($teams)
            <h2>No Data Found</h2>
        @endempty
    </div>
@endsection
@section('script')
    <script>
        let cards = document.body.getElementsByClassName('card');

        for(let card of cards) {

            card.firstElementChild.addEventListener("click", function () {
                let team = card.children[2].children;

                let body = {
                    name: team[0].innerHTML,
                    conference: team[1].children[0].innerText,
                    division: team[2].children[0].innerText,
                    city: team[3].children[0].innerText,
                    abbreviation: team[4].children[0].innerText
                };

                body = JSON.stringify(body);

                let child = card.firstElementChild.firstChild;

                if(child.classList.contains('active')) {
                    unlike(card.firstElementChild.firstChild, body);
                } else {
                    like(card.firstElementChild.firstChild, body);
                }
            });
        }

        function like(child, body) {
            child.classList.add('active');

            let xhr = new XMLHttpRequest();

            xhr.open("POST", '{{ route('teams.like') }}', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

            xhr.send(body);
        }

        function unlike(child, body) {
            child.classList.remove('active');

            let xhr = new XMLHttpRequest();

            xhr.open("POST", '{{ route('teams.unlike') }}', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

            xhr.send(body);
        }
    </script>
@endsection
