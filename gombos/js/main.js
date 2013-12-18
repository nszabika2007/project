$(document).ready(function(){ 

	$("#users_table").tablesorter();
	$("#adress_table").tablesorter();
	
	$("#user_form" ).validate({
		rules: {
			username: {
			  required: true,
			  minlength: 3,
			  maxlength: 20
			},
			
			password: {
			  required: true,
			  minlength: 5,
			  maxlength: 20
			},
			
			name: {
			  required: true,
			  minlength: 3,
			  maxlength: 30
			},
			
			email: {
			  required: true,
			  email: true,
			  minlength: 10,
			  maxlength: 40
			},
			
			phone_number: {
			  required: true,
			  number: true,
			  minlength: 5,
			  maxlength: 15
			},
			
			description: {
			  required: true,
			  minlength: 5,
			  maxlength: 100
			}
		}
	});
	
	$( "#user_form_reset" ).validate({
	  rules: {
		password: "required",
		cpassword: {
		  equalTo: "#password"
		}
	  }
	});
	
	$( "#users_login" ).validate({
		rules: {
			username: {
			required: true,
			minlength: 3,
			maxlength: 20
			},

			password: {
			required: true,
			minlength: 5,
			maxlength: 20
			}
		}
	});
	
	$( "#users_psw_rec" ).validate({
		rules: {
			email: {
			  required: true,
			  email: true,
			  minlength: 10,
			  maxlength: 40
			}
		}
	});
	
	$( "#ch_adress" ).validate({
		rules: {
			adress: {
			  required: true,
			  minlength: 10,
			  maxlength: 40
			}
		}
	});
	
	$("#user_adress" ).validate({
		rules: {
			country: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			county: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			city: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			zip: {
			  required: true,
			  number: true,
			  minlength: 3,
			  maxlength: 10
			},
			
			street: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			number: {
			  required: true,
			  minlength: 1,
			  maxlength: 10
			}
		}
	});
	
	$("#myFormSubmit" ).validate({
		rules: {
			country: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			county: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			city: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			zip: {
			  required: true,
			  number: true,
			  minlength: 3,
			  maxlength: 10
			},
			
			street: {
			  required: true,
			  minlength: 3,
			  maxlength: 40
			},
			
			number: {
			  required: true,
			  minlength: 1,
			  maxlength: 10
			}
		}
	});
	
	$( '.edit-address' ).click( function ()
	{
		var myString = $(this).attr( 'id' );
		var myStringArray = myString.split(',');

		$( '.edit-address-user-id' ).val( myStringArray[0] );
		$( '.edit-address-user-country' ).val( myStringArray[1] );
		$( '.edit-address-user-county' ).val( myStringArray[2] );
		$( '.edit-address-user-city' ).val( myStringArray[3] );
		$( '.edit-address-user-zip' ).val( myStringArray[4] );
		$( '.edit-address-user-street' ).val( myStringArray[5] );
		$( '.edit-address-user-number' ).val( myStringArray[6] );
		
	});
	
	$( '.edit-address2' ).click( function ()
	{
		$( '#edit-address-user2' ).val( $(this).attr( 'id' ) );
	});
	
	$( '.insert-address' ).click( function ()
	{
		$( '#insert-address-user' ).val( $(this).attr( 'id' ) );
	});
	
}); 