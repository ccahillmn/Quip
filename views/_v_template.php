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
	<link href='http://fonts.googleapis.com/css?family=Quicksand:400' rel='stylesheet' type='text/css'>
	
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>

<body>	
	<!-- Sticky top menu -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<a class="navbar-brand brand" href="#">Quip</a>
		<?php if($user): ?>
		<ul class="nav navbar-nav navbar-right">
			<li><a href='/users/profile'><span class="glyphicon glyphicon-user"></span>Update Account</a></li>
			<li><a href='/users/logout'><span class="glyphicon glyphicon-off"></span>Logout</a></li>
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
	<?php if($user): ?>
		<nav id="menu" class="container">
			<ul class="row">
				<li class="menu-item"><a href="/">Home</a></li>
				<li>~</li>
				<li class="menu-item"><a href="/posts/users">Users</a></li>
				<li>~</li>
				<li class="menu-item"><a href="/posts/user/<?php echo $user->user_id ?>">My Profile</a></li>
			</ul>
			<hr>
		</nav>
	<?php endif ?>

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