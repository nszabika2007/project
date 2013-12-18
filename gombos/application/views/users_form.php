<div class='col-md-4 well text-left'>
<?php
echo form_open('users_controller/insert_user',array(
													'id' => 'user_form',
													'class' => 'form-horizontal'
													));

echo form_label('Username' , 'username');
echo '<br/>';
echo form_input(array(
						'name'=>'username',
						'id'=>'username',
						'class'=>'form-control',
						'placeholder'=>'username',
						'required'=>'required',
						'minlength'=>'3',
						'maxlength'=>'20'
						));
echo '<br/>';
echo form_label('Password' , 'password');
echo '<br/>';
echo form_password(array(
						'id'=>'password',
						'name'=>'password',
						'class'=>'form-control',
						'placeholder'=>'Password',
						'required'=>'required',
						'minlength'=>'5',
						'maxlength'=>'20'
						));
echo '<br/>';
echo form_label('Name' , 'name');
echo '<br/>';
echo form_input(array(
						'name'=>'name',
						'id'=>'name',
						'class'=>'form-control',
						'placeholder'=>'Name',
						'required'=>'required',
						'minlength'=>'3',
						'maxlength'=>'30'
						));			
echo '<br/>';	
echo form_label('E-mail' , 'email');
echo '<br/>';
echo form_input(array(
						'name'=>'email',
						'id'=>'email',
						'type'=>'email',
						'class'=>'form-control',
						'placeholder'=>'Email',
						'required'=>'required',
						'minlength'=>'10',
						'maxlength'=>'40'
						));	
echo '<br/>';
echo form_label('Phone number' , 'phone_number');
echo '<br/>';
echo form_input(array(
						'name'=>'phone_number',
						'id'=>'phone_number',
						'class'=>'form-control',
						'placeholder'=>'Phone Number',
						'required'=>'required',
						'minlength'=>'5',
						'maxlength'=>'15'
						));
echo '<br/>';
echo form_label('Description' , 'description');		
echo '<br/>';		
echo form_textarea(array(
						'name'=>'description',
						'id'=>'description',
						'rows'=>3,
						'class'=>'form-control',
						'placeholder'=>'Something about you',
						'required'=>'required',
						'minlength'=>'5',
						'maxlength'=>'100'
						));	
echo '<br/>';		
echo form_submit(array(
						'name' => 'submit',
						'value'=>'Add',
						'class' => 'btn btn-primary'
						));

echo form_close();
?>
</div>