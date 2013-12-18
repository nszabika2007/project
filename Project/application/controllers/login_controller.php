<?php

class Login_Controller extends CI_Controller
{
	private $view_array =array();
	function __construct()
	{
		parent::__construct();	
		$this->load->model('Users_Model');
		$this->load->library('form_validation');
		$this -> load -> helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('email');
	}
	
	private function wraper($data=array(),$param=0)
	{
		$this -> load -> view ('layout/header');
		if($param==0)
		{
			$this -> load -> view ('layout/menu');
		}
		foreach ($this ->view_array AS $num => $value)
			$this -> load -> view($value['view_location'] , array('array'=>$value['data']));
		$this -> load -> view ('layout/footer');
		
	}
	
	public function is_logged_in()
	{
		$loged_in = $this->session->userdata('logged_in');
		if($loged_in == false)
		{	
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function login()
	{
		$config = array(
			array(
				'field'   => 'username', 
				'label'   => 'Username', 
				'rules'   => 'required'
			),
			array(
				'field'   => 'password', 
				'label'   => 'Password', 
				'rules'   => 'required'
			),
		);
		$this->form_validation->set_rules($config);
			
		if ($this->form_validation->run() == FALSE)
		{
			$this -> view_array[] = array ('view_location' => 'users_login','data' => array());
			$this -> wraper($this->view_array,1);
		}
		else
		{
			$username=trim($this->input->post('username'));
			$password=md5($this->input->post('password'));

			$this->Users_Model->db->select('username')
									->from('users')
									->where('username', $username)
									->where('password', $password)
									->limit(1);
			$query=$this->Users_Model->db->get();
			
			if($query -> num_rows() == 1)
			{
				$uss = array(
					'username'  => $this->input->post('username'),
					'logged_in' => TRUE
				);
				
				$this->session->set_userdata($uss);
				$output= 'You have logged in '.$this->input->post('username').'!';
				
				$this -> load -> view ('layout/header');
				$this -> view_array[] = array (
									'view_location' => 'users_succes',
									'data' => array($output)
									);
				$this -> wraper($this->view_array);
				
			}
			else
			{
				$output='<a href="'.base_url().'index.php/Login_Controller/psw_reset">Press here to recover your password!</a><br />';
				$this -> view_array[] = array ('view_location' => 'users_error','data' => array('<p class="lead">Username or password is incorrect!</p>'));
				$this -> view_array[] = array ('view_location' => 'users_error','data' => array($output));
				$this -> view_array[] = array ('view_location' => 'users_login','data' => array());
				$this -> wraper($this->view_array,1);
			}
		}
	}	

	public function logout()
	{
		$this->session->sess_destroy();
		$this -> view_array[] = array ('view_location' => 'users_succes','data' => array('You have logged out!'));
		$this -> wraper($this->view_array,1);
	}
	
	public function psw_reset()
	{
		$config = array(
			array(
				'field'   => 'email', 
				'label'   => 'Email', 
				'rules'   => 'required'
			),
		);
		$this->form_validation->set_rules($config);
			
		if ($this->form_validation->run() == FALSE)
		{
			$this -> view_array[] = array ('view_location' => 'users_psw_rec_form','data' => array());
			$this -> wraper($this->view_array,1);
		}
		else
		{
			$email=$this->input->post('email');
			
			$this->Users_Model->db->select('username')
									->from('users')
									->where('email', $email)
									->limit(1);
			$query=$this->Users_Model->db->get();
			
			if($query -> num_rows() == 1)
			{
			
				$data = array();
				foreach ($query->result() AS $num => $user)
				{
					$data[] = array('username'	=> $user -> username,);
				}
				$username=$data[0]['username'];
			
				$npsw = md5(microtime());
				$param = base64_encode(json_encode(array('username'=> $username,
														 'password'=> $npsw
														 )));
														 
				$urlc=base_url().'index.php/login_controller/psw_recovery/'.$param;										 
				$url = str_replace("===", "", $urlc);
				$url2 = '<a href="'.$url.'">'.$url.'</a>';
				echo $url2;
				$message='Hello! Click at the link below to reset your password! \n\r'.$url2;	
				
				$this->db->set('password',$npsw)
						->where('username',$username)
						->update('users'); 
				
				$pswd = array('url' => $param ,
						'clicked' => 'N',
						'username' => $username
						);

				$this->db->insert('psw_rec', $pswd); 
	
				
				$this->email->from('projekt@example.com', 'Admin');
				$this->email->to($email); 
				$this->email->subject('Password Recovery');
				$this->email->message($message);	
				if($this->email->send())
				{
					$this -> view_array[] = array ('view_location' => 'users_succes','data' => array('<h3>We sent you a message!<br /> Please check your email!</h3>'));
					$this -> wraper($this->view_array,1);
				}
				else
				{
					show_error($this->email->print_debugger());
				}
				
				
			}
			else
			{
				$this -> view_array[] = array ('view_location' => 'users_succes','data' => array('<h3>Email adress is not found!<br /> Try again!</h3>'));
				$this -> view_array[] = array ('view_location' => 'users_psw_rec_form','data' => array());
				$this -> wraper($this->view_array,1);
			}
		}
	}
	
	public function psw_recovery($reset_string)
	{
		$carray = json_decode(base64_decode($reset_string));
		$user_array=array();
		foreach($carray AS $num)
		{
			$user_array[] = $num;
		}
		$username=$user_array[0];
		$password=$user_array[1];
		
		$this->db->select('clicked')
				->from('psw_rec')
				->where('url', $reset_string)
				->limit(1);
		$query2=$this->db->get();
		$data = array();
		foreach ($query2->result() AS $num => $user)
		{
			$data[] = array(
					'clicked'	=> $user -> clicked,	
			);
		}
		$ok=$data[0]['clicked'];
		
		if($ok=='N')
		{
			$uss = array(
					'username'  => $username,
					'logged_in' => TRUE
				);
				
			$this->session->set_userdata($uss);
			$this->newpassword();
		}
		else
		{
			$this -> view_array[] = array ('view_location' => 'users_error','data' => array('<h2>You reseted your password already!</h2>'));
			$this -> wraper($this->view_array,1);
		}
		
	}
	
	public function newpassword()
	{
		$config = array(
					array(
					'field'   => 'password', 
					'label'   => 'Password', 
					'rules'   => 'required'
					),
				);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this -> view_array[] = array ('view_location' => 'users_psw_reset','data' => array());
			$this -> wraper($this->view_array,1);
		}
		else
		{
			$username = $this->session->userdata('username');
			$password=md5($this->input->post('password'));
			$passwordc=md5($this->input->post('cpassword'));
			if($password==$passwordc)
			{
				$this->db->set('password',$password)
							->where('username',$username)
							->update('users'); 
				
				$this->db->set('clicked','Y')
						->where('username',$username)
						->update('psw_rec');
				$this -> load -> view ('layout/header');
				$this -> view_array[] = array ('view_location' => 'users_succes','data' => array('<h2>You have setted your password, and you logged in!</h2>'));
				$this -> wraper($this->view_array);
			}
			else
			{
				$this -> view_array[] = array ('view_location' => 'users_error','data' => array('<h3>The twoo paswords must be the same and it has to be at least 5 characters long!</h3>'));
				$this -> view_array[] = array ('view_location' => 'users_psw_reset','data' => array());
				$this -> wraper($this->view_array,1);
			}
		}
	}
}

?>