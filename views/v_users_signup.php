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