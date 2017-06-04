<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sch_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function cat_school(){


    $data = $this->db->select()->from('school')->get()->result_array();
		return  $data;

		}
    public function ins_school($data){


    	$this->db->insert('school',$data);

    }
		public function del_Course($cid){

    			$data =  $this->db->delete('course', array('cid' => $cid));
 					return $data;
		}
    public function selectsch($schname){

			$data =$this->db->select()->where('schname',$schname)->from('school')->get()->result_array();

			return  $data;

	     	}
		 public function serachsch($serach){
				      $array = array('schname'=>$serach);
							$data = $this->db->where($array)->from('school')->get()->result_array();
							return $data;

				}

    }
