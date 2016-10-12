anaControllers.controller('paneController',
	['$scope', '$http', '$stateParams', 'DataService', 'NgTableParams', 
	function($scope, $http, $stateParams, DataService, NgTableParams) {
		$scope.ds = DataService;
		$scope.$on('$viewContentLoaded', function(event) {
			
		$scope.tableParams = new NgTableParams({}, { dataset: $scope.ds.territories });

		});	
}]);