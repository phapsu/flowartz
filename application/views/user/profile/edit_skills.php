<?php
        $this->load->helper('form');
        $this->load->helper('text');
	/**
	 * Profile homepage
	 */
	$no_data = empty($uniqskillinfo);
	 
	if(false === $no_data){
		$data = (empty($uniqskillinfo) ? null : $uniqskillinfo[0]);
	}else {
		$data = new stdClass();
		$data->name = '';
		$data->artist_level = '';
	}
        
        $artistLevel = $this->config->item('artist_level');
?>
<div class="content">
	<div class="wrapper clearfix">
		<?php include('edit_profile_sidebar.php');?>
		<div class="profile-right">
			<h1>Edit Skills<span class="profile-item-counter"><?php //echo $this->profile_model->profile_item_counter(); ?></span></h1>
			<div class="edit-form">
				<form method="post" action="<?php echo base_url(); ?>user<?php if(false === $no_data){echo '/update/skills/'. $data->sid;}else {echo '/save/skills';} ?>" class="fa-edit-form">
					<label for="">Add a Skill or Talent</label>
					<?php echo form_dropdown('fac_profile[artist_level]', $artistLevel, $data->artist_level);?>
					<input type="text" name="fac_profile[name]" id="skill" value="<?php echo $data->name; ?>" />
					
					<input type="submit" name="fac_profile[save]" value="Save" />
					<?php if(false === $no_data) : ?>
						<input type="submit" name="fac_profile[delete]" value="Delete" id="delete-btn" />
						<input type="hidden" name="fac_profile[sid]" value="<?php echo $data->sid; ?>" />
					<?php endif; ?>
				</form>
			</div>
			<!-- end of edit-form div -->
			<div class="edit-list">
                            <h5>Edit Skills</h5>
                            <!--<pre><?php //print_r($skillinfo);?></pre>-->
				<div class="well">
                                    <ul class="nav nav-list">
                                        <?php 
                                            if(count($skillinfo) > 0) :
                                                $theLevelArray = array();
                                                foreach($skillinfo as $skill) :                                                    
                                                    if(!in_array($skill->artist_level, $theLevelArray) && isset($artistLevel[$skill->artist_level])){
                                                        echo '<li class="nav-header">'.$artistLevel[$skill->artist_level].'</li>';
                                                    }
                                                    $theLevelArray[$skill->artist_level] = $skill->artist_level;
                                                    $selected = ($skill_id == $skill->sid) ? 'active' : '';
                                        ?>
                                        <li class="<?php echo $selected;?>"><?php echo anchor('user/profile/edit/skills/'. $skill->sid, character_limiter($skill->name, 18)); ?></li>
					<?php endforeach; ?>
					<?php else : ?>
						<li class="nav-header">No Skills</li>
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