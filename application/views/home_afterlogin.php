<div id="donation">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="makeadonation">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="F7HTMEPZAMPP4">
        <p class="button"><a href="javascript:;;" onclick="document.makeadonation.submit();">Click this button</a></p>
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
</div>

<div id="message">
    <div class="wrapper clearfix">
        <h1 class="center">Bringing all forms of art, movement and flow to one location</h1>
    </div>
    <!-- end of message wrapper -->
</div>
<!-- end of message div -->

<div class="content" id="home-content">
    <div class="wrapper clearfix" id="home-afterlogin-content">

        <!-- end of home-signup div -->
        <div class="profile-feature" style="float: right; line-height: normal">
            <ul>
                <li>
                    <span class="active2">
                        <h2>Be the first to access new tools and resource by:</h2>
                        <p>Completely filling out your profile</p>
                        <p>Link all your social media</p>
                        <p>Update your skills and Experience</p>
                        <p>Like us on Facebook </p>
                        <p>Share us with your friends</p>
                        <p><a href="javascript:;;" onclick="document.makeadonation.submit();">Donate to the project</a></p>    
                    </span>
                </li>
            </ul>
            <!--                    <h1>Be the first to access new tools and resource by:</h1>
                                <h2>Completely filling out your profile</h2>
                                <h2>Link all your social media</h2>
                                <h2>Update your skills and Experience</h2>
                                <h2>Like us on Facebook </h2>
                                <h2>Share us with your friends</h2>
                                <h2>Donate to the project</h2>                    -->
        </div>

        <div class="home-signup" style="float: left; padding-top :20px;">                    
            <h1>Welcome to the first stage in a radical new system of cooperative resourcing to empower the arts community.</h1>
            <br>
            <h2>Its time to kick your career into high gear</h2>  
        </div>
    </div>
    <!-- end of home-content wrapper -->
</div>
<!-- end of content div -->

<div class="content" id="fa-future">
    <div class="wrapper clearfix">
        <h1 class="center">Profiles are just the beginning, this is what else is in the works</h1>
        <div class="fa-phase">
            <div class="phase-img">
                <img src="<?php echo base_url(); ?>template/images/talent-circle-violet.png" alt="Online Talent Agency" />
            </div>
            <ul>
                <li>Create a digital resume</li>
                <li>Connect your social media</li>
                <li>Promote your skills</li>
                <li>Book gigs</li>
                <li>Connect to local artists</li>
                <li>Collaborate on art projects</li>
            </ul>
        </div>

        <div class="phase-forward phase-current"></div>
        <!-- end of fa-phase div -->
        <div class="fa-phase">
            <div class="phase-img">
                <img src="<?php echo base_url(); ?>template/images/tools-circle-violet.png" alt="Career Tools" />
            </div>
            <ul class="text-smoke">
                <li>Business cards</li>
                <li>Websites</li>
                <li>Demo video</li>
                <li>Professional photography</li>
                <li>Business courses</li>
                <li>Networking opportunities</li>
            </ul>
        </div>
        <!-- end of fa-phase div -->

        <div class="phase-forward"></div>
        <div class="fa-phase last-phase">
            <div class="phase-img">
                <img src="<?php echo base_url(); ?>template/images/academy_wikiart.png" alt="Learning Resources" />
            </div>
            <ul class="text-smoke">
                <li>Organize your classes in one place</li>
                <li>Distribute courses globally</li>
                <li>Exchange for cash, credit or other courses</li>
                <li>Refine and evolve your teaching style</li>
                <li>Arts and technique encyclopedia</li>
            </ul>
        </div>
        <!-- end of fa-phase div -->
    </div>
    <!-- end of content wrapper -->
</div>
<!-- end of content div -->
<div id="footer-message">
    <div class="wrapper clearfix">
        <div class="group-button">
            <div class="button">
                <a href="https://docs.google.com/viewer?url=<?php echo base_url(); ?>template/files/flow_artz_laminate.pdf" target="_blank"><i class="pdf">&nbsp;</i>&nbsp;Project Fundraising Milestone</a>
            </div>

            <div class="button">
                <a href="http://www.youtube.com/watch?v=ZZXDWitcDOg" class="youtube" ><i class="video">&nbsp;</i>&nbsp;Fundraising Video</a>
            </div>
        </div>
    </div>
    <!-- end of message wrapper -->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/jquery.fancybox.js?v=2.1.0"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/jquery.fancybox.css?v=2.1.0" media="screen" />
<script type="text/javascript">
    jQuery(document).ready(function() {

        $(".youtube").click(function() {
            $.fancybox({
                'padding'		: 0,
                'autoScale'		: false,
                'transitionIn'	: 'none',
                'transitionOut'	: 'none',
                'title'			: this.title,
                'width'			: 640,
                'height'		: 385,
                'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                'type'			: 'swf',
                'swf'			: {
                    'wmode'			: 'transparent',
                    'allowfullscreen'	: 'true'
                }
            });

            return false;
        });
    });

</script>