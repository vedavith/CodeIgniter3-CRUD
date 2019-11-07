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
}