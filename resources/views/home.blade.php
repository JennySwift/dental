<!doctype html>
<html lang="en" class="" ng-app="dentalApp">
<head>

    <meta charset="UTF-8" name="viewport" content="initial-scale = 1">
    <title>Dental App!</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="" ng-controller="HomeController">

@include('templates.header')
@include('templates.popups')

<!-- ==============================.container============================== -->    
<div class="container">
	
	<!-- ==============================error messages============================== -->

	<div class="row">
		<div class="col-sm-12">
			<div ng-repeat = "message in error_messages" class="error-messages">
				<p class="">[[message]]</p>
				<button ng-click="dismiss(message)" class="btn btn-xs btn-default">dismiss</button>
			</div>
		</div>
	</div>

	<!-- ==============================search============================== -->
	
	<div class="row">
		<div class="col-sm-12">
			<input ng-model="filter" ng-list ng-keyup="myFilter($event.keyCode)" type="text" placeholder="search" class="form-control">
		</div>
	</div>

	<hr>
	
	@include('templates.new-entry')

	<hr>

	@include('templates.entries')
	      
</div> <!-- .container -->  

<script type="text/javascript" src="/js/all.js"></script>

</body>
</html>


