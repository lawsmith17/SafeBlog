<?php

class ArticleModel extends CI_Model
{

    public function fetch_all_article()
    {
$result = $this->db->query("SELECT `blogid`, `blog_title`, `blog_desc`, `blog_img`, `status`, `created_on`, `updated_on` FROM `articles` WHERE `status`='1'");
   

return $result->result_array();

}

public function fetch_blog_detail($blog_id)
{
$result = $this->db->query("SELECT `blogid`, `blog_title`, `blog_desc`, `blog_img`, `status`, `created_on`, `updated_on` FROM `articles` WHERE `blogid`='$blog_id'");
   

return $result->result_array();
}


}

?>