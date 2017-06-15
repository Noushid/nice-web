<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 25/4/17
 * Time: 3:36 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class App
 *
 */

class App extends CI_Controller
{

    protected $limit = 10;

    function __construct()
    {
        parent::__construct();
        require_once '../vendor/fzaninotto/faker/src/autoload.php';
//        can only be called from the command line!
        if (!$this->input->is_cli_request()) {
            exit('Direct Access Not Allowed');
        }

//        can only run in the development environment
        if (ENVIRONMENT !== 'development') {
            exit('Wowesers! You don\'t want to do that');
        }

//        initiate faker
        $this->faker = Faker\Factory::create();

//        Required Models
        $this->load->model('Blog_Model', 'blog');
        $this->load->model('Brochures_Model', 'brochure');
        $this->load->model('Files_Model', 'file');
        $this->load->model('Galleries_Model', 'gallery');
        $this->load->model('Gallery_Files_Model', 'gallery_file');
        $this->load->model('Helpful_Links_Model', 'helpful_link');
        $this->load->model('News_Model', 'news');
        $this->load->model('Slide_Image_Model', 'slide_image');
        $this->load->model('Users_Model', 'user');

    }

    function truncate()
    {
        $this->_truncate_db();
    }

    /**
     * Seed local database
    */

    function seed($tabel = "")
    {
        $this->truncate();

        $this->_seed_users(1);
        $this->_seed_blog($this->limit);
        $this->_seed_brochure($this->limit);
        $this->_seed_files(5);
        $this->_seed_gallery($this->limit);
        $this->_seed_gallery_files($this->limit);
        $this->_seed_helpful_link($this->limit);
        $this->_seed_news($this->limit);
        $this->_seed_slide_image($this->limit);
    }

    function _seed_users($limit)
    {
        echo "seeding $limit users";

        // create a bunch of base buyer accounts
        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'username' => 'admin', // get a unique nickname
                'password' => hash('sha256', 'admin'), // run this via your password hashing function
            );

            $this->user->add($data);
        }

        echo PHP_EOL;
    }

    function _seed_news($limit)
    {
        echo "seeding $limit news";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'heading' => $this->faker->sentence(4),
                'content' => $this->faker->paragraph(3),
                'date' => $this->faker->date(),
                'file_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            ];

            $this->news->add($data);
        }
        echo PHP_EOL;

    }

    function _seed_slide_image($limit)
    {
        echo "seeding $limit slide_images";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'file_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            ];

            $this->slide_image->add($data);
        }
        echo PHP_EOL;
    }

    function _seed_brochure($limit)
    {
        echo "seeding $limit brochures";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'name' => $this->faker->name,
                'subject' => $this->faker->sentence(3),
                'date' => $this->faker->date(),
                'file_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            ];

            $this->brochure->add($data);
        }
        echo PHP_EOL;
    }

    function _seed_gallery($limit)
    {
        echo "seeding $limit gallery";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'gallery_name' => $this->faker->name,
                'description' => $this->faker->sentence(5),
            ];

            $this->gallery->add($data);
        }
        echo PHP_EOL;
    }


    function _seed_gallery_files($limit)
    {
        echo "seeding $limit gallery_files";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'gallery_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                'file_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            ];

            $this->gallery_file->add($data);
        }
        echo PHP_EOL;
    }

    function _seed_helpful_link($limit)
    {
        echo "seeding $limit helpful links";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'name' => $this->faker->name,
                'link' => $this->faker->url,
            ];

            $this->helpful_link->add($data);
        }
        echo PHP_EOL;
    }

    function _seed_blog($limit)
    {
        echo "seeding $limit blogs";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'name' => $this->faker->name,
                'heading' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(4),
                'date' => $this->faker->date(),
                'file_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            ];

            $this->blog->add($data);
        }
        echo PHP_EOL;
    }

    function _seed_files($limit)
    {
        echo "seeding $limit files";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";
            $data = [
                'file_name' => $this->faker->image($dir = FCPATH . 'uploads', $width = 640, $height = 480, 'cats', false),
                'file_type' => $this->faker->fileExtension,
                'size' => $this->faker->randomElement([1200, 500, 6000, 5654]),
                'date' => $this->faker->date()
            ];

            $this->file->add($data);
        }
        echo PHP_EOL;
    }


    function _truncate_db()
    {
        $this->user->trunc();
        $this->blog->trunc();
        $this->brochure->trunc();
        $this->file->trunc();
        $this->gallery->trunc();
        $this->gallery_file->trunc();
        $this->helpful_link->trunc();
        $this->news->trunc();
        $this->slide_image->trunc();
    }
}