<?php

use PhpParser\Builder\Class_;

defined('BASEPATH') or exit('No direct script access allowed');

class USer_model extends CI_Model
{
    public function get()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }
}
