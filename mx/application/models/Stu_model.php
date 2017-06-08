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

	 public function stu_in_cur($data){


 		$this->db->insert('sacourse',$data);

 	}

//查询课程记录信息
	public function curecord(){
	//$data = $this->db->select('record_id,moocid,type,title,grade,name,state,approver,time')->from('record')->order_by('record_id','desc')->get()->result_array();
		//$array = array('moocid'=>$moocid,'state' => '未通过');
	//	$data = $this->db->where($array)->from('record')->order_by('record_id','desc')->get()->result_array();
				$data = $this->db->select()->from('sacourse')->get()->result_array();

			 //	  $query = $this->db->('student');
					return  $data;

 }
public function serachstu($serach){
      $array = array('name'=>$serach);
			$data = $this->db->where($array)->from('student')->get()->result_array();
			return $data;

}
public function serachstupid($pid){
      $array = array('pid'=>$pid);
			$data = $this->db->where($array)->from('student')->get()->result_array();
			return $data;

}

public function ins_crecord($data){

	$this->db->insert('crecord',$data);

}

public  function change_period($stuname,$course,$period){
	 //查询课时信息
	  $data=$this->db->select('period,dperiod')->where('stuname',$stuname)->where('course',$course)->from('sacourse')->get()->result_array();
		//var_dump($data[0]['period']);

   //修改课时信息
		$aperiod = ((int)$data[0]['period']-$period);
		$dperiod = ((int)$data[0]['dperiod']+$period);
		$uparray = array('period' => $aperiod, 'dperiod'=>$dperiod);
		$this->db->where('stuname', $stuname)->where('course',$course);
		$this->db->update('sacourse',$uparray);

}

//查询课程和剩余课时信息


    public function courseMess($stuname){

			//$data = $this->db->select('course,period,dperiod,money')->where('stuname',$stuname)->from('sacourse')->get()->result_array();
      $data = $this->db->select()->where('stuname',$stuname)->from('sacourse')->get()->result_array();

			return $data;


		}
		public function crecord($stuname){

			$data = $this->db->select()->where('stuname',$stuname)->from('crecord')->get()->result_array();

			return $data;
		}

		public function selectstu($stuname){

			$data =$this->db->select()->where('name',$stuname)->from('student')->get()->result_array();

			return  $data;
	     	}

				public function distinctstu() {
          $data = $this->db->distinct()->select('stuname')->count_all_results('sacourse');
        // $data['num'] = $this->db->count_all_results('student');
					return $data;
					//$data =  $this->db->select()->

				}
				public function distinctec() {
					$data = $this->db->distinct()->select('teacher')->count_all_results('sacourse');
				// $data['num'] = $this->db->count_all_results('student');
					return $data;
					//$data =  $this->db->select()->
				}
				public function courseIsexist($stuname,$course){

		    $data=$this->db->select()->where('stuname',$stuname)->where('course',$course)->from('sacourse')->get()->result_array();

					return $data;

				}
		public function updatestu($studata,$stuname){
			$this->db->update('student', $studata, array('name' => $stuname));
		}

    }
