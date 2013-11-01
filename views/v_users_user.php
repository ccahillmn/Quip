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