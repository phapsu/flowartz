<?php

	/**
	 * Search page view
	 */

?>
<div class="content">
	<div class="wrapper clearfix">
		<div class="artist-filter">
			<ul>
				<li><a href="#" class="active-filter">Recent</a></li>
				<li><a href="#">Popular</a></li>
			</ul>
			<form class="artist-search" action="<?php echo base_url(); ?>search" method="post">
				<input type="text" name="fac_search[q]" placeholder="Search for artists" value="">
				<input type="submit" value="">
				<input type="hidden" name="fac_search[action]" value="1" />
			</form>
		</div>
		<!-- end of artist filter div -->
		<ul class="artist-group">
			<?php foreach($users as $user): ?>
			<li class="artist-profile">
				<div class="artist">
					<?php if(!empty($user->name)){
						echo '<a href="'. base_url() .'user/'.$user->uid.'" class="thumb-link">'.$user->name.'</a>';
					}else{
						echo '<a href="'. base_url() .'user/'.$user->uid.'" class="thumb-link">New Artist</a>';
					}
					?>
					<a href="<?php echo base_url(); ?>user/<?php echo $user->uid; ?>" class="avatar">
						<img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="<?php echo $user->name; ?>&apos;s Profile Picture" />
					</a>
					<ul>
					<?php
						if(!empty($user->title)){
							echo '<li class="thumb-desc">'.$user->title.'</li>';
						}else{
							echo '<li class="thumb-desc">Artist\'s Title</li>';
						}
						
						
						if(!empty($user->location)){
						echo '<li>'.$user->location.'</li>';
						}else{
							echo '<li>Location</li>';
						}
					?>
					</ul>
				</div>
				<!-- end of artist div -->
			</li>
			<?php endforeach; ?>
		</ul>
		<!-- end of artist-group ul -->
		<div class="pagination"></div>
		<!-- end of pagination div -->
	</div>
	<!-- end of content wrapper div -->
</div>
<!-- end of content div -->


