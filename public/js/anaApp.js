'use strict';

var anaControllers = angular.module('ana.Controllers',[]);

var anaApp = angular.module('ana', ['ui.router', 'ana.Controllers', 'ana.Services', 'ngTable']);

/***
 Application Routes
***/
anaApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider){
	$urlRouterProvider.otherwise('/');
	$stateProvider
		.state('index', {
			url: "/",
			resolve: {

			},
			views: {
				"gameView": {
					templateUrl: "partials/menu.html",
					controller: function($log, $scope, $state, games, gameTypes, DataService) {
						$scope.games = games;
						$scope.gameTypes = gameTypes;
						
						$scope.createGame = function(versionId) {
							DataService.createGame(versionId).then(function(result) {
								DataService.activeGame = result.data;
								$state.go('game', { gameId: result.data.id });
							});
							
						}
					},
					resolve: {
						games: function(DataService) {
							return DataService.getGames();
						},
						gameTypes: function(DataService) {
							return DataService.getGameTypes();
						}
					}
				},
				"paneView": {
					templateUrl: "partials/pane.html",
					controller: "paneController"
				}
			},
		}).state('game', {
			url: "/game/{gameId}",
			resolve: {
				games: function(DataService) {
					return DataService.getGames();
				},
				invasions: function(DataService) {
					return DataService.getInvasions();
				}
			},
			views: {
				"gameView": {
					templateUrl: "partials/game.html",
					controller: "gameController"
				},
				"paneView": {
					templateUrl: "partials/pane.html",
					controller: "paneController"
				}
			},
		}).state('game.create', {
			
		})
}]);