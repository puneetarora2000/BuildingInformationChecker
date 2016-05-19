<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performaa extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
      redirect('admin','refresh');
    }
    $this->load->library('grocery_CRUD');    
  }

  public function index($group_id = NULL)
  {
    $this->data['page_title'] = 'Performa A';
    $this->data['users'] = $this->ion_auth->users($group_id)->result();
    $this->render('admin/crud/crud_list_view');
  }

  
}