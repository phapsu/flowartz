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
        <form method="post" action="<?php echo base_url(); ?>workshop/edit/<?php echo $workshop[0]->wid; ?>" id="frmEdit">
            <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
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
                <div style="width:90%;text-align:center; margin-bottom: 20px;">
                    <span style="width:50%;float:left">SHARE THE WORKSHOP</span>
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid; ?>"><img src="<?php echo base_url(); ?>template/images/social/facebook.png"/></a>
                    <a target="_blank" href="http://twitter.com/intent/tweet?text=Workshop on Flow Artz: <?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid; ?>"><img src="<?php echo base_url(); ?>template/images/social/twitter.png" /></a>
                </div>
                <!-- end of profile-picture div -->                
            </div>
            <div class="shop-right">
                <input type="text" name="fac_workshop[name]" value="<?php echo $workshop[0]->name; ?>" id="name" placeholder="" /></br>
                <label>Workshop Name</label>
                <input type="text" name="fac_workshop[teacher_name]" value="<?php echo $workshop[0]->teacher_name; ?>" id="teacher_name" placeholder="" /></br>
                <label>Teacher Name</label>
                <div>
                    <div class="shop-right-left">
                        <input type="text" name="fac_workshop[date]" value="<?php echo date("m/d/Y", strtotime($workshop[0]->date)); ?>" id="date" placeholder=""/></br>
                        <label>Date</label>
                        <input type="text" name="fac_workshop[length]" value="<?php echo $workshop[0]->length; ?>" id="length" placeholder=""/></br>
                        <label>Length</label>
                    </div>
                    <div class="shop-right-right">
                        <input type="text" name="fac_workshop[time]" value="<?php echo $workshop[0]->time; ?>" id="time" placeholder=""/></br>
                        <label>Time</label>
                        <input type="text" name="fac_workshop[frequency]" value="<?php echo $workshop[0]->frequency; ?>" id="frequency" placeholder=""/></br>
                        <label>Frequency</label>
                    </div>
                    <input type="text" name="fac_workshop[location]" value="<?php echo $workshop[0]->location; ?>" id="location" placeholder="address, city, province/state, postal code" style="width:56%;"/>
                    <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" /></br>
                    <label>Location</label>
                </div>
                </br>
                <div style="position: absolute;right: 0;top: 0;width: 35%;">
                    <a class="button turquoise gradient" href="#" onclick="document.getElementById('frmEdit').submit();" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Edit</a>
                    <a class="button turquoise gradient" href="#" onclick="document.getElementById('frmEdit').reset();" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Cancel Event</a>
                    <a class="button" id="box1" href="#div_addfile" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Add File</a>
                    <a class="button" id="box2" href="#div_sendmessage" style="float: right;margin: 0;text-align: center;width: 50%;">Send Message</a>
                </div>                
            </div>
            <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;">
                <div class="shop-left">
                    <select name="fac_workshop[cat_id]">
                        <?php
                        foreach ($categories as $id => $name) {
                            if ($id == $workshop[0]->cat_id) {
                                ?>
                                <option selected value="<?php echo $id; ?>"><?php echo $name; ?></option>

                            <?php } else { ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>                       

                            <?php }
                        } ?>
                    </select> 
                    <label>Art Catergory</label>
                    <input type="text" name="fac_workshop[tag]" value="<?php echo $workshop[0]->tag; ?>" id="tag" placeholder=""/>
                    <label>Art Tags</label>
                    <select name="fac_workshop[skill_level]">
                        <?php foreach ($skills as $id => $name) {
                            if ($id == $workshop[0]->skill_level) { ?>
                                <option selected value="<?php echo $id; ?>"><?php echo $name; ?></option>

                            <?php } else { ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            <?php }
                        } ?>
                    </select> 
                    <label>Skill Level</label>
                    <input type="text" name="fac_workshop[spot_available]" value="<?php echo $workshop[0]->spot_available; ?>" id="spot_available" placeholder=""/>
                    <label>Spot Available</label>            
                    <input type="text" name="fac_workshop[tools_required]" value="<?php echo $workshop[0]->tools_required; ?>" id="tools_required" placeholder=""/>
                    <label>Tools Required</label> 
                    <input type="text" name="fac_workshop[fee]" value="<?php echo $workshop[0]->fee; ?>" class="currency" id="fee" />
                    <label>Cost</label>
                </div>
                <div class="shop-right" style="margin-left: 20px;">
                    <div style="text-align: center;">
                        <label style="width: 100%;float:left">Workshop Description</label></br>
                        <textarea name="fac_workshop[description]" id="description" style="width: 98%;" rows="18" placeholder=""><?php echo $workshop[0]->description; ?></textarea>
                    </div>
                </div>
                </br>
            </div>

            <!-- begin box Enrolled  -->
            <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;text-align:center">
                <span style="font-weight:bold;font-size:20px">Student Enrolled</span>
                <ul class="artist-group" style="border-radius:10px;border:1px solid #ccc;margin-top:10px">

                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>

                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>
                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>
                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>
                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>

                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>
                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>
                    <li class="artist-profile">
                        <div class="ch_normal">
                            <img src="http://flowartz.dev:8080/template/images/artist-image.png">
                        </div>                      
                        <!-- end of artist div -->
                    </li>
                </ul>
            </div>
            <!-- end box Enrolled  -->

            <!-- begin box Complete Event  -->
            <div>
                <div style="width:50%;text-align:center;float:left">
                    <div><a style="margin: 0;" href="#" class="button">Complete Event</a></div>
                    <div style="margin-top:20px">Text</div>
                </div>
                <div class="totalEn" style="width:50%;float:right">

                    <div><label>Total Enrolled :</label><input type="text" /></div>
                    <div><label>Cost :</label><input type="text" /></div>
                    <div><label>Total :</label><input type="text" /></div>
                    <div><label>Surcharge (7%) :</label><input type="text" /></div>
                    <div style="border-top:1px solid #bbb"></div>
                    <div><label>Grand Total :</label><input type="text" /></div>

                </div>
            </div>
            <!-- end box Complete Event  -->
        </form>    

        <!-- add file form -->
        <div class="thumbnail" id="div_addfile" style="display: none; height: 500px; overflow: hidden; width: 700px;">
            <!-- begin form upload -->
            <div class="profile-right">
                <h1>Upload File(doc|pdf|gif|jpg|png|xls|zip|rar)</h1>
                <div class="edit-form" style="width:230px;">

                    <form method="post" action="<?php echo base_url(); ?>workshop/add_file" class="fa-edit-form"  enctype="multipart/form-data" accept-charset="utf-8">

                        <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                        <label for="name">File 1</label>
                        <input type="file" name="image_1" id="pimg1" value="" class="galleryUpload" />

                        <label for="name">File 2</label>
                        <input type="file" name="image_2" id="pimg2" value="" class="galleryUpload" />

                        <label for="name">File 3</label>
                        <input type="file" name="image_3" id="pimg3" value="" class="galleryUpload" />

                        <label for="name">File 4</label>
                        <input type="file" name="image_4" id="pimg4" value="" class="galleryUpload" />

                        <label for="name">File 5</label>
                        <input type="file" name="image_5" id="pimg5" value="" class="galleryUpload" />

                        <input type="submit" value="Save" />
                    </form>
                </div>
                <script type="text/javascript">
                    var $hasUploaded = <?php echo intval(count($files)); ?>;
                    $(function(){
                        switch($hasUploaded){
                            case 1:
                                $('#pimg1').attr('disabled', true);
                                break;
                            case 2:
                                $('#pimg1').attr('disabled', true);
                                $('#pimg2').attr('disabled', true);
                                break;
                            case 3:
                                $('#pimg1').attr('disabled', true);
                                $('#pimg2').attr('disabled', true);
                                $('#pimg3').attr('disabled', true);
                                break;
                            case 4:
                                $('#pimg1').attr('disabled', true);
                                $('#pimg2').attr('disabled', true);
                                $('#pimg3').attr('disabled', true);
                                $('#pimg4').attr('disabled', true);
                                break;    
                            default:
                                $('.galleryUpload').attr('disabled', false);
                                break;
                        }
                    });
                </script>
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

        <!--send message form -->
        <div class="thumbnail" id="div_sendmessage" style="display: none; height: 500px; overflow: hidden; width: 700px;">
            <form id="deleteFileForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/send_message" method="post">
                <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                <label>Form send message</label>
                <textarea name="fac_workshop[message]"></textarea>
                <input type="submit" value="Send" />
            </form>
        </div>

    </div>
    <!-- end of content wrapper div -->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
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
        
        
        $('#box1, #box2').fancybox({
            openEffect : 'elastic',
            openSpeed : 100,
            closeEffect : 'elastic',
            closeSpeed : 100,
            padding : 0
        }); 
        
    });
    
    
     
    
</script>