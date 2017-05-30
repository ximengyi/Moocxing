<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct(){
 		 parent::__construct();
 		 $this->load->model('Cour_model');

 	 }

	public function stuAddCourseView()
	{
    $data['course'] =  $this->Cour_model->cat_Course();
		$this->load->view('header.html');
		$this->load->view('stuAddCourseView.html',$data);
		$this->load->view('footer.html');

	}

}
