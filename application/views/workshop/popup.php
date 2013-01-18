<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Untitled Document</title>
        <script src="<?php echo base_url(); ?>template/js/jquery.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>template/js/common.js"></script>
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
            
            $('.sendmail').click(function(){    
                window.parent.$(".sendmail").click();               
            });
           
        });
        </script>     
    </head>

    <body>
        <div style="width:50%;float:left;">
            <a href="/workshop/view/<?php echo $wid; ?>" target="_parent" class="button btn_accept" style="display: none; background-color: #4B216A;float: left;margin-left: 30px; margin-bottom: 10px;padding: 4px;"><img src="<?php echo base_url(); ?>/template/images/camera_test.png" /></a>
            <a href="#" class="button btn_cancel" style="display: none;background-color: #F1592A;float: left;margin-left: 30px;padding:4px; margin-top: 50px;"><img src="<?php echo base_url(); ?>/template/images/delete.png" /></a>
        </div>
        <div style="width:42%;float:right">
            <a href="#" class="button btn_add" style="background-color: #4B216A;float: left;margin-left: 30px; margin-bottom: 10px;padding: 11px 7px;text-decoration: none;font-size: 12px;font-weight: bold;">ADD</a>
            <a class="sendmail button" href="#" style="background-color: #4B216A;float: left;margin-left: 30px;padding:8px; margin-bottom: 10px;"><img src="<?php echo base_url(); ?>/template/images/24_comment_square.png" /></a>
            <a href="#" class="button" style="background-color: #4B216A;float: left;margin-left: 30px;padding:4px"><img src="<?php echo base_url(); ?>/template/images/down_right2.png" /></a>
        </div>
    </body>
</html>