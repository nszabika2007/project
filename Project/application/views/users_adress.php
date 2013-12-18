<?php

$this->table->set_heading('Username','Country', 'County','City','ZIP','Street','Number','','');
$this->table->set_template(array('table_open'=>'<table id=\'adress_table\' class=\'table\'>'));
$data = array();

if(count($array)!=0)
{
	foreach ($array AS $num => $user)
	{
		$data[] = array(
					
					'username'	=> $user -> username,	
					'country'	=> $user -> country,
					'county'	=> $user -> county,	
					'city'	=> $user -> city,				
					'zip'	=> $user -> zip,
					'street'	=> $user -> street,
					'number'	=> $user -> number,
					'edit'=>'<a id="'.$user -> id.','.$user -> country.','.$user -> county.','.$user -> city.','.$user -> zip.','.$user -> street.','.$user -> number.'" data-toggle="modal" href="#popup" class="btn btn-info btn-sm edit-address" >Edit adress</a>',
					'delete'=>'<a id="'.$user -> id.'" data-toggle="modal" href="#popup2" class="btn btn-danger btn-sm edit-address2" >x</a>',
					);
	}
	echo $this -> table -> generate($data);
	echo '<a id="'.$user -> username.'" data-toggle="modal" href="#popup3" class="btn btn-primary btn-sm insert-address" >Add adress</a>';
}
else
{
	$user=$this->uri->segment(3);
	echo '<a id="'.$user.'" data-toggle="modal" href="#popup3" class="btn btn-primary btn-sm insert-address" >Add adress</a>';
}
?>
<!-- Modal popup -->
<!-- Add adress -->
<div class="modal fade" id="popup3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		  <h4 class="modal-title">Add new adress:</h4>
		</div>
		<div class="modal-body">
			<form id="myFormSubmit" method="POST" action="<?php echo base_url(); ?>index.php/Users_Controller/insert_adress">
				<input type="hidden" value="0" name="user_id" id="insert-address-user"/>
				<label for="country">Country:</label><br />
				<input type="text" name="country" id="country" placeholder="Country" required="required" minlength="3" maxlength="40" /><br />
				<label for="county">County:</label><br />
				<input type="text" name="county" id="county" placeholder="County" required="required" minlength="3" maxlength="40" /><br />
				<label for="city">City:</label><br />
				<input type="text" name="city" id="city" placeholder="City"  required="required" minlength="3" maxlength="40" /><br />
				<label for="zip">ZIP:</label><br />
				<input type="text" name="zip" id="zip" placeholder="ZIP" required="required" minlength="3" maxlength="10" /><br />
				<label for="street">Street:</label><br />
				<input type="text" name="street" id="street" placeholder="Street"  required="required" minlength="3" maxlength="40" /><br />
				<label for="numnber">Number:</label><br />
				<input type="text" name="number" id="number" placeholder="Number"  required="required" minlength="1" maxlength="10" /><br /><br />
				<input id="myFormSubmit" class="btn btn-primary" type="submit" value="Add adress">
				<button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
			</form>
		</div>
	  </div>
	</div>
</div>

<!-- Edit adress -->
<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		  <h4 class="modal-title">Edit your adress:</h4>
		</div>
		<div class="modal-body">
			<form id="myFormSubmit" method="POST" action="<?php echo base_url(); ?>index.php/Users_Controller/edit_adress">
				<input type="hidden" value="0" name="user_id" class="edit-address-user-id"/>
				<label for="country">Country:</label><br />
				<input type="text" name="country" id="country" value="0" class="edit-address-user-country" required="required" minlength="3" maxlength="40" /><br />
				<label for="county">County:</label><br />
				<input type="text" name="county" id="county" value="0" class="edit-address-user-county" required="required" minlength="3" maxlength="40" /><br />
				<label for="city">City:</label><br />
				<input type="text" name="city" id="city" value="0" class="edit-address-user-city"  required="required" minlength="3" maxlength="40" /><br />
				<label for="zip">ZIP:</label><br />
				<input type="text" name="zip" id="zip" value="0" class="edit-address-user-zip" required="required" minlength="3" maxlength="10" /><br />
				<label for="street">Street:</label><br />
				<input type="text" name="street" id="street" value="0" class="edit-address-user-street"  required="required" minlength="3" maxlength="40" /><br />
				<label for="numnber">Number:</label><br />
				<input type="text" name="number" id="number" value="0" class="edit-address-user-number"  required="required" minlength="1" maxlength="10" /><br /><br />
				<input id="myFormSubmit" class="btn btn-primary" type="submit" value="Edit your adress">
				<button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
			</form>
		</div>
	  </div>
	</div>
</div>

<!-- Delete adress -->
<div class="modal fade" id="popup2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Are you sure to delete adress?</h4>
		</div>
		<div class="modal-body">
			<form id="myformdelete" method="POST" action="<?php echo base_url(); ?>index.php/Users_Controller/delete_adress">
				<input type="hidden" value="0" name="user_id" id="edit-address-user2"/>
				<input id="myFormSubmit" class="btn btn-primary" type="submit" value="Yes">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</form>
		</div>
	  </div>
	</div>
</div>
<!-- Modal popup end -->