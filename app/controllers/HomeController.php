<?php

class HomeController extends BaseController {

	public function index()
	{
		$msisdn = Input::get('msisdn');
		$text = Input::get('text');
		$rrn = Input::get('rrn');
		if($msisdn != '' && isset($msisdn)) {
			$user = User::where('cellnumber', $msisdn)->first();
			if (isset($user) && $user->accesstoken != '') 
			{
				$cookie_file_path = "C:/wamp/www/crawler/bestbuy/cookie.txt";
			    $url = 'https://graph.facebook.com/me/feed?';
			    $data = 'method=POST&message='.$text.'&format=json&suppress_http_code=1&access_token='.$user->accesstoken;
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			    curl_setopt($ch, CURLOPT_ENCODING, 'identity');
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
			    curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/-.facebook.crt");
			    curl_setopt($ch, CURLOPT_POST, 1); 
			    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			    curl_setopt($ch, CURLOPT_HEADER, FALSE);
			    $data = curl_exec($ch);
			    if(curl_errno($ch)){
			     echo 'Curl error: ' . curl_error($ch) . "\n";
			     return false;
			    }
			    curl_close($ch);
				//fb_post($user->accesstoken, $text);
			} else
			{
				$user = User::where('cellnumber', '000000000000')->first();
				$cookie_file_path = "C:/wamp/www/crawler/bestbuy/cookie.txt";
			    $url = 'https://graph.facebook.com/me/feed?';
			    $data = 'method=POST&message='.$text.'&format=json&suppress_http_code=1&access_token='.$user->accesstoken;
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			    curl_setopt($ch, CURLOPT_ENCODING, 'identity');
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
			    curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/-.facebook.crt");
			    curl_setopt($ch, CURLOPT_POST, 1); 
			    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			    curl_setopt($ch, CURLOPT_HEADER, FALSE);
			    $data = curl_exec($ch);
			    if(curl_errno($ch)){
			     echo 'Curl error: ' . curl_error($ch) . "\n";
			     return false;
			    }
			    curl_close($ch);
			}
				Message::create(array(
					'msisdn' => $msisdn,
					'text' => $text,
					'rrn' => $rrn
				));
			
		}
		return View::make('home.home');
	}

	public function messages() 
	{
		$messages = Message::all();
		return View::make('messages.messages')->with('messages',$messages);
	}

	public function users()
	{
		$users = User::all();
		return View::make('users.users')->with('users',$users);
	}

	public function create_user()
	{
		$accesstoken = Input::get('id');
		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');
		$fbid = Input::get('fbid');
		$username = Input::get('username');
		if ($accesstoken != '') {
			$data = '';
			$cookie_file_path = "C:/wamp/www/crawler/bestbuy/cookie.txt";
			$client_id = '556202757797620';
			$client_secret = '0f6987a93555f9a9d71cdde341b57f55';
			$url = 'https://graph.facebook.com/oauth/access_token?client_id='.$client_id.'&client_secret='.$client_secret.'&grant_type=fb_exchange_token&fb_exchange_token='.$accesstoken.'&req_perms=publish_actions';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_ENCODING, 'identity');
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/-.facebook.crt");
			curl_setopt($ch, CURLOPT_POST, 0); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			$data = curl_exec($ch);
			  if(curl_errno($ch)){
			   echo 'Curl error: ' . curl_error($ch) . "\n";
			   return false;
			}

			curl_close($ch);
			$long_token = $data;
			parse_str($long_token, $a);
			User::create(array(
				'username' => $username,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'accesstoken' => $a['access_token'],
				'fbid' => $fbid,
				'cellnumber' => ''
			));
			return Redirect::to("users");
		}
	}

	public function delete()
	{
		$id = Input::get('id');
		$user = User::find($id);
		$user->delete();
		return Redirect::to('users');
	}

	public function edit()
	{
		$cellnumber = Input::get('cellnumber');
		$id = Input::get('id');
		$user = User::find($id);
		$user->cellnumber =$cellnumber;
		$user->save();
		return Redirect::to('users');
	}

	public function show($id)
	{
		$user = User::findOrFail($id);
		return View::make('users.show')->with('user', $user);
	}

	public function login()
	{
		return View::make('home.login');
	}

	public function auth()
	{
		// get POST data
	    $userdata = array(
	        'username'      => Input::get('username'),
	        'password'      => Input::get('password')
	    );
	    if ( Auth::attempt($userdata) )
	    {
	        return Redirect::to('/');
	    }
	    else
	    {
	        return Redirect::to('login')->with('login_errors', true);
	    }
	}


	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

	public function mail()
	{
		$email_add = Input::get('email');
		$tasks = Task::all();

		$data = array(
		    'detail'=>'Your awesome detail here',
		    'name'  => "Mederic"
		);


		$to 		= $email_add;
		$headers	= 'MIME-Version: 1.0' . "\r\n";
	    $headers  	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers	.= "From: <twocngdagz@yahoo.com>" . "\r\n";
		$headers	.= "Reply-To: <twocngdagz@yahoo.com>" . "\r\n";
		$subject	= "Task List";

		$message = "<div><strong>
					Task List
					</strong>";
		foreach ($tasks as $task) {
		$is_completed = ($task->completed == '1') ? "Yes" : "No";
		$due = date('m/d/Y', strtotime($task->due_date));
		$message .= "<ul>
				<li>Title: $task->title</li>
				<li>Due Date: $due</li>
				<li>Completed: $is_completed </li>
			</ul>";
		}
		$message .= "</div>";

		if (@mail($to, $subject, $message, $headers))
		{
			return "<h4>Task List Sent to email: $email_add</h4>";
		} else {
			return "<h4>Can't send email to $email_add</h4>";
		}


		//return View::make('emails.mail')->with('tasks', $tasks);
		// return Mail::send('emails.mail', $data, function($message) use($email_add)
		// {
		//     $message->to($email_add, '')->subject('Task List');
		// });

	}

}