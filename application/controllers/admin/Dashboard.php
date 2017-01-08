<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
  	//var_dump($this->ion_auth->user()->row());
  	$this->data['page_title'] = 'Rule Engine Admin Panel';
    $this->render('admin/dashboard_view');
  }
}