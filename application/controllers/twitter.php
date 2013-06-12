<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller{
	
	
	public function index()
	{		
		$this->session->sess_destroy();
		$this->load->view('twitter');
	}
	
	public function connect()
	{
		$this->load->model('twitter_model');
		$this->twitter_model->connect('http://'.$_SERVER['HTTP_HOST'].'/twitter/connect');	
		$this->load->view('twitter');	
	}
	
	public function post_status()
	{		
		$message = "default";
		
		if(!empty($_POST))
		{
			$message = $_POST['message'];
		}
		$this->load->model('twitter_model');
		$status = $this->twitter_model->post_status($message);
		echo json_encode($status);		
	}
	
	public function get_followers_list()
	{
		$this->load->model('twitter_model');
		$followers_list = $this->twitter_model->get_followers_list();
		
//		echo "<table border=1 cols=1>
//		<tr>
//		<th>Followers List</th>
//		</tr>
//		";
//		
//		
//		
//		
//		foreach($followers_list->users as $follower)
//		{
//			echo "<tr>
//			<td>".$follower->screen_name."</td>
//			</tr>";
//		}
		echo json_encode($followers_list);
		//return json_encode($followers_list);
	}
	
	public function get_friends_list()
	{
		$this->load->model('twitter_model');
		$friends_list = $this->twitter_model->get_friends_list();
		echo json_encode($friends_list);		
	}
	
	public function get_friends_ids()
	{
		$this->load->model('twitter_model');
		$friends_ids = $this->twitter_model->get_friends_ids();
		echo json_encode($friends_ids);
	}
}

