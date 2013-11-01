<div class="post>
	<p><?=$post['content']?><img src="<?=$post['photo']?>" class="avatar"/></p>
	<p class="meta">Posted by <em><?=$post['first_name']?> on <?=Time::display($post['created'])?></em></p>
</div>