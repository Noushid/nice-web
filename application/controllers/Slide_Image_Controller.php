<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 4/5/17
 * Time: 1:02 PM
 */

defined('BASEPATH') or exit('No Direct Script Access Allowed');
require_once(APPPATH . 'core/Check_Logged.php');

class Slide_Image_Controller extends Check_Logged
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Slide_Image_Model', 'slide_image');
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
        $data = $this->slide_image->select();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function store()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $uploaded = json_decode($this->input->post('uploaded'));
            if (!empty($uploaded)) {
                foreach ($uploaded as $value) {
                    $data = [];
                    $data['file_name'] = $value->file_name;
                    $data['file_type'] = $value->file_type;
                    $data['size'] = $value->file_size;
                    $data['date'] = date('Y-m-d');
                    $file_id = $this->file->add($data);
                    if ($file_id) {
                        $slide_data['file_id'] = $file_id;
                        if ($this->slide_image->add($slide_data)) {

                            /************resize and create thumbnail image*******/

                            if ($value->image_width > 1920 OR $value->image_width < 1920) {
                                $img_cfg['image_library'] = 'gd2';
                                $img_cfg['source_image'] = getwdir() . 'uploads/' . $value->file_name;
                                $img_cfg['maintain_ratio'] = TRUE;
                                $img_cfg['new_image'] = getwdir() . 'uploads/' . $value->file_name;
                                $img_cfg['width'] = 1920;
                                $img_cfg['quality'] = 80;
                                $img_cfg['master_dim'] = 'width';

                                $this->image_lib->initialize($img_cfg);
                                if (!$this->image_lib->resize()) {
                                    $resize_error[] = $this->image_lib->display_errors();
                                }
                                $this->image_lib->clear();

                                /********End resize*********/
                                $this->output->set_content_type('application/json')->set_output(json_encode('Upload success'));
                            }
                        }else{
                            $this->output->set_status_header(400, 'Server Down');
                            $this->output->set_content_type('application/json')->set_output(json_encode('Add error.try again later'));
                        }
                    }
                }
            } else {
                $this->output->set_status_header(400, 'Validation Error');
                $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Select an image']));
            }
        } else {
            show_404();
        }
    }

    function update($id)
    {
    }

    function upload()
    {
        $config['upload_path'] = getwdir() . 'uploads';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG';
        $config['max_size'] = 4096;
        $config['file_name'] = 'S_' . rand();
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
        $slide_image = $this->slide_image->select_where(['slide_images.id' => $id]);
        if ($slide_image) {
            if ($this->slide_image->remove($id)) {
                if ($this->file->remove($slide_image[0]->file_id) && file_exists(getwdir() . 'uploads/' . $slide_image[0]->file_name)) {
                    unlink(getwdir() . 'uploads/' . $slide_image[0]->file_name);
                    $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Slide Image Deleted']));
                } else {
                    $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Slide Image Deleted and file delete error']));
                }
            } else {
                $this->output->set_status_header(500, 'Server Down');
                $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Delete Error']));
            }
        } else {
            $this->output->set_status_header(400, '404');
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Record Not found']));
        }
    }

}