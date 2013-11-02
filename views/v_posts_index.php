<h1 class="col-md-offset-1">Quips</h1>
<div class="row">
	<div id="sidebar" class="col-xs-6 col-md-4 col-md-offset-2">
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
				<p><?=$post['content']?><img src="/uploads/avatars/<?=$post['photo']?>" class="avatar"/></p>
				<p class="meta">Posted by <em><?=$post['first_name']?></em> on <?=Time::display($post['created'])?></p>
			</div>
		<?php endforeach; ?>
	</div>
	
</div>

