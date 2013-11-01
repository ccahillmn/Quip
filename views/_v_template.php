<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>		

	<link rel="stylesheet" href="/css/boostrap.min.css" type="text/css">
	<link rel="stylesheet" href="/css/boostrap-theme.min.css" type="text/css">
	<link rel="stylesheet" href="/css/style.css" type="text/css">
	
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>

<body>	
	<!-- Sticky top menu -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<p class="navbar-text navbar-left">Quip</p>
		<menu>
				<li class="navbar-left">><a href='/'><span class="glyphicon glyphicon-home"></span>Home</a></li>
				
			<?php if($user): ?>
				<li class="navbar-left"><a href='/posts/users'><span class="glyphicon glyphicon-user"></span>Users</a></li>
				<li class="navbar-right"><a href='/users/profile'>My Account</a></li>
				<li class="navbar-right"><a href='/users/logout'><span class="glyphicon glyphicon-off"></span>Logout</a></li>
			<?php else: ?>
				<li class="navbar-right"><a href='/users/signup'>Sign Up</a></li>
				
				<!-- Inline login on navbar -->
				<li class="navbar-right">
					<form class="form-inline" role="form" action='/users/p_signup'>
					
						<div class="input-group input-group-lg">
							<label class="sr-only" for="email">Email address</label>
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input type="email" class="form-control" placeholder="Email">
						</div>
						
						<div class="input-group input-group-lg">
							<label class="sr-only" for="password">Password</label>
							<span class="input-group-addon">"><span class="glyphicon glyphicon-lock"></span></</span>
							<input type="password" class="form-control" placeholder="Password">
						</div>

						<button type="submit" class="btn btn-default">Login</button>
						
					</form>
				</li>
			<?php endif; ?>
		</menu>
	</nav>

	<!-- Main Content -->
	<div id="main" class="container">
		<?php if(isset($content)) echo $content; ?>
	</div>
	
	<!-- Footer -->
	<footer>
		Copyright &copy; <?php echo date("Y"); ?> Caitlin Cahill
	</footer>

	<script type="text/javascript" src="/js/boostrap.min.js></script>		
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>