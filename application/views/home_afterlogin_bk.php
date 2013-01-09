<div id="donation">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="makeadonation">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="2B4R2RVQCK7LQ">
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
	<div class="wrapper clearfix">
		<!--<h1 class="center">Profiles are just the beginning, this is what else is in the works</h1>-->
		<div class="fa-phase">
			<div class="phase-img">
				<img src="<?php echo base_url(); ?>template/images/learning-circle.png" alt="Learning Resources" />
			</div>
			<p>The database that will be developed through the online agency can be used to target areas of your city that are interested in learning about Flow Artz. With this information we can strategically position various workshops to facilitate learning with an instructor.</p>
		</div>
		<!-- end of fa-phase div -->
		<div class="fa-phase">
			<div class="phase-img">
				<img src="<?php echo base_url(); ?>template/images/talent-circle.png" alt="Online Talent Agency" />
			</div>
			<p>This website is designed to profile artists. It will give artists a way to equally promote themselves through a medium where they can provide sample work, demo music, demo videos and any info a client may want.</p>
		</div>
		<!-- end of fa-phase div -->
		<div class="fa-phase last-phase">
			<div class="phase-img">
				<img src="<?php echo base_url(); ?>template/images/tools-circle.png" alt="Career Tools" />
			</div>
			<p>We will be working directly with performers to help them develop promotional materials to better develop their careers. This will cover everything from physical materials that they will hand out and any digital tools that will make it easier for them to promote their skills.</p>
		</div>
		<!-- end of fa-phase div -->
	</div>
	<!-- end of home-content wrapper -->
</div>
<!-- end of content div -->

<div class="content" id="fa-future">
	<div class="wrapper clearfix">
                <h1 class="center">Profiles are just the beginning, this is what else is in the works</h1>
                <div class="phase">
                    <div id="phase-header"></div>
                    <div id="phase-body">
                        <h2>Talent Agency</h2>
                        <span class="sexy_line"></span>
                        <ul>
                            <li>Create a digital resume</li>
                            <li>Connect your social media</li>
                            <li>Promote your skills</li>
                            <li>Book gigs</li>
                            <li>Connect to local artists</li>
                            <li>Collaborate on art projects</li>
                        </ul>
                    </div>
                    <div id="phase-footer" class="footer_phase_1"></div>
		</div>
                
                <div id="phase-forward"></div>
            
                <div class="phase phase_no">
                    <div id="phase-header"></div>
                    <div id="phase-body">
                        <h2>Career Tools</h2>
                        <span class="sexy_line"></span>
                        <ul>
                            <li>Business cards</li>
                            <li>Websites</li>
                            <li>Demo video</li>
                            <li>Professional photography</li>
                            <li>Business courses</li>
                            <li>Networking opportunities</li>
                        </ul>
                    </div>
                    <div id="phase-footer" class="footer_phase_no_2"></div>
		</div>	
                
                <div id="phase-forward"></div>
            
                <div class="phase phase_no">
                    <div id="phase-header"></div>
                    <div id="phase-body">
                        <h2>Academy +  WikiArt</h2>
                        <span class="sexy_line"></span>
                        <ul>
                            <li>Organize your classes in one place</li>
                            <li>Distribute courses globally</li>
                            <li>Exchange for cash, credit or other courses</li>
                            <li>Refine and evolve your teaching style</li>
                            <li>Arts and technique encyclopedia</li>
                        </ul>
                    </div>
                    <div id="phase-footer" class="footer_phase_no_3"></div>
		</div>		
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