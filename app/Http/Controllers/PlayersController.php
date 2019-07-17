<?php

namespace App\Http\Controllers;

use App\Team;
use Unirest\Request;
use Illuminate\Http\Request as R;

/**
 * Class PlayersController
 * @package App\Http\Controllers
 */
class PlayersController extends Controller
{
    /**
     * Players per page
     */
    const PER_PAGE = 25;

    /**
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSingle(int $id)
    {
        $player = Request::get(config('apiRootPath.ROOT_API_PATH')."/players/".$id, config('apiNBA'));

        $player->body->team->link = Team::getFullLink($player->body->team->abbreviation, $player->body->team->name);
        $player->body->team->image = Team::getAvatar($player->body->team->abbreviation);

        $playerData = $player->body;

        return view('players.single', ['player' => $playerData]);
    }

    /**
     * @param R $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
