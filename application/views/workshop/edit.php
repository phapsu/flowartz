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
                    <a id="box3" href="#div_edit_image">Edit</a>
                    <?php if ($workshop[0]->image) : ?>
                        <img src="<?php echo base_url(); ?>application/files/<?php echo $workshop[0]->image; ?>" alt="Workshop Picture" />
                    <?php else : ?>
                        <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="No Picture" />
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
                <label>Workshop Name</label>
                <input type="text" name="fac_workshop[name]" value="<?php echo $workshop[0]->name; ?>" id="name" placeholder="" /></br>
                <label>Teacher Name</label>
                <input type="text" name="fac_workshop[teacher_name]" value="<?php echo $workshop[0]->teacher_name; ?>" id="teacher_name" placeholder="" /></br>

                <div>
                    <div class="shop-right-left">
                        <label>Date</label>
                        <input type="text" name="fac_workshop[date]" value="<?php echo date("m/d/Y", strtotime($workshop[0]->date)); ?>" id="date" placeholder=""/></br>
                        <label>Length</label>
                        <input type="text" name="fac_workshop[length]" value="<?php echo $workshop[0]->length; ?>" id="length" placeholder=""/></br>
                    </div>
                    <div class="shop-right-right">
                        <label>Time</label>
                        <input type="text" name="fac_workshop[time]" value="<?php echo $workshop[0]->time; ?>" id="time" placeholder=""/></br>
                        <label>Frequency</label>                   
                        <select name="fac_workshop[frequency_custom]" id="frequency_custom" style="text-align: center; width: 90%;">
                            <option selected value="<?php echo $workshop[0]->frequency; ?>"><?php echo $workshop[0]->frequency; ?></option>    
                            <?php foreach ($frequency as $id => $name) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" name="fac_workshop[frequency]" value="<?php echo $workshop[0]->frequency; ?>" id="frequency" placeholder="input your frequency" style="display: none;"/>
                    </div>
                    <label>Location</label>
                    <input type="text" name="fac_workshop[location]" value="<?php echo $workshop[0]->location; ?>" id="location" placeholder="address, city, province/state, postal code" style="width:56%;"/>
                    <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" /></br>
                </div>
                </br>
                <div style="position: absolute;right: -15px;top: 0;width: 30%;">
                    <a class="button turquoise gradient" href="javascript:;;" onclick="document.getElementById('frmEdit').submit();" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Edit</a>
                    <a class="button turquoise gradient" href="javascript:;;" onclick="document.getElementById('frmEdit').reset();" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Cancel Event</a>
                    <a class="button" id="box1" href="#div_addfile" style="float: right;margin: 0;text-align: center;width: 50%;margin-bottom:25px">Add File</a>
                    <a class="button" id="box2" href="#div_sendmessage" style="float: right;margin: 0;text-align: center;width: 50%;">Send Message</a>
                </div>                
            </div>
            <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;">
                <div class="shop-left">
                    <label>Art Catergory</label>
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
                    <label>Art Tags</label>
                    <input type="text" name="fac_workshop[tag]" value="<?php echo $workshop[0]->tag; ?>" id="tag" placeholder=""/>
                    <label>Skill Level</label>
                    <select name="fac_workshop[skill_level]">
                        <?php foreach ($skills as $id => $name) {
                            if ($id == $workshop[0]->skill_level) { ?>
                                <option selected value="<?php echo $id; ?>"><?php echo $name; ?></option>

                            <?php } else { ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            <?php }
                        } ?>
                    </select> 
                    <label>Spot Available</label>
                    <input type="text" name="fac_workshop[spot_available]" value="<?php echo $workshop[0]->spot_available; ?>" id="spot_available" placeholder=""/>
                    <label>Tools Required</label>            
                    <input type="text" name="fac_workshop[tools_required]" value="<?php echo $workshop[0]->tools_required; ?>" id="tools_required" placeholder=""/>
                    <label>Cost</label> 
                    <input type="text" name="fac_workshop[fee]" value="<?php echo $workshop[0]->fee; ?>" class="currency" id="fee" />
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

            <!-- begin box Complete Event  -->
            <div>
                <div style="width:60%;text-align:center;float:left">
                    <div><a style="margin: 0;" href="javascript:;;" onclick="document.complete_eventForm.submit();" class="button">Complete Event</a></div>
                    <div style="margin-top:20px">PLEASE NOTE THAT WHEN YOU CAN'T COMPLETE AN EVENT UNTIL AFTER THE DATE WAS BEING HOSTED. </div>

                    <div style="margin-top:20px">PLEASE ENSURE THAT YOU HAVE CONFIRMED THE ATTENDACE OF YOUR STUDENTS BEFORE COMPLETING SO THAT THIS WORKSHOP WILL BE ADDED  TO THEIR EXPERIENCE. </div>
                </div>
                <div class="totalEn" style="width:40%;float:right">

                    <div><label>Total Enrolled :</label><input type="text" readonly value="<?php echo $total_enrolled; ?>"/></div>
                    <div><label>Cost :</label><input class="currency" type="text" readonly value="<?php echo $workshop[0]->fee; ?>"/></div>
                    <div><label>Total :</label><input class="currency" type="text" readonly value="<?php echo $total; ?>"/></div>
                    <div><label>Surcharge (<?php echo $surcharge; ?>%) :</label><input class="currency" type="text" readonly value="<?php echo $total_surcharge; ?>"/></div>
                    <div style="border-top:1px solid #bbb"></div>
                    <div><label>Grand Total :</label><input type="text" class="currency" readonly value="<?php echo $total_real; ?>"/></div>

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

        <!-- edit workshop image-->
        <div class="thumbnail" id="div_edit_image" style="display: none; height: 500px; overflow: hidden; width: 700px;">
            <!-- begin form upload -->
            <div class="profile-right">
                <h1>Upload File(gif|jpg|png)</h1>
                <div class="edit-form" style="width:230px;">

                    <form method="post" action="<?php echo base_url(); ?>workshop/add_image" class="fa-edit-form"  enctype="multipart/form-data" accept-charset="utf-8">

                        <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                        <label for="name">Image</label>
                        <input type="file" name="image_1" id="pimg1" value="" class="galleryUpload" />

                        <input type="submit" value="Save" />
                    </form>
                </div>

                <!-- end of edit-form div -->
                <div class="edit-list" style="width:360px; border-left: solid 1px #f0f0f0; padding-left: 10px">
                    <h5>Uploaded Files</h5>
                    <?php
                    if ($workshop[0]->image):
                        ?> 
                        <form id="deleteImageForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/delete_image" method="post">
                            <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                            <input type="hidden" name="fac_workshop[image_name]" value="<?php echo $workshop[0]->image; ?>">
                            <div style="clear:both;">
                                <ul id="fa_gallery" class="fa_gallery">
                                    <li>
                                        <?php if (is_file('./application/files/' . $workshop[0]->image)) : ?>
                                            <a class="fancybox" href="<?php echo base_url(); ?>application/files/<?php echo $workshop[0]->image; ?>"><img src="<?php echo base_url(); ?>application/files/<?php echo $workshop[0]->image; ?>" alt="Workshop Picture" /></a>
                                        <?php else : ?>
                                            No file
                                        <?php endif; ?> 
                                    </li>                                   
                                </ul>                    
                            </div>
                            <div style="clear:both"><input type="submit" id="delete-image-btn" value="Delete" name="delete" onclick="if(confirm('Are you sure?')) document.getElementById('deleteImageForm').submit(); else return false;"></div>
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
            <form id="sendmessageForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/send_message" method="post">
                <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                <h2>Form Send Message</h2>
                <textarea name="fac_workshop[message]" style="height: 370px;"></textarea>
                <input type="submit" value="Send" />
            </form>
        </div>

        <!--form complete_eventForm  -->
        <form id="complete_eventForm" name="complete_eventForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/complete_event" method="post">
            <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
        </form>

    </div>
    <!-- end of content wrapper div -->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
<script>
    $(function() {
        $( "#date" ).datepicker();
        $( "#time" ).timepicker();
        
        $('.currency').formatCurrency();
        
        $('#btn_googlemap').click(function(){
            var address = $('#location').val();
            var content =  $.base64.encode(address);
           
            var a = document.createElement('a');
            a.href='<?php echo base_url(); ?>template/google_map.php?address='+content;
            a.target = '_blank';
            document.body.appendChild(a);
            a.click();           
        });
        
        
        $('#box1, #box2, #box3').fancybox({
            openEffect : 'elastic',
            openSpeed : 100,
            closeEffect : 'elastic',
            closeSpeed : 100,
            padding : 0
        }); 
        
        $('#frequency').val($('#frequency_custom').val());
        
        $('#frequency_custom').change(function() {
            val = $(this).val();
            
            if(val=='Custom'){
                $('#frequency').val('');
                $('#frequency').show();
            } 
            else{
                $('#frequency').val(val);
                $('#frequency').hide();
            } 
        });
        
    });
    
    
     
    
</script>