<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutController extends CI_Controller {

	//logout and destory the session
	public function index()
	{
		session_destroy();
		redirect("login");
	}
}
