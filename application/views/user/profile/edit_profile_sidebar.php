<div class="profile-left" id="edit-profile">
	<h3>Edit Profile</h3>
	<ul class="profile-navigation">
		<li><a href="<?php echo base_url(); ?>user/profile/edit" class="user-icon">Info</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/profile_picture" class="profile-icon">Picture</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/links" class="links-icon">Links</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/skills" class="skills-icon">Skills</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/experience" class="calendar-icon">Experience</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/images" class="image-icon">Images</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/videos" class="film-icon">Videos</a></li>
		<li><a href="<?php echo base_url(); ?>user/profile/edit/settings" class="settings-icon">Settings</a></li>
		<li><a href="<?php echo base_url(); ?>user/classroom" class="classroom-icon">Classroom</a></li>
	</ul>
	<div class="profile-widgets">
		<?php echo $this->widgets->views(); ?>
	</div>
</div>
<!-- end of profile-left div -->