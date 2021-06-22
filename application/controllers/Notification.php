<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{
   // var $perPage = '10';
   // var $segment = '3';
    public $viewData = array();
    public $loggedInAdmin = array();
    private $upload_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("basic_helper");
		$this->load->helper("push_notification");
        $this->load->model('admin_model');  // load the admin model
        $this->load->model('role_model');  // load the admin model
        $this->load->model('Users_model');  // load the admin model
        $this->load->model("Api_model");
        $this->viewData['data'] = array();
        $this->loggedInId = trim(getSessionUserData("id"));
        //echo $this->loggedInId;die;
        if (getSessionUserData("logged_in") == FALSE && getSessionUserData("id") == "" && empty(getSessionUserData("id"))) 
        {
            // if user is not login then it will rediret to the login page of panel
            redirect(base_url(''));  
        }
        $role_type = trim(getSessionUserData("role_type"));       
        $this->roleTypeForCheck = $role_type;
        $rolename = getAdminRoleInfo($role_type, $table = "roles");  // geting the user role      
    }

function index(){

        isLoggedIn();
        customPagination();
        $this->checkUserLevel($this->roleTypeForCheck);
        $this->viewData['adminid'] = $this->loggedInId;
        $this->viewData['dataQuery'] = $this->db->last_query();
        $this->viewData['title'] = 'Send Notification';
        //echo "<pre>";print_r($this->viewData);die;
        $this->load->view('notification/send', $this->viewData); 

    }

    public function ajaxsearch(){
        if(!isset($_GET['searchTerm'])){ 
            $json = [];
            echo json_encode($json); 
        }else{
            $keyword = $_GET['searchTerm'];
            $sql = $this->db->select('*')
                            ->from('users')
                            ->where("fullname LIKE '%$keyword%'")
                            ->or_where("email LIKE '%$keyword%'")
                            ->get()
                            ->result();
            echo json_encode($sql); 
        }
        
        

    }
	
	 public function send(){
        //echo "<pre>";print_r($this->input->post());die;
		$msg = $this->input->post('notification_msg');
		$title = $this->input->post('notification_title');
		
        if($this->input->post('user_type')=='all_user'){
            $deviceIds = $this->Users_model->get_users_device_tokens('');
        }
        if($this->input->post('user_type')=='ios_user'){
            $deviceIds = $this->Users_model->get_users_device_tokens('ios');
        }
        if($this->input->post('user_type')=='android_user'){
            $deviceIds = $this->Users_model->get_users_device_tokens('android');
        }
		
		if($this->input->post('user_type')=='selected_user'){
			$userids = $this->input->post('user_id');			
            $deviceIds = $this->Users_model->get_users_device_tokens($userids);
        }
		
		
        foreach($deviceIds as $row){
           $deviceIdss[] = $row->device_token;
        }       

        //echo "<pre>";print_r($deviceIdss);die;
		$status = sendPush($deviceIdss,$msg,$title);
		//echo "<pre>";print_r($status);die;
		//echo $status;die;
		if($status){
			$this->session->set_flashdata('success','Notification successfully sent.');
			redirect('notification/index');	
		}
		

    }



    public function searchUser(){
		//echo "hello";die;       	
		$keyword = $_POST['keyword'];			
		$data['data'] = $this->Users_model->user_search($keyword);            
		echo $this->load->view('notification/searchUser',$data,true);//This will load your view page to the  
	}


  







    function checkUserLevel($role)
     {

        if($role != 1)
        {
            redirect("dashboard");
        }
     }



}// class