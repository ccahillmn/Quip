<!-- If account is new, post alert to show successful account creation -->
<?php if(isset($_GET['acct'])): ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Account successfully created! </strong> Please login to access your account.
	</div>
<?php endif; ?>

<div id="login_form">
	<h1>Login</h1>
	<form role="form" method='POST' action='/users/p_login/'>
		<div class="form-group">
			<label for="email">Email address</label>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
				<input name="email" type="email" class="form-control" placeholder="Email">
			</div>
		</div>
		<div class="form-group">	
			<label for="password">Password</label>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
				<input name="password" type="password" class="form-control" placeholder="Password">
			</div>
		</div>
		<button type="submit" class="btn btn-success btn-lg pull-right">Login</button>
	</form>
	<p>Don't have an account? <a data-toggle="modal" href="#signup">Sign up</a> today!</p>
</div>

<!-- Sign-up form modal -->
<?=$signup?>


