<div class="row">
  <div class="col-lg-6">
    <h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage" class="bg-danger" style="padding: 10px;"><?php echo $message;?></div>
<?php //echo $identity_column; ?>
<?php echo form_open("register");?>

      <div class="form-group">
            <?php echo lang('create_user_fname_label', 'first_name');?>
            <?php echo form_input($first_name,'','class="form-control"');?>
      </div>
      <div class="form-group">
            <?php echo lang('create_user_lname_label', 'last_name');?> 
            <?php echo form_input($last_name,'','class="form-control"');?>
      </div>
      
      
      <?php
      if($identity_column!=='email') {
          echo '<div class="form-group">';
          echo lang('create_user_identity_label', 'username');
          echo form_error('username');
          echo form_input($identity,'Username','class="form-control"');
          echo '</div>';
      }
      ?>
      <div class="form-group">
            <?php echo lang('create_user_company_label', 'company');?> 
            <?php echo form_input($company,'','class="form-control"');?>
      </div>
      <div class="form-group">
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email,'','class="form-control"');?>
      </div>
      <div class="form-group">
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone,'','class="form-control"');?>
      </div>
      <div class="form-group">
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password,'','class="form-control"');?>
      </div>
      <div class="form-group">
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm,'','class="form-control"');?>
      </div>
      
        <?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>

  </div>
</div>
<br /><br />