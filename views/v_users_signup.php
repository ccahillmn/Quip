<div id="signup_form">
<h1>Sign up</h1>
<?php if(isset($error)): ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Account could not be created</strong> - Correct errors below.
	</div>
<?php endif; ?>
<?=$signup?>
</div>