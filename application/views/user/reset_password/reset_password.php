<div class="content">
	<div class="wrapper clearfix">
		<div class="login">
			<h3 class="center">Flow Artz Password Reset</h3>
			<form class="fa-form" name="fac_reset" method="post" action="<?php echo base_url(); ?>user/reset_password">
				<input type="password" name="fac_reset[password_1]" id="email" placeholder="Password" />
				<input type="password" name="fac_reset[password_2]" id="email" placeholder="Confirm Password" />
				<input type="submit" name="submit" id="submit" value="Reset Password" />
			</form>
		</div>
		<!-- end of login div -->
	</div>
	<!-- end of content wrapper -->
</div>
<!-- end of content div -->