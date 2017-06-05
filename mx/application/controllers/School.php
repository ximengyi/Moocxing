<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {
	public function __construct(){
			parent::__construct();
			$this->load->model('Sch_model');
			$this->load->helper('form');
			$this->load->library('form_validation');

		}


	public function catSchool()
	{
			$this->load->library('pagination');
			$perPage =8;
			$config['base_url'] = site_url('School/catSchool');
			$config['total_rows']= $this->db->count_all_results('school');
			$config['per_page'] = $perPage;
			$config['uri_segment'] = 3;
			$config['first_link'] = '第一页';
			$config['prev_link'] = '上一页';
			$config['next_link'] = '下一页';
			$config['last_link'] = '最后一页';
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$offset = $this->uri->segment(3);
			$this->db->limit($perPage,$offset);

			$data['schMessage'] = $this->Sch_model->cat_school();

			$this->load->view('header.html');
			$this->load->view('findSchoolView.html');
			$this->load->view('catschool.html',$data);
			$this->load->view('footer.html');


	}
	public function addSchool()
	{
		$this->load->view('header.html');
		$this->load->view('addSchool.html');
		$this->load->view('footer.html');
	}
	public function doaddSchool(){
		$this->form_validation->set_rules('schname', '学校/组织机构', 'required');
		$this->form_validation->set_rules('contact', '联系人', 'required');
		$this->form_validation->set_rules('phone', '联系电话', 'required|is_natural');
		$this->form_validation->set_rules('addreess', '组织机构地址', 'required');
		$status = $this->form_validation->run();

		$schname = $this->input->post('schname');//获取表单数据
		$contact =$this->input->post('contact');
		$phone = $this->input->post('phone');
		$addreess = $this->input->post('addreess');
		$content = $this->input->post('content');

       $schdata = array(
      'schname' =>$schname ,
			'kpeople' =>$contact ,
			'phone' =>$phone,
			'adreess' =>$addreess ,
			'content' =>$content ,

	);
	if ($status)
	{
		//判断是否已有该机构
		$data = $this->Sch_model->selectsch($schname);
		if(!$data){
		 $this->Sch_model->ins_school($schdata);
		 success('School/catschool','添加成功');
	 } else {
		 $datalist['failMessage']="-----已添加过该组织机构或学校，请勿重复添加-----";
		 $this->load->view('header.html');  //载入视图
		 $this->load->view('addcfailMessage.html',$datalist);
		 $this->load->view('footer.html');

	 }



	}
}
	public function findSchool()
	{
		$this->load->view('header.html');
		$this->load->view('findSchoolView.html');
	  $this->load->view('footer.html');
	}

	public function dofindSchool()
	{


	  //$serach = $this->input->post('keywords');
  $serach = $this->input->post('keywords');
		//$serach = $this->input->post_get('keywords', TRUE);
   	$this->load->model('Busine_model');

	$data['schMessage'] = $this->Sch_model->serachsch($serach);

	if(!empty($serach)&&!empty($data['schMessage'])){


	//$data['stuMessage']=$this->Stu_model->serachstu($serach);
	//$data['stuMessage'] = $this->Stu_model->serachstu($serach);
	$data['busMess'] = $this->Busine_model->selectbus($serach);
	//$data['crecord'] = $this->Stu_model->crecord($serach);

	$this->load->view('header.html');
	$this->load->view('findSchool.html',$data);
	$this->load->view('footer.html');

	}else{
	$datalist['failMessage']="-----未查询到该组织机构，请检查名字是否拼写错误-----";
 	 $this->load->view('header.html');  //载入视图
	 $this->load->view('findSchoolView.html');
 	 $this->load->view('addcfailMessage.html',$datalist);
 	 $this->load->view('footer.html');
	}

		}
		public function findschoolTable($schname){

		    $serach=urldecode($schname);
	  //    $serach = $this->input->get();

			//$serach = $this->input->post_get('keywords', TRUE);
	   	$this->load->model('Busine_model');

		$data['schMessage'] = $this->Sch_model->serachsch($serach);

		if(!empty($serach)&&!empty($data['schMessage'])){


		//$data['stuMessage']=$this->Stu_model->serachstu($serach);
		//$data['stuMessage'] = $this->Stu_model->serachstu($serach);
		$data['busMess'] = $this->Busine_model->selectbus($serach);
		//$data['crecord'] = $this->Stu_model->crecord($serach);

		$this->load->view('header.html');
		$this->load->view('findSchoolView.html');
		$this->load->view('findSchool.html',$data);
		$this->load->view('footer.html');

		}else{
			$datalist['failMessage']="-----未查询到该组织机构，请检查名字是否拼写错误-----";
	 	 $this->load->view('header.html');  //载入视图
	 	 $this->load->view('addcfailMessage.html',$datalist);
	 	 $this->load->view('footer.html');
		}
		}

	public function addBusiness()
	{
		$this->load->view('header.html');
		$this->load->view('addBusiness.html');
   	$this->load->view('footer.html');
	}
	public function doaddBusiness()
	{
		$this->form_validation->set_rules('schname', '学校/组织机构', 'required');
		$this->form_validation->set_rules('type', '类型', 'required');
		$this->form_validation->set_rules('model', '型号', 'required');
	//	$this->form_validation->set_rules('description', '详细说明', 'required');
		$this->form_validation->set_rules('quantity', '数量', 'required|is_natural');
		$this->form_validation->set_rules('price', '单价', 'required|is_natural');
		$this->form_validation->set_rules('escort', '引流', 'required');
		$this->form_validation->set_rules('sale', '销售', 'required');
		$this->form_validation->set_rules('time', '时间', 'required');
		//$this->form_validation->set_rules('content', '组织机构地址', 'required');
		$status = $this->form_validation->run();

		$schname = $this->input->post('schname');//获取表单数据
		$type =$this->input->post('type');
		$model = $this->input->post('model');
		$description = $this->input->post('description');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');//获取表单数据
		$escort =$this->input->post('escort');
		$sale = $this->input->post('sale');
		$time = $this->input->post('time');
		$content = $this->input->post('content');

       $business = array(
      'schname' =>$schname ,
			'type' =>$type ,
			'model' =>$model,
			'description' =>$description,
			'quantity'=>$quantity,
			'price'=>$price,
			'escort'=>$escort,
			'sale'=>$sale,
			'time'=>$time,
			'content' =>$content ,

	);
	if ($status)
	{
		//判断是否已有该机构
				$this->load->model('Busine_model');
		$data = $this->Sch_model->selectsch($schname);
		if($data){
		 $this->Busine_model->ins_business($business);
		 success('School/catschool','添加成功');
	 } else {
		 $datalist['failMessage']="<-----数据库并没有该学校或组织机构记录，请先添加该学校或组织机构，然后再添加业务----->";
		 $this->load->view('header.html');  //载入视图
		 $this->load->view('addcfailMessage.html',$datalist);
		 $this->load->view('footer.html');

	 }
	}
}

	public function updatesch($cid)
	{
		$data['schmess']=$this->Sch_model->selectschcid($cid);
		$this->load->view('header.html');
		$this->load->view('updateSchool.html',$data);
   	$this->load->view('footer.html');
	}
	public function doupdatesch()
	{
		$this->form_validation->set_rules('schname', '学校/组织机构', 'required');
		$this->form_validation->set_rules('contact', '联系人', 'required');
		$this->form_validation->set_rules('phone', '联系电话', 'required|is_natural');
		$this->form_validation->set_rules('addreess', '组织机构地址', 'required');
		$status = $this->form_validation->run();

		$schname = $this->input->post('schname');//获取表单数据
		$contact =$this->input->post('contact');
		$phone = $this->input->post('phone');
		$addreess = $this->input->post('addreess');
		$content = $this->input->post('content');

       $schdata = array(
      'schname' =>$schname ,
			'kpeople' =>$contact ,
			'phone' =>$phone,
			'adreess' =>$addreess ,
			'content' =>$content ,

	);
	if ($status)
	{

		    $this->Sch_model->updatesch($schdata,$schname);
		 success('School/catschool','修改成功');
	}else {
		 $datalist['failMessage']="-----更新数据失败-----";
		 $this->load->view('header.html');  //载入视图
		 $this->load->view('addcfailMessage.html',$datalist);
		 $this->load->view('footer.html');

	 }
	}

}
