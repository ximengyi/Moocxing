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
         	'pid'      =>$userData[0]['pid'],

         	);
         //原生session
           if(!isset($_SESSION)){
         session_start();
      }

                    $_SESSION['username'] = $userData[0]['username'];

                     $_SESSION['pid'] =$userData[0]['pid'];
                    //$_SESSION['mid'] = $username;

                    // // if ($userData[0]['mooc_ps']==2) {
                    // //  success('pression/index','登陆成功,正在跳转~');
                    // // }else{
                    //   success('admin/index','登陆成功,正在跳转~');
                    // }
                    success('student/index','登陆成功,正在跳转~');

 	}
  public function change(){

        $this->load->helper('form');
        $this->load->view('header.html');
        $this->load->view('change.html');
        $this->load->view('footer.html');

      }
  public function change_passwd(){
      $this->load->model('Admin_model','admin');

      $username = $_SESSION['username'];
      $userData = $this->admin->check($username);

      $passwd = $this->input->post('passwd');
      if ($passwd !=$userData[0]['userpw']) {
        error('原始密码错误');
      }


       $passwdf = $this->input->post('passwdf');
       $passwds = $this->input->post('passwds');
       if ($passwdf !=$passwds){
        error('两次密码不相同');
       }


    //   $moocid = $_SESSION['mid'];
       $data = array(
         'userpw' =>$passwdf

        );

       $pid =  $_SESSION['pid'];
      $this->admin->change($pid,$data);
     success('Login/index','修改成功');

    }

}
