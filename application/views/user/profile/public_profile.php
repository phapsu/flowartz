<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />

<?php
/**
 * Profile homepage
 */
$this->load->helper('inflector');
$user = $userinfo[0];

$slug = ($user->name) ? underscore($user->name) : underscore($user->title);

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
                    <?php $can_see_class = $this->classroom_model->user_can_view(); ?>
                    <li>
                        <?php echo count($classes); ?> classes created. <?php if($can_see_class){ ?> <a href="<?php echo base_url(); ?>user/classroom/add">Add class.</a> <?php } ?>
                    </li>
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
            <?php if ($this->profile_model->user_can_view('links')): ?>
                <div class="profile-right-section" id="user-links">
                    <h4>Online Presence</h4>

                    <ul>
                        <!--<li><a href="<?php echo $user->website; ?>" class="home-link" target="_blank">Website</a></li>-->
                        <?php
                        $hasLink = 0;
                        if (count($linkinfo) > 0) :
                            //foreach($links as $linkinfo):
                            ?>
                            <!--<li><a href="<?php //echo $this->profile_model->append_html(html_entity_decode($link->link));  ?>" class="<?php //echo $this->profile_model->profile_link_class($link->link);  ?>" target="_blank"><?php //echo $link->name;  ?></a></li>-->
                            <?php if (isset($linkinfo->facebook) && !empty($linkinfo->facebook)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->facebook)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/facebook.png" height="34" width="34" alt="Facebook" title="Facebook"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->twitter) && !empty($linkinfo->twitter)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->twitter)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/twitter.png" height="34" width="34" alt="Twitter" title="Twitter"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->googleplus) && !empty($linkinfo->googleplus)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->googleplus)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/googleplus.png" height="34" width="34" alt="Google Plus" title="Google Plus"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->youtube) && !empty($linkinfo->youtube)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->youtube)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/youtube.png" height="34" width="34" alt="Youtube" title="Youtube"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->vimeo) && !empty($linkinfo->vimeo)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->vimeo)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/vimeo.png" height="34" width="34" alt="Vimeo" title="Vimeo"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->foursquare) && !empty($linkinfo->foursquare)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->foursquare)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/foursquare.png" height="34" width="34" alt="Four Square" title="Four Square"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->devianart) && !empty($linkinfo->devianart)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->devianart)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/devianart.png" height="34" width="34" alt="Devian Art" title="Devian Art"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->soundcloud) && !empty($linkinfo->soundcloud)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->soundcloud)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/soundcloud.png" height="34" width="34" alt="Sound Cloud" title="Sound Cloud"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->photobucket) && !empty($linkinfo->photobucket)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->photobucket)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/photobucket.png" height="34" width="34" alt="Twitter" title="Photobucket"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->link1) && !empty($linkinfo->link1)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->link1)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="<?php echo $linkinfo->title1; ?>" title="<?php echo $linkinfo->title1; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->link2) && !empty($linkinfo->link2)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->link2)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="<?php echo $linkinfo->title2; ?>" title="<?php echo $linkinfo->title2; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->link3) && !empty($linkinfo->link3)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->link3)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="<?php echo $linkinfo->title3; ?>" title="<?php echo $linkinfo->title3; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (isset($linkinfo->link4) && !empty($linkinfo->link4)) : $hasLink++; ?>
                                <li><a href="<?php echo $this->profile_model->append_html(html_entity_decode($linkinfo->link4)); ?>" target="_blank"><img src="<?php echo base_url(); ?>template/images/social/white_link.png" height="34" width="34" alt="<?php echo $linkinfo->title4; ?>" title="<?php echo $linkinfo->title4; ?>"></a></li>
                            <?php endif; ?>

                            <?php
                            //endforeach;
                        endif;

                        if ($hasLink == 0):
                            ?>
                            <li class="no-posts">No links posted yet. <a href="<?php echo base_url(); ?>user/profile/edit/links">Add some.</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- end of user-links div -->
            <?php endif; ?>
            <?php if ($this->profile_model->user_can_view('skills')): ?>
                <div class="profile-right-section" id="user-skills">
                    <h4>Skills &amp; Talents</h4>

                    <?php
                    $artistLevel = $this->config->item('artist_level');
                    $numOfSkill = count($skillinfo);
                    if ($numOfSkill > 0) :
                        $theLevelArray = array();

                        foreach ($skillinfo as $idx => $skill) :
                            if ($idx > 0 && !in_array($skill->artist_level, $theLevelArray)) {
                                echo '</ul>';
                            }
                            if (!in_array($skill->artist_level, $theLevelArray)) {
                                if ($idx > 0 && ($idx + 1) <= $numOfSkill) {
                                    echo '<div class="skill-divider"></div>';
                                }
                                echo '<ul>';
                                if(isset($artistLevel[$skill->artist_level])) echo '<li class="nav-header"><h3>' . $artistLevel[$skill->artist_level] . '</h3></li>';
                            }


                            echo '<li>' . $skill->name . '</li>';



                            $theLevelArray[$skill->artist_level] = $skill->artist_level;
                        endforeach;
                        ?>
                    <?php else : ?>
                        <ul><li class="no-posts">No skills posted yet. <a href="<?php echo base_url(); ?>user/profile/edit/skills">Add some.</a></li></ul>                                
                    <?php endif; ?>

                    <!--<div class="skill-divider"></div>-->
                </div>
                <!-- end of user-skills div -->
            <?php endif; ?>
            <?php if ($this->profile_model->user_can_view('experience')): ?>
                <div class="profile-right-section" id="user-exp">
                    <h4>Experience</h4>

                    <?php if (count($expinfo) > 0) : ?>
                        <?php foreach ($expinfo as $exp) : ?>
                            <div class="user-exp-item experience-box <?php echo $exp->artist_level;?>">
                                <div class="user-exp-info">
                                    <ul>
                                        <li class="date">
                                            <?php if ($exp->job_date != '0000-00-00'): //echo date('F jS, Y', strtotime($exp->job_date)); ?>
                                                <div class='dateblock'>
                                                    <span class='dateblock_mon'><?php echo date('M', strtotime($exp->job_date));?></span>
                                                    <span class='dateblock_day'><?php echo date('d', strtotime($exp->job_date));?></span>
                                                    <span class='dateblock_year'><?php echo date('Y', strtotime($exp->job_date));?></span>
                                                </div>
                                            <?php endif; ?>
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="user-exp-summary">
                                    <h3><?php echo $exp->job_title; ?></h3>
                                    <p><?php echo $exp->job_description; ?></p>
                                    <?php if($exp->job_location):?>
                                    <div class="location"><p><?php echo $exp->job_location; ?></p></div>
                                    <?php endif;?>
                                    <?php if($exp->job_link):?>
                                    <div class="url">
                                        <p>
                                            <a href="<?php echo html_entity_decode($exp->job_link); ?>">
                                            <?php if($exp->job_link_title) echo $exp->job_link_title; else html_entity_decode($exp->job_link);?>
                                            </a>
                                        </p>
                                    </div>
                                    <?php endif;?>
                                </div>                                
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="user-exp-item">
                            <div class="user-exp-summary">
                                <ul>
                                    <li class="no-posts">No experiences posted yet. <a href="<?php echo base_url(); ?>user/profile/edit/experience">Add some.</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- end of user-exp div -->
            <?php endif; ?>
                
            <!-- begin of classroom -->    
            <?php if (count($classes) > 0) : ?>
            <div class="profile-right-section" id="user-class">
                <h4>Classroom</h4>
                <table cellspacing="0" cellpadding="0" border="0" class="listTable highlight">
                    <tbody><tr class="tableRowHeader">
                            <th width="30%">Date</th>                        
                            <th width="45%">Class Name</th>                        
                            <th width="20%" >Fee</th>
                            <th width="5%" >&nbsp; </th>
                        </tr>   
                        
                        <?php foreach ($classes as $id=> $row) : ?>
                            <tr align="center">
                                <td><?php echo date("m/d/Y", strtotime($row->from_date)).' -> '.date("m/d/Y", strtotime($row->to_date)); ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->fee.' ('.$row->fee_currency.')'; ?></td>
                                <td><a href="<?php echo base_url().'user/'.$user->uid.'/'.$slug.'/'.$row->cid; ?>" target="_blank">view</a></td>
                            </tr>
                        <?php endforeach; ?>
                </table>                
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