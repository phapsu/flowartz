<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>
<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />
<?php include('favorite.php'); ?>

<div class="content">
    <div class="wrapper clearfix">
        
        <?php include('header.php'); ?>

        <div class="workshop-center">
            <a class="button orange workshop-center-a-hot" href="<?php echo base_url(); ?>workshop/add" >Host a workshop</a>
            <span class="workshop-center-a-all" ><a href="<?php echo base_url(); ?>workshop/all" style="color: #7F7F7F;">or check out some of these workshop</a></span>

            <!-- begin box all -->
            <ul class="artist-group fea-group workshop-center-box-container" style="border-top: 1px solid #CCCCCC;">
                
                <?php if ($workshop) {
                    foreach ($workshop as $id => $w) {
                        if($id % 4 ==0) {?>
                            <li class="artist-profile rotate" style="width:0px;font-weight: bold;margin-top: 109px;"></li> 
                        <?php }
                        ?>                
                        <li class="artist-profile artist-border" style="padding:5px;margin: 0 8px 20px;">
                            <div class="ch_normal">
                                <div style="width:67%;float:left;text-align:center">
                                    <input type="text" value="<?php echo $skills[$w->skill_level]; ?>" style="margin: 3px 0px;width:100%"/>
                                    <label>Skill level</label>
                                    <input type="text" value="<?php echo $w->fee; ?>" style="margin: 3px 0px;width:100%"/>
                                    <label>Cost</label>
                                    <input type="text" value="<?php echo $w->enrolled_counter; ?>" style="margin: 3px 0px;width:100%"/>
                                    <label>Spots Filled</label>
                                </div>
                                <div style="width:20%;float:right">
                                    <a href="javascript:;;" onclick="add_favorite(this, '<?php echo $w->wid; ?>', '<?php echo $w->name; ?>')" class="button" style="background-color: #4B216A;float: left;padding:4px; margin-bottom: 10px;">
                                        <img src="<?php echo base_url(); ?>template/images/star.png" />
                                    </a>
                                    <a href="<?php echo base_url(); ?>workshop/popup_send_mail/<?php echo $w->wid; ?>" data-fancybox-type="iframe" class="sendmail button" style="background-color: #4B216A;float: left;padding:8px; margin-bottom: 10px;">
                                        <img src="<?php echo base_url(); ?>template/images/24_comment_square.png" />
                                    </a>
                                    <a href="<?php echo base_url(); ?>workshop/popup/<?php echo $w->wid; ?>" data-fancybox-type="iframe" class="various button" style="background-color: #4B216A;float: left;padding:4px">
                                        <img src="<?php echo base_url(); ?>template/images/down_right2.png" />
                                    </a>
                                </div>
                            </div>                                                 
                        </li>
                    <?php }
                } ?>                
            </ul>
            <!-- end box all -->

            <div class="pagination"><?php if (isset($links))
                    echo $links; ?></div>

        </div>
    </div>
    <!-- end of content wrapper div -->
</div>

<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js"></script>

<script>
    $(document).ready(function() {
        $(".various").fancybox({
            maxWidth	: 220,
            maxHeight	: 300,
            fitToView	: false,
            width	: '40%',
            height	: '30%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
        });
        
        $(".sendmail").fancybox({
            maxWidth	: 620,
            maxHeight	: 620,
            fitToView	: false,
            width	: '70%',
            height	: '65%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    });    
    
    function add_favorite(contaner, $id, $name){
        $(contaner).html('Saving...');
        $.post("/workshop/add_favorite",{
            id: $id, 
            name: $name
        } ,function(data) {
            $(contaner).html('<img src="<?php echo base_url(); ?>template/images/star.png" />'); 
            
            if(!$('li').hasClass('item-'+$id)){
                $('#u-favorite').append("<li class='item-"+$id+"'><a href='/workshop/view/"+$id+"'>"+$name+"</a></li>");
            }            
        });
    }
    
</script>