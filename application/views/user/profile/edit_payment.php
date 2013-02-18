<?php
/**
 * Profile homepage
 */
$this->load->helper('form');
$user = $userinfo[0];

?>
<div class="content">
    <div class="wrapper clearfix">
        <?php include('edit_profile_sidebar.php'); ?>
        <div class="profile-right">            
            <h1>Edit Payment</h1>
            <?php //var_dump(validation_errors()); ?>
            <?php echo form_open(base_url().'user/save/payment', array('class'=>'fa-edit-form')); ?>
                <label for="blurb">Payment</label>
                <textarea name="fac_profile[payment]" id="payment"><?php echo $user->payment; ?></textarea>

                <input type="submit" value="Save" />
            </form>
        </div>
        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<!-- end of content div -->