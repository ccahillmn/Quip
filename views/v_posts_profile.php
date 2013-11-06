<h1 class="col-md-offset-2">Quipper</h1>
<div class="row">
	<div id="sidebar" class="col-xs-6 col-md-4 col-md-offset-2">
		<!-- User Profile -->
		<div class="box">
			<?=$user_sum?>
		</div>
		<!-- Add a post if on own profile -->
		<?php if($add == true): ?>
			<div class="box">
				<?=$add_post?>
			</div>
		<?php endif ?>
	</div>
	<!-- Stream of posts -->
	<div id="stream" class="col-xs-6 col-md-5">
		<?=$stream?>
	</div>
</div>

