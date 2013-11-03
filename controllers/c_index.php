<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
		
		# if user is logged in, send to posts
		if($this->user) {
			Router::redirect('/posts/');
		}
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "Quip - a microblog for hipsters, because Twitter is too mainstream";
			
		# Sign-up form for modal
		$this->template->content->signup = View::instance('v_users_signup_form');
	
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	      					     		
		# Render the view
			echo $this->template;

	} # End of method
	
	
} # End of class
