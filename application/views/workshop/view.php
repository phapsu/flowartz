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
                <?php if ($workshop[0]->image) : ?>
                    <img src="<?php echo base_url(); ?>application/files/<?php echo $workshop[0]->image; ?>" alt="Workshop Picture" />
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="No Picture" />
                <?php endif; ?>
            </div>
            <div style="width:90%;text-align:center; margin-bottom: 20px;">
                <span style="width:50%;float:left">SHARE THE WORKSHOP</span>
                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid.'-'.url_title($workshop[0]->name); ?>"><img src="<?php echo base_url(); ?>template/images/social/facebook.png"/></a>
                <a target="_blank" href="http://twitter.com/intent/tweet?text=Workshop on Flow Artz: <?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid.'-'.url_title($workshop[0]->name); ?>"><img src="<?php echo base_url(); ?>template/images/social/twitter.png" /></a>
            </div>
            <!-- end of profile-picture div -->                
        </div>
        <div class="shop-right">
            <div class="row-fluid">
                <input type="text" readonly name="fac_workshop[name]" value="<?php echo $workshop[0]->name; ?>" id="name" placeholder="Workshop Name" />
            </div>
            <div class="row-fluid">
                <input type="text" readonly name="fac_workshop[teacher_name]" value="<?php echo $workshop[0]->teacher_name; ?>" id="teacher_name" placeholder="Teacher Name" />
            </div>
            <div>
                <div class="shop-right-left">
                    <div class="row-fluid">
                        <input readonly type="text" name="fac_workshop[date]" value="<?php echo date("m/d/Y", strtotime($workshop[0]->date)); ?>" id="date" placeholder="Date"/>
                    </div>
                    <div class="row-fluid">
                        <input readonly type="text" name="fac_workshop[length]" value="<?php echo $workshop[0]->length; ?>" id="length" placeholder="Length"/>
                    </div>
                </div>
                <div class="shop-right-right">
                    <div class="row-fluid">
                        <input readonly type="text" name="fac_workshop[time]" value="<?php echo $workshop[0]->time; ?>" id="time" placeholder="Start Time"/>
                    </div>
                    <div class="row-fluid">
                        <input readonly type="text" name="fac_workshop[frequency]" value="<?php echo $workshop[0]->frequency; ?>" id="frequency" placeholder=""/>
                    </div>
                </div>
                <div class="row-fluid">
                <input readonly type="text" name="fac_workshop[location]" value="<?php echo $workshop[0]->location; ?>" id="location" placeholder="Location(address, city, province/state, postal code)" style="width:56%;"/>
                <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" />
                </div>
            </div>
            </br>
            <div style="position: absolute;right: 0;top: 0;width: 35%;">
                <a class="button turquoise gradient" href="javascript:;;" onclick="add_favorite(this, '<?php echo $workshop[0]->wid; ?>', '<?php echo $workshop[0]->name; ?>')" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Add to Favorite</a>
                <a class="button turquoise gradient" id="box1" href="#div_addfile" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">View File</a>
                <a class="button" href="javascript:;;" onclick="javascript:enroll();" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Enroll</a>                    
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmEnroll">
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
                <div class="row-fluid">
                    <input readonly type="text" name="fac_workshop[cat_id]" value="<?php echo $categories[$workshop[0]->cat_id]; ?>" id="cat_id" placeholder="Art Catergory"/>
                </div>
                <div class="row-fluid">                
                    <input readonly type="text" name="fac_workshop[tag]" value="<?php echo $workshop[0]->tag; ?>" id="tag" placeholder="Art Tags"/>
                </div>
                <div class="row-fluid">
                    <input readonly type="text" name="fac_workshop[skill_level]" value="<?php echo $skills[$workshop[0]->skill_level]; ?>" id="skill_level" placeholder="Skill Level"/>
                </div>
                <div class="row-fluid">
                    <input readonly type="text" name="fac_workshop[spot_available]" value="<?php echo $workshop[0]->spot_available; ?>" id="spot_available" placeholder="Spot Available"/>
                </div>
                <div class="row-fluid">
                    <input readonly type="text" name="fac_workshop[tools_required]" value="<?php echo $workshop[0]->tools_required; ?>" id="tools_required" placeholder="Tools Required"/>
                </div>
                <div class="row-fluid">
                    <input readonly type="text" name="fac_workshop[fee]" value="<?php echo $workshop[0]->fee; ?>" class="currency" id="fee" />
                </div>
            </div>
            <div class="shop-right" style="margin-left: 20px;">
                <div class="row-fluid">
                    <textarea readonly name="fac_workshop[description]" id="description" style="width: 98%;" rows="13" placeholder="Workshop Description"><?php echo $workshop[0]->description; ?></textarea>
                </div>
            </div>
            </br>
        </div>
        
        <!-- begin box Enrolled  -->
        <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;text-align:center; width: 100%">
            <span style="font-weight:bold;font-size:20px">Student Enrolled</span>
            <ul class="artist-group" style="border-radius:10px;border:1px solid #ccc;margin-top:10px">
                <?php
                if ($enrolled) {
                    foreach ($enrolled as $id => $row) {
                        ?>
                        <li class="artist-profile">
                            <div class="ch_normal">
                                <?php if ($row->profile_picture) { ?>
                                    <img src="<?php echo base_url(); ?>application/files/<?php echo $row->profile_picture; ?>" alt="Profile Picture" />
                                <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                                <?php } ?>
                            </div>                                              
                        </li>
                        <?php
                    }
                }
                ?>                    
            </ul>
        </div>
        <!-- end box Enrolled  -->
        
        <!-- begin box upload file -->
        <!-- add file form -->
        <div class="thumbnail" id="div_addfile" style="display: none; height: 500px; overflow: hidden; width: 700px;">
            <!-- begin form upload -->
            <div class="profile-right">                
                <!-- end of edit-form div -->
                <div class="edit-list" style="width:360px; border-left: solid 1px #f0f0f0; padding-left: 10px">
                    <h5>Uploaded Files</h5>
                    <?php
                    if (!empty($files)):
                        ?> 
                        <form id="deleteFileForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/delete_file" method="post">
                            <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                            <div style="clear:both;">
                                <ul id="fa_gallery" class="fa_gallery">
                                    <?php
                                    $totalFile = count($files);
                                    foreach ($files as $idx => $file):
                                        $last = ($idx + 1 == $totalFile) ? 'last-thumb' : '';
                                        ?>
                                        <li class="<?php echo $last; ?>">
                                            <?php if ($file->name && is_file('./application/files/' . $file->name)) : ?>
                                                <a class="fancybox" href="<?php echo base_url(); ?>application/files/<?php echo $file->name; ?>"><?php echo $file->name; ?></a>
                                            <?php else : ?>
                                                No file
                                            <?php endif; ?> 
                                            <p><input type="checkbox" id="<?php echo $file->id; ?>"  name="fac_workshop[<?php echo $file->id; ?>]" value="<?php echo $file->id; ?>"></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>                    
                            </div>
                            <div style="clear:both"><input type="submit" id="delete-btn" value="Delete" name="delete" onclick="if(confirm('Are you sure?')) document.getElementById('deleteFileForm').submit(); else return false;"></div>
                        </form>
                        <?php
                    endif;
                    ?>                
                </div>                    
            </div>
            <!-- end form upload -->
        </div>
        <!-- end box upload file -->
        

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
            $(contaner).removeAttr('onclick');   
            $(contaner).html('Add to Favorite');
        });
    }
     
    function enroll(){
        var login = '<?php echo $user_id; ?>';
        if(login!=''){
            document.frmEnroll.submit();
        }else{
            alert('You must login before Enroll.');
            window.location.href="/user/login";
        }
    }
</script>