<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
	public function index()
	{
		$this->load->model('twitter_model');	
		
		$this->twitter_model->connect('http://'.$_SERVER['HTTP_HOST']);
		$account_info = $this->twitter_model->get_account_settings();echo "<pre>";print_r($account_info);
		$this->twitter_model->post_status("post1 to twitter06062013");		
		echo $this->session->userdata('username');
//		$this->load->library('Twitter');
//		$this->twitter->connect('http://'.$_SERVER['HTTP_HOST']);
		
		$this->load->view('welcome_message');
	}
	
	public function post_status()
	{
		$this->load->model('twitter_model');
		$this->twitter_model->post_status("post1 to twitter06062013");		
	}
	
	public function get_followers_list()
	{
		$this->load->model('twitter_model');
		$followers_list = $this->twitter_model->get_followers_list();
		echo json_encode($followers_list);
		//return json_encode($followers_list);
	}
	
	public function get_friends_ids()
	{
		$this->load->model('twitter_model');
		$friends_ids = $this->twitter_model->get_friends_ids();
		echo json_encode($friends_ids);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */