<?php
	/**
	 * Edit links page
	 */
	 $data = $links;
        //print_r($data);
?>
<div class="content">
	<div class="wrapper clearfix">
		<?php include('edit_profile_sidebar.php'); ?>
		<div class="profile-right">
			<h1>Edit Links <span class="profile-item-counter"><?php //echo $this->profile_model->profile_item_counter(); ?></span></h1>
			<form method="post" action="<?php echo base_url(); ?>user<?php if(!empty($data)){echo '/update/links/'. $data->lid;}else {echo '/save/links';} ?>" class="fa-edit-form">
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/facebook.png" height="34" width="34" alt="Facebook" title="Facebook"></label>
                                <input type="text" name="fac_profile[facebook]" value="<?php echo @$data->facebook; ?>"  placeholder="Facebook"/>
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/twitter.png" height="34" width="34" alt="Twitter" title="Twitter"></label>
                                <input type="text" name="fac_profile[twitter]" value="<?php echo @$data->twitter; ?>"  placeholder="Twitter"/>
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/googleplus.png" height="34" width="34" alt="Google Plus" title="Google Plus"></label>
                                <input type="text" name="fac_profile[googleplus]" value="<?php echo @$data->googleplus; ?>" placeholder="Google Plus" />
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/youtube.png" height="34" width="34" alt="Youtube" title="Youtube"></label>
                                <input type="text" name="fac_profile[youtube]" value="<?php echo @$data->youtube; ?>" placeholder="Youtube" />
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/vimeo.png" height="34" width="34" alt="Vimeo" title="Vimeo"></label>
                                <input type="text" name="fac_profile[vimeo]" value="<?php echo @$data->vimeo; ?>"  placeholder="Vimeo"/>
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/foursquare.png" height="34" width="34"  alt="Four Square" title="Four Square"></label>
                                <input type="text" name="fac_profile[foursquare]" value="<?php echo @$data->foursquare; ?>" placeholder="Four Square"/>
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/soundcloud.png" height="34" width="34"  alt="Sound Cloud" title="Sound Cloud"></label>
                                <input type="text" name="fac_profile[soundcloud]" value="<?php echo @$data->soundcloud; ?>" placeholder="Sound Cloud"/>
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/devianart.png" height="34" width="34" alt="Devian Art" title="Devian Art"></label>
                                <input type="text" name="fac_profile[devianart]" value="<?php echo @$data->devianart; ?>" placeholder="Devian Art" />
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/photobucket.png" height="34" width="34" alt="Photobucket" title="Photobucket"></label>
                                <input type="text" name="fac_profile[photobucket]" value="<?php echo @$data->photobucket; ?>" placeholder="Photobucket" />
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34"  alt="Link #1" title="Link #1"></label>
                                <input type="text" name="fac_profile[title1]" value="<?php echo @$data->title1; ?>" placeholder="Title"/>
                                <input type="text" name="fac_profile[link1]" class="another_link" value="<?php echo @$data->link1; ?>" placeholder="Link"/>
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="Link #2" title="Link #2"></label>
                                <input type="text" name="fac_profile[title2]" value="<?php echo @$data->title2; ?>" placeholder="Title"/>
                                <input type="text" name="fac_profile[link2]" class="another_link" value="<?php echo @$data->link2; ?>" placeholder="Link" />
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="Link #3" title="Link #3"></label>
                                <input type="text" name="fac_profile[title3]" value="<?php echo @$data->title3; ?>" placeholder="Title"/>
                                <input type="text" name="fac_profile[link3]" class="another_link" value="<?php echo @$data->link3; ?>" placeholder="Link" />
                            </div>
                            <div class="social-networks">
                                <label for=""><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="Link #4" title="Link #4"></label>
                                <input type="text" name="fac_profile[title4]" value="<?php echo @$data->title4; ?>" placeholder="Title"/>
                                <input type="text" name="fac_profile[link4]" class="another_link" value="<?php echo @$data->link4; ?>" placeholder="Link" />
                            </div>
                            
                            <input type="submit" name="fac_profile[save]" value="Save" style="float: right; margin-bottom: 20px;"/>

                        </form>
			<!-- end of edit-list div -->
		</div>
		<!-- end of profile-right div -->
	</div>
	<!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.placeholder.min.js"></script>
<script type="text/javascript">    
    $(function(){
        $('input, textarea').placeholder();        
    });
</script>