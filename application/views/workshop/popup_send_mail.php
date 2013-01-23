<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Untitled Document</title>
        <script src="<?php echo base_url(); ?>template/js/jquery.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/flowartz-core.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/template/css/styles.css" />

        <script>
            $(document).ready(function() {
                $('.btn_cancel').click(function(){
                    javascript:parent.jQuery.fancybox.close();
                });
            
                $('.btn_add').click(function(){               
                    $('.btn_accept').show();
                    $('.btn_cancel').show();
                });
                
                $('#btnSend').click(function(){               
                    $.post("/workshop/popup_send_mail",{wid: "<?php echo $wid; ?>", email: $('#workshop_email').val(), message: $('#workshop_message').val()} ,function(data) {
                        $('#btnSend').after('<span>  Send Message Successful.</span>');
                    });
                    
                    return false;
                });
            });
        </script>
    </head>

    <body>
        <div class="thumbnail" id="div_sendmessage">
            <form id="deleteFileForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/popup_send_mail" method="post">
                <input type="hidden" name="fac_workshop[wid]" value="<?php echo $wid; ?>">
                    <div>
                        <h2>SEND MESSAGE TO TEACHER</h2>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="fac_workshop[email]" value="<?php echo $email; ?>" id="workshop_email" style="width: 630px;"/>
                    </div>
                    <div>
                        <label>Content</label>
                        <textarea name="fac_workshop[message]" id="workshop_message" style="width: 630px; height: 180px"></textarea>
                    </div>
                    <div>
                        <input class="button orange" id="btnSend" type="submit" value="Send" />
                    </div>
            </form>
        </div>
    </body>
</html>
<style>
    #div_sendmessage div{
        margin-bottom: 10px;
    }
</style>