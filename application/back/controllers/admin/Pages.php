<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the Pages page');
      redirect('admin','refresh');
    }
    $this->load->model('page_model');
    $this->load->model('page_translation_model');
    $this->load->model('language_model');
    $this->load->library('form_validation');
    $this->load->helper('text');
  }

  public function index()
  {
    //$this->render('admin/pages/index_view');
  }
...