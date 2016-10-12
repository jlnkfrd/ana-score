anaControllers.controller('selectController', 
	['$scope', '$http', 'DataService', 
	function($scope, $http, DataService) {
		$scope.ds = DataService;
		$scope.$on('$viewContentLoaded', function(event) {
			$scope.ds.getGames();
		});
}]);