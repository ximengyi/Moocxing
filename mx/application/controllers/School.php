<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {


	public function catSchool()
	{
		$this->load->view('header.html');
		$this->load->view('catschool.html');
		$this->load->view('footer.html');
	}
	public function addSchool()
	{
		$this->load->view('header.html');
		$this->load->view('addSchool.html');
		$this->load->view('footer.html');

	}
	public function findSchool()
	{
		$this->load->view('header.html');
		$this->load->view('findSchool.html');
	  $this->load->view('footer.html');
	}
	public function system()
	{
		$this->load->view('header.html');
		$this->load->view('system.html');
   	$this->load->view('footer.html');
	}
}
