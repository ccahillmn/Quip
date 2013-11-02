<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- Javascript -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>	
	
	<!-- CSS -->
	<link rel="stylesheet" href="/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="/css/bootstrap-theme.css" type="text/css">
	<link rel="stylesheet" href="/css/style.css" type="text/css">
	
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>

<body>	
	<!-- Sticky top menu -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<a class="navbar-brand" href="#">Quip</a>
		<ul class="nav navbar-nav">
			<li class="navbar-left"><a href='/'><span class="glyphicon glyphicon-home"></span>Home</a></li>
		<?php if($user): ?>
			<li class="navbar-left"><a href='/posts/users'><span class="glyphicon glyphicon-user"></span>Users</a></li>
			<li class="navbar-right"><a href='/users/profile'>My Account</a></li>
			<li class="navbar-right"><a href='/users/logout'><span class="glyphicon glyphicon-off"></span>Logout</a></li>
		</ul>
		<?php else: ?>
		</ul>
			<!-- Inline login on navbar -->
			<form class="navbar-form navbar-right" method='POST' action='/users/p_login/'>
				<div class="form-group">
					<input name="email" type="text" placeholder="Email" class="form-control">
				</div>
				<div class="form-group">
					<input name="password" type="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Login</button>
			</form>
		<?php endif; ?>
	</nav>

	<!-- Main Content -->
	<div id="main" class="container">
		<?php if(isset($content)) echo $content; ?>
	</div>
	
	<!-- Footer -->
	<footer>
		Copyright &copy; <?php echo date("Y"); ?> Caitlin Cahill
	</footer>
	
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>