<?php if(empty($posts)): ?>
<div class="center">
	<h2>Nothing to see here...</h2>
	<p class="center">Why don't you <a href="/posts/users">follow a few others</a>.</p>
</div>
<?php else : ?>
	<?php foreach($posts as $post): ?>
		<div class="post">
			<?php if($post['post_user_id'] == $user->user_id): ?>
				<a href="/posts/delete/<?=$post['post_id']?>/<?php echo $page_id?>"><span alt="Delete Post" title="Delete this post" class="glyphicon glyphicon-remove-circle pull-right"></span></a>
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
<?php endif ?>