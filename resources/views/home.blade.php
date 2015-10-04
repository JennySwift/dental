<!doctype html>
<html lang="en" class="" ng-app="dentalApp">
<head>

    <meta charset="UTF-8" name="viewport" content="initial-scale = 1">
    <title>Dental App!</title>
    <link rel="stylesheet" href="/css/plugins.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="" ng-controller="HomeController">

@include('templates.header')
@include('templates.popups')

<div class="container">
	
    @include('templates.feedback')


    @include('templates.filter')

	<hr>
	
	@include('templates.new-entry')

	<hr>

	@include('templates.entries')
	      
</div> <!-- .container -->  

@include('templates.footer')

</body>
</html>


