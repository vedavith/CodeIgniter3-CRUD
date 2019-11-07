<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('insert_model');
        $this->load->model('select_model');
        $this->load->model('delete_model');
    }

    public function index()
    {
        $this->create_blog();
    }

    private function create_blog()
    {
        $this->load->view('template/header');
        $data['get_posts'] = $this->select_model->select_post();
        $this->load->view('blogs/createblog', $data);
        $this->load->view('template/footer');
    }

    public function insert_post()
    {
        $data = array();

        $message = array();
        $message['success'] = null;
        $message['message'] = null;

        $data['post_name'] = $this->input->post('post_name');
        $data['post_message'] = $this->input->post('post_message');
        $data['post_tags'] = $this->input->post('post_tags');

        if ($this->insert_model->post_insert($data)) {
            $message['success'] = true;
            $message['message'] = 'inserted';
            echo json_encode($message);
        } else {
            $message['success'] = false;
            $message['message'] = 'problem in Insert';
            echo json_encode($message);
        }
    }

    public function delete_post()
    {
        $id = $this->input->post('id');
        $message = array();
        if ($this->delete_model->delete_post_by_id($id)) {
            $message['success'] = true;
            $message['message'] = 'Deleted';

            echo json_encode($message);
        } else { 
            $message['success'] = false;
            $message['message'] = 'Problem in deleting!!';

            echo json_encode($message);
        }
    }
}
