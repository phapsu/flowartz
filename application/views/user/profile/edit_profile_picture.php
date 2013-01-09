<?php
	/**
	 * Edit profile picture view
	 */
	$user = $userinfo[0];
	$ci =& get_instance();
	
	$ci->load->helper(array('form', 'url'));
?>
<div class="content">
	<div class="wrapper clearfix">
		<?php include('edit_profile_sidebar.php'); ?>
		<div class="profile-right">
			<h1>Edit Profile Picture</h1>
			<div class="edit-form">
				<form method="post" action="<?php echo base_url(); ?>user/save/profile_picture" class="fa-edit-form" enctype="multipart/form-data" accept-charset="utf-8">
					<label for="pimg">Choose a new profile image</label>
					<input type="file" name="profile_picture" id="pimg" value="" />
					<input type="hidden" name="fac_profile[old_profile_picture]" id="oimg" value="<?php echo $user->profile_picture; ?>" />
					
					<input type="submit" name="fac_profile[save]" value="Save" />
				</form>
			</div>
			<!-- end of edit-form div -->
			<div class="edit-list"> <!-- these styles to be added to .current-profile-image -->
				<h5>Current Profile Picture</h5>
				<div class="current-img"> <!-- these styles to be added to .cur-img -->
                                    <?php if ($user->profile_picture && is_file('./application/files/' . $user->profile_picture)) : ?>
                                        <div id="avatar">
                                            <img src="<?php echo base_url(); ?>application/files/<?php echo $user->profile_picture; ?>" alt="<?php echo $user->name; ?>&apos;s Profile Picture" />
                                        </div>
                                        <div style="clear:both"><input type="submit" id="delete-profile-img" class="delete-btn" value="Delete" name="delete"></div>
                                    <?php else : ?>
                                        <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="<?php echo $user->name; ?>&apos;s Profile Picture"/>
                                    <?php endif; ?>                                    
				</div>
				<!-- end of current img div -->
			</div>
			<!-- end of edit-links div -->
		</div>
		<!-- end of profile-right div -->
	</div>
	<!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<script type="text/javascript">
$(function(){
    $('#delete-profile-img').bind('click', function(){
        $btn = $(this);
        if(confirm('Are you sure?')){
            $.post("<?php echo base_url(); ?>user/delete/profile_image", {'fac_profile':<?php echo $this->session->userdata('user_id');?>}, 
            function(res){
                if(res == 1){
                    $('#avatar').html('<img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="No Picture Picture"/>');
                    $btn.hide();
                }
            });
        }else{
            return false;
        }
    });
});
</script>