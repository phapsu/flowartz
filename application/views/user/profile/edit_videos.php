<?php
/**
 * Edit videos page
 */
$no_data = empty($uniqvidinfo);

if (false === $no_data) {
    $data = (empty($uniqvidinfo) ? null : $uniqvidinfo[0]);
} else {
    $data = new stdClass();
    $data->link = '';
    $data->name = '';
}
?>
<div class="content">
    <div class="wrapper clearfix">
        <?php include('edit_profile_sidebar.php'); ?>
        <div class="profile-right">
            <h1>Edit Video Links<span class="profile-item-counter"><?php echo $this->profile_model->profile_item_counter(); ?></span></h1>
            <div class="edit-form">
                <form method="post" action="<?php echo base_url(); ?>user<?php
        if (false === $no_data) {
            echo '/update/videos/' . $data->vid;
        } else {
            echo '/save/videos';
        }
        ?>" class="fa-edit-form">
                    <label for="">Paste Video Link</label>
                    <input type="text" name="fac_profile[link]" id="video-url" value="<?php echo $data->link; ?>" />

                    <label for="">Video Title</label>
                    <input type="text" name="fac_profile[name]" id="video-title" value="<?php echo $data->name; ?>" />

                    <input type="submit" name="fac_profile[save]" value="Save" />
                    <?php if (false === $no_data) : ?>
                        <input type="submit" name="fac_profile[delete]" value="Delete" id="delete-btn" />
                        <input type="hidden" name="fac_profile[vid]" value="<?php echo $data->vid; ?>" />
<?php endif; ?>
                </form>
            </div>
            <!-- end of edit-form div -->
            <div class="edit-list">
                <h5>Edit Videos</h5>
                <ul>
                    <?php if (count($vidinfo) > 0) : ?>
                        <?php foreach ($vidinfo as $video) : ?>
                            <li><?php echo anchor('user/profile/edit/videos/' . $video->vid, $video->name); ?></li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No Videos</li>
<?php endif; ?>
                </ul>
            </div>
            <!-- end of edit-list div -->
        </div>                
        <div class="profile-right" id="out" style="display: none; margin-top: 20px;padding-bottom: 25px;">

        </div>
        <div id="video_div">
        </div>
        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.oembed.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.oembed.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
	 
        $('#video-url').bind("keyup mouseover", function(){
            tagdata = [];
            eventdata = [];
            var scriptruns = [];
            var text = $('#video-url').val();
            text = $('<span>'+text+'</span>').text(); //strip html
            text = text.replace(/(\s|>|^)(https?:[^\s<]*)/igm,'$1<div><a href="$2" class="oembed">$2</a></div>');
            text = text.replace(/(\s|>|^)(mailto:[^\s<]*)/igm,'$1<div><a href="$2" class="oembed">$2</a></div>');
	
		
            $('#out').empty().html(text);
            $('#out').show();
		
            //		$(".oembed").oembed(null,{
            //			apikeys: {
            //				//etsy : 'd0jq4lmfi5bjbrxq2etulmjr',
            //				amazon : 'caterwall-20'
            //				//eventbrite: 'SKOFRBQRGNQW5VAS6P',
            //			}
            //			//maxHeight: 200, maxWidth:300
            //                        
            //		});

            $(".oembed").oembed(null, 
            {
                embedMethod: "replace", 
                maxWidth: 640,
                maxHeight: 480                   
            }
        );
        }); 
        
    });  
</script>
