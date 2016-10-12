<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	return View::make('home');
});


Route::get('/alliances/game-data/{game_id}', ['as' => 'alliances.game-data', 'uses' => 'AllianceController@gameData']);

Route::get('/teams/{game_id}', ['as' => 'teams', 'uses' => 'AllianceController@teamData']);

Route::get('/territories/{game_id}', ['as' => 'game.territories', 'uses' => 'AllianceController@territories']);


Route::get('/game/init/{version_id}', ['as' => 'game.init', 'uses' => 'AllianceController@initGame']);

Route::resource('games', 'GameController', ['except' => ['create']]);
Route::get('/versions', ['as' => 'games.versions', 'uses' => 'GameController@versions']);
Route::post('/games/{game_id}/setTurn', ['as' => 'games.setTurn', 'uses' => 'GameController@setTurn']);

Route::any('/territories/{territory_id}/updateScore', ['as' => 'territory.updateScore', 'uses' => 'TerritoryController@updateScore']);
Route::get('/games/{game_id}/invasions', ['as' => 'game.invasions', 'uses' => 'TerritoryController@invasions']);
