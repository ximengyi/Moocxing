<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stu_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function ins_stu($data){


     	$this->db->insert('student',$data);

		}

		public function sturecord(){
		//$data = $this->db->select('record_id,moocid,type,title,grade,name,state,approver,time')->from('record')->order_by('record_id','desc')->get()->result_array();
	  	//$array = array('moocid'=>$moocid,'state' => '未通过');
		//	$data = $this->db->where($array)->from('record')->order_by('record_id','desc')->get()->result_array();
			    $data = $this->db->select()->from('student')->get()->result_array();

				 //	  $query = $this->db->('student');
		      	return  $data;

	 }

	 public function countResult($table){

		 $this->db->count_all_results($table);

	 }

	 public function ins_course($data){

		 $this->db->insert('course',$data);

	 }



    }
