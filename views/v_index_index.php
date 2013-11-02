
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
						<li class="list-group-item">Feature 1</li>
						<li class="list-group-item">Feature 2</li>
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
				<form  role="form" method='POST' action='/users/p_signup/'>
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" class="form-control" id="exampleInputEmail2" placeholder="First Name">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="password2">Repeat Password</label>
						<input type="password" class="form-control" id="password2" placeholder="Repeat Password">
					</div>
					<button type="submit" class="btn btn-info btn-lg">Sign up</button>
				</form>
			</div>
		</div>
	</div>
</div>


