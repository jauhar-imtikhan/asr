<?php

use PhpParser\Builder\Class_;

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function getbyid($id)
    {
        $query = $this->db->get_where('user', ['email' => $id])->row_array();
        return $query;
    }

    public function rowId($id)
    {
        $this->db->get_where('user', ['user_id' => $id])->result_array();
    }

    public function user_login($id = null)
    {
        $this->db->from('user');
        $this->db->join('level', 'level.level_id=user.level');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function updateProfile($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
    }
}
