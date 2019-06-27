<?php

namespace App\Http\Controllers;

use App\Team;
use Unirest\Request;
use Illuminate\Http\Request as R;

class TeamsController extends Controller
{
    public function index()
    {
        $response = Request::get(config('apiRootPath.ROOT_API_PATH')."/teams", config('apiNBA'));

        $teamsData = $response->body->data;
        $teamsData = Team::addProps($teamsData);

        return view('teams.index', ['teams' => $teamsData]);
    }

    public function like(R $request)
    {
        $likedTeam = new Team;
        $likedTeam->likeTeam($request, $likedTeam);
        $likedTeam->save();
    }
}
