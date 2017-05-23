
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//后台用户管理模型
class Admin_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }

	public function check($username){
		$data = $this->db->get_where('users',array('username' => $username))->result_array();
		return $data;

	}
	public function check_level($moocid){

		$data = $this->db->get_where('level',array('moocid' =>$moocid))->result_array();

		return $data;

	}

	public  function change($pid,$data){

		$this->db->update('users',$data,array('pid'=>$pid));

	}
	public function regeist($data,$ldata){

		$this->db->insert('users',$data);
		$this->db->insert('level',$ldata);

	}

}
