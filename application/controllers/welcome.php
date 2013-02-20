<?php
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->helper('url');
                
                
                $this->load->view('global/header');
                $session_uid = $this->session->userdata('user_id');
                if($session_uid){
                    $this->load->view('home_afterlogin');
                }else{
                    $this->load->view('home');
                }
		$this->load->view('global/footer');
	}
        
        public function message($to = 'World')
	{
		echo "Hello {$to}!".PHP_EOL;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */