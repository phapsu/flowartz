<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>
<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />
<style>

    .shop-left-tag a{
        outline: medium none; text-decoration: none; color:#999999;
    }

    .shop-left-tag a:hover{
        color:red;
    }

</style>

<?php include('favorite.php'); ?>

<div class="content">
    <div class="wrapper clearfix">
        <div class="menu-nav">
            <ul class="nav">
                <?php foreach ($categories as $id => $name) {
                    if ($id == 1) { ?>
                        <li><a style="border-left:0 none" href="<?php echo base_url(); ?>workshop/cats/<?php echo $id; ?>"><?php echo $name; ?></a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url(); ?>workshop/cats/<?php echo $id; ?>"><?php echo $name; ?></a></li>
                    <?php }
                } ?>
            </ul>
        </div>
        <div class="menu-az">
            <ul class="nav">
                <?php
                $keyword = (isset($keyword) ? $keyword : '');
                $type_id = (isset($type_id) ? $type_id : 0);
                ?>
                <form method="post" action="<?php echo base_url(); ?>workshop/search" id="frmSearch">

                    <li><a href="javascript:;;" class="option_search option0" value="0" onclick="select_search(this)" style="border-left:0 none">A - Z</a></li>
                    <li><a href="javascript:;;" class="option_search option1" value="1" onclick="select_search(this)">Nearest</a></li>
                    <li><a href="javascript:;;" class="option_search option2" value="2" onclick="select_search(this)">Price</a></li>
                    <li><a href="javascript:;;" class="option_search option3" value="3" onclick="select_search(this)">Availability</a></li>
                    <li><a href="javascript:;;" class="option_search option4" value="4" onclick="select_search(this)">Skilly</a></li>
                    <li><a href="javascript:;;" class="option_search option5" value="5" onclick="select_search(this)">Soonest</a></li>


                    <input type="hidden" name="fac_workshop[type_id]" id="type_id" value="<?php echo $type_id; ?>">
                    <input type="text" name="fac_workshop[keyword]" value="<?php echo $keyword; ?>" placeholder="Search" autocomplete="true">                
                </form>
            </ul>
        </div>

        <div>
            <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;text-align:center">

                <!-- begin box list tag  -->
                <div class="shop-left shop-left-tag" style="background: #FFFFFF;border: 1px solid #BBBBBB;border-radius:10px;">
                    <p style="margin-top: 10px; margin-bottom: 10px;">
                        <?php
                        foreach ($tags as $id => $tag) {
                            $class = '';
                            if($tag->tag == $tag){                                
                                $class = 'style="color: red;"';
                            }

                            if ($id == 0) {
                                ?>
                                <a <?php echo $class; ?> href="<?php echo base_url(); ?>workshop/tag/<?php echo urlencode($tag->tag); ?>"><?php echo $tag->tag; ?></a>
                            <?php } else { ?>
                                , <a <?php echo $class; ?> href="<?php echo base_url(); ?>workshop/tag/<?php echo urlencode($tag->tag); ?>"><?php echo $tag->tag; ?></a>
                            <?php }
                        } ?>   
                    </p>
                </div>
                <!-- end box list tag  -->

                <div class="shop-right">                    

                    <?php if ($workshop) { ?>

                        <ul class="artist-group fea-group note-group" style="border:0 none;padding:0; margin-left:36px;">
                            <?php foreach ($workshop as $id => $w) {
                                if ($id % 3 == 0 && $id != 0) { ?>

                                </ul><ul class="artist-group fea-group note-group" style="border:0 none;padding:0; margin-left:36px;">
                                <?php } ?>

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

                </div>
            </div>
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
        
        var option = <?php echo $type_id; ?>;

        $('.option'+option).attr('style', 'color:red;');
        
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
    
    function select_search(object){
        $('.option_search').removeAttr('style', 'color');
        $('#type_id').val($(object).attr('value'));
        $(object).attr('style', 'color:red;')
    }
    
</script>