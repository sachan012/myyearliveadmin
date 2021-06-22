<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public $viewData = array();
    public $loggedInAdmin = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model', 'CommonModel');
        $this->load->model('admin_model');
        $this->viewData['data'] = array();
    }

    function SessionCreate()
    {
        if (!$this->input->is_ajax_request()) {
            echo "Ajax Requests allowed.";
            die;
        } else {

            $isAll = getStringSegment(3) ? getStringSegment(3) : false;
            $FormData = $this->input->post('FormData');

            $sessionQuery = array('sort' => array('field' => 'id', 'order' => 'desc'));
            if (!empty($FormData) && isset($FormData['like']) && $FormData['like'] != '') {
                foreach ($FormData['like'] as $likeKey => $like) {
                    if ($FormData['like'][$likeKey] != '') {
                        $sessionQuery['like'][$likeKey] = trim($like);
                    }
                }
            }
            if (!empty($FormData) && isset($FormData['equal']) && $FormData['equal'] != '') {
                foreach ($FormData['equal'] as $key => $status) {
                    if (strpos($key, '-') !== false) {
                        $key = str_replace("-", ".", $key);
                    }
                    if ($key == 'status' || $key == 'type') {
                        if ($status == '0' || $status == '1' || $status == '2' || $status == '3' || $status == '4' || $status == '5') {
                            $sessionQuery['equal'][$key] = $status;
                        }
                    } else if ($status != '') {
                        $sessionQuery['equal'][$key] = $status;
                    }

                }
            }
            if (!empty($FormData) && isset($FormData['sort']) && $FormData['sort'] != '') {
                foreach ($FormData['sort'] as $equalKey => $equal) {
                    if ($equal != '') {
                        $sessionQuery['sort'][$equalKey] = trim($equal);
                    }
                }
            }
           
            if ($sessionQuery && ($isAll != 'all' || $isAll == false)) {
                $sessionQueryNew = array_merge($FormData, $sessionQuery);
                setSessionUserData(array($FormData['form_name'] => $sessionQueryNew));
            }
            
            if (!empty($FormData)) { 
                $this->output->set_output(json_encode(array('status' => true, 'data' => 'success')));
                $string = $this->output->get_output();
                echo $string;
                exit();
            }

        }
    }
}