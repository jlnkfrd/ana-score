<!doctype html>
<html lang="en" ng-app="ana">
<head>
	<meta charset="UTF-8">
	<title>A&amp;A Score Card</title>
	<link rel="stylesheet" href="bower_components/ng-table/dist/ng-table.min.css" />
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/app.css" />
</head>
<body>
	<div class="container">
		<h1 class="text-center">Axis &amp; Allies Scorecard</h1>
		
		<div>
			<div class="col-md-9 col-xs-12" ui-view="gameView"></div>
			<div class="col-md-3 col-xs-12" ui-view="paneView"></div>
		</div>
	</div>

	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/angular/angular.min.js"></script>
	<script src="bower_components/ui-router/release/angular-ui-router.min.js"></script>
	<script src="bower_components/ng-table/dist/ng-table.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="js/anaApp.js"></script>
	<script src="js/services.js"></script>
	<script src="js/controllers/pane.js"></script>
	<script src="js/controllers/game.js"></script>
</body>
</html>
