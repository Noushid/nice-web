<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 4/5/17
 * Time: 1:02 PM
 */

defined('BASEPATH') or exit('No Direct Script Access Allowed');
require_once(APPPATH . 'core/Check_Logged.php');

class Brochure_Controller extends Check_Logged
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Brochures_Model', 'brochure');
        $this->load->model('Files_Model', 'file');

        $this->load->library(['upload', 'image_lib']);

        if (!$this->logged) {
            redirect(base_url('login'));
        }
    }

    function index()
    {

    }

    function get_all()
    {
        $data = $this->brochure->select();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation Error');
            $this->output->set_content_type('application/json')->set_output(json_encode(validation_errors()));
        } else {
            $post_data = $this->input->post();
            $uploaded = json_decode($post_data['uploaded']);

            unset($post_data['uploaded']);

            if (!empty($uploaded)) {
                /*INSERT FILE DATA TO DB*/

                $file_data['file_name'] = $uploaded->file_name;
                $file_data['file_type'] = $uploaded->file_type;
                $file_data['size'] = $uploaded->file_size;
                $file_data['date'] = $this->input->post('date');

                $file_id = $this->file->add($file_data);

                $post_data['file_id'] = $file_id;
                if ($file_id and $this->brochure->add($post_data)) {
                    $this->output->set_content_type('application/json')->set_output(json_encode($post_data));
                }
            } else {
                $this->output->set_status_header(403, 'Validation Error');
                $this->output->set_content_type('application/json')->set_output(json_encode(['validation_error' => 'select any file']));
            }
        }
    }

    function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation Error');
            $this->output->set_content_type('application/json')->set_output(json_encode(validation_errors()));
        } else {
            if ($this->input->post('date') == '0000-00-00') {
                $date = null;
            }else{
                $date = $this->input->post('date');
            }

            $uploaded = json_decode($this->input->post('uploaded'));
            if (empty($uploaded)) {
                $data['name'] = $this->input->post('name');
                $data['subject'] = $this->input->post('subject');
                $data['date'] = $date;

                if ($this->brochure->edit($data,$id)) {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Updated']));
                } else {
                    $this->output->set_status_header(500, 'Server Down');
                    $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'server Down']));
                }
            } else {
                $file_data['file_name'] = $uploaded->file_name;
                $file_data['file_type'] = $uploaded->file_type;
                $file_data['size'] = $uploaded->file_size;
                $file_data['date'] = $date;

                $file_id = $this->file->add($file_data);
                if ($file_id) {
                    $data = [];
                    $data['name'] = $this->input->post('name');
                    $data['subject'] = $this->input->post('subject');
                    $data['date'] = $date;
                    $data['file_id'] = $file_id;
                    if ($this->brochure->edit($data, $id)) {
                        if ($this->input->post('file_id') != 'null') {
                            if ($this->file->remove($this->input->post('file_id'))) {
                                if (file_exists(getwdir() . 'uploads/' . $this->input->post('file_name'))) {
                                    unlink(getwdir() . 'uploads/' . $this->input->post('file_name'));
                                }
                            }
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        } else {
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        }
                    }else{
                        $this->output->set_status_header(402, 'Server Down');
                        $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Server Error']));
                    }
                }

            }
        }
    }

    function upload()
    {
        $config['upload_path'] = getwdir() . 'uploads';
        $config['allowed_types'] = 'pdf|docx|doc|xlsx|word|csv|odt|odp|ods';
        $config['max_size'] = 4096;
        $config['file_name'] = 'B_' . rand();
        $config['multi'] = 'ignore';
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $this->output->set_content_type('application/json')->set_output(json_encode($this->upload->data()));
        }else{
            $this->output->set_status_header(401, 'File Upload Error');
            $this->output->set_content_type('application/json')->set_output(json_encode($this->upload->display_errors()));
        }
    }



    public function delete($id)
    {
        $brochure = $this->brochure->select_where(['id' => $id]);
        if ($this->brochure->remove($id)) {
            if ($this->file->remove($brochure[0]->file_id) && file_exists(getwdir() . 'uploads/' . $brochure[0]->file_name)) {
                unlink(getwdir() . 'uploads/' . $brochure[0]->file_name);
                $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Brochure Deleted']));
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Brochure Deleted and file delete error']));
            }
        } else {
            $this->output->set_status_header(500, 'Server Down');
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Delete Error']));
        }
    }


}