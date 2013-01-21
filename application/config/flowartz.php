<?php
	
	/* 
	* Copyright Flowartz 2011
	* Author: Ryan Priebe
	* Version: 1.0.0
	* Date: September 24, 2011
	* Updated: November 18, 2011
	*/

	if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	$config = array();
	$config['site_name'] = 'Flow Artz';
	$config['environment'] = 'DEV';
	$config['admin_email'] = 'no-reply@flowartz.com';
	$config['contact_email'] = 'vukhanhtruong@gmail.com';
	
	//Max profile definitions, will come from a db setting eventually 
	$config['profile_max_skills'] = 8;
	$config['profile_max_links'] = 4;
	$config['profile_max_images'] = 3;
	$config['profile_max_videos'] = 3;
	
	//Mailchimp configuration
	$config['mailchimp_apikey'] = '45def12e8d46d7f1f6495b548d003262-us2';
	$config['mailchimp_listid'] = '40d0bd85b0';
	
        //Paging
        $config['numof_artist_paging'] = 16;
        $config['numof_workshop_paging'] = 16;
        
	//Skill and Experience level
        $config['artist_level'] = array(
                'student_level'=>'Student Level',
                'performing_level'=>'Performing Level',
                'teaching_level'=>'Teaching Level'
            );        
        
        //Art category
        $config['artist_category'] = array(
                '1'=>'MUSIC',
                '2'=>'DANCE',
                '3'=>'PROP + CIRCUS',
                '4'=>'DIGITAL',
                '5'=>'MARTIAL',
                '6'=>'TRADITIONAL'
            );        
        
        $config['workshop_max_files'] = 5;
        
        $config['workshop_surcharge'] = 7; //%
?>