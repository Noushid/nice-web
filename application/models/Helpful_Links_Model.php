<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 25/4/17
 * Time: 4:51 PM
 */


defined('BASEPATH') or exit ('No direct script access allowed');
require_once APPPATH . 'core/My_Model.php';

class Helpful_Links_Model extends My_Model
{

    protected $table = 'helpful_links';

    function __construct()
    {
        parent::__construct();
    }

    public function select()
    {
        return $this->get_all();
    }

    public function select_where(array $where)
    {
        return $this->get($where);
    }
    public function add($data)
    {
        return $this->insert($data);
    }

    public function edit($data, $id)
    {
        return $this->update($data, $id);
    }

    public function remove($id)
    {
        return $this->drop($id);
    }

    public function trunc()
    {
        return $this->truncate();
    }
}

