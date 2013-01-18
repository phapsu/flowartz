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

            <!-- begin box featured -->
            <ul class="artist-group fea-group workshop-center-box-container" style="border-top: 1px solid #CCCCCC;">
                <li class="artist-profile rotate" style="width:20px;font-weight: bold;margin-top: 109px;">FEATURED</li> 
                <?php if ($workshop_featured) {
                    foreach ($workshop_featured as $id => $w) { ?>                
                        <li class="artist-profile">
                            <div class="ch_normal">
                                <!--<a href="/workshop/view/<?php echo $w->wid; ?>">-->
                                    <?php if (empty($w->name)) { ?>
                                        <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>application/files/<?php echo $w->name; ?>" alt="Profile Picture"/>
                                    <?php } ?>                                    
                              <!--  </a>-->
                            </div>                                          
                        </li>
                    <?php }
                } ?>                
            </ul>
            <!-- end box featured -->

            <!-- begin box nearby -->
            <ul class="workshop-center-box-container artist-group fea-group" style="border-top: 1px solid #CCCCCC;">
                <li class="artist-profile rotate" style="width:20px;font-weight: bold;margin-top: 109px;">NEARBY</li> 
                <?php if ($workshop_nearby) {
                    foreach ($workshop_nearby as $id => $w) { ?>                
                        <li class="artist-profile">
                            <div class="ch_normal">
                                <a href="/workshop/view/<?php echo $w->wid; ?>">
                                    <?php if (empty($w->name)) { ?>
                                        <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>application/files/<?php echo $w->name; ?>" alt="Profile Picture"/>
                                    <?php } ?>
                                </a>
                            </div>                                          
                        </li>
                    <?php }
                } ?>   
            </ul>
            <!-- end box nearby -->

            <!-- begin box soon -->
            <ul class="artist-group fea-group workshop-center-box-container" style="border-top: 1px solid #CCCCCC;">
                <li class="artist-profile rotate" style="width:20px;font-weight: bold;margin-top: 109px;">SOON</li> 
                <?php if ($workshop_soon) {
                    foreach ($workshop_soon as $id => $w) { ?>                
                        <li class="artist-profile">
                            <div class="ch_normal">
                                <a href="/workshop/view/<?php echo $w->wid; ?>">
                                    <?php if (empty($w->name)) { ?>
                                        <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>application/files/<?php echo $w->name; ?>" alt="Profile Picture" />
                                    <?php } ?>
                                </a>
                            </div>                                          
                        </li>
                    <?php }
                } ?>   
            </ul>
            <!-- end box soon -->


        </div>
    </div>
    <!-- end of content wrapper div -->
</div>
