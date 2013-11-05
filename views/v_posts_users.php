	<h1 class="col-md-offset-2">Quippers</h1>
	<div class="row">
	
		<div id="sidebar" class="col-xs-6 col-md-4 col-md-offset-2">
			<!-- User Profile -->
			<div class="box">
				<?=$user_sum?>
			</div>
		</div>
		
		<!-- Stream of posts -->
		<div id="stream" class="col-xs-6 col-md-5">
			<?php foreach($users as $user): ?>
				<div class="user clear">
				
					<!-- Display follow button based on connection -->
					<?php if(isset($connections[$user['user_id']])): ?>
						<a href='/posts/unfollow/<?=$user['user_id']?>'><button type="button" class="btn btn-danger pull-right">Unfollow</button></a>
					<?php else: ?>
						<a href='/posts/follow/<?=$user['user_id']?>'><button type="button" class="btn btn-success pull-right">Follow</button></a>
					<?php endif; ?>	
					
					<!-- User Summary -->
					<img src="/uploads/avatars/<?=$user['photo']?>" class="avatar img-circle"/>
					<strong><a href="/posts/user/<?=$user['user_id']?>"><?=$user['first_name']?> <?=$user['last_name']?></a></strong><br>

					<!-- Display website if set -->
					<?php if($user['website']): ?>
						<a href="<?php $user['website']?>"><?=$user['website']?></a><br>
					<?php endif; ?>	

					<!-- Display bio if set -->
					<?php if($user['bio']): ?>
						<p><?=$user['bio']?></p>
					<?php endif; ?>	
					
				</div>
				
			<?php endforeach; ?>
		</div>
		
	</div>

