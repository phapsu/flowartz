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
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid.'-'.url_title($workshop[0]->name); ?>"><img src="<?php echo base_url(); ?>template/images/social/facebook.png"/></a>
                    <a target="_blank" href="http://twitter.com/intent/tweet?text=Workshop on Flow Artz: <?php echo base_url(); ?>workshop/view/<?php echo $workshop[0]->wid.'-'.url_title($workshop[0]->name); ?>"><img src="<?php echo base_url(); ?>template/images/social/twitter.png" /></a>
                </div>
                <!-- end of profile-picture div -->                
            </div>
            <div class="shop-right">
                <div class="row-fluid">
                    <input type="text" name="fac_workshop[name]" value="<?php echo $workshop[0]->name; ?>" id="name" placeholder="Workshop Name" />
                </div>
                <div class="row-fluid">
                    <input type="text" name="fac_workshop[teacher_name]" value="<?php echo $workshop[0]->teacher_name; ?>" id="teacher_name" placeholder="Teacher Name" />
                </div>
                <div>
                    <div class="shop-right-left">
                        <div class="row-fluid">
                            <input type="text" name="fac_workshop[date]" value="<?php echo date("m/d/Y", strtotime($workshop[0]->date)); ?>" id="date" placeholder="Date"/>
                        </div>
                        
                        <div class="row-fluid">                                 
                            <select name="fac_workshop[length]" style="width: 90%;">
                                <option value="">Select Your Length</option>
                                <?php foreach ($length as $id => $name) {
                                    if ($id == $workshop[0]->length) { ?>
                                        <option selected value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                    <?php } else { ?>
                                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                    <?php }
                                } ?>
                            </select> 
                        </div>
                    </div>
                    <div class="shop-right-right">
                        <div class="row-fluid">
                            <input type="text" name="fac_workshop[time]" value="<?php echo $workshop[0]->time; ?>" id="time" placeholder="Start Time"/>
                        </div>
                        <div class="row-fluid">
                            <select name="fac_workshop[frequency]" id="frequency" style="width: 90%;">
                                <option value="">Select Your Frequency</option>
                                <option selected value="<?php echo $workshop[0]->frequency; ?>"><?php echo $workshop[0]->frequency; ?></option>    
                                
                                <?php foreach ($frequency as $id => $name) { ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="div-ui-datepicker-frequency" style="z-index: 1; display: none; position: absolute;">
                                <div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all">
                                    <div class="ui-datepicker-title"><span class="ui-datepicker-month">Choose Custom Frequency</span>                                    </div>
                                </div>
                                <table class="ui-datepicker-calendar">
                                    <thead>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        <tr>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">Su</a>                                            </td>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">Mo</a>                                            </td>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">Tu</a></td>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">We</a></td>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">Th</a></td>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">Fr</a></td>
                                            <td><a href="javascript:;;" onclick="onchoose(this)" class="ui-state-default">Sa</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="row-fluid">
                        <input type="text" name="fac_workshop[location]" value="<?php echo $workshop[0]->location; ?>" id="location" placeholder="Location(address, city, province/state, postal code)" style="width:57%;"/>
                        <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" />
                    </div>
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
                    <div class="row-fluid">
                        <select name="fac_workshop[cat_id]">
                            <option value="">Select Your Frequency</option>
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
                    </div>
                    <div class="row-fluid">
                        <input type="text" name="fac_workshop[tag]" value="<?php echo $workshop[0]->tag; ?>" id="tag" placeholder="Art Tags"/>
                    </div>
                    <div class="row-fluid">
                        <select name="fac_workshop[skill_level]">
                            <option value="">Select Your Skill_Level</option>
                            <?php foreach ($skills as $id => $name) {
                                if ($id == $workshop[0]->skill_level) { ?>
                                    <option selected value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                <?php } else { ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                <?php }
                            } ?>
                        </select> 
                    </div>
                    <div class="row-fluid">
                        <input type="text" name="fac_workshop[spot_available]" value="<?php echo $workshop[0]->spot_available; ?>" id="spot_available" placeholder="Spot Available"/>
                    </div>
                    <div class="row-fluid">
                        <input type="text" name="fac_workshop[tools_required]" value="<?php echo $workshop[0]->tools_required; ?>" id="tools_required" placeholder="Tools Required"/>
                    </div>
                    <div class="row-fluid">
                        <input type="text" name="fac_workshop[fee]" value="<?php echo $workshop[0]->fee; ?>" class="currency" id="fee" placeholder="Cost"/>
                    </div>
                </div>
                <div class="shop-right" style="margin-left: 20px;">
                    <div class="row-fluid">
                        <textarea name="fac_workshop[description]" id="description" style="width: 98%;" rows="13" placeholder="Workshop Description"><?php echo $workshop[0]->description; ?></textarea>
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

                    <form method="post" action="<?php echo base_url(); ?>workshop/update_image" class="fa-edit-form"  enctype="multipart/form-data" accept-charset="utf-8">

                        <input type="hidden" name="fac_workshop[wid]" value="<?php echo $workshop[0]->wid; ?>">
                        <input type="hidden" name="fac_workshop[image]" value="<?php echo $workshop[0]->image; ?>">
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
        
        $('#frequency').change(function() {
        val = $(this).val();

        if (val == 'Custom') {
            $('#div-ui-datepicker-frequency').show();

            $("#div-ui-datepicker-frequency").mouseout(function() {
                $(document).bind("click", function() {
                    $(document).unbind("click");
                    $("#div-ui-datepicker-frequency").fadeOut();
                });
            }).mouseover(function() {
                $(document).unbind("click");


            });


        }
        else {
            $(document).unbind("click");
            $('#div-ui-datepicker-frequency').hide();
        }
    });



    $("#fee").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
                // Allow: Ctrl+A
                        (event.keyCode == 65 && event.ctrlKey === true) ||
                        // Allow: home, end, left, right
                                (event.keyCode >= 35 && event.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                else {
                    // Ensure that it is a number and stop the keypress
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                        event.preventDefault();
                    }
                }
            });
        
    });   


function onchoose($this) {
    var class_value = $($this).attr('class');
    var old_value;
    var new_value;
    if (class_value == 'ui-state-default') {
        $($this).removeAttr('class');
        $($this).attr('class', 'ui-state-default ui-state-highlight');

        old_value = $("#frequency").val();
        new_value;
        if (old_value == "Custom") {

            $("#frequency option[value='Custom']").html($($this).html() + "; ");
            $("#frequency option[value='Custom']").val($($this).html() + "; ");
        }
        else {
            new_value = old_value + $($this).html() + "; ";

            $("#frequency option[value='" + old_value + "']").html(new_value);
            $("#frequency option[value='" + old_value + "']").val(new_value);
        }
    }
    else {
        $($this).removeAttr('class');
        $($this).attr('class', 'ui-state-default');

        old_value = $("#frequency").val();
        new_value = old_value.replace($($this).html() + "; ", "");
        if (new_value == "")
            new_value = "Custom";

        $("#frequency option[value='" + old_value + "']").html(new_value);
        $("#frequency option[value='" + old_value + "']").val(new_value);
    }
}
     
    
</script>