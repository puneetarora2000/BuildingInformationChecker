<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="row">
	<div class="col-lg-12">
		<h2>
		<?php echo $page_title; 
	if(!empty($crud_type)) {
		if(strpos($this->uri->uri_string(), 'read')):
		switch ($crud_type) {
			case 'performaa':
				echo '<a href="'.site_url('admin/forms/performareceipt').'/'.$this->uri->segment($this->uri->total_segments()).'" class="btn btn-primary pull-right">View Receipt</a>';
				break;
			case 'performab':
				echo '<a href="'.site_url('admin/forms/performareceipt').'/'.$this->uri->segment($this->uri->total_segments()).'" class="btn btn-primary pull-right">View Receipt</a>';
				break;
			case 'performac':
				echo '<a href="'.site_url('admin/forms/performareceipt').'/'.$this->uri->segment($this->uri->total_segments()).'" class="btn btn-primary pull-right">View Receipt</a>';
				break;
			default:
				# code...
				break;
		}
		endif;
		
			if($crud_type == 'resultregister_download'):
				echo '<a href="'.site_url('admin/seedsamples/downloadreport').'" class="btn btn-primary pull-right">Download Report</a>';
			endif;
	}
		if(strpos($this->uri->uri_string(), 'inspections/index')):
			//var_dump($this);
			echo '<a href="'.site_url('admin/inspections/finalreport/').'/'.$this->uri->segment($this->uri->total_segments()).'" class="btn btn-primary pull-right">View Complete Report</a>';
		endif;
		?>		
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
	