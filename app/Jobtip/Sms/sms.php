<?php namespace App\Jobtip\Sms;

// use Config;

class Sms {	

	public function send($mobile, $message) 
	{
		$host = config('sms.host');
		$username = config('sms.username');
		$password = config('sms.password');
		$sender = config('sms.sender');

		$client = new \GuzzleHttp\Client();

		$response = $client->request('POST', $host, [
		    'form_params' => [
		        'username' => $username,
		        'password' => $password,
		        'sendername' => $sender,
		        'mobileno' => $mobile,
		        'message' => $message
		    ]
	    ]);

        return $response->getStatusCode();
    }

}