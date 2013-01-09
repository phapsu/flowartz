<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Request {
	
	//vars
	
		private $whitelist = array();
		private $valid_request_types = array();
	
	//methods
		
		public function __construct(){
			
			$this->valid_request_types = array('$_POST', '$_GET');
			
		}
		
		/*
		 * Gets a variable from a _POST or _GET, sanitizes it, and returns it for use in a query
		 * 
		 * @return mixed
		 * @param $var (mixed) - the variable from the array we wish to return
		 * @param $request_type (str) - the request type, optional
		 */
		
		public function getVar($var = null, $request_type = ''){

			$request = $_REQUEST;
			
			if($request_type && in_array($request_type, $this->valid_request_types)){
				$request = $request_type;
			}
			
			if(false === is_array($request[$var])){
				
				$data = $request[$var];
				
				if($data){
					
					if(!empty($this->whitelist)){
						$data = strip_tags($data, $this->whitelist);
					}else {
						$data = strip_tags($data);
					}
					
					return mysql_real_escape_string($data);
					
				}
			
			}elseif(true === is_array($request[$var])) {
				
				foreach($request[$var] as $item){
					
					if($item){
						
						if(!empty($this->whitelist)){
							$item = strip_tags($item, $this->whitelist);
						}else {
							$item = strip_tags($item);
						}
						
						$item = mysql_real_escape_string($item);
						
						$items[] = $item;
						
					}
					
				}
				
				return $items;
				
			}//end array check
			
			return false;
			
		}
		
		public function requestSet(){

			if($_POST){
				
				foreach($_POST as $post){
					if(is_array($post)){
						foreach($post as $p){
							if($p != ""){
								return true;
							}
						}
					}
				}
			
			}
			
			if($_FILES){
				
				foreach($_FILES as $file){
					if(is_array($file)){
						foreach($file as $f){
							if($f != ""){
								return true;
							}
						}
					}
				}
			
			}
			
			return false;
			
			/*if($_GET){
				
				foreach($_GET as $get){
					if(is_array($get)){
						foreach($get as $g){
							if(count($g) != 1){
								return false;
							}else {
								return true;
							}
						}
					}
				}
			
			}*/
			
		}
	
}

?>