<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller {

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

	$this->load->helper('form');
	$this->load->library('form_validation');

	//loading user model
      $this->load->model('AuthUserModel');

}


	public function index()
	{
		$this->load->view('template/header');
    $this->load->view('auth/register');
    $this->load->view('template/footer');
	}


	public function register()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

		if($this->form_validation->run()== FALSE)
		{
			//failed
			$this->index();
		}
		else
		{
			$data = array
        (
          'first_name' => $this->input->post('first_name'),
          'last_name' => $this->input->post('last_name'),
          'email' => $this->input->post('email'),
		  'password' => $this->input->post('password')

		);
		$register_user = new AuthUserModel;
		$checking = $register_user->registerUser($data);
		if($checking)
		{
			$this->session->set_flashdata('status','Registered Successfully!');
			redirect(base_url('login'));
		}else
		{
			$this->session->set_flashdata('status','Something went wrong');
			redirect(base_url('register'));
		}

		}
	}
}
