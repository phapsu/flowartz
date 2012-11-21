<?php
	/**
	 * Profile homepage
	 */
	$user = $userinfo[0];
	
	/**
	 * Sample setting schema
	 */
	$settings = array(
		
		'allow_hire' => true,
		'show_location' => true,
		'show_history' => true
		
	);
?>
<div class="content">
	<div class="wrapper clearfix">
		<?php include('edit_profile_sidebar.php'); ?>
		<div class="profile-right">
			<h1>Edit Account Settings</h1>
			<form method="post" action="<?php echo base_url(); ?>user/save/settings" class="fa-edit-form">
				
				<label for="email">Email Address</label>
				<input type="text" name="fac_profile[email]" id="email" value="<?php echo $user->email; ?>" />
				
				<input type="submit" value="Save" />
				<a href="<?php echo base_url(); ?>user/reset_password/" class="grey-btn">Change Password</a>
			</form>
		</div>
		<!-- end of profile-right div -->
	</div>
	<!-- end of content wrapper div -->
</div>
<!-- end of content div -->