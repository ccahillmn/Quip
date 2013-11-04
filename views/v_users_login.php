<div id="login_form">
	<h1>Login</h1>
	
	<!-- If account is new, post alert to show successful account creation -->
	<?php if(isset($_GET['acct']) && $_GET['acct'] == 'new'): ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Account successfully created! </strong> Please login to access your account.
		</div>
	<?php endif; ?>

	<!-- If email exists during sign up -->
	<?php if(isset($_GET['acct']) && $_GET['acct'] == 'exists'): ?>
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Existing account</strong> - An account with that email already exists. Please login.
		</div>
	<?php endif; ?>
	
	<!-- Invalid Login -->
	<?php if(isset($error)): ?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Invalid Login</strong> - Incorrect email or password. Try again.
		</div>
	<?php endif; ?>
	
	<form role="form" method='POST' action='/users/p_login/'>
		<div class="form-group">
			<label for="email">Email</label>
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
	<p class="helptext">Don't have an account? <a data-toggle="modal" href="#signup">Sign up</a> today!</p>
</div>

<!-- Sign-up form modal for link on login form-->
<div class="modal fade" id="signup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">Sign Up</h2>
			</div>
			<div class="modal-body">
				<?=$signup?>
			</div>
		</div>
	</div>
</div>


