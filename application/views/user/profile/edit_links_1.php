<?php
	/**
	 * Edit links page 
	 */
	 $no_data = empty($uniqlinkinfo);
	 
	 if(false === $no_data){
	 	$data = (empty($uniqlinkinfo) ? null : $uniqlinkinfo[0]);
	 }else {
	 	$data = new stdClass();
	 	$data->link = '';
	 	$data->name = '';
	 }
?>
<div class="content">
	<div class="wrapper clearfix">
		<?php include('edit_profile_sidebar.php'); ?>
		<div class="profile-right">
			<h1>Edit Links <span class="profile-item-counter"><?php echo $this->profile_model->profile_item_counter(); ?></span></h1>
			<div class="edit-form">
				<form method="post" action="<?php echo base_url(); ?>user<?php if(false === $no_data){echo '/update/links/'. $data->lid;}else {echo '/save/links';} ?>" class="fa-edit-form">
					<label for="">Paste Link</label>
					<input type="text" name="fac_profile[link]" id="link-url" value="<?php echo $data->link; ?>" />
					
					<label for="">Link Title</label>
					<input type="text" name="fac_profile[name]" id="link-title" value="<?php echo $data->name; ?>" />
				
					<input type="submit" name="fac_profile[save]" value="Save" />
					<?php if(false === $no_data) : ?>
						<input type="submit" name="fac_profile[delete]" value="Delete" id="delete-btn" />
						<input type="hidden" name="fac_profile[lid]" value="<?php echo $data->lid; ?>" />
					<?php endif; ?>
				</form>
			</div>
			<!-- end of edit-form div -->
			<div class="edit-list">
				<h5>Edit Links</h5>
				<ul>
					<?php if(count($linkinfo) > 0) : ?>
						<?php foreach($linkinfo as $link) : ?>
							<li><?php echo anchor('user/profile/edit/links/'. $link->lid, $link->name); ?></li>
						<?php endforeach; ?>
					<?php else : ?>
						<li>No Links</li>
					<?php endif; ?>
				</ul>
			</div>
			<!-- end of edit-list div -->
		</div>
		<!-- end of profile-right div -->
	</div>
	<!-- end of content wrapper div -->
</div>
<!-- end of content div -->