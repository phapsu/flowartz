<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>
<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />
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

        <div class="workshop-header">
            <div class="workshop-header-l">
                <div>THIS TOOL IS DESIGNED TO CONNECT TEACHERS AND STUDENT AND EMPOWER THEM WITH A NUMBERS OF TOOLS TO SHARE EDUCATION OF THEIR ARTISTS PASSION</div>
            </div>
            <div class="totalEn workshop-header-r">
                <div>
                    <div class="workshop-header-r-c"> Select a category arove or search for workshop</div>
                </div>
                <div>
                    <form method="post" action="<?php echo base_url(); ?>workshop/search" id="frmAdd">
                        <input type="hidden" name="fac_workshop[type_id]" value="0">
                        <input type="text" name="fac_workshop[keyword]" placeholder="Search" autocomplete="true" class="workshop-search">
                    </form>
                </div>
            </div>
        </div>


        <div class="workshop-center">
            <a class="button orange workshop-center-a-hot" href="/workshop" >Host a workshop</a>
            <span class="workshop-center-a-all" ><a href="/workshop/all" style="color: #7F7F7F;">or check out some of these workshop</a></span>

            <!-- begin box all -->
            <ul class="artist-group fea-group workshop-center-box-container" style="border-top: 1px solid #CCCCCC;">
                <li class="artist-profile rotate" style="width:20px;font-weight: bold;margin-top: 109px;">All</li> 
                <?php if($workshop){ foreach($workshop as $id =>$w){ ?>                
                <li class="artist-profile artist-border" style="padding:5px;margin: 0 8px 20px;">
                            <div class="ch_normal">
                                <div style="width:67%;float:left;text-align:center">
                                    <input type="text" value="<?php echo  $skills[$w->skill_level]; ?>" style="margin: 3px 0px;width:100%"/>
                                    <label>Skill level</label>
                                    <input type="text" value="<?php echo $w->fee; ?>" style="margin: 3px 0px;width:100%"/>
                                    <label>Cost</label>
                                    <input type="text" value="<?php echo $w->enrolled_counter; ?>" style="margin: 3px 0px;width:100%"/>
                                    <label>Spots Filled</label>
                                </div>
                                <div style="width:20%;float:right">
                                    <a href="#" class="button" style="background-color: #4B216A;float: left;padding:4px; margin-bottom: 10px;">
                                        <img src="<?php echo base_url(); ?>template/images/star.png" />
                                    </a>
                                    <a href="#" class="button" style="background-color: #4B216A;float: left;padding:8px; margin-bottom: 10px;">
                                        <img src="<?php echo base_url(); ?>template/images/24_comment_square.png" />
                                    </a>
                                    <a href="#" class="various button" style="background-color: #4B216A;float: left;padding:4px">
                                        <img src="<?php echo base_url(); ?>template/images/down_right2.png" />
                                    </a>
                                </div>
                            </div>                                                  
                        </li>
                <?php } }?>                
            </ul>
            <!-- end box all -->

            <div class="pagination"><?php if(isset($links)) echo $links; ?></div>
            
        </div>
    </div>
    <!-- end of content wrapper div -->
</div>