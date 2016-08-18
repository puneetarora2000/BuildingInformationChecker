<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url('assets/sbadmin/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo site_url('assets/sbadmin/bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo site_url('assets/sbadmin/dist/js/sb-admin-2.js');?>"></script>
    <script src="<?php echo site_url('assets/sbadmin/js/printThis.js');?>"></script>
    <script src="<?php echo site_url('assets/sbadmin/js/admin.js');?>"></script>	 

    <?php
		// Grocery CRUD scripts
		if ( !empty($output) )
		{
			
			foreach ($output->js_files as $file)
				echo "<script src='$file'></script>".PHP_EOL;
		}
	?>
	<?php if(isset($calculations_js)) { 
        echo "<script src=".site_url('assets/sbadmin/js')."/".$calculations_js."></script>".PHP_EOL;
     }?>

<?php echo $before_body;?>
</body>
</html>