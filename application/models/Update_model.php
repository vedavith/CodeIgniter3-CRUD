<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_model extends CI_Model
{
    public function update_post($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('posts', $data);
        return $affected =  $this->db->affected_rows();
    }
}