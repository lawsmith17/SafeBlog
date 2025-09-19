<?php

class AuthUserModel extends CI_Model
{
    public function registerUser($data)
    {
     return   $this->db->insert('users',$data);

    }

    //cheacking if the provided login details matchs the ones in the database
public function loginUser($data)
    {
         $this->db->select('*');
         $this->db->where('email',$data['email']);
         $this->db->where('password',$data['password']);
         $this->db->from('users');
         $this->db->limit(1);
         $query = $this->db->get();
         if($query->num_rows() == 1)
         {
            return $query->row();
         }else
         {
            return false;
         }

      

    }
}

?>