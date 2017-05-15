<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-type: text/html; charset=utf8');
class Student extends CI_Controller {

	 public function __construct(){
			 parent::__construct();
			 $this->load->library('pagination');
    	 $this->load->model('Stu_model');
			 $this->load->helper('form');
			 $this->load->library('form_validation');
		 }


	public function index()
	{
		$data['num'] = $this->db->count_all_results('student');
		$data['attendstu'] = $this->Stu_model->distinctstu();
		$data['attendtec'] = $this->Stu_model->distinctec();
		date_default_timezone_set('Asia/Shanghai');

    switch (date('w')) {
			case 0:$dayStr ='日';break;
			case 1:$dayStr ='一';break;
			case 2:$dayStr ='二';break;
			case 3:$dayStr ='三';break;
			case 4:$dayStr ='四';break;
			case 5:$dayStr ='五';break;
			case 6:$dayStr ='六';break;
    	default:
    		$dayStr ='非法日期';
    		break;
    }
   $data['date'] = date('Y年m月d日 H:i:s');
	 $data['dayStr'] = '星期'.$dayStr;
		$this->load->view('header.html');
		$this->load->view('index.html',$data);
		$this->load->view('footer.html');
	}
public function insertStuView(){

	$this->load->view('header.html');  //载入视图
	$this->load->view('insertStu.html');
	$this->load->view('footer.html');

}
public function insertStu()
	{
		$this->form_validation->set_rules('stuname', '姓名', 'required');
		$this->form_validation->set_rules('sex', '性别', 'required');
		$this->form_validation->set_rules('birthday', '出生年月', 'required');
		$this->form_validation->set_rules('parentname', '家长姓名', 'required');
		$this->form_validation->set_rules('phone', '联系电话', 'required');
		$this->form_validation->set_rules('addreess', '家庭住址', 'required');
		$this->form_validation->set_rules('rtext', '备注信息', 'required');
		$status = $this->form_validation->run();

		$stuname = $this->input->post('stuname');//获取表单数据
		$sex =$this->input->post('sex');
		$birthday = $this->input->post('birthday');
		$parentname = $this->input->post('parentname');
		$phone = $this->input->post('phone');
		$addreess = $this->input->post('addreess');
		$rtext =$this->input->post('rtext');


       $studata = array(
      'name' =>$stuname ,
			'sex' =>$sex ,
			'birthday' =>$birthday ,
			'parentname' =>$parentname ,
			'phone' =>$phone ,
			'adreess' =>$addreess ,
			'remarks' =>$rtext
	);

				if ($status)
				{
					//判断是否已有该学员
					$data = $this->Stu_model->selectstu($stuname);
					if(!$data){
          $this->Stu_model->ins_stu($studata);
           success('Student/baseMessage','添加成功');
				 } else {
					 $datalist['name']=$stuname;
					 $this->load->view('header.html');  //载入视图
			 		 $this->load->view('failMessage.html',$datalist);
			 		 $this->load->view('footer.html');

				 }


				}


	}

	// public function doinsertstu(){
	// 	$this->load->helper('form');
	// 	$this->load->library('form_validation');
	//
	// 	$this->form_validation->set_rules('stuname', '姓名', 'required');
	// 	// $this->form_validation->set_rules('sex', '性别', 'required');
	// 	// $this->form_validation->set_rules('birthday', '出生年月', 'required');
	// 	// $this->form_validation->set_rules('parentname', '家长姓名', 'required');
	// 	// $this->form_validation->set_rules('phone', '联系电话', 'required');
	// 	// $this->form_validation->set_rules('addreess', '家庭住址', 'required');
	// 	// $this->form_validation->set_rules('rtext', '备注信息', 'required');
	// 	$status = $this->form_validation->run();
  //   echo $status;
	//
	// 	if ($status) {
	//    echo "123";
	//  }else{
	// 	 echo"456";
	//  }
	//
	//
	// }
	public function findStuView(){
		$this->load->view('header.html');
	  $this->load->view('findStuView.html');
		$this->load->view('footer.html');
	}

