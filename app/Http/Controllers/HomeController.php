<?php

namespace App\Http\Controllers;

use App\Team;
use Unirest\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response = Request::get(config('apiRootPath.ROOT_API_PATH')."/teams", config('apiNBA'));

        $teamsData = $response->body->data;
        $teamsData = Team::addProps($teamsData);

        return view('home', ['teams' => $teamsData]);
    }
}
