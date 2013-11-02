<div class="row">
<h1 class="center">Your Account</h1>
<?php if(isset($_GET['update'])): ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Account updated! </strong> Go back to <a href="/">Quips</a> or <a href="/posts/users">Users</a>.
	</div>
<?php endif; ?>
<form class="form-horizontal col-md-offset-3" role="form" method='POST' enctype="multipart/form-data" action='/users/p_profile/'>

	<!--Required Info -->
	<div class="form-group">
		<label for="first_name" class="col-md-2 control-label">First Name</label>
		<div class="col-md-5">
			<input type="text" class="form-control" name="first_name" value="<?=$user->first_name;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="last_name" class="col-md-2 control-label">Last Name</label>
		<div class="col-md-5">
			<input type="text" class="form-control" name="last_name" value="<?=$user->last_name;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="email" class="col-md-2 control-label">Email</label>
		<div class="col-md-5">
			<input type="email" class="form-control" name="email" value="<?=$user->email;?>">
		</div>
	</div>
	
	<!-- Reset password
	<div class="form-group">
		<label for="password" class="col-md-2 control-label">Password</label>
		<div class="col-md-5">
			<input type="password" class="form-control" name="password" placeholder="Enter new password">
		</div>
	</div>
	--?>
  
	<!-- Optional Info -->
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
	
	<!-- Photo Upload 
	<div class="form-group">
		<label for="photo" class="col-md-2 control-label">
			Photo<br/>
		</label>
		<div class="col-md-5">
			<img src="/uploads/avatars/<?=$user->photo;?>" alt="<?php $user->first_name . ' ' . $user->last_name ?>" class="avatar">
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
	</div>-->
  
	<!-- Submit -->
	<div class="form-group">
		<div class="col-md-offset-2 col-md-5">
			<button type="submit" class="btn btn-primary btn-lg">Update</button>
			or <a href="/">Cancel</a>
		</div>
	</div>
</form>
</div>
