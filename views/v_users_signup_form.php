<form  role="form" method='POST' action='/users/p_signup/'>

	<!-- Error for blank fields -->
	<?php if(isset($_GET['blank']) && $_GET['blank'] == 'blank'): ?>
		<div class="bs-callout bs-callout-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Please complete all fields.
		</div>
	<?php endif; ?>
	
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" class="form-control" name="first_name" id="exampleInputEmail2" placeholder="First Name" <?php if(isset($_COOKIE['first_name'])): ?>value="<?php echo $_COOKIE['first_name'] ?>"<?php endif ?>>
	</div>
	
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" <?php if(isset($_COOKIE['last_name'])): ?>value="<?php echo $_COOKIE['last_name'] ?>"<?php endif ?>>
	</div>
	
	<!-- Invalid Email -->
	<?php if(isset($_GET['email']) && $_GET['email'] == 'invalid'): ?>
		<div class="bs-callout bs-callout-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Invalid email address
		</div>
	<?php endif; ?>
	
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email" id="email" placeholder="Email" <?php if(isset($_COOKIE['email'])): ?>value="<?php echo $_COOKIE['email'] ?>"<?php endif ?>>
	</div>
	
	<!-- Password Mismatch -->
	<?php if(isset($_GET['pw']) && $_GET['pw'] == 'mismatch'): ?>
		<div class="bs-callout bs-callout-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Passwords did not match
		</div>
	<?php endif; ?>
	
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Password">
	</div>
	<div class="form-group">
		<label for="password2">Repeat Password</label>
		<input type="password" class="form-control" name ="password2" id="password2" placeholder="Repeat Password">
	</div>
	<button type="submit" class="btn btn-info btn-lg pull-right">Sign up</button>
</form>
<p class="helptext">Have an account already? <a href="/users/login">Login</a>
