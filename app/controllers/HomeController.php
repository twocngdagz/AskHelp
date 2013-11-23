<?php

class HomeController extends BaseController {

	public function index()
	{
		$msisdn = Input::get('msisdn');
		$text = Input::get('text');
		$rrn = Input::get('rrn');
		if($msisdn != '' && isset($msisdn)) {
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