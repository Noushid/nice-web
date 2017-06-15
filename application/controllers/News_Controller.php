<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 26/4/17
 * Time: 10:27 AM
 */

defined('BASEPATH') or exit('No Direct Script Access Allowed');
require_once(APPPATH . 'core/Check_Logged.php');

class News_Controller extends Check_Logged
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_Model', 'news');
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
        $data = $this->news->select();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function store()
    {
        $this->form_validation->set_rules('heading', 'Heading', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
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
                $resize_error = [];
                if ($file_id and $this->news->add($post_data)) {
                    /*****Create Thumb Image****/
                    $img_cfg['source_image'] = getwdir() . 'uploads/' . $uploaded->file_name;
                    $img_cfg['maintain_ratio'] = TRUE;
                    $img_cfg['new_image'] = getwdir() . 'uploads/thumb/thumb_' . $uploaded->file_name;
                    $img_cfg['quality'] = 99;
                    $img_cfg['master_dim'] = 'height';

                    $this->image_lib->initialize($img_cfg);
                    if (!$this->image_lib->resize()) {
                        $resize_error[] = $this->image_lib->display_errors();
                    }
                    $this->image_lib->clear();

                    /********End Thumb*********/

                    /*resize and create thumbnail image*/
                    if ($uploaded->file_size > 1024) {
                        $img_cfg['image_library'] = 'gd2';
                        $img_cfg['source_image'] = getwdir() . 'uploads/' . $uploaded->file_name;
                        $img_cfg['maintain_ratio'] = TRUE;
                        $img_cfg['new_image'] = getwdir() . 'uploads/' . $uploaded->file_name;
                        $img_cfg['height'] = 500;
                        $img_cfg['quality'] = 100;
                        $img_cfg['master_dim'] = 'height';

                        $this->image_lib->initialize($img_cfg);
                        if (!$this->image_lib->resize()) {
                            $resize_error[] = $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();

                        /********End resize*********/


                        if (empty($resize_error)) {
                            $this->output->set_content_type('application/json')->set_output(json_encode($post_data));
                        } else {
                            $this->output->set_status_header(402, 'Server Down');
                            $this->output->set_content_type('application/json')->set_output(json_encode($resize_error));
                        }
                    } else {
                        $this->output->set_content_type('application/json')->set_output(json_encode($post_data));
                    }
                }
            } else {
                if ($this->news->add($post_data)) {
                    $this->output->set_content_type('application/json')->set_output(json_encode($post_data));
                } else {
                    $this->output->set_status_header(402, 'Server Down');
                    $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Add Error']));
                }
            }
        }
    }

    function update($id)
    {
        $this->form_validation->set_rules('heading', 'Heading', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
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
                $data['heading'] = $this->input->post('heading');
                $data['content'] = $this->input->post('content');
                $data['date'] = $date;

                if ($this->news->edit($data,$id)) {
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
                    $data['heading'] = $this->input->post('heading');
                    $data['content'] = $this->input->post('content');
                    $data['date'] = $date;
                    $data['file_id'] = $file_id;
                    if ($this->news->edit($data, $id)) {
                        if ($this->input->post('file_id') != 'null') {
                            if ($this->file->remove($this->input->post('file_id'))) {
                                if (file_exists(getwdir() . 'uploads/' . $this->input->post('file_name'))) {
                                    unlink(getwdir() . 'uploads/' . $this->input->post('file_name'));
                                }
                            }
                        }
                        /*****Create Thumb Image****/
                        $img_cfg['source_image'] = getwdir() . 'uploads/' . $uploaded->file_name;
                        $img_cfg['maintain_ratio'] = TRUE;
                        $img_cfg['new_image'] = getwdir() . 'uploads/thumb/thumb_' . $uploaded->file_name;
                        $img_cfg['quality'] = 99;
                        $img_cfg['master_dim'] = 'height';

                        $this->image_lib->initialize($img_cfg);
                        if (!$this->image_lib->resize()) {
                            $resize_error[] = $this->image_lib->display_errors();
                        }
                        $this->image_lib->clear();

                        /********End Thumb*********/

                        /*resize and create thumbnail image*/
                        if ($uploaded->file_size > 1024) {
                            $img_cfg['image_library'] = 'gd2';
                            $img_cfg['source_image'] = getwdir() . 'uploads/' . $uploaded->file_name;
                            $img_cfg['maintain_ratio'] = TRUE;
                            $img_cfg['new_image'] = getwdir() . 'uploads/' . $uploaded->file_name;
                            $img_cfg['height'] = 500;
                            $img_cfg['quality'] = 100;
                            $img_cfg['master_dim'] = 'height';

                            $this->image_lib->initialize($img_cfg);
                            if (!$this->image_lib->resize()) {
                                $resize_error[] = $this->image_lib->display_errors();
                            }
                            $this->image_lib->clear();

                            /********End resize*********/


                            if (empty($resize_error)) {
                                $this->output->set_content_type('application/json')->set_output(json_encode($date));
                            } else {
                                $this->output->set_status_header(402, 'Server Down');
                                $this->output->set_content_type('application/json')->set_output(json_encode($resize_error));
                            }
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

    function delete_image($id)
    {

        $news = $this->news->select_where(['id' => $id]);

        if ($this->file->remove($news[0]->file_id)) {
            $data['file_id'] = null;
            if ($this->news->edit($data,$id)) {
                if (file_exists(getwdir() . 'uploads/' . $news[0]->file_name)) {
                    unlink(getwdir() . 'uploads/' . $news[0]->file_name);
                }
                $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'Image Delete']));
            }
        }else{
            $this->output->set_status_header(400, 'Server Down');
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Try again later']));
        }
    }

    function upload()
    {
        $config['upload_path'] = getwdir() . 'uploads';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG';
        $config['max_size'] = 4096;
        $config['file_name'] = 'N_' . rand();
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
        $news = $this->news->select_where(['id' => $id]);
        if ($this->news->remove($id)) {
            if ($this->file->remove($news[0]->file_id) && file_exists(getwdir() . 'uploads/' . $news[0]->file_name)) {
                unlink(getwdir() . 'uploads/' . $news[0]->file_name);
                $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'News Deleted']));
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode(['msg' => 'News Deleted and file delete error']));
            }
        } else {
            $this->output->set_status_header(500, 'Server Down');
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Delete Error']));
        }
    }


}