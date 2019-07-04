<?php

namespace App\Http\Controllers;

use App\Team;
use Unirest\Request;
use Illuminate\Http\Request as R;

/**
 * Class TeamsController
 * @package App\Http\Controllers
 */
class TeamsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $response = Request::get(config('apiRootPath.ROOT_API_PATH')."/teams", config('apiNBA'));

        $teamsData = $response->body->data;
        $teamsData = Team::addProps($teamsData);

        return view('teams.index', ['teams' => $teamsData]);
    }

    /**
     * Like the certain team
     * @param R $request
     */
    public function like(R $request)
    {
        $likedTeam = new Team;
        $likedTeam->likeTeam($request, $likedTeam);
        $likedTeam->save();
    }

    /**
     * Unlike the certain team
     * @param R $request
     */
    public function unlike(R $request)
    {
        $abbreviation = $request->get('abbreviation');
        Team::unlikeTeam($abbreviation);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFavourite()
    {
        $likedTeams = Team::getLikedTeams();

        foreach ($likedTeams as $team) {
            $team->link = Team::getFullLink($team->abbreviation, $team->name);
            $team->image = Team::getAvatar($team->abbreviation);
        }

        return view('teams.favourite', ['likedTeams' => $likedTeams]);
    }
}
