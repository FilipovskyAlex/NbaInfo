@extends('layouts.main')

@section('content')
    <div class="row justify-content-center players-table" id="tableWrapper">
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
                                <td style="width: 25%"><a href="{{ route('players.single', $player->id) }}">{{ $player->first_name }}&nbsp;{{ $player->last_name }}</a></td>
                                <td>
                                    @isset($player->height_feet){{ $player->height_feet }}@endisset
                                    @empty($player->height_feet)&nbsp;-&nbsp;@endempty
                                </td>
                                <td>
                                    @isset($player->height_inches){{ $player->height_inches }}@endisset
                                    @empty($player->height_inches)&nbsp;-&nbsp;@endempty
                                </td>
                                <td>{{ $player->position }}</td>
                                <td>
                                    @isset($player->weight_pounds){{ $player->weight_pounds }}@endisset
                                    @empty($player->weight_pounds)&nbsp;-&nbsp;@endempty
                                </td>
                                <td><a href="{{ $player->teamLink }}">{{ $player->team->full_name }}</a></td>
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
    @if($pagination->next_page !== null)
        <div class="row pagination justify-content-between">
            @if($pagination->current_page !== 1)
                <div class="col-sm-3">
                    <div>
                        <button class="btn">
                            <a class="nav-link" href="{{ route('players.index', $pagination->current_page - 1) }}">previous</a>
                        </button>
                    </div>
                </div>
            @endif
            <div class="col-sm-3">
                <div>
                    <button class="btn">
                        <a class="nav-link" href="{{ route('players.index', $pagination->next_page) }}">next</a>
                    </button>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        let pagination = document.body.getElementsByClassName('pagination');
        if(pagination.length === 0) {
            let elem = document.getElementById("tableWrapper");
            elem.style.paddingBottom = "60px";
        }
    </script>
@endsection
