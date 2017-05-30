<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cour_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function cat_Course(){


    $data = $this->db->select()->from('course')->get()->result_array();
		return  $data;

		}

    }
