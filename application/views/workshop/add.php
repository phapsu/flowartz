<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<?php $user = $userinfo[0]; ?>

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
        <form method="post" action="<?php echo base_url(); ?>workshop/add" id="frmAdd" enctype="multipart/form-data">
            <div class="shop-left">
                <!-- begin of profile-picture div -->
                <div class="profile-picture" style="margin-bottom: 20px;">
                    <a id="box1" href="#div_addfile">Edit</a>
                    <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="No Picture" />
                </div>
                <!-- end of profile-picture div -->
                <div class="row-fluid">                
                    <select name="fac_workshop[cat_id]">
                        <option value="">Select Art Catergory</option>
                        <?php foreach ($categories as $id => $name) { ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select> 
                </div>
                <div class="row-fluid">
                    <input type="text" name="fac_workshop[tag]" id="tag" placeholder="Art Tags"/>
                </div>
                <div class="row-fluid">                
                    <select name="fac_workshop[skill_level]">
                        <option value="">Select Skill Level</option>
                        <?php foreach ($skills as $id => $name) { ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>   
                </div>
                <div class="row-fluid">   
                    <input type="text" name="fac_workshop[spot_available]" id="spot_available" placeholder="Spot Available"/>
                </div>
                <div class="row-fluid">   
                    <input type="text" name="fac_workshop[tools_required]" id="tools_required" placeholder="Tools Required"/>
                </div>
                <div class="row-fluid">   
                    <input type="text" name="fac_workshop[fee]" class="currency" id="fee" placeholder="Cost"/>
                </div>
            </div>
            <div class="shop-right">
                <div class="row-fluid">
                    <input type="text" name="fac_workshop[name]" id="name" placeholder="Workshop Name" />
                </div>
                <div class="row-fluid">
                    <input type="text" name="fac_workshop[teacher_name]" id="teacher_name" placeholder="Teacher Name" />
                </div>
                <div>
                    <div class="shop-right-left">
                        <div class="row-fluid">
                            <input type="text" name="fac_workshop[date]" id="date" placeholder="Date"/>
                        </div>
                        <div class="row-fluid">                            
                            <select name="fac_workshop[length]" style="width: 90%;" id="length">
                                <option value="">Select Your Length</option>
                                <?php foreach ($length as $id => $name) { ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                <?php } ?>
                            </select> 
                        </div>
                    </div>
                    <div class="shop-right-right">
                        <div class="row-fluid">
                            <input type="text" name="fac_workshop[time]" id="time" placeholder="Start Time"/>
                        </div>
                        <div class="row-fluid">
                            <select name="fac_workshop[frequency]" style="width: 90%;" id="frequency">
                                <option value="">Select Your Frequency</option>
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
                        <input type="text" name="fac_workshop[location]" id="location" placeholder="Location(address, city, province/state, postal code)" style="width:57%;"/>
                        <input type="text" id="btn_googlemap" placeholder="Google Map" style="width: 11%; cursor: pointer" />
                    </div>
                </div>                
                <div>    
                    <div class="row-fluid">
                        <textarea name="fac_workshop[description]" id="description" style="width: 100%; height: 257px;" rows="12" placeholder="Workshop Description"></textarea>
                    </div>
                </div>
                <div style="position: absolute;right: 0;top: 0;width: 35%;">
                    <a class="button turquoise gradient" onclick="document.getElementById('frmAdd').submit();" href="#" style="float: right;margin: 0;text-align: center;width: 40%;margin-bottom:25px">Confirm</a>
                    <a class="button" href="#" onclick="document.getElementById('frmAdd').reset();" style="float: right;margin: 0;text-align: center;width: 40%;margin-bottom:25px;">Cancel</a>                
                    <a id="box2" class="button turquoise gradient" href="#div_payment" style="float: right;margin: 0;text-align: center;width: 40%;margin-bottom:25px">Paypal</a>
                </div>
            </div>

            <!-- add file form -->
            <div class="thumbnail" id="div_addfile" style="display: none; height: 500px; overflow: hidden; width: 700px;">
                <!-- begin form upload -->
                <div class="profile-right">
                    <h1>Upload Image(gif|jpg|png)</h1>
                    <div class="edit-form" style="width:230px;">
                        <label for="name">Image</label>
                        <input type="file" name="image_1" id="pimg1" value="" class="galleryUpload" />
                    </div>        
                </div>
                <!-- end form upload -->
            </div>           
        </form>   
        
        <!-- begin payment information -->
        <div class="thumbnail" id="div_payment" style="display: none; height: 400px; overflow: hidden; width: 700px;">
            <div class="profile-right">
                <h1>Payment</h1>
                <div class="edit-form" style="padding-top: 10px;">
                    <textarea style="width: 625px; height: 300px;" name="fac_profile[payment]" id="payment"><?php echo $user->payment; ?></textarea>
                </div>        
            </div>
        </div>    
       <!-- end payment information -->
    </div>   

    <!-- end of content wrapper div -->
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
<script>
                                                $(function() {
                                                    $("#date").datepicker();
                                                    $("#time").timepicker();

                                                    $('.currency').blur(function()
                                                    {
                                                        $('.currency').formatCurrency();
                                                    });

                                                    $('#btn_googlemap').click(function() {
                                                        var address = $('#location').val();
                                                        var content = $.base64.encode(address);

                                                        var a = document.createElement('a');
                                                        a.href = '<?php echo base_url(); ?>template/google_map.php?address=' + content;
                                                        a.target = '_blank';
                                                        document.body.appendChild(a);
                                                        a.click();
                                                    });


                                                    $('#box1, #box2').fancybox({
                                                        openEffect: 'elastic',
                                                        openSpeed: 100,
                                                        closeEffect: 'elastic',
                                                        closeSpeed: 100,
                                                        padding: 0
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

                                                    //event fee just only number
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

                                                    //event auto complete tag
                                                    var availableTags = [
<?php echo $tags; ?>
                                                    ];
                                                    $("#tag").autocomplete({
                                                        source: availableTags
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