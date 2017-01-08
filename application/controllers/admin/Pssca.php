<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pssca extends Admin_Controller
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
    $this->load->helper('url');
  }

  public function index()
  {
    
  }
  public function staff()
  {
    $this->data['page_title'] = 'Rule Engine Employees';
    $crud = new grocery_CRUD();
    $crud->set_table('employees');

   // $user_id= $this->ion_auth->user()->row()->id;
    $crud->set_subject('Employee');
    
    $crud->set_relation('RegionID','regional_office','RegionName');
    $crud->set_relation('DesignationID','designation_type','DesignationName ');
 //   $crud->set_relation('WingID','wing_type','WingName');

    $crud->display_as('firstName','First Name')
         ->display_as('lastName','Last Name')
         ->display_as('RegionID','Region Office')
         ->display_as('DesignationID','Designation');
    
    $crud->fields('suffix', 'firstName', 'lastName', 'DesignationID', 'RegionID', 'contact', 'email');

      $crud->required_fields('RegionID','contact','firstName');


      $this->data['crud_type'] = 'pssca';
      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
  }


  public function designations()
  {
    $this->output->enable_profiler(TRUE);
    $this->data['page_title'] = 'PSSCA Designations';
    $crud = new grocery_CRUD();
    $crud->set_table('designation_type');

   // $user_id= $this->ion_auth->user()->row()->id;
    $crud->set_primary_key('DesignationID','designation_type');
    $crud->set_subject('Designation');
    
    $crud->set_relation('CategoryID', 'category_type', 'CategoryName');

    $crud->display_as('DesignationName','Designation Name')
         ->display_as('CategoryID','Designation Category');

    //$crud->fields('DesignationName', 'CategoryID');
      
//    $crud->required_fields('DesignationName','CategoryID');

         $crud->callback_after_insert(array($this, 'after_insert_callback'));

      $this->data['crud_type'] = 'pssca';
      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
  }

   function after_insert_callback($post_array,$primary_key)
    {
            log_message('debug', 'SQL: '.$this->db->last_query());
    }

  public function categories()
  {
    $this->data['page_title'] = 'Staff Categories';
    $crud = new grocery_CRUD();
    $crud->set_table('category_type');

   // $user_id= $this->ion_auth->user()->row()->id;

    $crud->set_subject('Staff Category');
    
  //$crud->set_relation('WingID','wing_type','WingName');
    $crud->field_type('WingID', 'hidden', 1);
    $crud->display_as('CategoryName','Category Name')
         ->display_as('CategoryID','Designation Category')
         ->display_as('WingID','Wing');
      
      $crud->required_fields('CategoryName'); 

      $this->data['crud_type'] = 'pssca';
      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
  }
  
}