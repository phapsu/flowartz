<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />

<?php
/**
 * Profile homepage
 */
$user = $userinfo[0];


if (isset($user_id)) {
    $share_link = base_url() . 'user/' . $user_id;
} else {
    $share_link = base_url() . 'user/' . $user->uid;
}
$user->title = (strlen($user->title) > 0 ? $user->title : 'Artist Title');
$user->location = (isset($user->country) && isset($user->state) && isset($user->city)) ? $cities[$user->city] . ',' . $states[$user->state] . ',' . $countries[$user->country] : 'Artist Location';
$user->blurb = (strlen($user->blurb) > 0 ? $user->blurb : 'Artist Description');
//$user->profile_picture = (strlen($user->profile_picture) > 0 ? $user->profile_picture : base_url().'template/images/profile-feature-pic.jpg');
?>
<div class="content">
    <div class="wrapper clearfix">
        <div class="profile-left">

            <div class="profile-picture">
                <?php
                if (((isset($user->uid) && ($this->session->userdata('user_id') == $user->uid))) || (isset($user_id) && $this->session->userdata('user_id') == $user_id)) :
                    ?>
                    <a href="<?php echo base_url(); ?>user/profile/edit/profile_picture">Edit</a>
                    <?php
                endif;
                ?>

                <?php if (false === is_null($user->profile_picture)) : ?>
                    <img src="<?php echo base_url(); ?>application/files/<?php echo $user->profile_picture; ?>" alt="Profile Picture" />
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="Profile Picture" />
                <?php endif; ?>
            </div>
            <!-- end of profile-picture div -->

            <div class="user-media" id="user-images">
                <h4>Images</h4>
                <?php
                if (!empty($gallery)):
                    ?>
                    <ul>
                        <?php
                        $totalImg = count($gallery);
                        foreach ($gallery as $idx => $image):
                            $last = ($idx + 1 == $totalImg) ? 'last-thumb' : '';
                            ?>
                            <li class="<?php echo $last; ?>">
                                <a data-fancybox-group="gallery" class="fancybox" href="<?php echo base_url(); ?>application/files/<?php echo $image->name; ?>">
                                    <img src="<?php echo base_url(); ?>application/files/thumb_<?php echo $image->name; ?>" alt="Image 01" />
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                endif;
                ?>
            </div>
            <!-- end of user-images div -->
            <?php if ($this->profile_model->user_can_view('videos')): ?>
                <div class="user-media" id="user-video">
                    <h4>Video</h4>
                    <ul>
                        <?php if (count($vidinfo) > 0) : ?>
                            <?php foreach ($vidinfo as $video) : ?>
                                <li><a href="<?php echo $this->profile_model->append_html($video->link); ?>" target="_blank"><span id="vid-<?php echo $video->vid; ?>"></span></a></li>
                                <script type="text/javascript">
                                    $(function(){
                                        processURL('<?php echo $video->link; ?>', 'vid-<?php echo $video->vid; ?>', '<?php echo $video->name; ?>', '<?php echo base_url(); ?>template/images/novideo.png');
                                    });
                                </script>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li>No videos posted yet. <a href="<?php echo base_url(); ?>user/profile/edit/videos">Add some.</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- end of user-video div -->
            <?php endif; ?>
                
            <!-- begin div classroom -->                
            
            <div class="user-media" id="user-video">
                <h4>Classroom</h4>
                <ul>
                    <li>10 classes. <a href="<?php echo base_url(); ?>user/classroom/add">Add class.</a></li>
                </ul>
            </div>       
            
            <!-- end div classroom -->    
                
                
            <div class="user-media" id="user-share">
                <h4>Share</h4>
                <ul>
                    <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $share_link; ?>" target="_blank" class="facebook-share-icon">Facebook</a></li>
                    <li><a href="http://twitter.com/intent/tweet?text=Cool Artist on Flow Artz: <?php echo $share_link; ?>" target="_blank" class="twitter-share-icon">Twitter</a></li>
                    <li><a href="mailto: ?subject=Flow Artz Profile&body=Cool Artist on Flow Artz: <?php echo $share_link; ?>" class="email-share-icon">Email</a></li>
                </ul>
            </div>
            <!-- end of user-share div -->

        </div>
        <!-- end of profile-left div -->

        <div class="profile-right">
            <div class="profile-right-section" id="user-info">
                <h1><?php echo $user->name; ?></h1>
                <ul>
                    <li class="user-title"><?php echo $user->title; ?></li>
                    <li><?php echo $user->location; ?></li>
                    <li class="user-desc"><?php echo $user->blurb; ?></li>
                </ul>
            </div>
            <!-- end of user-info div -->
            
                
            <!-- begin of classroom -->    
            <?php if (!empty ($class)) : ?>
            <div class="profile-right-section" id="user-class">
                <h4>Classroom</h4>
                <div class="class_name">
                    <span><?php echo $class[0]->name; ?></span>
                    <div class="class_detail">Date: <?php echo date("m/d/Y", strtotime($class[0]->from_date)).' -> '.date("m/d/Y", strtotime($class[0]->to_date)); ?></div>
                    <div class="class_detail">Fee: <?php echo $class[0]->fee.' ('.$class[0]->fee_currency.')'; ?></div>
                    <div class="class_detail">Description: </div>
                    <div class="class_description"><?php echo $class[0]->description; ?></div>
                </div>

                <div class="class_paypal">                    
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="9AR8TUL8JKKJQ">
                        <input type="hidden" name="custom" value="<?php echo $this->session->userdata('user_id'); ?>" />
                        <input type="hidden" name="currency_code" value="<?php echo $class[0]->fee_currency; ?>">
                        <input type="hidden" name=AMT value=<?php echo $class[0]->fee;?> >
                        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>
            </div>
            <?php endif; ?>
            <!-- end of classroom -->                   
                
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