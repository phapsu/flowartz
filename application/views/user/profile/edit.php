<?php
/**
 * Profile homepage
 */
$this->load->helper('form');
$user = $userinfo[0];

$location = array('country'=>$user->country, 'state'=>$user->state, 'city'=>$user->city);
$location = json_encode($location);
?>
<div class="content">
    <div class="wrapper clearfix">
        <?php include('edit_profile_sidebar.php'); ?>
        <div class="profile-right">            
            <h1>Edit Information</h1>
            <?php //var_dump(validation_errors()); ?>
            <?php echo form_open(base_url().'user/save/profile', array('class'=>'fa-edit-form')); ?>
            <!--<form method="post" action="<?php echo base_url(); ?>user/save/profile" class="fa-edit-form">-->
                <label for="name">Name</label>                
                <!--<input type="text" name="fac_profile[name]" id="name" value="<?php echo $user->name; ?>" />-->
                <?php 
                echo form_input('fac_profile[name]', $user->name, 'id="name"');
                echo '<span class="form-error">'.form_error('fac_profile[name]').'</span>'; 
                ?>

                <label for="name">Website</label>
                <input type="text" name="fac_profile[website]" id="name" value="<?php echo $user->website; ?>" />

                <label for="title">Title or Profession</label>
                <input type="text" name="fac_profile[title]" id="title" value="<?php echo $user->title; ?>" />

                <label for="location">Location</label>
                <!--<input type="text" name="fac_profile[location]" id="location" value="<?php echo $user->location; ?>" />-->
                <span id="selectLocation">
                    <input type="text" name="fac_profile[location]" id="location" value="" />
                </span>

                <label for="blurb">Brief Description</label>
                <textarea name="fac_profile[blurb]" id="blurb"><?php echo $user->blurb; ?></textarea>

                <input type="submit" value="Save" />
            </form>
        </div>
        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<!-- end of content div -->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.chained.mini.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {    
        /* load select location */
        $.post('<?php echo base_url(); ?>location/selectbox', {'location':<?php echo $location;?>}, 
        function(res){
            $('#selectLocation').html(res);
                
            /* For jquery.chained.js */
            $("#selectState").chained("#selectCountry");
            $("#selectCity").chained("#selectState"); 
        }
    );});
</script> 