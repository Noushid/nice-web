<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 25/4/17
 * Time: 4:48 PM
 */


defined('BASEPATH') or exit ('No direct script access allowed');
require_once APPPATH . 'core/My_Model.php';

class Gallery_Files_Model extends My_Model
{

    protected $table = 'gallery_files';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Return ALL galleries with their files ie,album model
     *
     */
    public function select($limit = null, $order = null)
    {
        $this->db->from('galleries');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($order != null) {
            $this->db->order_by('id', 'DESC');
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $galleries = $query->result();
            foreach ($galleries as $value) {
                $this->db->from('gallery_files');
                $this->db->where('gallery_id', $value->id);
                $glr_fls_query = $this->db->get();
                $gallery_files = $glr_fls_query->result();
                foreach ($gallery_files as $val) {
                    $this->db->from('files');
                    $this->db->where('id', $val->file_id);
                    $files_query = $this->db->get();
                    $files = $files_query->result();
                    foreach ($files as $file) {
                        $val->file_name = $file->file_name;
                        $val->file_type = $file->file_type;
                        $val->gallery_file_id = $val->id;
                        $val->thumbImgUrl = public_url() . 'uploads/thumb/thumb_' . $file->file_name;
                        $val->imgUrl = public_url() . 'uploads/' . $file->file_name;
                    }
                }
                $value->files = $gallery_files;
            }
            return $galleries;
        }else
            return FALSE;

    }

    /**
     * Return ONE gallery with their files ie,album model
     *
     */
    public function select_where($galery_id, $limit = null, $order = null)
    {
        $this->db->from('galleries');
        $this->db->where('id', $galery_id);
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($order != null) {
            $this->db->order_by('id', 'DESC');
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $galleries = $query->result();
            foreach ($galleries as $value) {
                $this->db->from('gallery_files');
                $this->db->where('gallery_id', $value->id);
                $glr_fls_query = $this->db->get();
                $gallery_files = $glr_fls_query->result();
                foreach ($gallery_files as $val) {
                    $this->db->from('files');
                    $this->db->where('id', $val->file_id);
                    $files_query = $this->db->get();
                    $files = $files_query->result();
                    foreach ($files as $file) {
                        $val->file_name = $file->file_name;
                        $val->file_type = $file->file_type;
                        $val->gallery_file_id = $val->id;
                    }
                }
                $value->files = $gallery_files;
            }
            return $galleries;
        }else
            return FALSE;

    }


    /**
     *return all gallery files one by one
     *
     */
    public function select_all($limit = null, $order = null)
    {
        $this->db->from('galleries');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($order != null) {
            $this->db->order_by($order, 'DESC');
        }
        $all_files = [];
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $galleries = $query->result();
            foreach ($galleries as $value) {
                $this->db->from('gallery_files');
                $this->db->where('gallery_id', $value->id);
                $glr_fls_query = $this->db->get();
                $gallery_files = $glr_fls_query->result();
                foreach ($gallery_files as $val) {
                    $this->db->from('files');
                    $this->db->where('id', $val->file_id);
                    $files_query = $this->db->get();
                    $files = $files_query->result();
                    foreach ($files as $file) {
                        $val->thumbUrl = public_url() . 'uploads/thumb/thumb_' . $file->file_name;
                        $val->url = public_url() . 'uploads/' . $file->file_name;
                        $val->alt = 'gallery';
                        $val->category = $value->name;
                        $val->description = $value->description;
                        array_push($all_files, $val);
                    }
                }
            }
            return $all_files;
        }else
            return FALSE;
    }

    public function select_gl_fl_where(array $where)
    {
        $this->db->select(['gallery_files.*', 'files.id as filId', 'files.file_name', 'files.file_type']);
        $this->db->from($this->table);
        $this->db->join('files', 'files.id = gallery_files.file_id', 'full');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
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

