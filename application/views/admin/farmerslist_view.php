<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="row">
	<div class="col-lg-12">
	<?php if($crud_type == 'farmerslist'): ?>
		<form method="POST" class="form-inline" action="<?php echo base_url('admin/farmers/year');?>">
			<?php //var_dump($years);?>
			<div class="form-group">
			<label for="year">Select Year</label>
			<select id="year" name="year" class="form-control">
			<?php foreach ($years as $year) {
				echo '<option value='.$year->YearID.'">'.$year->StartYear.'-'.$year->EndYear.'</option>';
			}
			?>	
			</select>
			</div>
			
			<input class="btn btn-success" type="submit" value="List Farmers">
			
		</form>
	<?php endif;
		if($crud_type == 'farmerslist_yearwise'){
			echo '<a class="btn btn-info" href="javascript:window.history.go(-1);">Go Back</a>';
		}
	?>
		<h2>
		<?php echo $page_title; ?>
		</h1>
		<?php 
		echo $output->output; ?>
	</div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<br /><br />
</div>
<!-- /.row -->
	