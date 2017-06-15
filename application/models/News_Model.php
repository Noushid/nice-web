<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 25/4/17
 * Time: 4:42 PM
 */

defined('BASEPATH') or exit ('No direct script access allowed');
require_once APPPATH . 'core/My_Model.php';

class News_Model extends My_Model
{

    protected $table = 'news';
    protected $fields = [
        'news.*',
        'files.id fileId',
        'files.file_name',
        'files.file_type'
    ];

    function __construct()
    {
        parent::__construct();
    }

    public function select($limit = "", $order = "")
    {
//        $this->db->select($this->fields);
        $this->db->from($this->table);
        if ($limit != "") {
            $this->db->limit($limit);
        }
        if ($order != "") {
            $this->db->order_by('id', $order);
        }

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $data = $result->result();
            foreach ($data as $value) {
                if ($value->file_id != null) {
                    $query = $this->db->get_where('files', ['id' => $value->file_id]);
                    if ($query->num_rows() > 0) {
                        $file = $query->result();
                        $value->file_name = $file[0]->file_name;
                        $value->file_type = $file[0]->file_type;
                        $value->imgUrl = public_url() . 'uploads/' . $file[0]->file_name;
                        $value->thumbImgUrl = public_url() . 'uploads/thumb/thumb_' . $file[0]->file_name;
                    }
                }
            }
            return $data;
        }else
            return FALSE;
    }

    public function select_where(array $where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $data = $result->result();
            foreach ($data as $value) {
                if ($value->file_id != null) {
                    $query = $this->db->get_where('files', ['id' => $value->file_id]);
                    if ($query->num_rows() > 0) {
                        $file = $query->result();
                        $value->file_name = $file[0]->file_name;
                        $value->file_type = $file[0]->file_type;
                        $value->imgUrl = public_url() . 'uploads/' . $file[0]->file_name;
                        $value->thumbImgUrl = public_url() . 'uploads/thumb/thumb_' . $file[0]->file_name;
                    }
                }
            }
            return $data;
        }else
            return FALSE;
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

