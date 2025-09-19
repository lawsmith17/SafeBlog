<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	
	public function index()
	{
		$this->load->view('adminviews/adminhome');
	}

     public function addblog()
    {

        $this->load->view('adminviews/addblog');
    }

	 public function viewblog()
    {

		$query = $this->db->query("SELECT * FROM `articles` ORDER BY `blogid` DESC;");

        $data['result'] = $query->result_array();

        $this->load->view('adminviews/viewblog',$data);
    }
	  public function editblog($blog_id)
    {
        // print_r($blog_id);
        //we getting the articles from the data base and passing the records into our editblog view
        $query = $this->db->query("SELECT  `blog_title`, `blog_desc`, `blog_img`FROM `articles` WHERE `blogid` ='$blog_id'");
        $data['result'] = $query->result_array();
        $data['blog_id'] = $blog_id;




        $this->load->view('adminviews/editblog', $data);
    }

	 public function editblog_post()
    {
        
        if ($_FILES['file']['name']) {
            

            //updating everything with the image that means the user wants to chamge the current image
            $config['upload_path']          = './assets/upload/blogimg/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';


            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                die("Error");
               
            } else {
                $data = array('upload_data' => $this->upload->data());

                $filename_location = "assets/upload/blogimg/" . $data['upload_data']['file_name'];
                $blog_title = $_POST['blog_title'];
                $desc = $_POST['desc'];
                $blog_id = $_POST['blog_id'];


                $query = $this->db->query("UPDATE `articles` SET `blog_title`='$blog_title',`blog_desc`='$desc',`blog_img`='$filename_location' WHERE `blogid` ='$blog_id'");

                if ($query) {
                    $this->session->set_flashdata('updated', 'yes');
                    redirect(base_url('viewblog'));
                } else {
                    $this->session->set_flashdata('updated', 'no');
                    redirect(base_url('viewblog'));
                }
            }
        } else {


            // die("Update without file");
            //updating everything without the image that means the user wants to change the other fields without the image
            $blog_title = $_POST['blog_title'];
            $desc = $_POST['desc'];
            $blog_id = $_POST['blog_id'];


            $query = $this->db->query("UPDATE `articles` SET `blog_title`='$blog_title',`blog_desc`='$desc' WHERE `blogid` ='$blog_id'");

            if ($query) {
                $this->session->set_flashdata('updated', 'yes');
                redirect(base_url('viewblog'));
            } else {
                $this->session->set_flashdata('updated', 'no');
                redirect(base_url('viewblog'));
            }
        }
    }

	public function deleteblog()
    {
        

        $delete_id = $_POST['delete_id'];

        $query = $this->db->query("DELETE FROM `articles` WHERE `blogid` = '$delete_id'");

        if ($query) {
            echo "deleted";
        } else {
            echo "notdeleted";
        }
    }


	 function addblog_post()
    {
        // print_r($_POST);
        // print_r($_FILES);

        if ($_FILES) {
            //Image is passed for upload
            $config['upload_path']          = './assets/upload/blogimg/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';


            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                die("Error");
               
            } else {
                $data = array('upload_data' => $this->upload->data());
                // echo "<pre>";
                //print_r($data);
                //echo $data['upload_data']['file_name'];

                $fileurl = "assets/upload/blogimg/" . $data['upload_data']['file_name'];
                $blog_title = $_POST['blog_title'];
                $desc = $_POST['desc'];

                $query = $this->db->query("INSERT INTO `articles`(`blog_title`, `blog_desc`, `blog_img`) VALUES ('$blog_title','$desc','$fileurl')");

                if ($query) {
                    $this->session->set_flashdata('inserted', 'yes');
                    redirect('AdminController/addblog');
                } else {
                    $this->session->set_flashdata('inserted', 'no');
                    redirect('AdminController/addblog');
                }
                // $this->load->view('upload_success', $data);
            }
        } else {
            //Image is not passed for upload

        }
    }
}
