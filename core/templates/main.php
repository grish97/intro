<!DOCTYPE html>
<html>
	<head>
		<title>@title</title>
		<meta name="charset" content="utf-8">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/custom.css">
		<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
	</head>
	<body>
		<nav class="navbar navbar-default">
		    <div class="container-fluid">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		            <a class="navbar-brand" href="#">My Site</a>
		        </div>

		        <!-- Collect the nav links, forms, and other content for toggling -->
		        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		            <ul class="nav navbar-nav">
		                <li class="active"><a href="/">Home</a></li>
		            </ul>
		            <ul class="nav navbar-nav navbar-right">
		                <li><a href="/user/login">Login</a></li>
		                <li><a href="/user/register">Register</a></li>
		            </ul>
		        </div><!-- /.navbar-collapse -->
		    </div><!-- /.container-fluid -->
		</nav>
		<div class="container">
			@content
		</div>
		<footer class="footer">
	        <div class="container">
	          	<p class="text-muted">
	          		Made by Tco Trainings Team
	          		<span class="pull-right">&copy; 2018</span>
	          	</p>
	        </div>
	    </footer>
	    <pre>
	    	<?php var_dump($_SESSION); ?>
	    </pre>
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
	</body>
</html>