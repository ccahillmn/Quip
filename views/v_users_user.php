<h2>Your Profile</h2>
<img src="/uploads/avatars/<?=$user->photo;?>" class="avatar img-circle"/>
<a href="/posts/user/<?=$user->user_id?>"><?=$user->first_name;?> <?=$user->last_name;?></a><br>

<!-- if website set -->
<?php if($user->website): ?>
     <a href="<?php $user->website?>"><?=$user->website?></a><br>
<?php endif; ?>     

<!-- if bio set -->
<?php if($user->bio): ?>
     <p><?=$user->bio?><p>
<?php endif; ?> 

<hr/>
<a href="/users/profile/">Update your profile</a>