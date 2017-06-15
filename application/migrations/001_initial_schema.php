<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 25/4/17
 * Time: 3:48 PM
 */

defined('BASEPATH') or exit('No direct Script Access Allowed');

/**
 * Class Migration_initial_schema
 */

class Migration_initial_schema extends CI_Migration
{
    public function up()
    {
        /*
        ////////////////////////////////////////////////////////////////////
       |                                                                   |
       |                 USERS                                             |
       |                                                                   |
       /////////////////////////////////////////////////////////////////////
       */

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '56',
                'unique' => TRUE,
            ],
            'password' => [
                'type' => 'LONGTEXT'
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');


        /*
       /////////////////////////////////////////////////////////////////////
       |                                                                   |
       |                 FILES                                             |
       |                                                                   |
       /////////////////////////////////////////////////////////////////////
       */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ],
            'file_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ],
            'size' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => TRUE
            ],
            'date' => [
                'type' => 'DATE',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('files');



        /*
      /////////////////////////////////////////////////////////////////////
      |                                                                   |
      |                 NEWS                                             |
      |                                                                   |
      /////////////////////////////////////////////////////////////////////
      */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'heading' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'date' => [
                'type' => 'DATE',
                'null' => TRUE
            ],
            'file_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('news');

        /*
   /////////////////////////////////////////////////////////////////////
   |                                                                   |
   |                 SLIDE IMAGE                                       |
   |                                                                   |
   /////////////////////////////////////////////////////////////////////
   */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'file_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('slide_images');


   /*
   /////////////////////////////////////////////////////////////////////
   |                                                                   |
   |                 BROCHURE                                             |
   |                                                                   |
   /////////////////////////////////////////////////////////////////////
   */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'subject' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'date' => [
                'type' => 'DATE',
                'null' => TRUE
            ],
            'file_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('brochures');


    /*
   /////////////////////////////////////////////////////////////////////
   |                                                                   |
   |                 GALLERY                                           |
   |                                                                   |
   /////////////////////////////////////////////////////////////////////
   */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'gallery_name' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('galleries');

    /*
   /////////////////////////////////////////////////////////////////////
   |                                                                   |
   |                 GALLERY_FILES                                     |
   |                                                                   |
   /////////////////////////////////////////////////////////////////////
   */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'file_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ],
            'gallery_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('gallery_files');



   /*
   /////////////////////////////////////////////////////////////////////
   |                                                                   |
   |                 HELPFUL_LINKS                                     |
   |                                                                   |
   /////////////////////////////////////////////////////////////////////
   */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'link' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('helpful_links');




        /*
        /////////////////////////////////////////////////////////////////////
        |                                                                   |
        |                 BLOGS                                             |
        |                                                                   |
        /////////////////////////////////////////////////////////////////////
        */


        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'heading' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => TRUE
            ],
            'date' => [
                'type' => 'DATE',
                'null' => TRUE
            ],
            'file_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id' ,TRUE);
        $this->dbforge->create_table('blogs');


        /*
        /////////////////////////////////////////////////////////////////////
        |                                                                   |
        |                 SUBSCRIPTIONS                                       |
        |                                                                   |
        /////////////////////////////////////////////////////////////////////
        */

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'email' => [
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'active' => [
                'type' => 'INT',
                'null' => TRUE,
                'default' => 1
            ],
            'ip' => [
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('subscriptions');
    }


    function down()
    {
        $this->dbforge->drop_table('users');
        $this->dbforge->drop_table('files');
        $this->dbforge->drop_table('news');
        $this->dbforge->drop_table('slide_images');
        $this->dbforge->drop_table('brochures');
        $this->dbforge->drop_table('galleries');
        $this->dbforge->drop_table('gallery_files');
        $this->dbforge->drop_table('helpful_links');
        $this->dbforge->drop_table('blogs');
        $this->dbforge->drop_table('subscription');
    }

}
