<h1>Your Account</h1>
<form class="form-horizontal" role="form" method='POST' enctype="multipart/form-data" action='/users/p_profile/'>

	<!--Required Info -->
	<label class="col-sm-2 control-label">Name</label>
	<div class="col-sm-10">
		<div class="form-group">
			<label class="sr-only" for="first_name">First Name</label>
			<input type="text" class="form-control" id="first_name" placeholder="<?=$user['first_name']?>">
		</div>
		<div class="form-group">
			<label class="sr-only" for="last_name">Last Name</label>
			<input type="text" class="form-control" id="last_name" placeholder="<?=$user['last_name']?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" placeholder="<?=$user['email']?>">
		</div>
	</div>
	
	<!-- Reset password
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="password" placeholder="Enter new password">
		</div>
	</div>
	--?>
  
	<!-- Optional Info -->
	<div class="form-group">
		<label for="website" class="col-sm-2 control-label">Website</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="website" placeholder="<?=$website?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="bio" class="col-sm-2 control-label">Bio</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="3" id="bio" placeholder="<?=$bio?>"></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<label for="photo" class="col-sm-2 control-label">
			Photo<br/>
			<img src="/uploads/avatars/<?php $user->photo ?>" alt="<?php $user->first_name . ' ' . $user->last_name ?>">
		</label>
		<div class="col-lg-6">
			<div class="input-group">
				<input type="file" class="form-control" id="photo" placeholder="Select a file...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">Browse</button>
				</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<label>
					<input id="rm_photo" type="checkbox"> Remove photo
				</label>
			</div>
		</div>
	</div>
  
	<!-- Submit -->
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-primary btn-lg">Update Profile</button>
		</div>
	</div>
</form>
