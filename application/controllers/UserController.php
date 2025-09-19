<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	
	

	public function index()
	{
		$this->load->model('ArticleModel',"am");

		$result = $this->am->fetch_all_article();

		//print_r($result); die();

		$data['result'] = $result;

		$this->load->view('userviews/userhome',$data);
	}

//passing the blog id into the blog_detail view
	public function blog_detail($blog_id=0)
	{
		//die($blog_id);
		$this->load->model('ArticleModel',"am");
		$result = $this->am->fetch_blog_detail($blog_id);
$data['result'] = $result;

$this->load->view('userviews/blog_detail',$data);
	}
}
