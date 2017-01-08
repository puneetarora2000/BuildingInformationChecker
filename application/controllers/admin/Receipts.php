<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipts extends Admin_Controller
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

  public function receipt_approve() {
    
    $this->load->model('receipts_model');
    $update_data = array(
        'status' => 'approved'
      );
    $last = $this->uri->total_segments();
    $id = $this->uri->segment($last);
  //  echo 'tt'.$id;
    $where = array(
        'id' => $id
      );
    
    $this->receipts_model->update($update_data, $where);
    //$this->load->helper('url');
    redirect_back();
  }

  public function receipt_pending() {
    
    $this->load->model('receipts_model');
    $update_data = array(
        'status' => 'pending'
      );
    $last = $this->uri->total_segments();
    $id = $this->uri->segment($last);
  //  echo 'tt'.$id;
    $where = array(
        'id' => $id
      );
    
    $this->receipts_model->update($update_data, $where);
    //$this->load->helper('url');
    redirect_back();
  }

  function changePerformaDisplay($value, $row)
  {
  	return ucwords(substr_replace($value, ' ' . substr($value, -1), -1) );
  }

  function changeStatusDisplay($value, $row)
  {
  	if($value == 'pending') 
  	{
  		return '<span style="background-color: #ff0000; color: #FFF; padding: 2px">'.$value.'</span>';
  	}
  	else {
  		return '<span style="background-color: #00ff24; padding: 2px">'.$value.'</span>';
  	}
  	
  }
	
	public function performaa()
	{
	    $this->data['page_title'] = 'Receipts Rule Engine ';
	    $crud = new grocery_CRUD();
	    $crud->set_table('receipts');
	    $crud->set_subject('Receipt');

	   // $crud->unset_add();
	    $crud->unset_edit();
	    $crud->unset_delete();
	    $crud->unset_read();

	    $crud->add_action('Approve', '' ,'admin/forms/receipt_approve', 'btn btn-success');
    	$crud->add_action('Disapprove', '' ,'admin/forms/receipt_pending', 'btn btn-danger');
    	
    	$crud->callback_column('PerformaType',array($this,'changePerformaDisplay'));
    	$crud->callback_column('status', array($this,'changeStatusDisplay'));

	  $crud->set_relation('PerformaID','performa','PerformaID');
   	
   	$user_id= $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

	  $where = array(
        'receipts.branch'       => $branch,
        'receipts.PerformaType' => 'performaa'
      );
      $crud->where($where);
      

	    $crud->unset_columns('created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'SeedProducerID', 'branch');

	    $this->data['crud_type'] = 'receipts_performa_a';
	    $this->data['disabling_css'] = 'disabling_css.css';

	    $this->data['output'] = $crud->render();

	    $this->render('admin/crud_view');
	  }

	  public function performab()
	  {
	    $this->data['page_title'] = 'Receipts';
	    $crud = new grocery_CRUD();
	    $crud->set_table('receipts');
	    $crud->set_subject('Receipt');

	   // $crud->unset_add();
	    $crud->unset_edit();
	    $crud->unset_delete();
	    $crud->unset_read();

	    $crud->add_action('Approve', '' ,'admin/forms/receipt_approve', 'btn btn-success');
    	$crud->add_action('Disapprove', '' ,'admin/forms/receipt_pending', 'btn btn-danger');
    	
    	$crud->callback_column('PerformaType',array($this,'changePerformaDisplay'));
    	$crud->callback_column('status', array($this,'changeStatusDisplay'));

	  $crud->set_relation('PerformaID','performa','PerformaID');

	  $user_id= $this->ion_auth->user()->row()->id;
      $branch = $this->ion_auth->user()->row()->branch;

	  $where = array(
        'receipts.branch'       => $branch,
        'receipts.PerformaType' => 'performab'
      );
      $crud->where($where);
   

	  $crud->where('receipts.PerformaType', 'performab');
      

	    $crud->unset_columns('created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'SeedProducerID', 'branch');
	    
	    $this->data['crud_type'] = 'receipts_performa_b';
	    $this->data['disabling_css'] = 'disabling_css.css';

	    $this->data['output'] = $crud->render();

	    $this->render('admin/crud_view');
	  }

	  public function performac()
	  {
	    $this->data['page_title'] = 'Receipts Rule Engine ';
	    $crud = new grocery_CRUD();
	    $crud->set_table('receipts');
	    $crud->set_subject('Receipt');

	   // $crud->unset_add();
	    $crud->unset_edit();
	    $crud->unset_delete();
	    $crud->unset_read();

		$crud->add_action('Approve', '' ,'admin/forms/receipt_approve', 'btn btn-success');
    	$crud->add_action('Disapprove', '' ,'admin/forms/receipt_pending', 'btn btn-danger');
    	
    	$crud->callback_column('PerformaType', array($this,'changePerformaDisplay'));
    	$crud->callback_column('status', array($this,'changeStatusDisplay'));

	  $crud->set_relation('PerformaID','performa','PerformaID');

	  $user_id= $this->ion_auth->user()->row()->id;
      $branch = $this->ion_auth->user()->row()->branch;

	  $where = array(
        'receipts.branch'       => $branch,
        'receipts.PerformaType' => 'performac'
      );
      $crud->where($where);
   

	  $crud->where('receipts.PerformaType', 'performac');
      

	    $crud->unset_columns('created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'SeedProducerID', 'branch');
	    
	    $this->data['crud_type'] = 'receipts_performa_c';
	    $this->data['disabling_css'] = 'disabling_css.css';

	    $this->data['output'] = $crud->render();

	    $this->render('admin/crud_view');
	  }
}