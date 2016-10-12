'use strict';

var anaServices = angular.module('ana.Services',[]);

anaServices.factory('DataService',['$http', '$log', function($http, $log) {
	return {
		gameId: 0,
		games: [],
		alliances: [],
		teams: new Object,
		orderedTeams: [],
		territories: [],
		invasions: [],
		activeGame: undefined,
		createGame: function(versionId) {
			var self = this;
			
			return $http.post('games', { version_id: versionId }).then(function(result) {
				self.games[self.games.length] = result.data;
				return result;
			});
		},
		getGames: function() {
			var self = this;
			
			if (self.games.length > 0) return self.games;
			
			var url = 'games';
			
			return $http.get(url).then(function(result) {				
				self.games = result.data;
				return result.data;
			});
		},
		getGameTypes: function() {
			return $http.get('versions').then(function(result){
				return result.data;
			});
		},
		setGame: function(gameId) {
			var self = this;
			self.gameId = gameId;
			self.activeGame = self.fetchGame(gameId);
		},
		fetchGame: function(gameId) {
			var self = this;
			
			for (var i = 0; i < self.games.length; i++) {
				if (self.games[i].id == gameId) {
					return self.games[i];
				}
			}
		
			return undefined;
		},
		endGame: function() {
			
		},
		nextTurn: function() {
			var self = this;
			var currentOrder = self.teams[self.activeGame.current_team.id].pivot.order;
			if(currentOrder < self.orderedTeams.length) {
				self.activeGame.current_team = self.orderedTeams[currentOrder];
			} else {
				self.activeGame.current_team = self.orderedTeams[0];
				self.activeGame.round_number += 1;
			}
			self.setTurn(self.activeGame.current_team.id, self.activeGame.round_number);
		},
		prevTurn: function() {
			var self = this;
			var currentOrder = self.teams[self.activeGame.current_team.id].pivot.order;
			if (currentOrder > 1) {
				self.activeGame.current_team = self.orderedTeams[currentOrder - 2];
			} else {
				self.activeGame.current_team = self.orderedTeams[self.orderedTeams.length - 1];
				self.activeGame.round_number -= 1;
			}
			self.setTurn(self.activeGame.current_team.id, self.activeGame.round_number);
		},
		setTurn: function(teamId, round) {
			var self = this;
			$http.post('games/' + self.activeGame.id + '/setTurn', { round_number: round, current_team_id: teamId });
		},
		getAlliances: function() {
			var self = this;

			var url = 'alliances/game-data/' + self.gameId;

			return $http.get(url).then(function(result) {
				self.alliances = result.data;
			});
		},
		getTeams: function(game_id) {
			var self = this;

			var url = 'teams/' + game_id;

			return $http.get(url).then(function(result) {
				self.orderedTeams = result.data;

				for (var i = 0; i < result.data.length; i++) {
					result.data[i].score = 0;
					result.data[i].initialScore = 0;
					self.teams[result.data[i].id] = result.data[i];
				}
			});
		},
		getTerritories: function() {
			var self = this;
			
			var url = 'territories/' + self.gameId;
						
			return $http.get(url).then(function(result) {
				for (var i = 0; i < result.data.length; i++) {
					var t = result.data[i];
					
					var obj = {
						id: t.territory.id,
						name: t.territory.name,
						short_name: t.territory.short_name,
						initial_owner: self.teams[t.territory.territory_default_assignments[0].initial_owner_id],
						current_owner: self.teams[t.current_owner_id],
						value: t.territory.territory_default_assignments[0].value,
						capitol: t.territory.territory_default_assignments[0].capitol
					};
										
					self.teams[obj.current_owner.id].score += obj.value;
					self.teams[obj.initial_owner.id].initialScore += obj.value;

					self.territories.push(obj);
				}
			});
		},
		invadeTerritory: function(territory, success) {
			var self = this;
			if (success) {
				self.updateScore(territory);
			}
		},
		updateScore: function(territory) {
			var self = this;
			var newOwner = self.activeGame.current_team;
			
			if (self.teams[territory.initial_owner.id].pivot.alliance_id == self.teams[self.activeGame.current_team.id].pivot.alliance_id) {
				newOwner = territory.initial_owner;
			}
			
			self.teams[territory.current_owner.id].score -= territory.value;
			self.teams[newOwner.id].score += territory.value;
			territory.current_owner = newOwner;
			
			$http.post('territories/' + territory.id + '/updateScore', { new_owner_id: territory.current_owner.id, game_id: self.activeGame.id });
		},
		getInvasions: function() {
			var self = this;
			var url = 'games/' + self.gameId + '/invasions';
			$http.get(url).then(function(result) {
				self.invasions = result.data;
			});
		}
	}
}]);	