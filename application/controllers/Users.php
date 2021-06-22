<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    var $perPage = '10';
    var $segment = '3';
    public $viewData = array();
    public $loggedInAdmin = array();
    private $upload_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("basic_helper");
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

function index()
    {

        //echo "hello";die;
       
       isLoggedIn();
       customPagination();
       $this->checkUserLevel($this->roleTypeForCheck);
       $isAll = getStringSegment(3) ? getStringSegment(3) : false;
       if ($isAll && $isAll == 'all') {
            $this->session->unset_userdata('UserList');
        }
        $prevSessData = getSessionUserData('UserList');
        $conditionArray=$prevSessData;
       /* $conditionArray['equal']['template_type'] = 'email';*/
        if($isAll!='all')
        {
            $start =validateURI(3) != '' ? validateURI(3) : '0';
            $getData['page']=$start;
        }
        else{
            $start='0';
            $getData['page']='';
        }
        $getField= $this->input->get();
        $sortField= isset($prevSessData['sort']['field'])?$prevSessData['sort']['field']:'id';
        $order= isset($prevSessData['sort']['order'])?$prevSessData['sort']['order']:'desc';
        $page_num = (int)$this->uri->segment(3);
        if($page_num==0) $page_num=1;
        if($order == "asc") $order_seg = "desc"; else $order_seg = "asc";

        $contactDataCount = $this->Users_model->record_count('users', $conditionArray);
        $contactData = $this->Users_model->get_records('users', $start, $this->perPage, $conditionArray);

        $pagination = createPagination('Users/index', $contactDataCount, $this->perPage, $this->segment, $getField);

        $this->viewData['pagination'] = $pagination;
        $this->viewData['dbdata'] = $contactData;
        $this->viewData['getData'] = $getData;
        $this->viewData['pageNum'] = $page_num;
        $this->viewData['field'] = $sortField;
        $this->viewData['order'] = $order_seg;
        $this->viewData['FormData'] =$prevSessData;
        $this->viewData['adminid'] = $this->loggedInId;
        $this->viewData['dataQuery'] = $this->db->last_query();
        $this->viewData['title'] = 'User List';
        //echo "<pre>";print_r($this->viewData);die;
        $this->load->view('users/list', $this->viewData); 

    }


 function view($id)
    {
        isLoggedIn();
        $this->viewData['title'] = 'Customer View';
        // get admin user from database
        $this->viewData['customerdetails'] = getWhereWithId("customers", array("id"=>$id));
        $this->viewData['data'] = array();
        $this->viewData['adminid'] = $this->loggedInId;
        //print_r($this->viewData['customerdetails']); die;
        $this->load->view('users/view', $this->viewData);
    }  // view

    function statusChangeAjax(){             
        $status = $this->input->post('status');        
        $id = $this->input->post('id');       
        $this->db->set('status',$status)->where('id',$id)->update('users');
        echo 1;
    }
	
	

function uniqidReal($lenght = 16) 
    {
        // uniqid gives 16 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }


  function SendEmailByTemplate($template_id, $email_keywords = array(), $mailTo, $mailFrom, $mailFromName)
    {
        $CI =& get_instance();
        $strSQL = "SELECT * FROM b_email_templates WHERE id =" . $template_id;
        $resSQL = $CI->db->query($strSQL);
        if ($resSQL->num_rows() > 0) {
            $result = $resSQL->result_array();
            $msg_body = $result[0]['email_content'];
            $msg_subject = $result[0]['email_subject'];
            if (is_array($email_keywords)) {
                foreach ($email_keywords as $key => $value) {
                    $msg_subject = str_replace("[" . $key . "]", $value, $msg_subject);

                    if (strstr($msg_body, "/[" . $key . "]")) {
                        $msg_body = str_replace("/[" . $key . "]", $value, $msg_body);
                        $msg_body = str_replace("[" . $key . "]", $value, $msg_body);
                    } else {
                        $msg_body = str_replace("[" . $key . "]", $value, $msg_body);
                    }
                }
            }
            if (preg_match_all('@<img.*src="([^"]*)"[^>/]*/?>@Ui', $msg_body, $image)) {
                if (isset($image[1]) && !empty($image[1])) {
                    foreach ($image[1] as $src) {
                        //$msg_body = str_replace($src,$siteUrl.$src,$msg_body);
                    }
                }

            }
            if (preg_match("/[SITE_URL]/", $msg_body)) {
                $msg_body = str_replace('/[SITE_URL]', base_url(), $msg_body);
            }

            //$msg_body = replaceImgSrc( $msg_body);
            $siteUrl = sprintf("%s://%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME']);


            $msg_body = replaceImgSrc($msg_body);
            $msg_subject = html_entity_decode(htmlentities($msg_subject));
            $msg_body = html_entity_decode(htmlentities($msg_body));
            $CI->viewData['msg_body'] = $msg_body;
            $msg_header = $CI->load->view('email/header', $CI->viewData, true);
            $full_msg_body = $msg_header;			
			$this->load->library('email');	
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => EMAIL,
				'smtp_pass' => PASSWORD,
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1'
			  );
			$this->email->initialize($config);		
			$this->email->set_newline("\r\n");
			$this->email->from(EMAIL,$mailFromName);		
			$this->email->to($mailTo);		
			$this->email->set_mailtype('html');
			$this->email->subject($msg_subject);
			$this->email->message($full_msg_body);
			if($this->email->send()){
             return true;
            }else{
              return false;
            }
        }
    }

    function checkUserLevel($role)
     {

        if($role != 1)
        {
            redirect("dashboard");
        }
     }



}// class