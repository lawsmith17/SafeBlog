<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
{
	parent::__construct();
//checking if the user has already loggin
	if($this->session->has_userdata('authenticated'))
	{
		$this->session->set_flashdata('status','You are Already logged in ');
			redirect(base_url('userpage'));
	}
//checking Ends Here

//loading the form validation
	$this->load->helper('form');
	$this->load->library('form_validation');

	//loading user model
      $this->load->model('AuthUserModel');

}

	
	public function index()
	{
		$this->load->view('template/header');
		
    $this->load->view('auth/login');
    $this->load->view('template/footer');
	}


	public function login()
	{
		$this->form_validation->set_rules('email_id', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run()== FALSE)
		{
			//failed
			$this->index();
		}
		else
		{

			$data = [
'email' => $this->input->post('email_id'),
'password' => $this->input->post('password')
			];
			//to login as admin email=admin@gmail.com and password=1234
			$user = new AuthUserModel;
			$result = $user->loginUser($data);
			if($result != FALSE)
			{
				
$auth_userdetails = [
'first_name' => $result->first_name,
'last_name' => $result->last_name,
'email' => $result->email,

];

//setting the flash data to display a message
$this->session->set_userdata('auth_user',$auth_userdetails);
$this->session->set_flashdata('status','You are logged in SuccessFully');


//if the email equals to admin@gmail.com means its the admin login in if not redirect tohe user to the user page because its the user login in
if($result->email=="admin@gmail.com")
{
redirect(base_url('adminpage'));
}else
{
	redirect(base_url('userpage'));
}
			

			}else
			{
				$this->session->set_flashdata('status','Invaild Email ID or Password');
			redirect(base_url('login'));
			}
	}

}
}
