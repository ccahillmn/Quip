	<div class="row">
	
		<div id="sidebar" class="col-xs-6 col-md-4">
			<!-- User Profile -->
			<div class="box">
				<?$user?>
			</div>
		</div>
		
		<!-- Stream of posts -->
		<div id="stream" class="col-xs-12 col-md-8">
			<?php foreach($users as $user): ?>
				<div class="user>
					<!-- User Summary -->
					<?$user?>
					
					<!-- Display follow button based on connection -->
					<?php if(isset($connections[$user['user_id']])): ?>
						<a href='/posts/unfollow/<?=$user['user_id']?>'><button type="button" class="btn btn-danger">Unfollow</button></a>
					<?php else: ?>
						<a href='/posts/follow/<?=$user['user_id']?>'><button type="button" class="btn btn-success">Follow</button></a>
					<?php endif; ?>	
				</div>
				
			<?php endforeach; ?>
		</div>
		
	</div>

