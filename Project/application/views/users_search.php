<div class='pull-left col-md-3'>
<?php

echo form_open('users_controller/search', array('class' => 'form-inline'));
	echo form_input(array(
						'name' => 'search_box',
						'class' =>	'form-control',
						'placeholder'=>'Search'
						));

	echo "<button type='submit' class='btn btn-success buttonsearch' value='Search'><i class='glyphicon glyphicon-search'></i></button>";
echo form_close();

?>
</div>