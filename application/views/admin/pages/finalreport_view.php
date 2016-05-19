<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 

//
//var_dump($inspections_joined);

//print_r($output);
if(!empty($performa_id)){
?>
<div class="pull-right"><a href="<?php echo base_url('admin/myperformas/genpdf').'/'.$performa_id; ?>" class="btn btn-primary" >Download PDF</a></div>
<?php
}
echo $output->output;
 ?>
