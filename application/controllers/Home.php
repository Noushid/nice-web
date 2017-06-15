<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 25/4/17
 * Time: 5:57 PM
 */
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Home extends CI_Controller
{
    protected $header = 'templates/header';
    protected $footer = 'templates/footer';
    
    function __construct()
    {
        parent::__construct();

        $this->load->library('session');

        $this->load->model('Brochures_Model', 'brochure');
        $this->load->model('News_Model', 'news');
        $this->load->model('Subscription_Model', 'subscription');
        $this->load->model('Slide_Image_Model', 'slide_image');
        $this->load->model('Gallery_Files_Model', 'gallery_files');
        $this->load->model('Blog_Model', 'blog');
    }

    public function login()
    {

        if ($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url('admin'));
            return FALSE;
        }

        $this->load->view('login');
    }

    public function test($page = 'test')
    {
        $this->load->view($this->header);
        $this->load->view($page);
        $this->load->view($this->footer);
    }

    public function index($page = 'index')
    {
        $data['slide_image'] = $this->_get_slide_images();
        $data['brochure'] = $this->_get_latest_brochure()[0];
        $data['news'] = $this->_get_news();
        $this->load->view($this->header);
        $this->load->view($page,$data);
        $this->load->view($this->footer);
    }

    public function about($page = 'about')
    {
        $this->load->view($this->header);
        $this->load->view($page);
        $this->load->view($this->footer);
    }

    public function team($page = 'team')
    {
        $this->load->view($this->header);
        $this->load->view($page);
        $this->load->view($this->footer);
    }

    public function service($page = 'service')
    {
        $this->load->view($this->header);
        $this->load->view($page);
        $this->load->view($this->footer);
    }

    public function moments($page = 'gallery')
    {
        $data['gallery'] = $this->_get_gallery();
        $this->load->view($this->header);
        $this->load->view($page,$data);
        $this->load->view($this->footer);
    }

    public function blog($page = 'blog')
    {
        $data['blog'] = $this->_get_blog();
        $this->load->view($this->header);
        $this->load->view($page,$data);
        $this->load->view($this->footer);
    }

    public function blogView($id)
    {
        $data['blog'] = $this->_get_blog($id);
        $data['blog_latest'] = $this->_get_latest_blog();
        $this->load->view($this->header);
        $this->load->view('blogView', $data);
        $this->load->view($this->footer);
    }

    public function contact($page = 'contact')
    {
        $this->load->view($this->header);
        $this->load->view($page);
        $this->load->view($this->footer);
    }

    public function _get_latest_brochure()
    {
        $data = $this->brochure->select($limit = 1, $order = 'DESC');
        return $data;
    }

    public function _get_news()
    {
        $data = $this->news->select($limit = 6, $order = 'DESC');
        return $data;
    }

    public function subscribe()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_mail');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_status_header(400, 'Validation Error');
            $this->output->set_output(validation_errors());
        } else {
            $data['email'] = $this->input->post('email');
            $data['ip'] = $this->get_client_ip();
            $data['date'] = date('Y-m-d');
            if ($this->subscription->add($data)) {
                $this->output->set_output('subscription success');
            } else {
                $this->output->set_status_header(500, 'Server Error');
                $this->output->set_output('subscription success');
            }
        }
    }

    public function check_mail($mail)
    {
        if ($this->subscription->select_where(['email' => $mail]) == FALSE) {
            return TRUE;
        } else {
            $this->form_validation->set_error_delimiters('<div style="color: #ff0000">', '</div>');
            $this->form_validation->set_message('check_mail', 'You Have Already Subscribed');
            return FALSE;
        }
    }

    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function unsubscribe($param1)
    {
        if ($this->subscription->unsub(['active' => 0],['email' => $param1])) {
            redirect(base_url(), 'refresh');
        }
    }

    public function _get_slide_images()
    {
        $data = $this->slide_image->select();
        return $data;
    }

    public function _get_gallery()
    {
        $data = $this->gallery_files->select();
        return $data;
    }

    public function _get_blog($id="")
    {
        if ($id != "") {
            $data = $this->blog->select_where(['id' => $id]);
            return $data;
        } else {
            $data = $this->blog->select();
            return $data;
        }
    }

    public function _get_latest_blog()
    {
        $data = $this->blog->select($limit = 8, $order = 'DESC');
        return $data;
    }

    public function request_quote()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation error');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $service = $this->input->post('service');
            $message = $this->input->post('message');


            $message = wordwrap($message, 70, "\n");

            $subject = 'Quote From :  ' . $name;

            $content = 'name    :   ' . $name . PHP_EOL . PHP_EOL;
            $content .= 'Quote from   :  ' . $email . PHP_EOL . PHP_EOL;
            $content .= 'Phone   :   ' . $phone . PHP_EOL . PHP_EOL;
            $content .= 'Requested Service   :   ' . $service . PHP_EOL . PHP_EOL;

            $content .= 'Message  :   ' . $message . PHP_EOL . PHP_EOL;

            $content = str_replace("\n.", "\n.", $content);

            $to = 'noushid@psybotechnologies.com';

            $headers = 'From:comments@psybotechnologies.com';

            if (mail($to, $subject, $content, $headers)) {
                $this->output->set_output("We will contact you soon!\n Thank you.");
            } else {
                $this->output->set_status_header(400, 'Unable to send mail');
                $this->output->set_output("Please try again later.");
            }
        }
    }

    public function appointment_request()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation error');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $service = $this->input->post('service');
            $message = $this->input->post('message');


            $message = wordwrap($message, 70, "\n");

            $subject = 'Appointment From :  ' . $name;

            $content = 'name    :   ' . $name . PHP_EOL . PHP_EOL;
            $content .= 'appointment from   :  ' . $email . PHP_EOL . PHP_EOL;
            $content .= 'Phone   :   ' . $phone . PHP_EOL . PHP_EOL;
            $content .= 'Requested Service   :   ' . $service . PHP_EOL . PHP_EOL;

            $content .= 'Message  :   ' . $message . PHP_EOL . PHP_EOL;

            $content = str_replace("\n.", "\n.", $content);

            $to = 'noushid@psybotechnologies.com';

            $headers = 'From:comments@psybotechnologies.com';

            if (mail($to, $subject, $content, $headers)) {
                $this->output->set_output("We will contact you soon!\n Thank you.");
            } else {
                $this->output->set_status_header(400, 'Unable to send mail');
                $this->output->set_output("Please try again later.");
            }
        }

    }

    public function contact_request()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400, 'Validation error');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $website = $this->input->post('website');
            $message = $this->input->post('message');


            $message = wordwrap($message, 70, "\n");

            $subject = 'Contact Request From :  ' . $name;

            $content = 'name    :   ' . $name . PHP_EOL . PHP_EOL;
            $content .= 'contact request   :  ' . $email . PHP_EOL . PHP_EOL;
            $content .= 'Phone   :   ' . $phone . PHP_EOL . PHP_EOL;
            $content .= 'Website   :   ' . $website . PHP_EOL . PHP_EOL;

            $content .= 'Message  :   ' . $message . PHP_EOL . PHP_EOL;

            $content = str_replace("\n.", "\n.", $content);

            $to = 'noushid@psybotechnologies.com';

            $headers = 'From:comments@psybotechnologies.com';

            if (mail($to, $subject, $content, $headers)) {
                $this->output->set_output("We will contact you soon!\n Thank you.");
            } else {
                $this->output->set_status_header(400, 'Unable to send mail');
                $this->output->set_output("Please try again later.");
            }
        }
    }
}