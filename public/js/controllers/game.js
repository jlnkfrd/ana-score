anaControllers.controller('gameController', 
	['$scope', '$log', '$http', '$stateParams', 'DataService', 
	function($scope, $log, $http, $stateParams, DataService) {
		$scope.ds = DataService;
		$scope.$on('$viewContentLoaded', function(event) {
			$scope.ds.setGame($stateParams.gameId);
			$scope.ds.getAlliances();
			$scope.ds.getTeams($scope.ds.gameId);
			$scope.ds.getTerritories();

			$scope.nextTurn = function() {
				$scope.ds.nextTurn();
			};
			
			$scope.prevTurn = function() {
				$scope.ds.prevTurn();
			};
			
			$scope.invadeSuccess = function() {
				$scope.ds.invadeTerritory($scope.invasionCountry, true);
			}
		});
}]);