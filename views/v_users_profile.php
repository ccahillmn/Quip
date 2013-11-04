<div class="row">
<h1 class="center">Your Account</h1>

<!--Update successful -->
<?php if(isset($_GET['success'])): ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Account updated! </strong> Go back to <a href="/">Home</a> or <a href="/posts/users">Users</a>
	</div>
<?php endif; ?>

<!-- Account not updated-->
<?php if(isset($error)): ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Account could not be updated</strong> - Correct errors below
	</div>
<?php endif; ?>

<form class="form-horizontal col-md-offset-3" role="form" method='POST' enctype="multipart/form-data" action='/users/p_profile/'>

	<!-- Required field blank error -->
	<?php if(isset($_GET['blank']) && $_GET['blank'] == 'blank'): ?>
		<div class="bs-callout bs-callout-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Required fields cannot be left blank.
		</div>
	<?php endif; ?>
	
	<div class="form-group">
		<label for="first_name" class="col-md-2 control-label">First Name*</label>
		<div class="col-md-5">
			<input type="text" class="form-control" name="first_name" value="<?=$user->first_name;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="last_name" class="col-md-2 control-label">Last Name*</label>
		<div class="col-md-5">
			<input type="text" class="form-control" name="last_name" value="<?=$user->last_name;?>">
		</div>
	</div>
	
	<!-- Invalid Email -->
	<?php if(isset($_GET['email'])&& $_GET['email'] == 'invalid'): ?>
		<div class="bs-callout bs-callout-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Invalid email address. <br>
		</div>
	<?php endif ?>
	
	<div class="form-group">
		<label for="email" class="col-md-2 control-label">Email*</label>
		<div class="col-md-5">
			<input type="email" class="form-control" name="email" value="<?=$user->email;?>">
		</div>
	</div>
	
	<!-- Passwords don't match error -->
	<?php if(isset($_GET['password']) && $_GET['password'] == 'mismatch'): ?>
		<div class="bs-callout bs-callout-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Passwords do not match.
		</div>
	<?php endif; ?>
	
	<div class="form-group">
		<label for="password" class="col-md-2 control-label">Password</label>
		<div class="col-md-5">
			<input type="password" class="form-control" name="password" placeholder="Enter new password"><br>
			<input type="password" class="form-control" name="password2" placeholder="Repeat password">
		</div>
	</div>
	
	<!-- Invalid URL -->
	<?php if(isset($_GET['url'])&& $_GET['url'] == 'invalid'): ?>
		<div class="bs-callout bs-callout-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> Invalid web address. <br><span class="helptext">Please include the entire URL, e.g. http://quip.com</span>
		</div>
	<?php endif ?>
	
	<div class="form-group">
		<label for="website" class="col-md-2 control-label">Website</label>
		<div class="col-md-5">
			<input type="text" class="form-control" name="website" value="<?=$user->website;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="bio" class="col-md-2 control-label">Bio</label>
		<div class="col-md-5">
			<textarea class="form-control" rows="3" name="bio" value="" placeholder="Tell us a bit about yourself..."><?=$user->bio;?></textarea>
		</div>
	</div>
	
	<!-- Photo Upload Error -->
	<?php if(isset($_GET['file'])&& $_GET['file'] == 'invalid'): ?>
		<div class="bs-callout bs-callout-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Whoops!</strong> File type is invalid. Please choose a jpg, png, or gif.
		</div>
	<?php endif ?>
	
	<div class="form-group">
		<label for="photo" class="col-md-2 control-label">
			Photo<br/>
		</label>
		<div class="col-md-5">
			<img src="/uploads/avatars/<?=$user->photo;?>" alt="<?php $user->first_name . ' ' . $user->last_name ?>" class="avatar img-circle">
			<div class="input-group">
				<input type="file" class="form-control" name="photo" placeholder="Select a file...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">Browse</button>
				</span>
			</div>
			<div class="checkbox pull-right">
				<label>
					<input name="rm_photo" type="checkbox"> Remove photo
				</label>
			</div>
		</div>
	</div>
  
	<div class="form-group">
		<div class="col-md-offset-2 col-md-5">
			<button type="submit" class="btn btn-primary btn-lg">Update</button>
			or <a href="/">Cancel</a>
		</div>
	</div>
</form>
</div>
