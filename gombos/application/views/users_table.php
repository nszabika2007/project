<?php

$this->table->set_heading('Username', 'Name', 'Email','Phone Number','Description');
$this->table->set_template(array('table_open'=>'<table id=\'users_table\' class=\'table table-hover\'>'));
$data = array();
foreach ($array AS $num => $user)
{
	$data[] = array(
				'username'	=> $user -> username,	
				'name'	=> $user -> name,
				'email'	=> $user -> email,	
				'phone_number'	=> $user -> phone_number,				
				'description'	=> $user -> description,
				''=>'<a class="btn btn-success btn-sm" href="'.base_url().'index.php/Users_Controller/see_more/'.$user -> username.'" role="button">See more</a>'
	);
}

echo $this -> table -> generate($data);
?>