	public function findStu()
	{


		$serach = $this->input->post('keywords');


 $data['stuMessage'] = $this->Stu_model->serachstu($serach);

 if(!empty($serach)&&!empty($data['stuMessage'])){


 //$data['stuMessage']=$this->Stu_model->serachstu($serach);
 $data['stuMessage'] = $this->Stu_model->serachstu($serach);
 $data['courseMess'] = $this->Stu_model->courseMess($serach);
 $data['crecord'] = $this->Stu_model->crecord($serach);

 $this->load->view('header.html');
 $this->load->view('findStu.html',$data);
 $this->load->view('footer.html');

}else{
 $this->load->view('header.html');
 $this->load->view('findStunull.html');
 $this->load->view('footer.html');
}

		}

		public function  findStutable($stuname){

			$serach=urldecode($stuname);
	$data['stuMessage'] = $this->Stu_model->serachstu($serach);

	if(!empty($serach)&&!empty($data['stuMessage'])){


	 //$data['stuMessage']=$this->Stu_model->serachstu($serach);
	 $data['stuMessage'] = $this->Stu_model->serachstu($serach);
	$data['courseMess'] = $this->Stu_model->courseMess($serach);
	$data['crecord'] = $this->Stu_model->crecord($serach);

	$this->load->view('header.html');
	$this->load->view('findStu.html',$data);
	$this->load->view('footer.html');

}else{
	 $this->load->view('header.html');
	 $this->load->view('findStunull.html');
	$this->load->view('footer.html');
}


		}

	public function newCourse()
	{
		$this->load->library('pagination');
		$perPage =8;
		$config['base_url'] = site_url('Student/newCourse');
		$config['total_rows']= $this->db->count_all_results('sacourse');
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

		$data['curMessage'] = $this->Stu_model->curecord();

		$this->load->view('header.html');
		$this->load->view('findStuView.html');
		$this->load->view('newCourse.html',$data);
		$this->load->view('footer.html');

	}
	public function stuAddCourse()
	{
		$this->form_validation->set_rules('stuname', '姓名', 'required');
	//	$this->form_validation->set_rules('course', '课程名字', 'required');
		$this->form_validation->set_rules('escort', '引流人', 'required');
		$this->form_validation->set_rules('sale', '销售人', 'required');
		$this->form_validation->set_rules('money', '金额', 'required');
		$this->form_validation->set_rules('teacher', '上课老师', 'required');
	//	$this->form_validation->set_rules('content', '备注内容', 'required');
		$status = $this->form_validation->run();
		$this->load->view('header.html');
		$this->load->view('stuAddCourse.html');
		$this->load->view('footer.html');

		$stuname = $this->input->post('stuname');//获取表单数据
		$course =$this->input->post('course');
		$escort = $this->input->post('escort');
		$sale = $this->input->post('sale');
		$money = $this->input->post('money');
		$teacher = $this->input->post('teacher');
		$content =$this->input->post('content');

		$Coursedata = array(
	 'stuname' =>$stuname,
	 'course'=>'course',
	 'escort' =>$escort,
	 'sale' =>$sale,
	 'money' =>$money,
	 'teacher'=>$teacher,
	 'content' =>$content
);
   //var_dump($course);
//var_dump($Coursedata);
$data = $this->Stu_model->selectstu($stuname);
if ($data&&$status)
{
	// $this->Stu_model->ins_stu($studata);
	//  success('Student/baseMessage','添加成功');
	if(!empty($course)){
	 foreach ($course as $value) {
	 //	array_push($Coursedata, 'course'=>$value);
		 $Coursedata['course']=$value;
		 $data = $this->Stu_model->courseIsexist($stuname,$value);
		//	var_dump($Coursedata);
			//echo "$key";
			if(!$data){
    $this->Stu_model->stu_in_cur($Coursedata);
		 success('Student/baseMessage','添加成功');
		    continue;
	}
         $failMessage ='该学员已报过该课程，请检查所报课程是否正确';
		     $this->stuAddCourseFail($failMessage);

	}


}

}else{
  	// $this->load->view('header.html');
	  // $this->load->view('addcfailMessage.html');
    // $this->load->view('footer.html');

		$failMess = '数据库里没有该学员，请先添加该学员，如已有学员请检查名字是否拼写错误已经表单是否填写正确！';
		$this->stuAddCourseFail($failMess);
}


	}

