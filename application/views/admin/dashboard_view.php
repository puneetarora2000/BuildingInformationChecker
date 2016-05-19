<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $user_role = $this->ion_auth->get_users_groups()->row()->name;
	   $user_name = $this->ion_auth->user()->row()->username; 
?>

<div class="row">
	<div class="col-lg-12">
		<h3>Welcome to the <?php echo ucfirst($user_name);?> Panel </h3>
		<h3><?php echo ucfirst($user_role);?> </h3>
	</div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
