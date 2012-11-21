<?php /* HEADER START */?>
	<div id="header">
		<div class="wrapper">
			<h1 id="logo"><a href="<?php echo $this->config->item('site_url'); ?>"><?php echo $this->config->item('site_name'); ?></a></h1>
			<ul id="social-media-icons">
				<li class="facebook"><a href="http://www.facebook.com/pages/Flow-Artz/124302124322167" target="_blank">&nbsp;</a></li>
				<li class="twitter"><a href="http://twitter.com/flowartz1" target="_blank">&nbsp;</a></li>
				<li class="youtube"><a href="http://youtube.com/user/FlowArtzD" target="_blank">&nbsp;</a></li>
			</ul>
		</div><?php /* WRAPPER END */?>
	</div>
<?php /* HEADER END */?>
<?php /* CONTENT START */?>
	<div id="content">
		<div id="promo">
			<div class="wrapper">
				<p class="left">Through collaboration and inclusiveness we help foster trust and unity between arts and business communities</p>
				<div class="right">
				
					<?php
						
						$message = 'Want to stay up to date?';
						$submessage = 'Subscribe to our newsletter for news, updates and more information on how you can get involved!';
						
						//integrate mailchimp so we can add users directly to our contact list 
						if($_POST){
						
							$is_valid = preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_POST['user_email']);
							
							if(!empty($_POST['user_email']) && $is_valid){
							
								require_once('application/includes/mailchimp/MCAPI.class.php');
	
								$api = new MCAPI($this->config->item('mailchimp_apikey'));
								$list = $this->config->item('mailchimp_listid');
	
	
								$merged = array('EMAIL' => $_POST['user_email']);
	
								if($api->listSubscribe($list, $_POST['user_email'], $merged, 'html') === true){
									$message = 'Subscribed!';
									$submessage = 'Thank you for subscribing to Flow Artz!  Please check your email inbox for our confirmation notice.';
								}else {
									$message = '<span class="error">An error occurred</span>';
									$submessage = 'Please try submitting your email address again.';
								}
								
							}
						}

					?>
					
					<h2><?php echo $message; ?></h2>
					<p><?php echo $submessage; ?></p>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="email_list">
						<input type="text" name="user_email" value="Your Email Address" id="user_email" />
						<input type="submit" name="submit" value="Send" />
					</form>
				</div>
			</div><?php /* WRAPPER END */?>
		</div>
		<?php /* PROMO END */?>

		<div id="maincontent">
			<div class="wrapper">
				<p id="helping">We're helping the growth of the arts community in the following ways</p>
				<div class="grid">
					<div class="item">
						<img src="<?php echo base_url(); ?>template/images/demo-1.png" />
						<h3>Artist Promotion Services</h3>
						<p>Flow Artz will be working directly with performers to help them develop promotional materials to better develop their careers.  This will cover everything from physical materials that they will hand out and any digital tools that will make it easier for them to promote their skills.</p>
					</div>
					<div class="item">
						<img src="<?php echo base_url(); ?>template/images/demo-2v2.png" />
						<h3>Online Talent Agency</h3>
						<p>This website will be designed to profile both artists and clients.  It will give a way for artists to equally promote themselves through a medium where they can provide sample work, demo music, demo vidos and any info the client may want.</p>
					</div>
					<div class="item">
						<img src="<?php echo base_url(); ?>template/images/demo-3v2.png" />
						<h3>Develop Educational Resources</h3>
						<p>The database that will be developed through the online agency can be used to target areas of the city that are interested in learning about Flow Artz.  With this information we can strategically position various workshops to facilitate learning with an instructor.</p>
					</div>
				</div>
			</div><?php /* WRAPPER END */?>
		</div>
		<?php /* MAINCONTENT END */?>

	</div>
<?php /* CONTENT END */?>
<?php /* FOOTER START */?>
	<div id="footer">
		<div class="wrapper">
			<p id="help">Would you like access to these tools and opportunities sooner?  You can help by making a small donation.</p>
			<div id="donations">
				<ul>
					<li class="donate"><a href="http://www.indiegogo.com/Unity-of-the-Arts-and-Business-worlds" target="_blank">Donate</a></li>
					<li class="contact"><a href='&#109;&#97;il&#116;&#111;&#58;&#105;n%66o&#64;f%6&#67;o%77a%72t%&#55;&#65;&#46;%63om'>info&#64;flowartz&#46;&#99;om</a></li>
				</ul>
			</div>
		</div><?php /* WRAPPER END */?>
	</div>
<?php /* FOOTER END */?>