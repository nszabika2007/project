<div class='col-md-4 well text-left'>
<?php
echo form_open('login_controller/newpassword',array(
													'id' => 'user_form_reset',
													'class' => 'form-horizontal'
													));
	
echo form_label('New Password' , 'password');
echo form_password(array(
						'id'=>'password',
						'name'=>'password',
						'class'=>'form-control',
						'placeholder'=>'Password',
						'required'=>'required',
						'minlength'=>'5'
						));
echo '<br />';	
echo form_label('Confirm Password' , 'password');
echo form_password(array(
						'id'=>'cpassword',
						'name'=>'cpassword',
						'class'=>'form-control',
						'placeholder'=>'Confirm Password',
						'required'=>'required',
						'minlength'=>'5'
						));
echo '<br />';							
echo form_submit(array(
						'name' => 'submit',
						'value'=>'Reset',
						'class' => 'btn btn-primary'
						));

echo form_close();
?>
</div>