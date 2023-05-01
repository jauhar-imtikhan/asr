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
}
