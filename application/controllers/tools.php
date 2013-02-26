<?php

class Tools extends CI_Controller {

    public function resend_activated() {
	
        $time = mktime(0,0,0,date("m"),date("d")-2,date("Y"));
                
        $activate_sql = 'SELECT uid, password, email FROM fa_users WHERE activated IS NOT NULL And join_date < '.$time.' And reset_activated = 0 limit 1';
        $activate_query = $this->db->query($activate_sql);
        $activation_data = $activate_query->result();
                
        if($activation_data){
			$activated = sha1(time() . $activation_data[0]->password);
			$sql = "UPDATE fa_users SET activated ='".$activated."', reset_activated = reset_activated + 1 WHERE uid = ".$activation_data[0]->uid;
			$this->db->query($sql);
			
			$activate_url = base_url() . 'user/activate/' . $activated;

			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($this->config->item('admin_email'));
			$this->email->to($activation_data[0]->email);
			$this->email->subject('Flowartz Registration');
			$this->email->message('<p>Welcome to Flowartz!  You\'re almost there, just click the following link to activate your account and choose your security question and you\'re all set!</p><p><a href="' . $activate_url . '">Click me to activate!</a></p><p>Thanks, the Flowartz Team.</p>');

			$this->email->send();
		}
        
        
		
        
        
    }
    
    

}

?>