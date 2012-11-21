<?php
/**
 * Artists page view
 */
$this->load->helper('inflector');
$this->load->helper('text');
$page = $this->uri->segment(2, 0);
?>
<div class="content">
    <div class="wrapper clearfix">
        <div class="artist-filter">

            <ul>
                <li><a href="<?php echo base_url(); ?>artists" <?php if (isset($action) && (!$action || $action == 'index')) { ?>class="active-filter"<?php } ?>>Recent</a></li>
                <li><a href="<?php echo base_url(); ?>artists/popular" <?php if (isset($action) && $action == 'popular') { ?>class="active-filter"<?php } ?>>Popular</a></li>
            </ul>

            <form class="artist-search" name="artistSearch"  id="artistSearch" action="<?php echo base_url(); ?>search" method="post">
            <div id="searchForm">
                <div class="search-input">
                    <input type="text" id="search-keyword" name="fac_search[q]" placeholder="Search for artists" value="<?php echo $this->session->userdata('search_string'); ?>">
                    <input type="hidden" id="search-location" name="fac_search[location]" value="<?php echo $this->session->userdata('search_location');?>">
                </div>
                <div class="search-change">
                    <div class="location-name" id="location-name">
                        <?php $locationText = ($this->session->userdata('search_location')) ? $cities[$this->session->userdata('search_location')] : 'Find By Location'; ?>
                        <span id="locationSelector"><?php echo $locationText;?></span>
                    </div>
                    <div class="change-location">
                        <a class="fancybox fancybox.ajax" href="<?php echo base_url(); ?>location/search">Change</a>
                    </div>
                </div>
                <div class="search-button"><a id="doSearch" href="#">&nbsp;</a></div>
            </div>
            </form>
        </div>
        <!-- end of artist filter div -->
        <ul class="artist-group">
            <?php if (false === empty($results)) : ?>
                <?php foreach ($results as $user): 
						$slug = ($user->name) ? underscore($user->name) : underscore($user->title);
						$slug = ($slug) ?  $slug : 'profile';
				?>

                    <li class="artist-profile">
                        <div class="artist">
                            <?php                            
                            if (!empty($user->name)) {
                                echo '<p style="padding-bottom:10px;"><a href="' . base_url() . 'user/' . $user->uid . '/' . $slug .'" class="thumb-link">' . $user->name . '</a></p>';
                            } else {
                                echo '<p style="padding-bottom:10px;"><a href="' . base_url() . 'user/' . $user->uid . '/' . $slug .'" class="thumb-link">New Artist</a></p>';
                            }
                            ?>
                            <?php if ($user->profile_picture && is_file('./application/files/' . $user->profile_picture)) : ?>
                                <img src="<?php echo base_url(); ?>application/files/<?php echo $user->profile_picture; ?>" alt="<?php echo $user->name; ?>&apos;s Profile Picture"  class="showContenthover"/>
                            <?php else : ?>
                                <img src="<?php echo base_url(); ?>template/images/artist-image.png" alt="<?php echo $user->name; ?>&apos;s Profile Picture" class="showContenthover"/>
                            <?php endif; ?>
                            <div class="contenthover">
                                <?php
                                if (!empty($user->title)) {
                                    echo '<h3>' . word_limiter($user->title, 6) . '</h3>';
                                } else {
                                    echo '<h3>Artist\'s Title</h3>';
                                }

                                if (!empty($user->country) && !empty($user->state) && !empty($user->city)) {
                                    echo '<p>' . $cities[$user->city] . ',' . $states[$user->state] . ',' . $countries[$user->country] . '</p>';
                                } else {
                                    echo '<p>Unavailable Location</p>';
                                }
								
                                ?>
                                <p><a href="<?php echo base_url(); ?>user/<?php echo $user->uid; ?>/<?php echo $slug;?>" class="mybutton">View Profile</a></p>
                            </div>
                        </div>
                        <!-- end of artist div -->
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <li class="no-results">No search results found</li>
            <?php endif; ?>
        </ul>
        <!-- end of artist-group ul -->
        <div class="pagination"><?php if(isset($links)) echo $links; ?></div>
        <!-- end of pagination div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.contenthover.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.simpletip-1.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.chained.mini.js"></script>
<script type="text/javascript">
    $(function(){
        $('.showContenthover').contenthover({
            overlay_background:'#000',
            overlay_opacity:0.8,
            width: 195,
            height: 195
            //        effect:'slide',
            //        slide_direction:'bottom'
        });
        

        $('.fancybox').fancybox({
            beforeClose    :   function() {
                //alert();
            },
            afterClose    :   function() {
                //alert('');
            }
        });

        //bind search click
        $('#doSearch').bind('click', function(){
            if($('#search-keyword').val() != '' || $('#search-location').val()){
                document.artistSearch.submit();
            }else{
                window.location.href = $('#artistSearch').attr('action');
            }
        })

        // Selects one or more elements to assign a simpletip to
        $("#location-name").simpletip({ content: '<?php echo $locationText;?>', position: 'top' });
    });
</script>
