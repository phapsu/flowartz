<?php
/**
 * Profile homepage
 */
$user = $userinfo[0];
//        echo "<pre>";
//        print_r($user);
//        echo "</pre>";
?>
<div class="content">
    <div class="wrapper clearfix">
        <?php include('edit_profile_sidebar.php'); ?>
        <div class="profile-right">
            <h1>Upload Images</h1>
            <div class="edit-form" style="width:230px;">

                <form method="post" action="<?php echo base_url(); ?>user/save/images" class="fa-edit-form"  enctype="multipart/form-data" accept-charset="utf-8">
                    <label for="name">Image 1</label>
                    <input type="file" name="image_1" id="pimg1" value="" class="galleryUpload" />

                    <label for="name">Image 2</label>
                    <input type="file" name="image_2" id="pimg2" value="" class="galleryUpload" />

                    <label for="name">Image 3</label>
                    <input type="file" name="image_3" id="pimg3" value="" class="galleryUpload" />

                    <input type="submit" value="Save" />
                </form>
            </div>
            <script type="text/javascript">
                var $hasUploaded = <?php echo intval(count($gallery));?>;
                $(function(){
                    switch($hasUploaded){
                        case 1:
                            $('.galleryUpload').last().attr('disabled', true);
                            break;
                        case 2:
                            $('.galleryUpload').attr('disabled', true);
                            $('.galleryUpload').first().attr('disabled', false);
                            break;
                        case 3:
                            $('.galleryUpload').attr('disabled', true);
                            break;
                        default:
                            $('.galleryUpload').attr('disabled', false);
                            break;
                    }
                });
            </script>
            <!-- end of edit-form div -->
            <div class="edit-list" style="width:360px; border-left: solid 1px #f0f0f0; padding-left: 10px">
                <h5>Uploaded Images</h5>
                <?php
                    if (!empty($gallery)):
                ?> 
                    <form id="deleteImgForm" class="fa-edit-form" action="<?php echo base_url(); ?>user/delete/images" method="post">
                    <div style="clear:both;">
                        <ul id="fa_gallery" class="fa_gallery">
                            <?php
                            $totalImg = count($gallery);
                            foreach($gallery as $idx => $image):
                                $last = ($idx+1 == $totalImg) ?  'last-thumb' : '';
                            ?>
                            <li class="<?php echo $last;?>">
                                <?php if ($image->name && is_file('./application/files/thumb_' . $image->name)) : ?>
                                    <a data-fancybox-group="gallery" class="fancybox" href="<?php echo base_url(); ?>application/files/<?php echo $image->name;?>"><img src="<?php echo base_url(); ?>application/files/thumb_<?php echo $image->name;?>" alt="Image 01" /></a>
                                <?php else : ?>
                                    <img src="<?php echo base_url(); ?>template/images/noimage.png" alt="No Image" title="No Image"/>
                                <?php endif; ?> 
                                <p><input type="checkbox" id="<?php echo $image->id;?>"  name="fac_profile[<?php echo $image->id;?>]" value="<?php echo $image->id;?>"></p>
                            </li>
                            <?php endforeach;?>
                        </ul>                    
                    </div>
                    <div style="clear:both"><input type="submit" id="delete-btn" value="Delete" name="delete" onclick="if(confirm('Are you sure?')) document.getElementById('deleteImgForm').submit(); else return false;"></div>
                    </form>
                <?php
                    endif;
                ?>                
            </div>
            <!-- end of edit-list div -->
        </div>
        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
    $('.fancybox').fancybox();
});
</script> 