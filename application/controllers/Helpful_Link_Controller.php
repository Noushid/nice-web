<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 4/5/17
 * Time: 1:02 PM
 */

defined('BASEPATH') or exit('No Direct Script Access Allowed');
require_once(APPPATH . 'core/Check_Logged.php');

class Helpful_Link_Controller extends Check_Logged
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Helpful_Links_Model', 'helpful_link');

        if (!$this->logged) {
            redirect(base_url('login'));
        }
    }

    function index()
    {

    }

    function get_all()
    {
        $data = $this->helpful_link->select();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation Error');
            $this->output->set_content_type('application/json')->set_output(json_encode(validation_errors()));
        } else {
            $post_data = $this->input->post();
            if ($this->helpful_link->add($post_data)) {
                $this->output->set_content_type('application/json')->set_output(json_encode($post_data));
            }
            else {
                $this->output->set_status_header(500, 'Server Down');
                $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Add error.Try again later']));
            }
        }
    }

    function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation Error');
            $this->output->set_content_type('application/json')->set_output(json_encode(validation_errors()));
        } else {
            $data['name'] = $this->input->post('name');
            $data['link'] = $this->input->post('link');
            if ($this->helpful_link->edit($data, $id)) {
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }else{
                $this->output->set_status_header(402, 'Server Down');
                $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Server Error']));
            }
        }
    }

    public function delete($id)
    {
        $helpful_link = $this->helpful_link->select_where(['id' => $id]);
        if ($helpful_link != FALSE) {
            if ($this->helpful_link->remove($id)) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Brochure Deleted.']));
            } else {
                $this->output->set_status_header(500, 'Server Down');
                $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Delete Error']));
            }
        }else{
            $this->output->set_status_header(404, 'Not found');
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'The record Not found']));
        }
    }


}