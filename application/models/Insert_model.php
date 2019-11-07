<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insert_model extends CI_Model
{
    public function post_insert($data)
    {
         $this->db->insert('posts',$data);
        return $this->db->affected_rows();
    }
}
