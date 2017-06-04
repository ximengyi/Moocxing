<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busine_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function cat_business(){


    $data = $this->db->select()->from('business')->get()->result_array();
		return  $data;

		}
    public function ins_business($business){


    	$this->db->insert('business',$business);

    }
		public function del_Course($cid){

    			$data =  $this->db->delete('course', array('cid' => $cid));
 					return $data;
		}
    public function selectbus($schname){

			$data =$this->db->select()->where('schname',$schname)->from('business')->get()->result_array();

			return  $data;

	     	}

    }