	public function baseMessage(){
		    //   $data = $this->Stu_model->sturecord();
				// 	echo "<pre>";
				// var_dump($data);
				//   echo "</pre>";
				$this->load->library('pagination');
		    $perPage =8;
	    	$config['base_url'] = site_url('Student/baseMessage');
	      $config['total_rows']= $this->db->count_all_results('student');
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

				$data['stuMessage'] = $this->Stu_model->sturecord();

				$this->load->view('header.html');
			  $this->load->view('findStuView.html');
				$this->load->view('catstu.html',$data);
				$this->load->view('footer.html');
	}

	public function addCourse(){
		$this->form_validation->set_rules('cname', '课程名称', 'required');
		$this->form_validation->set_rules('money', '课程价格', 'required|numeric');
		$status = $this->form_validation->run();
		$this->load->view('header.html');
		$this->load->view('addCourse.html');
		$this->load->view('footer.html');
		$cname = $this->input->post('cname');
		$money = $this->input->post('money');
		$cdata = array('cname' =>$cname ,'money'=>$money );

     if($status){

			 $this->Stu_model->ins_course($cdata);
		 	 success('Student/newCourse','添加成功');

		 }

	}

	  public function addRecord() {
			// //验证表单
			$this->form_validation->set_rules('stuname', '姓名', 'required');
			$this->form_validation->set_rules('teacher', '任课老师', 'required');
			$this->form_validation->set_rules('content', '课程内容', 'required');
			$this->form_validation->set_rules('date', '上课时间', 'required');
			$this->form_validation->set_rules('address', '上课地址', 'required');
			$this->form_validation->set_rules('time', '上课时长', 'required|integer');
			$status = $this->form_validation->run();

           //载入视图

			$this->load->view('header.html');
			$this->load->view('addRecord.html');
			$this->load->view('footer.html');


	    //获取表单数据
			$course =$this->input->post('course');
			$stuname = $this->input->post('stuname');
			$teacher = $this->input->post('teacher');
			$content =$this->input->post('content');

			$date = $this->input->post('date');
			$address = $this->input->post('address');
			$time = $this->input->post('time');


			$record = array(
		 'course' =>$course ,
		 'stuname' =>$stuname ,
		 'tename' =>$teacher ,
		 'tecontent' =>$content,
		 'tetime' =>$date,
		 'teadress' =>$address ,
		 'hours' =>$time
 );
 if($status&&!empty($course)){
	 $this->Stu_model->ins_crecord($record);
	 $this->Stu_model->change_period($stuname,$course,$time);
	 success('Student/baseMessage','添加成功');

 }


		}
  public function weekend(){
		 $data['message'] = $this->Stu_model->curecord();

		$this->load->view('header.html');
		$this->load->view('weekend.html',$data);
		$this->load->view('footer.html');

	}
 public function test(){
	// $serach = $stuname;
//  $data = $this->Stu_model->courseIsexist('王小月','设计思维');
  //var_dump($data);
// 	die;
//       $data = $this->Stu_model->distinct();
// 			var_dump($data);
// die;
// $a=urldecode($stuname);
// $a=mb_convert_encoding($a, 'GB2312', 'UTF-8');
// echo $a;

 }

  public function stuAddCourseFail($failMessage){

		$this->load->view('header.html');
		$data['failMessage']=$failMessage;
		$this->load->view('addcfailMessage.html',$data);
		$this->load->view('footer.html');

	}

}
