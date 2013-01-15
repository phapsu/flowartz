<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>

<!--Jquery format currency-->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/formatCurrency/jquery.formatCurrency-1.4.0.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/formatCurrency/i18n/jquery.formatCurrency.en-US.js"></script>

<!--Jquery timepicker-->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/timepicker/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/timepicker/jquery-ui-timepicker-addon.js"></script>

<!-- json2 jquery -->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.base64.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/css.css" />

<div class="content">
    <div class="wrapper clearfix">
    <form method="post" action="<?php echo base_url(); ?>workshop/add" id="frmAdd">
        <div class="shop-left">
            <!-- begin of profile-picture div -->
            <div class="profile-picture" style="margin-bottom: 20px;">
                <a href="<?php echo base_url(); ?>user/profile/edit/profile_picture">Edit</a>
                <?php $user = $userinfo[0]; ?>
                <?php if (false === is_null($user->profile_picture)) : ?>
                    <img src="<?php echo base_url(); ?>application/files/<?php echo $user->profile_picture; ?>" alt="Profile Picture" />
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                <?php endif; ?>
            </div>
            <!-- end of profile-picture div -->
            
            <select name="fac_workshop[cat_id]">
                <?php foreach($categories as $id => $name){ ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php } ?>
            </select> 
            <label>Art Catergory</label>
            <input type="text" name="fac_workshop[tag]" id="tag" placeholder=""/>
            <label>Art Tags</label>
            <select name="fac_workshop[skill_level]">
                <?php foreach($skills as $id => $name){ ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php } ?>
            </select>   
            <label>Skill Level</label>
            <input type="text" name="fac_workshop[spot_available]" id="spot_available" placeholder=""/>
            <label>Spot Available</label>            
            <input type="text" name="fac_workshop[tools_required]" id="tools_required" placeholder=""/>
            <label>Tools Required</label> 
            <input type="text" name="fac_workshop[fee]" class="currency" id="fee" />
            <label>Cost</label>
        </div>
        <div class="shop-right">
            <input type="text" name="fac_workshop[name]" id="name" placeholder="" /></br>
            <label>Workshop Name</label>
            <input type="text" name="fac_workshop[teacher_name]" id="teacher_name" placeholder="" /></br>
            <label>Teacher Name</label>
            <div>
                <div class="shop-right-left">
                    <input type="text" name="fac_workshop[date]" id="date" placeholder=""/></br>
                    <label>Date</label>
                    <input type="text" name="fac_workshop[length]" id="length" placeholder=""/></br>
                    <label>Length</label>
                </div>
                <div class="shop-right-right">
                    <input type="text" name="fac_workshop[time]" id="time" placeholder=""/></br>
                    <label>Time</label>
                    <input type="text" name="fac_workshop[frequency]" id="frequency" placeholder=""/></br>
                    <label>Frequency</label>
                </div>
                <input type="text" name="fac_workshop[location]" id="location" placeholder="address, city, province/state, postal code" style="width:56%;"/>
                <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" /></br>
                <label>Location</label>
            </div>
            </br>
            <div style="text-align: center;">
                <label style="width: 100%;float:left">Workshop Description</label></br>
                <textarea name="fac_workshop[description]" id="description" style="width: 100%;" rows="12" placeholder=""></textarea>
            </div>
            <div style="position: absolute;right: 0;top: 0;width: 35%;">
                <a class="button turquoise gradient" onclick="document.getElementById('frmAdd').submit();" href="#" style="float: right;margin: 0;text-align: center;width: 40%;margin-bottom:25px">Confirm</a>
                <a class="button" href="#" onclick="document.getElementById('frmAdd').reset();" style="float: right;margin: 0;text-align: center;width: 40%;">Cancel</a>                
            </div>
        </div>
    </form>    
    </div>
    <!-- end of content wrapper div -->
</div>

<script>
    $(function() {
        $( "#date" ).datepicker();
        $( "#time" ).timepicker();
        
        $('.currency').blur(function()
        {
            $('.currency').formatCurrency();
        });
        
        $('#btn_googlemap').click(function(){
           var address = $('#location').val();
           var content =  $.base64.encode(address);
           
           var a = document.createElement('a');
            a.href='<?php echo base_url(); ?>template/google_map.php?address='+content;
            a.target = '_blank';
            document.body.appendChild(a);
            a.click();           
        });
    });
</script>