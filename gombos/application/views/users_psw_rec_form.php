<div class='pull-left col-md-4'>
<?php

echo form_open('login_controller/psw_reset',array(
													'id' => 'users_psw_rec',
													'class' => 'form-inline'
													));

echo form_label('E-mail' , 'email');
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
echo form_submit(array(
						'name' => 'submit',
						'value'=>'Ok',
						'class' => 'btn btn-primary buttonsearch'
						));

echo form_close();
?>
</div>
