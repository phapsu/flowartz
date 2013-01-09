<?php
        $this->load->helper('text');
        /**
	 * Profile homepage
	 */
        $this->load->helper('form');
	$no_data = empty($uniqexpinfo);
	 
	if(false === $no_data){
		$data = (empty($uniqexpinfo) ? null : $uniqexpinfo[0]);
	}else {
		$data = new stdClass();
		$data->artist_level = '';
		$data->job_title = '';
		$data->job_event_title = '';
		$data->job_description = '';
		$data->job_date = date('m/d/Y');
		$data->job_location = '';
		$data->job_link = '';
		$data->job_link_title = '';
	}
        $artistLevel = $this->config->item('artist_level');
?>
<div class="content">
	<div class="wrapper clearfix">
		<?php include('edit_profile_sidebar.php'); ?>
		<div class="profile-right">
			<h1>Edit Experience</h1>
			<div class="edit-form">
				<form method="post" action="<?php echo base_url(); ?>user<?php if(false === $no_data){echo '/update/experience/'. $data->eid;}else {echo '/save/experience';} ?>" class="fa-edit-form">
					<label for="">Level</label>
					<?php echo form_dropdown('fac_profile[artist_level]', $artistLevel, $data->artist_level);?>
				
					<label for="">What you did</label>
					<input type="text" name="fac_profile[job_title]" value="<?php echo $data->job_title; ?>" />
				
					<label for="">Where you did it</label>
					<input type="text" name="fac_profile[job_location]" value="<?php echo $data->job_location; ?>" />
					
					<label for="">Date you did it</label>
					<input type="text" name="fac_profile[job_date]"  id="datepicker" value="<?php echo date('m/d/Y', strtotime($data->job_date)); ?>"/>
				
					<label for="">Paste a Relevant Link</label>
					<input type="text" name="fac_profile[job_link]" value="<?php echo $data->job_link; ?>" />
					
					<label for="">Link Title</label>
					<input type="text" name="fac_profile[job_link_title]" value="<?php echo $data->job_link_title; ?>" />
				
					<label for="">Brief Description</label>
					<textarea name="fac_profile[job_description]" id=""><?php echo $data->job_description; ?></textarea>
				
					<input type="submit" name="fac_profile[save]" value="Save" />
					<?php if(false === $no_data) : ?>
						<input type="submit" name="fac_profile[delete]" value="Delete" id="delete-btn" />
						<input type="hidden" name="fac_profile[eid]" value="<?php echo $data->eid; ?>" />
					<?php endif; ?>
				</form>
			</div>
			<!-- end of edit-form div -->
                        <div class="edit-list">
                            <h5>Edit Experiences</h5>
				<div class="well">
                                    <ul class="nav nav-list">
                                        <?php 
                                            if(count($expinfo) > 0) : 
                                                $theLevelArray = array();
                                                foreach($expinfo as $exp) :
                                                    $exp->job_title = (!$exp->job_title) ? 'Untitled' : $exp->job_title;
                                                    if(!in_array($exp->artist_level, $theLevelArray)){
                                                        if(isset($artistLevel[$exp->artist_level])) echo '<li class="nav-header">'.$artistLevel[$exp->artist_level].'</li>';
                                                    }
                                                    $theLevelArray[$exp->artist_level] = $exp->artist_level;
                                                    $selected = ($exp_id == $exp->eid) ? 'active' : '';
                                        ?>
                                                    <li class="<?php echo $selected;?>"><?php echo anchor('user/profile/edit/experience/'. $exp->eid, character_limiter($exp->job_title, 18)); ?></li>
					<?php endforeach; ?>
					<?php else : ?>
						<li class="nav-header">No experiences yet</li>
					<?php endif; ?>                                       
                                        <li class="divider"></li>
                                    </ul>
                                </div>
			</div>
			<!-- end of edit-list div -->
		</div>
		<!-- end of profile-right div -->
	</div>
	<!-- end of content wrapper div -->
</div>
<!-- end of content div -->

<script>
$(function() {
        $( "#datepicker" ).datepicker();
});
</script>