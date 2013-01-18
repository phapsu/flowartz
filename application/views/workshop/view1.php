<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>

<!--Jquery format currency-->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/formatCurrency/jquery.formatCurrency-1.4.0.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/formatCurrency/i18n/jquery.formatCurrency.en-US.js"></script>

<!--Jquery timepicker-->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/timepicker/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/timepicker/jquery-ui-timepicker-addon.js"></script>

<div class="content">
    <div class="wrapper clearfix">
        <?php include('class_sidebar.php'); ?>
        <div class="profile-right">
            <h1>Edit workshop</h1>

            <div class="edit-form">
                <form method="post" action="<?php echo base_url(); ?>workshop/edit" id="frmAdd" class="fa-edit-form">
                    <label for="">Workshop Name</label>
                    <input type="text" name="fac_workshop[name]" value="<?php echo $workshop[0]->name; ?>" id="name" placeholder="" />

                    <label for="">Teacher Name</label>
                    <input type="text" name="fac_workshop[teacher_name]" value="<?php echo $workshop[0]->teacher_name; ?>" id="teacher_name" placeholder="" />

                    <label for="">Date</label>
                    <input type="text" name="fac_workshop[date]" value="<?php echo $workshop[0]->date; ?>" id="date" placeholder=""/>

                    <label for="">Time</label>
                    <input type="text" name="fac_workshop[time]" value="<?php echo $workshop[0]->time; ?>" id="time" placeholder=""/>

                    <label for="">length</label>
                    <input type="text" name="fac_workshop[length]" value="<?php echo $workshop[0]->length; ?>" id="length" placeholder=""/>

                    <label for="">frequency</label>
                    <input type="text" name="fac_workshop[frequency]" value="<?php echo $workshop[0]->frequency; ?>" id="frequency" placeholder=""/>
                    
                    <label for="">location</label>
                    <input type="text" name="fac_workshop[location]" value="<?php echo $workshop[0]->location; ?>" id="location" placeholder=""/>
                    
                    
                    <a href="<?php echo base_url(); ?>template/google_map.php?address=<?php echo urlencode($workshop[0]->location); ?>" target="_blank">view location</a>
                    
                    <label for="">art category</label>
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

                    <label for="">art tags</label>
                    <input type="text" name="fac_workshop[tag]" value="<?php echo $workshop[0]->tag; ?>" id="tag" placeholder=""/>

                    <label for="">skill level</label>
                    <select name="fac_workshop[skill_level]">
                        <?php foreach ($skills as $id => $name) {
                            if ($id == $workshop[0]->skill_level) { ?>
                                <option selected value="<?php echo $id; ?>"><?php echo $name; ?></option>

                            <?php } else { ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            <?php }
                        } ?>
                    </select>    


                    <label for="">spot available</label>
                    <input type="text" name="fac_workshop[spot_available]" value="<?php echo $workshop[0]->spot_available; ?>" id="spot_available" placeholder=""/>

                    <label for="">tools required</label>
                    <input type="text" name="fac_workshop[tools_required]" value="<?php echo $workshop[0]->tools_required; ?>" id="tools_required" placeholder=""/>


                    <label for="">Cost</label>
                    <input type="text" name="fac_workshop[fee]" value="<?php echo $workshop[0]->fee; ?>" class="currency" id="fee" />

                    <label for="">Description</label>
                    <textarea name="fac_workshop[description]" value="<?php echo $workshop[0]->description; ?>" id="description" style="height:100px; width: 635px;" placeholder=""></textarea>

                    <input type="submit" name="save" id="btnSave" value="Save" />
                    <input type="reset" name="reset" value="Cancel" />

                </form>

                
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
                
                
                <!-- begin div student enrolled-->
                <div class="enrolled">
                    <?php if(!empty ($student_enrolled)){ foreach ($student_enrolled as $id=> $user){?>
                        <div>
                            <?php if ($user->profile_picture && is_file('./application/files/' . $user->profile_picture)){  ?>
                                <img src="<?php echo base_url(); ?>application/files/<?php echo $user->profile_picture; ?>" alt="<?php echo $user->name; ?>&apos;s Profile Picture"  class="showContenthover"/>
                            <?php }else{ ?>
                                <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="<?php echo $user->name; ?>&apos;s Profile Picture" class="showContenthover"/>
                             <?php } ?>    
                        </div>    
                    
                    <?php }} ?>
                    
                    <div class="total_enrolled">
                        Total: <?php echo count($student_enrolled); ?> <br/>
                        Fee: <?php echo $workshop[0]->fee; ?> <br/>
                    </div>                     
                </div>

                <!-- end div student enrolled-->
                
                <!-- begin div send message to student enrolled-->
                <br/>
                Form send message
                <form id="deleteFileForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/send_message" method="post">
                    <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                    
                    <textarea name="fac_workshop[message]"></textarea>
                    <input type="submit" value="Send" />
                </form>
                
                <!-- end div send message to student enrolled-->
                
                <!-- begin button complete event -->
                <br/><br/><br/><br/>
                <a href="<?php echo base_url(); ?>workshop/complete_event/<?php echo $workshop[0]->wid; ?>">Complete Event</a>
                
                <!-- end button complete event -->
                
            </div>

        </div>                
        <div class="profile-right" id="out" style="display: none; margin-top: 20px;padding-bottom: 25px;">

        </div>
        <div id="video_div">
        </div>
        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->

<script>
    $(function() {
        $( "#date" ).datepicker();
        $( "#time" ).timepicker();
        
        $('.currency').blur(function()
        {
            $('.currency').formatCurrency();
        });
    });
</script>