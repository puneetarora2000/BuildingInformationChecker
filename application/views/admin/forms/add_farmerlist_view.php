<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php  //print_r($crud->field_types);
//echo $output->output; 
//$div = '<div>test</div>';
//echo $this->performaa->get_div_value($div);
?>

<div class="container" style="width: 98%; background-color: #fff;">

<?php echo form_open_multipart('admin/farmerslist/add',array('class'=>''));?>
      <?php if(isset($message)): ?>
      <div class="alert alert-danger">
          <?php echo $message['error']; ?>
      </div>
      <?php endif;?>
      <div class="form-group">
        <?php
        echo form_label('Upload Farmers List','farmers_list');
        echo '<br/ ><br/ >';
     //   echo form_error('farmers_list', '<div class="alert alert-danger">', '</div>');
        echo form_upload('farmers_list',set_value('farmers_list'));
        ?>
      </div>
      <div class="form-group">
      <?php echo form_submit('submit', 'Add Farmers', 'class="btn btn-primary"');?>
      </div>
<?php echo form_close();?>

</div>	