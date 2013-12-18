<nav class="navbar navbar-inverse" role="navigation" style=''>
	<div class="navbar-header">
		<button class="navbar-toggle" data-target=".navbar-ex8-collapse" data-toggle="collapse" type="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/Users_Controller">Users</a>
	</div>
	<div class="collapse navbar-collapse navbar-ex8-collapse">
		<ul class="nav navbar-nav">	
			<li><a href="<?php echo base_url(); ?>index.php/Users_Controller/insert_user">Add new user</a><li>
			<li><a href="<?php echo base_url(); ?>index.php/Login_Controller/logout">Log out</a><li>
		</ul>
	</div>
</nav>