<div id="pitch" class="container">
	<h1><img class="logo" src="/images/logo.png"/>Welcome to Quip!</h1>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			<p>Quip is a microblog application that enables you to share your thoughts, one quick quip at a time. Follow your friends to see what's on their minds.</p>
			<p><a class="btn btn-info btn-lg" data-toggle="modal" href="#signup">Sign Up</a> or <a href="users/login">Login</a></p>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>+1 Features</strong>
				</div>
				<ul class="list-group">
					<li class="list-group-item">Delete a post</li>
					<li class="list-group-item">Edit and display profile info</li>
					<li class="list-group-item">Reset Password</li>
					<li class="list-group-item">Upload or Remove Photo</li>
					<li class="list-group-item">View posts from specific user</li>
				</ul>
			</div>
		</div>
	</div>
	<hr/>
</div>

<!-- Sign up form modal -->
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

<!-- if URL includes #signup, show signup form -->
<script>
	if(window.location.hash == '#signup') {
		$('#signup').modal('show')
	}
</script>


