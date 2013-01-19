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
        <div class="shop-left">
            <!-- begin of profile-picture div -->
            <div class="profile-picture" style="margin-bottom: 20px;">
                <a href="<?php echo base_url(); ?>user/profile/edit/profile_picture">Edit</a>

                <?php if ($workshop[0]->i_name) : ?>
                    <img src="<?php echo base_url(); ?>application/files/<?php echo $workshop[0]->i_name; ?>" alt="Profile Picture" />
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                <?php endif; ?>
            </div>
            <div style="width:90%;text-align:center; margin-bottom: 20px;">
                <span style="width:50%;float:left">SHARE THE WORKSHOP</span>
                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid; ?>"><img src="<?php echo base_url(); ?>template/images/social/facebook.png"/></a>
                <a target="_blank" href="http://twitter.com/intent/tweet?text=Workshop on Flow Artz: <?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid; ?>"><img src="<?php echo base_url(); ?>template/images/social/twitter.png" /></a>
            </div>
            <!-- end of profile-picture div -->                
        </div>
        <div class="shop-right">
            <input type="text" readonly name="fac_workshop[name]" value="<?php echo $workshop[0]->name; ?>" id="name" placeholder="" /></br>
            <label>Workshop Name</label>
            <input type="text" readonly name="fac_workshop[teacher_name]" value="<?php echo $workshop[0]->teacher_name; ?>" id="teacher_name" placeholder="" /></br>
            <label>Teacher Name</label>
            <div>
                <div class="shop-right-left">
                    <input readonly type="text" name="fac_workshop[date]" value="<?php echo date("m/d/Y", strtotime($workshop[0]->date)); ?>" id="date" placeholder=""/></br>
                    <label>Date</label>
                    <input readonly type="text" name="fac_workshop[length]" value="<?php echo $workshop[0]->length; ?>" id="length" placeholder=""/></br>
                    <label>Length</label>
                </div>
                <div class="shop-right-right">
                    <input readonly type="text" name="fac_workshop[time]" value="<?php echo $workshop[0]->time; ?>" id="time" placeholder=""/></br>
                    <label>Time</label>
                    <input readonly type="text" name="fac_workshop[frequency]" value="<?php echo $workshop[0]->frequency; ?>" id="frequency" placeholder=""/></br>
                    <label>Frequency</label>
                </div>
                <input readonly type="text" name="fac_workshop[location]" value="<?php echo $workshop[0]->location; ?>" id="location" placeholder="address, city, province/state, postal code" style="width:56%;"/>
                <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" /></br>
                <label>Location</label>
            </div>
            </br>
            <div style="position: absolute;right: 0;top: 0;width: 35%;">
                <a class="button turquoise gradient" href="javascript:;;" onclick="add_favorite(this, '<?php echo $workshop[0]->wid; ?>', '<?php echo $workshop[0]->name; ?>')" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Add to Favorite</a>
                <a class="button turquoise gradient" href="/workshop/enroll/<?php echo $workshop[0]->wid; ?>" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">EnRoll</a>
                <a class="button" href="javascript:;;" onclick="document.frmRSVP.submit();" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">RSVP</a>                    
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmRSVP">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="PXPDB9687JPKQ">
                    <input type="hidden" name="custom" value="<?php echo $this->session->userdata('user_id'); ?>" />
                    <input type="hidden" name="item_name" value="#<?php echo $workshop[0]->wid; ?>" />
                    <input type="hidden" name="currency_code" value="CAD" />
                    <table style="display: none;">
                        <tr><td><input type="hidden" name="on0" value=""></td></tr><tr><td>
                                <select name="os0" style="background-color: white">
                                    <option value="fee">fee <?php echo $workshop[0]->fee; ?></option>        
                                </select> </td></tr>
                    </table>
                    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>                
        </div>
        <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;">
            <div class="shop-left">                    
                <input readonly type="text" name="fac_workshop[cat_id]" value="<?php echo $categories[$workshop[0]->cat_id]; ?>" id="cat_id" placeholder=""/>
                <label>Art Catergory</label>
                <input readonly type="text" name="fac_workshop[tag]" value="<?php echo $workshop[0]->tag; ?>" id="tag" placeholder=""/>
                <label>Art Tags</label>
                <input readonly type="text" name="fac_workshop[skill_level]" value="<?php echo $skills[$workshop[0]->skill_level]; ?>" id="skill_level" placeholder=""/>
                <label>Skill Level</label>
                <input readonly type="text" name="fac_workshop[spot_available]" value="<?php echo $workshop[0]->spot_available; ?>" id="spot_available" placeholder=""/>
                <label>Spot Available</label>            
                <input readonly type="text" name="fac_workshop[tools_required]" value="<?php echo $workshop[0]->tools_required; ?>" id="tools_required" placeholder=""/>
                <label>Tools Required</label> 
                <input readonly type="text" name="fac_workshop[fee]" value="<?php echo $workshop[0]->fee; ?>" class="currency" id="fee" />
                <label>Cost</label>
            </div>
            <div class="shop-right" style="margin-left: 20px;">
                <div style="text-align: center;">
                    <label style="width: 100%;float:left">Workshop Description</label></br>
                    <textarea readonly name="fac_workshop[description]" id="description" style="width: 98%;" rows="18" placeholder=""><?php echo $workshop[0]->description; ?></textarea>
                </div>
            </div>
            </br>
        </div>

    </div>
    <!-- end of content wrapper div -->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
<script>
    $(function() {
                
        $('#btn_googlemap').click(function(){
            var address = $('#location').val();
            var content =  $.base64.encode(address);
           
            var a = document.createElement('a');
            a.href='<?php echo base_url(); ?>template/google_map.php?address='+content;
            a.target = '_blank';
            document.body.appendChild(a);
            a.click();           
        });
        
        
        $('#box1, #box2').fancybox({
            openEffect : 'elastic',
            openSpeed : 100,
            closeEffect : 'elastic',
            closeSpeed : 100,
            padding : 0
        }); 
        
    });
    
    function add_favorite(contaner, $id, $name){
        $(contaner).html('Saving...');
        $.post("/workshop/add_favorite",{id: $id, name: $name} ,function(data) {
            $(contaner).html('<img src="<?php echo base_url(); ?>template/images/star.png" />');                     
        });
    }
     
    
</script>