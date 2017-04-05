<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

 	public function index(){

 		$this->load->view('login.html');

 	}

 	public  function login_in(){

 		$username = $this->input->post('username');
 		$this->load->model('Admin_model','admin');
 		$userData = $this->admin->check($username);
        $passwd = $this->input->post('pwd');
        if(!$userData || $userData[0]['userpw'] != $passwd) {
          success('login/index','用户名或者密码不正确');
          error('用户名或者密码不正确');
        }


         $sessiondata = array(
         	'username' =>$userData[0]['username'],
         	//'mid'      =>$username

         	);
         //原生session
                     session_start();
                    $_SESSION['username'] = $userData[0]['username'];
                    //$_SESSION['mid'] = $username;

                    // // if ($userData[0]['mooc_ps']==2) {
                    // //  success('pression/index','登陆成功,正在跳转~');
                    // // }else{
                    //   success('admin/index','登陆成功,正在跳转~');
                    // }
                    success('student/index','登陆成功,正在跳转~');

 	}

}
