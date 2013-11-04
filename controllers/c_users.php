<?php
class users_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
    public function __construct() {
    
    	# Make sure the base controller construct gets called
		parent::__construct();
    } 
    
	/*-------------------------------------------------------------------------------------------------
    Display standalone sign up page
    -------------------------------------------------------------------------------------------------*/
	public function signup($error = NULL) {
	
		$this->template->content = View::instance('v_users_signup'); 
		$this->template->content->signup = View::instance('v_users_signup_form');
		$this->template->title = "Sign up";
		$this->template->content->error = $error;
		
    	echo $this->template;   
		
	}
    
    /*-------------------------------------------------------------------------------------------------
    Process the sign up form
    -------------------------------------------------------------------------------------------------*/
    public function p_signup() {
		
		// Check for existing account
		$exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");

		if (isset($exists)) {
			Router::redirect('/users/login?acct=exists');         
		}
		
		// Validate form input
		else{
		
			#initialize error
			$error = false;
			
			# Check for empty fields
			foreach($_POST as $req){
				if(empty($req)){
					$error = true;
					$blank = 'blank=blank';
				}
			}
			
			# Check for valid email
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$error = true;
				$email = 'email=invalid';
			}
			else{
				$email = $_POST['email'];
			}
			
			# Match passwords
			if($_POST['password'] != $_POST['password2']){
				$error = true;
				$pw = 'pw=mismatch';
			}
			
			# Return to form if error exists
			if($error == true){
				Router::redirect('/users/signup/error?' . $blank . '&' . $email. '&' . $pw);
			}
		}

		// Prep data
		
		#Clean up input
		$first_name = strip_tags(htmlentities(stripslashes(nl2br($_POST['first_name'])),ENT_NOQUOTES,"Utf-8"));
		$last_name = strip_tags(htmlentities(stripslashes(nl2br($_POST['last_name'])),ENT_NOQUOTES,"Utf-8"));
				
		# Mark the time
		$created  = Time::now();
		
		# Hash password
		$password = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Create a hashed token
		$token   = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
		$data = Array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'password' => $password,
				'created' => $created,
				'token' => $token
			);
		
		//Create account
		
		# Insert the new user    
		DB::instance(DB_NAME)->insert_row('users', $data);
		
		# Send them to the login page
		Router::redirect('/users/login/?acct=new');
	    
    }
	
	/*-------------------------------------------------------------------------------------------------
	Display a form so users can login
	-------------------------------------------------------------------------------------------------*/
    public function login($error = NULL) {
    
    	$this->template->content = View::instance('v_users_login'); 
		$this->template->title = "Login to Quip";
		$this->template->content->error = $error;

		# Provide sign-up option for those who landed on the wrong page
		$this->template->content->signup = View::instance('v_users_signup_form');
		
    	echo $this->template;   
       
    }
	
	/*-------------------------------------------------------------------------------------------------
    Process the login form
    -------------------------------------------------------------------------------------------------*/
    public function p_login() {
	   	   
	   	# Hash the password they entered so we can compare it with the ones in the database
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Set up the query to see if there's a matching email/password in the DB
		$q = 
			'SELECT token 
			FROM users
			WHERE email = "'.$_POST['email'].'"
			AND password = "'.$_POST['password'].'"';	
		
		# If there was, this will return the token	   
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# Success
		if($token) {
		
			# Don't echo anything to the page before setting this cookie!
			setcookie('token',$token, strtotime('+1 year'), '/');
			
			# Send them to the homepage
			Router::redirect('/');
		}
		# Fail
		else {
			Router::redirect('/users/login/error');
		}
	}
	
	/*-------------------------------------------------------------------------------------------------
	No view needed here, they just goto /users/logout, it logs them out and sends them
	back to the homepage.	
	-------------------------------------------------------------------------------------------------*/
    public function logout() {
       
       # Generate a new token they'll use next time they login
       $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
       
       # Update their row in the DB with the new token
       $data = Array(
       	'token' => $new_token
       );
	   
       DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);
       
       # Delete their old token cookie by expiring it
       setcookie('token', '', strtotime('-1 year'), '/');
       
       # Send them back to the homepage
       Router::redirect('/');
       
    }
	
	/*-------------------------------------------------------------------------------------------------
	Display User's Profile
	-------------------------------------------------------------------------------------------------*/
    public function profile($error = NULL) {
		
		# Route unauthenticated users to home with notifcation
		if(!$this->user) {
			Router::redirect('/?acct=false');
		}
		
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Update Profile";
		$this->template->content->error 	 = $error;
		
		echo $this->template;
				
    }
	
	/*-------------------------------------------------------------------------------------------------
	Update User's Profile
	-------------------------------------------------------------------------------------------------*/
    public function p_profile() {
	
		// Validate input

		#if any required fields are empty, return error
		if(empty($_POST['first_name'])||empty($_POST['last_name'])||empty($_POST['email'])){
			$blank = 'blank=blank';
		}
		
		# Check for valid email
		if(isset($_POST['email'])){
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$email = $_POST['email'];
			}
			else{
				$error = true;
				$mail = 'email=invalid';
			}
		}
		
		# Check for valid website url
		if(!empty($_POST['website'])){
			if(filter_var($_POST['website'], FILTER_VALIDATE_URL)){
				$website = $_POST['website'];
			}
			else{
				$error = true;
				$url = 'url=invalid';
			}
		}
	
		# If password field is set and matches confirmation, update password
		if(!empty($_POST['password']) || !empty($_POST['password2'])){
			if($_POST['password'] == $_POST['password2']){
				$password = sha1(PASSWORD_SALT.$_POST['password']);
			}
			else{
				$error = true;
				$pw = 'password=mismatch';
			}
        }
		
		// Process photo
		
		# If Remove Photo is checked, restore default avatar
		if (isset($_POST['rm_photo'])) {
			$data = Array('photo' => 'default.png');
            DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);
		}
		else{
			# If new photo chosen, process upload
			if (!empty($_FILES['photo']['name'])) {
            
				# Convert file extensions to lowercase and upload
				$_FILES['photo']['name'] = strtolower($_FILES['photo']['name']);
				$photo = Upload::upload($_FILES, "/uploads/avatars/", array('jpg', 'jpeg', 'gif', 'png',), $this->user->user_id);

				# Return error if invalid file type
				if($photo == 'Invalid file type.') {
					$error = true;
					$file = 'file=invalid';	
				}
				
				# Process image
				else {
					$data = Array("photo" => $photo);
					DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);
					
					$imgObj = new Image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $photo);
					$imgObj->resize(50,50, "crop");
					$imgObj->save_image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $photo); 
				}
			}
        }
		
		// Update if no errors
		if ($error == true){
			Router::redirect('/users/profile/error?' . $blank . '&' . $mail . '&' . $pw . '&' . $url . '&' . $file);
		}
		else{
			$data = Array(
				'first_name' => strip_tags(htmlentities(stripslashes(nl2br($_POST['first_name'])),ENT_NOQUOTES,"Utf-8")),
				'last_name' => strip_tags(htmlentities(stripslashes(nl2br($_POST['last_name'])),ENT_NOQUOTES,"Utf-8")),
				'email' => $email,
				'password' => $password,
				'bio' => strip_tags(htmlentities(stripslashes(nl2br($_POST['bio'])),ENT_NOQUOTES,"Utf-8")),
				'website' => $website,
			);
			
			DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);
			
			# Send them back to the homepage
			Router::redirect('/users/profile?success=true');
		}
    }
	
} # end of the class