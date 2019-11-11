<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_model extends CI_Model
{
    public function select_post()
    {
        $sql = "SELECT * FROM posts";
        $result = $this->db->query($sql);
        return $result;
    }

    public function select_post_by_id($id)
    {
        $sql = "SELECT * FROM posts WHERE id='".$id."'";
        $result = $this->db->query($sql);
        return $result;
    }
}