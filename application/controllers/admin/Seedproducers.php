<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seedproducers extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    /*if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
      redirect('admin','refresh');
    }*/
    $this->load->library('grocery_CRUD'); 
  }

  public function index()
  {
    $this->data['page_title'] = 'Seedproducer';
    $crud = new grocery_CRUD();
    $crud->set_table('users');
    $crud->set_subject('Seed Producers');
    $crud->set_theme('datatables');

    $this->load->library('ion_auth');

    $groups = $this->ion_auth->groups()->result();
    $group_id;
    foreach ($groups as $group) {
      if($group->name == 'seedproducer') {
        $group_id = $group->id;
      }
    }

    $users = $this->ion_auth->users($group_id)->result();
    $newusers = array();
    foreach ($users as $user) {
      unset($user->ip_address);
      unset($user->password);
      unset($user->salt);
      unset($user->activation_code);
      unset($user->forgotten_password_code);
      unset($user->forgotten_password_time);
      unset($user->remember_code);
      unset($user->created_on);
      unset($user->last_login);
      unset($user->active);
      unset($user->id);
      unset($user->blacklisted);
      unset($user->blacklist_reason);

      array_push($newusers, (array)$user);
      
    }

   // var_dump($users);

    $columns = array_keys($newusers[0]);

    //var_dump($columns);

    $crud->unset_delete();
    $crud->unset_add();
    $crud->unset_read();
    $crud->unset_edit();

    $crud->add_action('View Inspections', '' ,'admin/inspections/', 'btn btn-danger');

    $crud->unset_columns('ip_address', 'password', 'salt', 'activation_code', 'forgotten_password_code', 'forgotten_password_time', 'remember_code', 'created_on', 'last_login','active');

    $crud->where('id', $group_id);
    $this->data['crud_type'] = 'seedproducers';
    $this->data['columns'] = $columns;
    $this->data['list'] = $users;
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/pages/seedproducerslist_view');

  }
  
  public function blacklist()
  {
    $this->data['page_title'] = 'Blacklist Seedproducer';
    $crud = new grocery_CRUD();

    $this->load->library('ion_auth');

    $groups = $this->ion_auth->groups()->result();
    $group_id;
    foreach ($groups as $group) {
      if($group->name == 'seedproducer') {
        $group_id = $group->id;
      }
    }

    $users = $this->ion_auth->users($group_id)->result();
    $newusers = array();
    foreach ($users as $user) {
      unset($user->ip_address);
      unset($user->password);
      unset($user->salt);
      unset($user->activation_code);
      unset($user->forgotten_password_code);
      unset($user->forgotten_password_time);
      unset($user->remember_code);
      unset($user->created_on);
      unset($user->last_login);
      unset($user->active);
      unset($user->id);

      array_push($newusers, (array)$user);
      
    }

   // var_dump($users);

    $columns = array_keys($newusers[0]);
   

    $this->data['crud_type'] = 'blacklist';
    $this->data['columns'] = $columns;
    $this->data['list'] = $users;

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/pages/seedproducersblacklist_view');
  }

  function callbackBlacklistInactive($post_array,$primary_key)
  {
    $this->db->where('id', $primary_key)->update('users', array('active' => 0));
    return true;
  }
  
  public function doblacklist()
  {
    $this->data['page_title'] = 'Seedproducer';
    $crud = new grocery_CRUD();
    $crud->set_table('users');
    $crud->set_subject('Seed Producers');

    $crud->unset_delete()
         ->unset_add()
         ->unset_read()
         ->unset_list()
         ->unset_back_to_list();

    $crud->fields('blacklisted', 'blacklist_reason');

    $crud->callback_after_update(array($this, 'callbackBlacklistInactive'));
    //$crud->field_type('active', 'hidden', 0);

    $crud->unset_texteditor('blacklist_reason');

    $crud->set_lang_string('update_success_message',
     'This Seed Producer has been blacklisted.<br/>Please wait while you are redirecting to the seed producer list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/seedproducers/blacklist').'";
     </script>
     <div style="display:none">
     '
    );

    $this->data['crud_type'] = 'seedproducers';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');

  }
}