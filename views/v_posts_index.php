<h1 class="col-md-offset-1">Quips</h1>
<div class="row">
	<div id="sidebar" class="col-xs-6 col-md-4 col-md-offset-1">
		<!-- User Profile -->
		<div class="box">
			<?=$user_sum?>
		</div>
		<!-- Add a post -->
		<div class="box">
			<?=$addpost?>
		</div>
	</div>
	
	<!-- Stream of posts -->
	<div id="stream" class="col-xs-6 col-md-4">
		<?php foreach($posts as $post): ?>
			<div class="post">
				<?php if($post['post_user_id'] == $user->user_id): ?>
					<a href="/posts/delete/<?php echo $post['post_id']?>"><span alt="Delete Post" title="Delete this post" class="glyphicon glyphicon-remove-circle pull-right"></span></a>
				<?php endif; ?>
				<p><?=$post['content']?><img src="/uploads/avatars/<?=$post['photo']?>" class="avatar img-circle"/></p>
				<p class="meta">
					Posted by <em>
					<?php if($post['post_user_id'] == $user->user_id): ?>
						You
					<?php else: ?>
						<?=$post['first_name']?> 
					<?php endif; ?>
					</em>on <?=Time::display($post['created'])?>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
	
</div>

