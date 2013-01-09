<?php
	/* 
	* Copyright Flowartz 2011
	* Author: Ryan Priebe
	* Version: 1.0.0
	* Created on: September 25, 2011
	* Last Modified: September 28, 2011
	*/
	
	$time = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php $this->app->page_title(); ?></title>
	<meta name="keywords" content="Flow Artz, Edmonton, Flow, Prop, Community, Arts" />
	<meta property="og:description" content="Flow Artz is a collaborative organization that seeks to network all forms of art, movement and flow to one location, inviting teachers and students globally to help educate and inspire the world." />
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />
	<script src="<?php echo base_url(); ?>template/js/jquery.min.js"></script> 
        
                <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/base/jquery-ui.css" type="text/css" media="all" /> 
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/flowartz-core.css?<?php //echo $time;?>" />
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/flowartz-core-ie7.css?<?php //echo $time;?>" />
	<![endif]-->
	<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>template/css/flowartz-core-ie8.css?<?php //echo $time;?>" />
	<![endif]-->
	
	<link href="<?php echo base_url(); ?>template/images/favicon.ico?<?php //echo $time; ?>" rel="icon"/>
	<![if ! IE]>
	<link href="<?php echo base_url(); ?>template/images/favicon.png?<?php //echo $time; ?>" rel="shortcut icon"/>
	<![endif]>

       
</head>
<body>

<div id="admin-bar">
	<div class="wrapper clearfix">
		<ul class="admin">
			<?php if(false === $this->session->userdata('user_id')): ?>
				<li><?php echo anchor('user/signup', 'Sign Up'); ?></li>
				<li><?php echo anchor('user/login', 'Log In'); ?></li>
			<?php else: //user is logged in ?>
				<li><?php echo anchor('user/profile', 'Me'); ?></li>
				<li><?php echo anchor('user/profile/edit', 'Edit Profile'); ?></li>
				<li><?php echo anchor('user/logout', 'Log Out'); ?></li>
			<?php endif; ?>
		</ul>
		
		<form class="search-form" action="<?php echo base_url(); ?>search" method="post">
			<input type="text" name="fac_search[q]" placeholder="Search for artists">
			<input type="submit" value="">
			<input type="hidden" name="fac_search[action]" value="1" />
		</form>
	</div>
	<!-- end of admin-bar wrapper -->
</div>
<!-- end of admin-bar div -->

<div id="header">
	<div class="wrapper clearfix">
		<a href="<?php echo base_url(); ?>" id="logo"><img src="<?php echo base_url(); ?>template/images/fa-logo.png" alt="Flow Artz Distribution & Development" /></a>
		
		<ul class="nav">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li><?php echo anchor('artists', 'Artists'); ?></li>
			<li><a href="<?php echo base_url().'book_talent'; ?>">Book Talent</a></li>
			<li><a href="<?php echo base_url().'about'; ?>">About</a></li>
		</ul>
		<!-- end of nav list -->
	</div>
	<!-- end of header wrapper div -->
</div>
<!-- end of header div -->
<?php 
	/**
	 * Show the user errors, messages or just general tips
	 */
	$this->error->display_error(); 
?>
