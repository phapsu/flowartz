<div class="content">
	<div class="wrapper clearfix">
		<div class="login">
			<h3 class="center">Flow Artz Log In</h3>
			<form class="fa-form" name="fac_login" id="fac_login" method="post" action="<?php echo base_url(); ?>user/login">
				<label for="email">Email Address</label>
				<input type="text" name="fac_login[email]" id="email" />
				<label for="password">Password</label><a href="<?php echo base_url(); ?>user/reset_password/" class="reset-password">- Forgot Your Password?</a>
				<input type="password" name="fac_login[password]" id="password" />
				<input type="submit" name="submit" id="submit" value="Log In" />
				<input type="hidden" name="fac_login[token]" value="<?php echo sha1(time()); ?>" />
			</form>
		</div>
		<!-- end of login div -->
	</div>
	<!-- end of content wrapper -->
</div>
<!-- end of content div -->