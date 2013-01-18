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
                        <li><a style="border-left:0 none" href="/workshop/cats/<?php echo $id; ?>"><?php echo $name; ?></a></li>
                    <?php } else { ?>
                        <li><a href="/workshop/cats/<?php echo $id; ?>"><?php echo $name; ?></a></li>
                    <?php }
                } ?>
            </ul>
        </div>
        <div class="menu-az">
            <ul class="nav">
                <li><a href="#" class="option_search" value="0" onclick="select_search(this)" style="border-left:0 none">A - Z</a></li>
                <li><a href="#" class="option_search" value="1" onclick="select_search(this)">Nearest</a></li>
                <li><a href="#" class="option_search" value="2" onclick="select_search(this)">Price</a></li>
                <li><a href="#" class="option_search" value="3" onclick="select_search(this)">Availability</a></li>
                <li><a href="#" class="option_search" value="4" onclick="select_search(this)">Skilly</a></li>
                <li><a href="#" class="option_search" value="5" onclick="select_search(this)">Soonest</a></li>
                <input type="hidden" name="fac_workshop[type_id]" id="type_id" value="0">
                <input type="text" name="fac_workshop[keyword]" placeholder="Search" autocomplete="true">                
            </ul>
        </div>

        <div>
            <div style="border-top: 1px solid #bbb;display: inline-block;padding: 20px 0;text-align:center">

                <!-- begin box list tag  -->
                <div class="shop-left shop-left-tag" style="background: #FFFFFF;border: 1px solid #BBBBBB;border-radius:10px;height:635px">
                    <?php
                    foreach ($tags as $id => $tag) {
                        if ($id == 0) {
                            ?>
                            <a href="/workshop/tag/<?php echo urlencode($tag->tag); ?>"><?php echo $tag->tag; ?></a>
                        <?php } else { ?>
                            , <a href="/workshop/tag/<?php echo urlencode($tag->tag); ?>"><?php echo $tag->tag; ?></a>
                        <?php }
                    } ?>                    
                </div>
                <!-- end box list tag  -->

                <div class="shop-right">

                    <ul class="artist-group fea-group note-group" style="border:0 none;padding:0">

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

                    <ul class="artist-group fea-group note-group" style="border:0 none;padding:0">

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

                    <ul class="artist-group fea-group note-group" style="border:0 none;padding:0">

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
            </div>
        </div>
    </div>
    <!-- end of content wrapper div -->
</div>

<script>
function select_search(object){
    $('.option_search').removeAttr('style', 'color');
    $('#type_id').val($(object).attr('value'));
    $(object).attr('style', 'color:red;')
}

</script>