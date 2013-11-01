<?php if($user): ?>
	
<?php else: ?>
	<div class="container">
		<div class="jumbotron">
			<h1><img class="logo" src="/images/logo.png"/>Welcome to Quip!</h1>
			<div class="row">
				<div class="col-md-8">
					<p>App description goes here</p>
					<p><a href="users/signup" class="btn btn-primary btn-lg" role="button">Sign Up</a> or <a href="users/login">Login</a></p>
				</div>
				<div class="col-md-4">
					<h2>+1 Features</h2>
					<ul>
						<li>Feature 1</li>
						<li>Feature 2</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

