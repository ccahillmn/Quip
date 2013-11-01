<div class="row">

	<div id="sidebar" class="col-xs-6 col-md-4">
		<!-- User Profile -->
		<div class="box">
			<?$user?>
		</div>
		<!-- Add a post -->
		<div class="box">
			<?$addpost?>
		</div>
	</div>
	
	<!-- Stream of posts -->
	<div id="stream" class="col-xs-12 col-md-8">
		<?php foreach($posts as $post): ?>
			<?$post?>
		<?php endforeach; ?>
	</div>
	
</div>

