<?php
class posts_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
    public function __construct() {
    
    	# Make sure the base controller construct gets called
		parent::__construct();
		
		# Limit access to authenticated users
		if(!$this->user) {
			Router::redirect('/');
		}
    } 
	
	/*-------------------------------------------------------------------------------------------------
	View all posts
	-------------------------------------------------------------------------------------------------*/
	public function index($add = true,$error = NULL) {
		
		# Set up view
		$this->template->content = View::instance('v_posts_index');

		# Set up query for posts
		$q = 'SELECT 
			    posts.content,
			    posts.created,
			    posts.user_id AS post_user_id,
				posts.post_id,
			    users_users.user_id AS follower_id,
			    users.first_name,
			    users.last_name,
				users.photo
			FROM posts
			INNER JOIN users_users 
			    ON posts.user_id = users_users.user_id_followed
			INNER JOIN users 
			    ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id . ' 
			OR posts.user_id = '.$this->user->user_id . '
			GROUP BY posts.post_id
			ORDER BY posts.created DESC';
		
		# Run query	for posts
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		# Run query for user info
		$profile = DB::instance(DB_NAME)->select_row("SELECT * FROM users WHERE user_id = " . $this->user->user_id);
		
		# Pass data to the view
		$this->template->content->stream = View::instance('v_posts_stream');
		$this->template->content->user_sum = View::instance('v_users_user');
		$this->template->content->add_post = View::instance('v_posts_add');
		$this->template->content->stream->posts = $posts;
		$this->template->content->user_sum->profile= $profile;
		$this->template->content->error = $error;
		
		
		# Render view
		echo $this->template;
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	View all posts by a specific user
	-------------------------------------------------------------------------------------------------*/
	public function user($user_id, $error = NULL) {
	
		# If no user set, redirect to index
		if(!isset($user_id)){
			Router::redirect('/');
		}
		
		# Set up view
		$this->template->content = View::instance('v_posts_profile');

		# Set up query
		$q = 'SELECT 
			    posts.content,
			    posts.created,
			    posts.user_id AS post_user_id,
				posts.post_id,
			    users.first_name,
			    users.last_name,
				users.photo
			FROM posts
			INNER JOIN users 
			    ON posts.user_id = users.user_id
			WHERE posts.user_id = '.$user_id . ' 
			OR posts.user_id = '.$user_id . '
			ORDER BY posts.created DESC';
		
		# Run query	for posts
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		# Run query for user info
		$profile = DB::instance(DB_NAME)->select_row("SELECT * FROM users WHERE user_id = " . $user_id);
		
		# Diplay add post box if on own profile
		$add = ($user_id == $this->user->user_id ? true : false);
		
		# Pass data to the view
		$this->template->content->stream = View::instance('v_posts_stream');
		$this->template->content->user_sum = View::instance('v_users_user');
		$this->template->content->add_post = View::instance('v_posts_add');
		$this->template->content->stream->posts = $posts;
		$this->template->content->user_sum->profile = $profile;
		$this->template->content->error = $error;
		$this->template->content->add = $add;
		
		# Render view
		echo $this->template;
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Process new posts
	-------------------------------------------------------------------------------------------------*/
	public function p_add() {
	
		# Remove trailing whitespace
		$content = trim($_POST['content']);
		
		# Return error if post is blank
		if (empty($content)){
			Router::redirect('/posts');
		}

		# Add post
		else{
			$data = array(
				'content'  => strip_tags(htmlentities($_POST['content'])),
				'user_id'  => $this->user->user_id,
				'created'  => Time::now(),
				'modified' => Time::now()
			);
			
			DB::instance(DB_NAME)->insert_row('posts', $data);
			
			# Redirect back to previous page
			
			Router::redirect($_POST['page_id']);
		}
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Delete a post
	-------------------------------------------------------------------------------------------------*/
	public function delete($post_id, $user_id) {
	
		# Set up the where condition
	    $where_condition = 'WHERE post_id = '.$post_id;
	    
	    # Run the delete
	    DB::instance(DB_NAME)->delete('posts', $where_condition);
		
		# Redirect back to previous page
		$page_id = (isset($user_id) ? 'user/'.$user_id : "");
		
		Router::redirect('/posts/'.$page_id);
	

		
	}
	
	/*-------------------------------------------------------------------------------------------------
	View all users w/option to Follow
	-------------------------------------------------------------------------------------------------*/
	public function users() {
		
		# Set up view
		$this->template->content = View::instance('v_posts_users');
		
		# Set up query to get all users
		$q = "SELECT *
			FROM users
			WHERE user_id != ".$this->user->user_id;
			
		# Run query
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Set up query to get all connections from users_users table
		$q = 'SELECT *
			FROM users_users
			WHERE user_id = '.$this->user->user_id;
			
		# Run query
		$connections = DB::instance(DB_NAME)->select_array($q,'user_id_followed');
		
		# Pass data to the view
		$this->template->content->users = $users;
		$this->template->content->connections = $connections;
		$this->template->content->user_sum = View::instance('v_users_user');
		
		# Render view
		echo $this->template;
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Creates a row in the users_users table representing that one user is following another
	-------------------------------------------------------------------------------------------------*/
	public function follow($user_id_followed) {
	
	    # Prepare the data array to be inserted
	    $data = Array(
	        "created"          => Time::now(),
	        "user_id"          => $this->user->user_id,
	        "user_id_followed" => $user_id_followed
	        );
	
	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_users', $data);
	
	    # Send them back
	    Router::redirect("/posts/users");
	
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	Removes the specified row in the users_users table, removing the follow between two users
	-------------------------------------------------------------------------------------------------*/
	public function unfollow($user_id_followed) {
	
	    # Set up the where condition
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	    
	    # Run the delete
	    DB::instance(DB_NAME)->delete('users_users', $where_condition);
	
	    # Send them back
	    Router::redirect("/posts/users");
	
	}

} # End of class