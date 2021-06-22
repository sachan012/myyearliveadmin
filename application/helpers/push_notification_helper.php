<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('sendPush')) {
     function sendPush($deviceIds=array(),$message,$title){
        // $user = $this->Api_model->get_device_token($userid);
		//echo $message;die;
		//echo "<pre>";print_r($deviceIds);die;
		$url = 'https://fcm.googleapis.com/fcm/send';		
		
		
		
		//echo FIREBASE_API_ACCESS_KEY;die;
		$fields = [
	 "notification"=>[
		 "title"=>$title,
		 "body"=>$message,
         "sound"=>"default",
         "icon"=>"fcm_push_icon",
	 ],
	
	  "registration_ids"=>$deviceIds,
      "priority"=>"high",
      "restricted_package_name"=>""
];
		
		//echo "<pre>"; print_r($fields);die;
		$headers = array(			
			'Authorization: key=' . FIREBASE_API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		
		//print_r($fields);die;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		$result = curl_exec($ch);
        //print_r($result );die;
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}

		curl_close($ch);		
		return !empty($result);      
     }

    }


?>