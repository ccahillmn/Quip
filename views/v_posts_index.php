<h1 class="col-md-offset-2">Quips</h1>
<div class="row">
	<div id="sidebar" class="col-xs-6 col-md-4 col-md-offset-2">
		<!-- User Profile -->
		<div class="box">
			<?=$user_sum?>
		</div>
		<!-- Add a post -->
		<?php if ($add == true): ?>
		<div class="box">
			<h2>Post a quip:</h2>
			<form method='post' action='/posts/p_add' role="form">
				<div class="form-group">
					<label for="content" class="sr-only">Post a quip:</label>
					<input type="text" name="content" class="form-control">
					<input type="hidden" name="page_id" value="<?=$page_id?>">
				</div>
				<button class="btn btn-default" type='Submit'>Quip</button>
			</form>
		</div>
		<?php endif ?>
	</div>
	
	<!-- Stream of posts -->
	<div id="stream" class="col-xs-6 col-md-5">
		<?php foreach($posts as $post): ?>
			<div class="post">
				<?php if($post['post_user_id'] == $user->user_id): ?>
					<a href="/posts/delete/<?php echo $post['post_id']; if($add == true){ echo '/'. $user->user_id;}?>"><span alt="Delete Post" title="Delete this post" class="glyphicon glyphicon-remove-circle pull-right"></span></a>
				<?php endif; ?>
				<p><?=$post['content']?><img src="/uploads/avatars/<?=$post['photo']?>" class="avatar img-circle"/></p>
				<p class="meta">
					Posted by <a href="/posts/user/<?=$post['post_user_id']?>"><em>
					<?php if($post['post_user_id'] == $user->user_id): ?>
						You
					<?php else: ?>
						<?=$post['first_name']?> 
					<?php endif; ?>
					</a></em>on <?=Time::display($post['created'])?>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
	
</div>

