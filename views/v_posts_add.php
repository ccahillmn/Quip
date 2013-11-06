<h2>Post a quip:</h2>
<form method='post' action='/posts/p_add' role="form">
	<div class="form-group">
		<label for="content" class="sr-only">Post a quip:</label>
		<input type="text" name="content" class="form-control">
		<input type="hidden" name="page_id" value="<?php echo $_SERVER['ORIG_PATH_INFO'];?>">
	</div>
	<button class="btn btn-default" type='Submit'>Quip</button>
</form>