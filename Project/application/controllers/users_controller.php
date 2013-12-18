<?php

class Users_Controller extends CI_Controller
{
	private $view_array =array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_Model');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->controller('Login_Controller');
		$this->load->library('session');
		$this->load->library('table');
		$this->load->helper('devloper_helper');
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
	
	public function index()
	{
		$login=$this->Login_Controller->is_logged_in();
		if($login==true)
		{
			$this->get_users_sql();
		}
		else
		{
			$this->Login_Controller->login();
		}
	}
	
	public function search()
	{
		$searcha=array();
		$search_txt='';
		$search_txt=mysql_real_escape_string($this->input->post('search_box'));
		if(!empty($search_txt))
		{
			$this->Users_Model->search($search_txt);
		}
		$this->index();
	}
	
	public function get_users_sql()
	{
		$data=$this->Users_Model->get_users();
		
		$this->load->library('table');
		$this -> view_array[] = array (
									'view_location' => 'users_search',
									'data' => array()
									);
		$this -> view_array[] = array (
									'view_location' => 'users_table',
									'data' => $data->result()
									);
		$this -> wraper($this->view_array);
	}
	
	public function insert_user()
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
			array(
				'field'   => 'name', 
				'label'   => 'Real Name', 
				'rules'   => 'required'
			),   
			array(
				'field'   => 'email', 
				'label'   => 'Email', 
				'rules'   => 'required'
			),
			array(
				'field'   => 'phone_number', 
				'label'   => 'Phone Number', 
				'rules'   => 'required'
			),   
			array(
				'field'   => 'description', 
				'label'   => 'Description', 
				'rules'   => 'required'
			),   
		);
		$this->form_validation->set_rules($config);
			
		if ($this->form_validation->run() == FALSE)
		{
			$this -> view_array[] = array ('view_location' => 'users_form','data' => array());
			$this -> wraper($this->view_array);
		}
		else
		{
			
			$usernamel=strlen($this->input->post('username'));
			$passl=strlen($this->input->post('password'));
			$namel=strlen($this->input->post('name'));
			$emaill=strlen($this->input->post('email'));
			$phonel=strlen($this->input->post('phone_number'));
			$descl=strlen($this->input->post('description'));
		
			$form=array(
				'username'=>mysql_real_escape_string(trim($this->input->post('username'))),
				'password'=>md5(mysql_real_escape_string($this->input->post('password'))),
				'name'=>mysql_real_escape_string($this->input->post('name')),
				'email'=>mysql_real_escape_string($this->input->post('email')),
				'phone_number'=>mysql_real_escape_string($this->input->post('phone_number')),
				'description'=>mysql_real_escape_string($this->input->post('description')),
			);
			
			$error=array();
			
			if($this->Users_Model->is_used('username',$form['username']))
			{
				$error[]='Username is already used! <br />';
			}
			
			if($this->Users_Model->is_used('email',$form['email']))
			{
				$error[]='Email is already used! <br />';
			}
			
			if(($usernamel<3 or $usernamel>20))
				$error[]='Username has to be min 3 and max 20 characters long! <br />';
				
			if(($passl<5 or $passl>20))
				$error[]='Password has to be min 5 and max 20 character long! <br />';
				
			if(($namel<3 or $namel>30))
				$error[]='Name has to be min 3 and max 30 character long! <br />';
			
			if(($emaill<10 or $emaill>40))
				$error[]='Email has to be min 10 and max 40 characters long! <br />';
				
			if (!is_numeric($this->input->post('phone_number')))
				$error[]='Please write numbers to phone number! <br />';
				
			if(($phonel<5 or $phonel>15))
				$error[]='Phone Number has to be min 5 and max 15 characters long! <br />';
				
			if(($descl<5 or $descl>100))
				$error[]='Description has to be min 5 and max 100 characters long! <br />';
				
			if (count($error) > 0)
			{
				$this -> view_array[] = array ('view_location' => 'users_error','data' => $error);
				$this -> view_array[] = array ('view_location' => 'users_form','data' => array());
				$this -> wraper($this->view_array);
			}
			else
			{
				$this->Users_Model->add_user($form);
				$this -> view_array[] = array ('view_location' => 'users_succes','data' => array('You have added a new user!'));
				$this -> wraper($this->view_array);
			}
		}
	}
	
	public function see_more($user)
	{
		$data=$this->Users_Model->see_more($user);
		if($data -> num_rows() >= 1)
		{
			$this -> view_array[] = array ('view_location' => 'users_adress','data' => $data->result());
			$this -> wraper($this->view_array);
		}
		else
		{
			$this -> view_array[] = array ('view_location' => 'users_error','data' => array('This user has not added adress to his/her account yet!<br /><br />'));
			$this -> view_array[] = array ('view_location' => 'users_adress','data' => array());
			$this -> wraper($this->view_array);
		}
		
	}
	
	public function insert_adress()
	{
		
		$form=array(
			'user'=> mysql_real_escape_string(trim($this->input->post('user_id'))),
			'country'=>mysql_real_escape_string(trim($this->input->post('country'))),
			'county'=>mysql_real_escape_string(trim($this->input->post('county'))),
			'city'=>mysql_real_escape_string(trim($this->input->post('city'))),
			'zip'=>mysql_real_escape_string(trim($this->input->post('zip'))),
			'street'=>mysql_real_escape_string(trim($this->input->post('street'))),
			'number'=>mysql_real_escape_string(trim($this->input->post('number'))),
		);
		
		if(strlen($form['country'])<3 or strlen($form['country'])>40)
			$error[]='Country has to be min 3 and max 40 characters long! <br />';
			
		if(strlen($form['county'])<3 or strlen($form['county'])>40)
			$error[]='County has to be min 3 and max 40 character long! <br />';
			
		if(strlen($form['city'])<3 or strlen($form['city'])>40)
			$error[]='City has to be min 3 and max 40 character long! <br />';
		
		if(strlen($form['zip'])<3 or strlen($form['zip'])>10)
			$error[]='ZIP has to be min 3 and max 10 characters long! <br />';
			
		if (!is_numeric($form['zip']))
			$error[]='Please write numbers to zip! <br />';
			
		if(strlen($form['street'])<3 or strlen($form['street'])>40)
			$error[]='Street has to be min 3 and max 40 characters long! <br />';
			
		if(strlen($form['number'])<1 or strlen($form['number'])>10)
			$error[]='Number has to be min 1 and max 10 characters long! <br />';
		if (count($error) > 0)
		{
			$user=$this->Users_Model->get_user($id);
			redirect(base_url().'index.php/Users_Controller/see_more/'.$user.'', 'refresh');
		}
		else
		{
			$user=$this->Users_Model->insert_adress($form);
			redirect(base_url().'index.php/Users_Controller/see_more/'.$this->input->post('user_id').'', 'refresh');
		}
	}
	
	public function edit_adress()
	{
		$id=mysql_real_escape_string($this->input->post('user_id'));
		
		$error=array();
		
		$form=array(
			'country'=>mysql_real_escape_string(trim($this->input->post('country'))),
			'county'=>mysql_real_escape_string(trim($this->input->post('county'))),
			'city'=>mysql_real_escape_string(trim($this->input->post('city'))),
			'zip'=>mysql_real_escape_string(trim($this->input->post('zip'))),
			'street'=>mysql_real_escape_string(trim($this->input->post('street'))),
			'number'=>mysql_real_escape_string(trim($this->input->post('number'))),
		);
		
		if(strlen($form['country'])<3 or strlen($form['country'])>40)
			$error[]='Country has to be min 3 and max 40 characters long! <br />';
			
		if(strlen($form['county'])<3 or strlen($form['county'])>40)
			$error[]='County has to be min 3 and max 40 character long! <br />';
			
		if(strlen($form['city'])<3 or strlen($form['city'])>40)
			$error[]='City has to be min 3 and max 40 character long! <br />';
		
		if(strlen($form['zip'])<3 or strlen($form['zip'])>10)
			$error[]='ZIP has to be min 3 and max 10 characters long! <br />';
			
		if (!is_numeric($form['zip']))
			$error[]='Please write numbers to zip! <br />';
			
		if(strlen($form['street'])<3 or strlen($form['street'])>40)
			$error[]='Street has to be min 3 and max 40 characters long! <br />';
			
		if(strlen($form['number'])<1 or strlen($form['number'])>10)
			$error[]='Number has to be min 1 and max 10 characters long! <br />';
		if (count($error) > 0)
		{
			$user=$this->Users_Model->get_user($id);
			redirect(base_url().'index.php/Users_Controller/see_more/'.$user.'', 'refresh');
		}
		else
		{
			$user=$this->Users_Model->change_adress($id,$form);
			redirect(base_url().'index.php/Users_Controller/see_more/'.$user.'', 'refresh');
		}
	}
	
	public function delete_adress()
	{
		$id=$this->input->post('user_id');
		$user=$this->Users_Model->delete_adress($id);
		redirect(base_url().'index.php/Users_Controller/see_more/'.$user.'', 'refresh');
	}
}
?>