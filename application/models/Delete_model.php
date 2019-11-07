<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_model extends CI_Model
{
    public function delete_post_by_id($id)
    {
        $sql = "DELETE FROM posts WHERE id='".$id."'";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
}