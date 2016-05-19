<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container-fluid" style="padding: 20px 0px; margin: 0 -10px">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/users/create');?>" class="btn btn-primary">Create user</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
    <?php //var_dump($users);
    if(!empty($users))
    { ?>
      <table class="table table-hover table-bordered table-condensed">
        <tr>
          <td>ID</td>
          <td>Username</td>
          <td>Name</td>
          <td>Email</td>
          <td>Role</td>
          <td>Last login</td>
          <td>Operations</td>
        </tr>
    <?php
      foreach($users as $user)
      { ?>
        <tr>
          <td><?php echo $user->id; ?></td>
          <td><?php echo $user->username; ?></td>
          <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
          <td><?php echo $user->email; ?></td>
          <?php 
        //  $this->load->library('ion_auth');
          $roles = $this->ion_auth->get_users_groups($user->id)->result(); ?>
          <td>
          <?php 
          //print_r($roles);
              foreach ($roles as $role) {
                echo ucwords($role->name).', ';
              } ?>
          </td>
          <td> 
          <?php
            if($user->last_login != NULL):
              echo date('Y-m-d H:i:s', $user->last_login); ?>
          </td>
          <td> <?php
            else:
              echo 'Not Logged in yet. '; ?>
          </td>
          <td> <?php
            endif;
            if($current_user->id != $user->id) echo anchor('admin/users/edit/'.$user->id,'<span class="glyphicon glyphicon-pencil"></span>').' '.anchor('admin/users/delete/'.$user->id,'<span class="glyphicon glyphicon-remove"></span>');
            else echo '&nbsp;';
          ?>
          </td>
        </tr>
        <?php
      } ?>
      </table>
    <?php 
    }
    ?>
    </div>
  </div>
</div>