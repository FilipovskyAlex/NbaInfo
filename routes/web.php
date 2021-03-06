<?php

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/teams')->group(function () {
    Route::get('', 'TeamsController@index')->name('teams.index');
    Route::post('/like', 'TeamsController@like')->name('teams.like');
    Route::post('/unlike', 'TeamsController@unlike')->name('teams.unlike');
    Route::get('/favourite', 'TeamsController@showFavourite')->name('teams.favourite');
});

Route::prefix('/players')->group(function () {
    Route::get('/{page?}', 'PlayersController@index')->name('players.index');
    Route::get('/player/{id}', 'PlayersController@getSingle')->name('players.single');
    Route::post('', 'PlayersController@search')->name('players.search');
});
