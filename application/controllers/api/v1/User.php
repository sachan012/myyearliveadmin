<?php

require APPPATH . '/libraries/REST_Controller.php';  //load the rest controller library.
use Restserver\Libraries\REST_Controller;  // without this line it will give the error.

class User extends REST_Controller {
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */

    public function __construct(){        
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) 
        {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

        parent::__construct();      
        // Load these helper to create JWT tokens
        $this->load->helper(['jwt', 'authorization']); 
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model("Api_model");
        $this->load->model("common_model");
        $this->load->helper("basic_helper");
        }


    private function validate_token(){		
        $access_token = $this->input->get_request_header('authorisation');            
        $this->load->model("Api_model");
        if ($access_token == false) {
            $this->return['error'] = 1;
            $this->return['message'] = ERROR_UNAUTHORIZED_ACCESS;
            $this->response($this->return, REST_Controller::HTTP_UNAUTHORIZED);
        }
        $user = $this->Api_model->check_access_web_app_token($access_token);
        //print_r($user);die;
        if (!$user) {
            $this->return['error'] = ERROR_INVALID_ACCESS_TOKEN;
            $this->return['message'] = ERROR_INVALID_ACCESS_TOKEN_MSG;
            $this->response($this->return, REST_Controller::HTTP_OK);
        }
        $this->user_id = $user;        
        return $this->user_id;
    }
	
	public function generate_access_token(){
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(64);
        //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);
        //Print it out for example purposes.
        return $token;
    }


