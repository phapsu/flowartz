<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Untitled Document</title>
        <script src="<?php echo base_url(); ?>template/js/jquery.min.js"></script> 
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
        });
        </script>
    </head>

    <body>
        <div class="thumbnail" id="div_sendmessage" style="height: 400px; overflow: hidden; width: 500px;">
            <form id="deleteFileForm" class="fa-edit-form" action="<?php echo base_url(); ?>workshop/popup_send_mail" method="post">
                <input type="hidden" name="fac_workshop[wid]" value="<?php echo $wid; ?>">
                <label>Form send message</label>
                <textarea name="fac_workshop[message]"></textarea>
                <input type="submit" value="Send" />
            </form>
        </div>
    </body>
</html>