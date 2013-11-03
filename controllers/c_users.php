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
		$this->template->title   = "Sign up";
		$this->template->content->error = $error;
		
    	echo $this->template;   
		
	}
    
    /*-------------------------------------------------------------------------------------------------
    Process the sign up form
    -------------------------------------------------------------------------------------------------*/
    public function p_signup() {

		if($_POST){
		
			#Check for existing account
			$exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");

			if (isset($exists)) {
				Router::redirect('/users/login?acct=exists');         
			}
			
			# Validate form input
			else{
		
				#Check for empty fields
				foreach($_POST as $req){
					if(empty($req)){
						$blank = 'req=blank';
					}
				}
				
				#check for valid email
				#todo
				
				# Match passwords
				if($_POST['password'] != $_POST['password2']){
					$pw = 'pw=mismatch';
				}
				
				Router::redirect('/users/signup/error?' . $blank . '&' . $pw);
			}
		}
		
		#Clean up input
		$firstname = $_POST['first_name'];
		$firstname = strip_tags(htmlentities(stripslashes(nl2br($firstname)),ENT_NOQUOTES,"Utf-8"));
							
		$lastname = $_POST['last_name'];
		$lastname = strip_tags(htmlentities(stripslashes(nl2br($lastname)),ENT_NOQUOTES,"Utf-8"));
	    	    
	    # Mark the time
	    $_POST['created']  = Time::now();
	    
	    # Hash password
	    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	    
	    # Create a hashed token
	    $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
	    
	    # Insert the new user    
	    DB::instance(DB_NAME)->insert_row('users', $_POST);
	    
	    # Send them to the login page
	    Router::redirect('/users/login/?acct=new');
	    
    }
	
	/*-------------------------------------------------------------------------------------------------
	Display a form so users can login
	-------------------------------------------------------------------------------------------------*/
    public function login() {
    
    	$this->template->content = View::instance('v_users_login'); 
		$this->template->title   = "Login to Quip";

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
			echo "Login failed! <a href='/users/login'>Try again?</a>";
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
    public function profile() {
		
		# Route unauthenticated users to home with notifcation
		if(!$this->user) {
			Router::redirect('/?acct=false');
		}
		
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Update Profile";
		
		echo $this->template;
				
    }
	
	/*-------------------------------------------------------------------------------------------------
	Update User's Profile
	-------------------------------------------------------------------------------------------------*/
    public function p_profile() {

		#if any required fields are empty, return error; else update user
		if(empty($_POST['first_name'])||empty($_POST['last_name'])||empty($_POST['email'])){
			Router::redirect('/users/profile?error=blank');
		}
		else{
			$data = Array(
				'first_name' => $_POST['first_name'],
				'last_name' => $_POST['last_name'],
				'email' => $_POST['email'],
				'bio' => $_POST['bio'],
				'website' => $_POST['website'],
			);
			DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);
		}
	
		# If password field is set and matches confirmation, update password
		if(!empty($_POST['password'])){
			if($_POST['password'] == $_POST['password2']){
				$newpw = sha1(PASSWORD_SALT.$_POST['password']);
				$data = Array('password' => $newpw);
				DB::instance(DB_NAME)->update('users', $data, 'WHERE user_id ='. $this->user->user_id);
			}
			#If passwords don't match, return error
			else{
				Router::redirect('/users/profile?error=pw');
			}
        }

		# If Remove Photo is checked, replace default avatar
		if (isset($_POST['rm_photo'])) {
			$data = Array("photo" => 'default.png');
            DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);
		}
		
		# If new photo chosen, process upload
		elseif ($_FILES['photo']['name'] == 0) {
            
			# Conver file extensions to lowercase and upload
			$_FILES['photo']['name'] = strtolower($_FILES['photo']['name']);
            $photo = Upload::upload($_FILES, "/uploads/avatars/", array('jpg', 'jpeg', 'gif', 'png',), $this->user->user_id);

			# Return error if invalid file type
            if($photo == 'Invalid file type.') {
                Router::redirect("/users/profile?error=invalid"); 
            }
            else {
                # update file name in db
                $data = Array("photo" => $photo);
                DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);
				
				# Process image
                $imgObj = new Image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $photo);
                $imgObj->resize(50,50, "crop");
                $imgObj->save_image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $photo); 
            }
        }
		
		# Send them back to the homepage
		Router::redirect('/users/profile?update=success');
		
    }
	
} # end of the class