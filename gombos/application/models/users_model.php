<?php

class Users_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get_users()
	{
		$this->db->select('username,name,email,phone_number,description')
					->from('users')
					->order_by('username','asc');
		$data=$this->db->get();
		return $data;
	}
	
	public function search($search_txt)
	{
		if(is_numeric($search_txt))
			{
				$this->db->like('phone_number',$search_txt);
			}
			else
			{
				$this->db->or_like('name',$search_txt)
							->or_like('username',$search_txt)
							->or_like('email',$search_txt)
							->or_like('description',$search_txt);
			}
	}
	
	public function add_user($data)
	{
		$this->db->insert('users', $data); 
	}
	
	public function see_more($user)
	{
		$this->db->select('u.username,a.id,a.country,a.county,a.city,a.zip,a.street,a.number')
					->from('users u')
					->join('adresses a', 'u.username = a.user')
					->where('username',$user)
					->order_by('u.username','asc');
		$data=$this->db->get();
		return $data;
	
	}
	
	public function is_used($column,$user)
	{
		$this->db->select('username')
					->from('users')
					->where($column, $user)
					->limit(1);
		$query=$this->db->get();
		
		if($query -> num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get_user($id)
	{
		$this->db->select('user')
					->from('adresses')
					->where('id', $id)
					->limit(1);
		$query=$this->db->get();
		$array=$query->result();
		$data = array();
		foreach ($array AS $num => $user)
			$data[] = array('user'	=> $user -> user);	
		return $data[0]['user'];
	}
			
	public function insert_adress($data)
	{
		$this->db->insert('adresses', $data); 
	}
	
	public function change_adress($id,$array)
	{
		foreach($array as $column => $value)
		{
			 $this->db->set($column,$value)
						->where('id',$id)
						->update('adresses'); 
		}
		return $this->get_user($id);
	}
	
	public function delete_adress($param)
	{
		$user=$this->get_user($param);
		$this->db->where('id', $param)
				->delete('adresses'); 
		return $user;
	}
}

?>