    public function  registration_post(){
        try {
            $config = [
                        [
                            'field' => 'fullname',
                            'rules' => 'required|trim',
                            'errors' => [
                                            'required' => 'Full Name is Required'
                                        ],
                        ],

                        [
                            'field' => 'email',
                            'rules' => 'required|trim|valid_email',
                            'errors' => [
                                            'required' => 'Email Id is required.',                                            
                                        ],
                        ],
                        [
                            'field' => 'password',
                            'rules' => 'trim',
                            'errors' => [
                                            'required' => 'Enter Secure Password.'
                                        ],
                        ],
                        [
                            'field' => 'cpassword',
                            'rules' => 'trim',
                            'errors' => [
                                            'required' => 'We need a confirm password'
                                        ],
                        ],
                     ];

            $params = $this->post();
            $this->form_validation->set_data($params);
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==FALSE)
            {
                $fullname_error = $this->form_validation->error('fullname');  // username validation
                if (!empty($fullname_error))
                {
                $status = parent::HTTP_OK;
                $this->return["msg"]=strip_tags($fullname_error);
                $this->return["status"]=0;
                $this->response($this->return, $status);
                }               

                $email_error = $this->form_validation->error('email');  // device validation
                if (!empty($email_error)) 
                {
                $status = parent::HTTP_OK;
                $this->return["msg"]=strip_tags($email_error);
                $this->return["status"]=0;
                $this->response($this->return, $status);
                }                

                $password_error = $this->form_validation->error('password');  // device validation
                if (!empty($password_error)) 
                {
                $status = parent::HTTP_OK;
                $this->return["msg"]=strip_tags($password_error);
                $this->return["status"]=0;
                $this->response($this->return, $status);
                }

                $cpassword_error = $this->form_validation->error('cpassword');  // device validation
                if (!empty($cpassword_error)) 
                {
                $status = parent::HTTP_OK;
                $this->return["msg"]=strip_tags($cpassword_error);
                $this->return["status"]=0;
                $this->response($this->return, $status);
                }
            }   // validation part
            else
            {   
                
                $userarray["fullname"]   =  ucwords($params["fullname"]);
                $userarray["email"]   =  strtolower($params["email"]);               
                $userarray["password"]   = md5(trim($params["password"]));               
                $userarray["device_type"]   = trim($params["device_type"]);               
                $userarray["device_token"]   = trim($params["device_token"]);               
                $userarray["firebase_user_id"]   = trim($params["firebase_user_id"]);               
                $userarray["status"]   =  1;

                $checkEmailExistence = $this->Api_model->email_exists("email", trim($params["email"]));
                if($checkEmailExistence > 0)
                {
					$frbseId   = $userarray["firebase_user_id"];  
					$device_type = $userarray["device_type"];
					$device_token = $userarray["device_token"];           
					$dataarray = array(
						'device_type'   => $device_type ,
						'device_token'   => $device_token
					);
				
					$update_status = $this->Api_model->update_device_token($frbseId,$dataarray);
                    $status = parent::HTTP_OK;
                    $this->return["status"]=0;
                    $this->return["msg"]="This email id already exist.";
                    $this->response($this->return, $status);
                }else{ 
                        $lastuserid = $this->Api_model->add_user($userarray);
                        if($lastuserid)
                        {                             
                            $status = parent::HTTP_OK;
                            $this->return["status"]=1;
                            $this->return["msg"]="Success.You have been successfully registered!.";
                            $this->return["data"]=$userarray;                           
                            $this->response($this->return, $status);
                        }
                    }

              }
        } //try
        catch(Exception $e) 
            { 
                log_message('error', "\n Exception Caught", $e->getMessage());
                $status = parent::HTTP_OK;
                $this->return["status"]=0;
                $this->return["msg"]= $e->getMessage();
                $this->response($this->return, $status);
            }  
    }

    function update_device_token_post(){
        try {
            $config = [
                        [
                            'field' => 'device_type',
                            'rules' => 'required|trim',
                            'errors' => [
                                            'required' => 'Device Type is Required'
                                        ],
                        ],

                        [
                            'field' => 'device_token',
                            'rules' => 'required|trim',
                            'errors' => [
                                            'required' => 'Device Token is required.'
                                           
                                        ],
                        ],

                        [
                            'field' => 'firebase_user_id',
                            'rules' => 'required|trim',
                            'errors' => [
                                            'required' => 'firebase User Id is Required'
                                        ],
                        ],
                        
                     ];

            $params = $this->post();
            $this->form_validation->set_data($params);
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==FALSE)
            {
                $device_type_error = $this->form_validation->error('device_type');  // username validation
                if (!empty($device_type_error))
                {
                    $status = parent::HTTP_OK;
                    $this->return["msg"]=strip_tags($device_type_error);
                    $this->return["status"]=0;
                    $this->response($this->return, $status);
                }               

                $device_token_error = $this->form_validation->error('device_token');  // device validation
                if (!empty($device_token_error)) 
                {
                    $status = parent::HTTP_OK;
                    $this->return["msg"]=strip_tags($device_token_error);
                    $this->return["status"]=0;
                    $this->response($this->return, $status);
                }                

                $firebase_user_id_error = $this->form_validation->error('firebase_user_id');  // device validation
                if (!empty($firebase_user_id_error)) 
                {
                $status = parent::HTTP_OK;
                $this->return["msg"]=strip_tags($firebase_user_id_error);
                $this->return["status"]=0;
                $this->response($this->return, $status);
                }
            // validation part                
            }   
            else
            {                            
                $frbseId   = $params["firebase_user_id"];  
                $device_type = $params["device_type"];
                $device_token = $params["device_token"];           
                $dataarray = array(
                    'device_type'   => $device_type ,
                    'device_token'   => $device_token
                );
                //echo $frbseId;die;

                $returnValue = $this->Api_model->firebase_userid_exists($frbseId);
                //echo $returnValue;die;  
                if($returnValue == 0){
                    $status = parent::HTTP_OK;
                    $this->return["status"]=0;
                    $this->return["msg"]="Error ! firebase user id Not Found";                    			
                    $this->response($this->return, $status);
                }else{                   
                    $update_status = $this->Api_model->update_device_token($frbseId,$dataarray); 
                    if($update_status==TRUE){
                        $status = parent::HTTP_OK;
                        $this->return["status"]=1;
                        $this->return["msg"]="success ! Device Token Updated";                    			
                        $this->response($this->return, $status);
                    }else{
                        $status = parent::HTTP_OK;
                        $this->return["status"]=0;
                        $this->return["msg"]="Error ! Something Went Wrong";                    			
                        $this->response($this->return, $status);
                    }
                }                
              }
        } //try
        catch(Exception $e) 
            { 
                log_message('error', "\n Exception Caught", $e->getMessage());
                $status = parent::HTTP_OK;
                $this->return["status"]=0;
                $this->return["msg"]= $e->getMessage();
                $this->response($this->return, $status);
            }  

    }

    
	
	
	

    
	
	
	

    




    
}
