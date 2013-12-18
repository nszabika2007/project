<h2>Please log in to see the website!</h2>
<div class='col-md-4 well text-left'>

<?php
echo form_open('login_controller/login',array(
													'id' => 'users_login',
													'class' => 'form-horizontal'
													));

echo form_label('Username' , 'username');
echo form_input(array(
						'name'=>'username',
						'class'=>'form-control',
						'placeholder'=>'Username',
						'required'=>'required',
						'minlength'=>'3',
						'maxlength'=>'20'
						));
echo '<br />';		
echo form_label('Password' , 'password');
echo form_password(array(
						'id'=>'password',
						'name'=>'password',
						'class'=>'form-control',
						'placeholder'=>'Password',
						'required'=>'required',
						'minlength'=>'5'
						));
echo '<br />';							
echo form_submit(array(
						'name' => 'submit',
						'value'=>'Login',
						'class' => 'btn btn-primary'
						));

echo form_close();
?>
</div>