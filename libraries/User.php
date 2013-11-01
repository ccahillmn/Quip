<?php

class User {
	
	public static function get_posts_by_user($user_id) {
	
		$q = 'SELECT *
			FROM users
			WHERE user_id = '.$user_id;
		
		return $q
		
	}

}

<div class="user">
		<img src="<?=$user['photo']?>" class="avatar"/>
		<?=$user['first_name']?> <?=$user['last_name']?><br>
		
		<!-- if website set -->
		<?php if($user->website): ?>
			<a href="<?=$user['website']?>"><?=$user['website']?></a><br>
		<?php endif; ?>	
		
		<!-- if bio set -->
		<?php if($user->bio): ?>
			<?=$user['bio']?><br>
		<?php endif; ?>	
		
		<!-- Display button based on connection -->
		<?php if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id']?>'><button type="button" class="btn btn-danger">Unfollow</button></a>
		<?php else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'><button type="button" class="btn btn-success">Follow</button></a>
		<?php endif; ?>	
</div>