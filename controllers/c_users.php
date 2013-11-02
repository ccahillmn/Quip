<?php
class users_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
    public function __construct() {
    
    	# Make sure the base controller construct gets called
		parent::__construct();
    } 
    
    
    /*-------------------------------------------------------------------------------------------------
    Process the sign up form
    -------------------------------------------------------------------------------------------------*/
    public function p_signup() {
	    	    
	    # Mark the time
	    $_POST['created']  = Time::now();
	    
	    # Hash password
	    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	    
	    # Create a hashed token
	    $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
	    
	    # Insert the new user    
	    DB::instance(DB_NAME)->insert_row('users', $_POST);
	    
	    # Send them to the login page
	    Router::redirect('/users/login');
	    
    }
	
	/*-------------------------------------------------------------------------------------------------
	Display a form so users can login
	-------------------------------------------------------------------------------------------------*/
    public function login() {
    
    	$this->template->content = View::instance('v_users_login');    	
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
		
		echo $q;	
		
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
	
} # end of the class