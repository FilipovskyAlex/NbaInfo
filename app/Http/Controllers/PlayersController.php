<?php

namespace App\Http\Controllers;

use App\Team;
use Unirest\Request;
use Illuminate\Http\Request as R;

class PlayersController extends Controller
{
    const PER_PAGE = 25;

    public function index(int $page = 0)
    {
        $playersResponse = Request::get(config('apiRootPath.ROOT_API_PATH')."/players?page=".$page."&per_page=".self::PER_PAGE, config('apiNBA'));

        $paginateData = $playersResponse->body->meta;
        $playersData = $playersResponse->body->data;

        foreach ($playersData as $player) {
            $player->teamLink = Team::getFullLink($player->team->abbreviation, $player->team->full_name);
        }

        return view('players.index', [
            'players' => $playersData,
            'pagination' => $paginateData
        ]);
    }

    public function getSingle(int $id)
    {
        $player = Request::get(config('apiRootPath.ROOT_API_PATH')."/players/".$id, config('apiNBA'));

        $player->body->team->link = Team::getFullLink($player->body->team->abbreviation, $player->body->team->name);
        $player->body->team->image = Team::getAvatar($player->body->team->abbreviation);

        $playerData = $player->body;
//dd($playerData->team);
        return view('players.single', ['player' => $playerData]);
    }

    public function search(R $request)
    {
        $playersResponse = Request::get(config('apiRootPath.ROOT_API_PATH')."/players?page=0&per_page=".self::PER_PAGE."&search=".$request->get('search'), config('apiNBA'));

        $playersData = $playersResponse->body->data;
        $paginateData = $playersResponse->body->meta;

        foreach ($playersData as $player) {
            $player->teamLink = Team::getFullLink($player->team->abbreviation, $player->team->full_name);
        }

        return view('players.index', [
            'players' => $playersData,
            'pagination' => $paginateData
        ]);
    }
}
