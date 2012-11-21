<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="content">
	<div class="wrapper clearfix">
		<div class="signup">
			<h3 class="center">Flow Artz Sign Up</h2>
			<form class="fa-form" method="post" action="<?php echo base_url(); ?>user/signup">
				<label for="email">Email Address</label>
				<input type="text" name="fac_signup[email]" id="email" />
				<label for="password">Password</label>
				<input type="password" name="fac_signup[password]" id="password" />
				<label for="confirm">Confirm Password</label>
				<input type="password" name="fac_signup[confirm]" id="confirm" />
				<input type="submit" name="submit" id="submit" value="Sign Up" />
				<input type="hidden" name="fac_login[token]" value="<?php echo sha1(time()); ?>" />
			</form>
		</div>
		<!-- end of signup div -->
	</div>
	<!-- end of content wrapper -->
</div>
<!-- end of content div -->