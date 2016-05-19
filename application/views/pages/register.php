<div class="content"> 
<?php // var_dump($_POST); ?>

<div class="panel panel-default">
  <div class="panel-heading"><h2 style="color:#fff;">Register Yourself</h2>
  <!-- <p style="text-align:center"><?php echo lang('create_user_subheading');?></p> -->
  </div>
  <div class="panel-body">
   <div class="container-fluid">
    <?php if($fields['message']): ?>
      <div id="infoMessage" class="alert alert-danger"><?php echo $fields['message'];?></div>
    <?php endif; ?>
    <?php //echo $identity_column; ?>
    <?php 
    $label_attributes = array(
        'class' => 'col-sm-2 control-label'
        );
    echo form_open("pages/register",array('class'=>'form-horizontal'));?>

          <div class="form-group">
                <?php 
                echo form_label('First name','first_name', $label_attributes); 
                echo '<div class="col-sm-10">';
                echo form_input($fields['first_name'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
                <?php 
                echo form_label('Last name','last_name', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['last_name'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          
          
          <?php
          if($fields['identity_column']!=='email') {
              echo '<div class="form-group">';
              echo form_label('Username','username', $label_attributes);
              echo form_error('username');
              echo '<div class="col-sm-10">';
              echo form_input($fields['identity'],'Username','class="form-control"');
              echo '</div></div>';
          }
          ?>
          <div class="form-group">
                <?php 
                echo form_label('Company','company', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['company'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
                <?php 
                echo form_label('Address','address', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['address'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
                <?php 
                echo form_label('Email','email', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['email'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
                <?php 
                echo form_label('Phone','phone', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['phone'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
                <?php 
                echo form_label('Password','password', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['password'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
                <?php 
                echo form_label('Confirm Password','password_confirm', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_input($fields['password_confirm'],'','class="form-control"');
                echo '</div>';
                ?>
          </div>

          <div class="form-group">
                <?php 
                $options = array(
                    'mohali' => 'Mohali',
                    'ludhiana'  => 'Ludhiana',
                    'kotakpura' => 'Kotakpura',
                    'jalandhar' => 'Jalandhar'
                  );
                echo form_label('PSSCA Branch','branch', $label_attributes);
                echo '<div class="col-sm-10">';
                echo form_dropdown($fields['branch'], $options, 'mohali', 'class=form-control');
                echo '</div>';
                ?>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label" for="submit"> </label>
          <div class="col-sm-10" align="left">
            <?php echo form_submit('submit', lang('create_user_submit_btn'),'class="btn btn-primary" style="background:#279174 none repeat scroll 0 0"');?></p>
          </div>

    <?php echo form_close();?>
    </div>
  </div>
</div>
</div>
<br /><br />