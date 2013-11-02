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

} # End of class