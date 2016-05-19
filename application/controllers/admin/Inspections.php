<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspections extends Admin_Controller
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
    $this->load->model('Receipts_model', 'receipts');
    $this->load->helper('url');
  }

  public function index()
  {
    $this->data['page_title'] = 'Inspections';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Inspections');

    $crud->unset_add();
    $crud->unset_edit();
    $crud->unset_delete();

    $crud->set_relation('seed_producer_id','users','{first_name} {last_name}');
    $crud->set_relation('farmer_id','farmerslist','name');
    $crud->set_relation('crop_id','crop_master','CropName');
    $crud->set_relation('crop_variety','crop_variety','VarietyName');
    $crud->set_relation('seed_class','classes_of_seed','ClassName');

    $crud->display_as('reserved_distance_correct', 'Reserved Distance Correct (Yes/No)')
         ->display_as('crop_id', 'Crop Name')
         ->display_as('farmer_id', 'Farmer / Seed Producer')
         ->display_as('seed_producer_id', 'Seed Producer Organisation')
         ->display_as('area_inspected', 'Area Inspected');


    $crud->set_relation_n_n('first_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
      
    $crud->set_relation_n_n('first_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
    $crud->set_relation_n_n('first_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $crud->unset_columns('SubmittedBy', 'created_at', 'updated_at');

    $last = $this->uri->total_segments();
    $seed_producer_id = $this->uri->segment($last);
    
    $crud->where('seed_producer_id', $seed_producer_id);

    $this->data['crud_type'] = 'finalreport';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');

  }
  
  // Helper Functions for Callback Values

  public function callback_seed_producer() {
    $last = $this->uri->total_segments();
    $receipt_id = $this->uri->segment($last);
    $val = $this->receipts->get_field('receipts', 'id', $receipt_id, 'SubmittedBy');
    return $val;
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }
 /* public function callback_farmer_name() {
    $last = $this->uri->total_segments(); 
    $farmer_id = $this->uri->segment($last);
    $val = $this->receipts->get_field($farmer_id, 'submitted_by');
    return $val;
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }*/
  public function callback_seed_producer_address_id() {
    $last = $this->uri->total_segments();
    $reqid = $this->uri->segment($last);
    $val = $this->reqform->get_field($reqid, 'SeedProducerID');
    return '<input id="field-seed_producer_address_id" type="text" class="form-control" value="'.$val.'" name="seed_producer_id" readonly>';
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }
  public function callback_indivisible_crops() {
    
    $indivisible_crops = $this->receipts->get_fields('crop_master', 'isDivisible');

    $indivisible_crops_list = array();
      foreach ($indivisible_crops as $val) {
        $indivisible_crops_list += array(
            $val->CropID => $val->CropName
          );
      }
    return $indivisible_crops_list;
  }

  public function callback_objectionable_weeds() {
  
    $objectionable_weeds = $this->receipts->get_fields('weed_master', 'isObjectionable');

    $objectionable_weeds_list = array();
      foreach ($objectionable_weeds as $val) {
        $objectionable_weeds_list += array(
            $val->WeedID => $val->WeedName
          );
      }
    return $objectionable_weeds_list;
  }
  
  public function callback_seed_diseases() {
  
    $seed_diseases = $this->receipts->get_fields('disease_master', 'isFromSeed');

    $seed_diseases_list = array();
      foreach ($seed_diseases as $val) {
        $seed_diseases_list += array(
            $val->DiseaseID => $val->DiseaseName
          );
      }
    return $seed_diseases_list;
  }
  

  function inHect($value, $row)
  {
      return $value.' Hectares';
  }

  function yieldPerHect($value, $primary_key = null)
  {
      return '<input type="text" id="field-estimated_yield" maxlength="8,2" value="'.$value.'" name="estimated_yield">  / Hectare';
  }

  function startinspection_callback($primary_key , $row)
  {
    $last = $this->uri->total_segments();
    
    return site_url('admin/inspections/firstinspection/add').'/receipt/'.$this->uri->segment($last).'/farmer/'.$row->id;
  }

  public function startinspection()
  {
    $this->data['page_title'] = 'Start Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('farmerslist');
    $crud->set_subject('Start Inspection');

    $crud->unset_delete();
    $crud->unset_edit();

    $last = $this->uri->total_segments();
    $receipt_id = $this->uri->segment($last);


    $crud->add_action('First Inspection', '' ,'', 'btn btn-danger', array($this, 'startinspection_callback'));

    $crud->set_relation('submitted_by', 'users','{first_name} {last_name}')
        ->set_relation('yearid', 'year', '{StartYear} - {EndYear}')
        ->set_relation('crop_name', 'crop_master', 'CropName')
        ->set_relation('crop_variety', 'crop_variety', 'VarietyName')
        ->set_relation('seed_class', 'classes_of_seed', 'ClassName')
        ;

    $crud->display_as('submitted_by', 'Seed Producer Organisation')
        ->display_as('yearid', 'Year')
        ;

    $this->load->model('Receipts_model', 'receipts');
    $seed_producer_id = $this->receipts->fields('SeedProducerID')->where('id', $receipt_id)->get()->SeedProducerID;

    $crud->where('submitted_by', $seed_producer_id);


    $this->data['crud_type'] = 'start_inspection';
    $this->data['output'] = $crud->render();

    //$this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');

  }
  public function firstinspection()
  {
    $this->data['page_title'] = 'First Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('First Inspection');

    $crud->unset_delete();

    $crud->add_action('Second Inspection', '' ,'admin/inspections/secondinspection/edit', 'btn btn-danger');

    $crud->fields('first_inspection_date', 'seed_producer_id', 'farmer_id', 'crop_id', 'crop_variety', 'seed_class', 'inspection_stage', 'area_inspected', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops','first_inspection_objectionable_weeds','first_inspection_seed_disease', 'reserved_distance_correct', 'reserved_distance_deducted', 'receipt_id', 'performa_id', 'SubmittedBy', 'branch');

    $branch = $this->ion_auth->user()->row()->branch;

     $where = array(
        'inspections.inspection_stage' => 'first',
        'inspections.branch'           => $branch
      );

    $crud->required_fields('first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type');

    $crud->set_rules('area_inspected','Area Inspected','numeric');

    $state = $crud->getstate();
    $crud->unset_read_fields('inspection_stage', 'second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'SubmittedBy', 'created_at', 'updated_at');
    $crud->unset_columns('inspection_stage', 'second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'SubmittedBy', 'created_at', 'updated_at');

    switch ($state) {
      case 'add':

         //$last = $this->uri->total_segments();
         //$farmer_id = $this->uri->segment($last);

         $ids = $this->uri->uri_to_assoc(5);
         //print_r($ids);

         $receipt_id = $ids['receipt'];
         $farmer_id = $ids['farmer'];

         $this->load->model('Receipts_model', 'receipts');

         $Performa = $this->receipts->where('id', $receipt_id)->get();

       //  var_dump($Performa);

          if(is_numeric($farmer_id)) {

            $crud->field_type('farmer_id', 'hidden', $farmer_id);
            $crud->field_type('receipt_id', 'hidden', $receipt_id);
            $crud->field_type('performa_id', 'hidden', $Performa->PerformaID);
            $crud->field_type('inspection_stage', 'hidden', 'first');
            $crud->field_type('branch', 'hidden', $Performa->branch);
            $crud->field_type('year_id', 'hidden', $Performa->YearID);

            $seed_producer_id = $this->receipts->get_field('farmerslist', 'id', $farmer_id, 'submitted_by');
            $crud->field_type('seed_producer_id', 'hidden', $seed_producer_id);

            $submitted_by = $this->ion_auth->user()->row()->id;
            $crud->field_type('SubmittedBy', 'hidden', $submitted_by);

          }
        break;

        case 'edit':
           $last = $this->uri->total_segments();
           $farmer_id = $this->uri->segment($last);

            if(is_numeric($farmer_id)) {
              $seed_producer_id = $this->callback_seed_producer();
              $crud->field_type('seed_producer_id', 'hidden', $seed_producer_id);

              $submitted_by = $this->ion_auth->user()->row()->id;
              $crud->field_type('SubmittedBy', 'hidden', $submitted_by);
            }

          break;

        case 'read':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          $crud->display_as('seed_producer_id', 'Seed Producer Organisation')
                ->display_as('farmer_id', 'Farmer Name');
          break;
        case 'list':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          $crud->display_as('seed_producer_id', 'Seed Producer Organisation')
                ->display_as('farmer_id', 'Farmer Name');
          break;
      
      default:
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          $crud->display_as('seed_producer_id', 'Seed Producer Organisation')
                ->display_as('farmer_id', 'Farmer Name');
        break;
    }

//    $crud->field_type('inspection_stage', 'hidden', 'first');
    $crud->set_relation('crop_id', 'crop_master', 'CropName');
    $crud->set_relation('crop_variety', 'crop_variety', 'VarietyName');
    $crud->set_relation('seed_class', 'classes_of_seed', 'ClassName');

     $crud->display_as('crop_id', 'Crop Name')
          ->display_as('crop_variety', 'Crop Variety')
          ->display_as('seed_class', 'Seed Class')
          ->display_as('first_inspection_indivisible_crops','Indivisible Crops')
          ->display_as('first_inspection_objectionable_weeds','Objectionable Weeds')
          ->display_as('first_inspection_seed_disease','Diseases from Seeds');
          

      $crud->set_relation_n_n('first_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
      
      $crud->set_relation_n_n('first_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
      $crud->set_relation_n_n('first_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $this->data['crud_type'] = 'first_inspection';
    $this->data['output'] = $crud->render();

    $this->data['calculations_js'] = 'calculations.js';

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');
  }

  public function secondinspection()
  {
    $this->data['page_title'] = 'Second Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Second Inspection');

    $crud->unset_delete();

    $crud->add_action('Third Inspection', '' ,'admin/inspections/thirdinspection/edit', 'btn btn-danger');

    $crud->fields('second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'inspection_stage', 'SubmittedBy');

    $branch = $this->ion_auth->user()->row()->branch;

     $where = array(
        'inspections.inspection_stage' => 'second',
        'inspections.branch'           => $branch
      );

    $crud->required_fields('second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type');

    $state = $crud->getstate();
    $crud->unset_read_fields('crop_id', 'crop_variety', 'seed_class', 'area_inspected',  'reserved_distance_correct', 'inspection_stage', 'first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_inspection_seed_disease', 'third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'SubmittedBy', 'created_at', 'updated_at');

    $crud->unset_columns('crop_id', 'crop_variety', 'seed_class', 'area_inspected',  'reserved_distance_correct', 'area_alloted', 'area_inspected', 'khet_no', 'reserved_distance', 'reserved_distance_correct', 'seed_producer_address_id', 'start_date_of_sowing', 'end_date_of_sowing', 'created_at', 'updated_at', 'inspection_stage', 'first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_second_inspection_seed_disease', 'third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'SubmittedBy');

    $crud->unset_add();

    switch ($state) {

        case 'edit':
              $submitted_by = $this->ion_auth->user()->row()->id;
              $crud->field_type('SubmittedBy', 'hidden', $submitted_by);
              $crud->field_type('inspection_stage', 'hidden', 'second');

          break;

        case 'read':
            $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
            $crud->set_relation('farmer_id', 'farmerslist','name');

          break;
        case 'list':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
 
          break;
      
      default:
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
        break;
    }



     $crud->display_as('seed_producer_id', 'Seed Producer Organisation')
          ->display_as('farmer_id', 'Farmer Name')
          ->display_as('second_inspection_date','Second Inspection Date')
          ->display_as('second_inspection_report_no','Second Inspection Report No.')
          ->display_as('second_inspection_indivisible_crops','Indivisible Crops')
          ->display_as('second_inspection_objectionable_weeds','Objectionable Weeds')
          ->display_as('second_inspection_seed_disease','Diseases from Seeds');

      $crud->set_relation_n_n('second_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
      $crud->set_relation_n_n('second_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
      $crud->set_relation_n_n('second_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $this->data['crud_type'] = 'second_inspection';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');
  }

  public function thirdinspection()
  {
    $this->data['page_title'] = 'Third Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Third Inspection');

    $crud->unset_delete();

    $crud->add_action('Fourth Inspection', '' ,'admin/inspections/fourthinspection/edit', 'btn btn-danger');

    $crud->fields('third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'inspection_stage', 'SubmittedBy');

    $branch = $this->ion_auth->user()->row()->branch;

     $where = array(
        'inspections.inspection_stage' => 'third',
        'inspections.branch'           => $branch
      );

    $crud->required_fields('third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type');

    $state = $crud->getstate();
    $crud->unset_read_fields('crop_id', 'crop_variety', 'seed_class', 'area_inspected',  'reserved_distance_correct', 'inspection_stage', 'first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_inspection_seed_disease', 'second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'SubmittedBy', 'created_at', 'updated_at');

    $crud->unset_columns('crop_id', 'crop_variety', 'seed_class', 'area_inspected',  'reserved_distance_correct', 'inspection_stage', 'first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_inspection_seed_disease', 'second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'SubmittedBy', 'created_at', 'updated_at');

    $crud->unset_add();

    switch ($state) {

        case 'edit':
              $submitted_by = $this->ion_auth->user()->row()->id;
              $crud->field_type('SubmittedBy', 'hidden', $submitted_by);

              $crud->field_type('inspection_stage', 'hidden', 'third');

          break;

        case 'read':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          break;
        case 'list':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          break;
      
      default:
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
        break;
    }


    $crud->display_as('seed_producer_id', 'Seed Producer Organisation')
          ->display_as('farmer_id', 'Farmer Name')
          ->display_as('third_inspection_date','Third Inspection Date')
          ->display_as('third_inspection_report_no','Third Inspection Report No.')
          ->display_as('third_inspection_indivisible_crops','Indivisible Crops')
          ->display_as('third_inspection_objectionable_weeds','Objectionable Weeds')
          ->display_as('third_inspection_seed_disease','Diseases from Seeds');

      $crud->set_relation_n_n('third_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
      $crud->set_relation_n_n('third_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
      $crud->set_relation_n_n('third_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $this->data['crud_type'] = 'third_inspection';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');
  }

  public function fourthinspection()
  {
    $this->data['page_title'] = 'Fourth Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Fourth Inspection');

    $crud->unset_delete();

    //$crud->add_action('Inspection Report', '' ,'admin/inspections/finalreport/read', 'btn btn-danger');

    $crud->fields('area_inspected', 'reserved_distance_deducted', 'fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'fourth_inspection_indivisible_crops', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease', 'SubmittedBy', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'total_quantity', 'special_remarks', 'inspection_stage');

    $branch = $this->ion_auth->user()->row()->branch;

     $where = array(
        'inspections.inspection_stage' => 'fourth',
        'inspections.branch'           => $branch
      );

    $crud->required_fields('fourth_inspection_date', 'fourth_inspection_report_no', 'fourth_inspection_of_type', 'cancelled_reserved_distance', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'cancelled_less_than_set_quality', 'estimated_yield', 'special_remarks');

    $state = $crud->getstate();
    $crud->unset_read_fields('crop_id', 'crop_variety', 'seed_class', 'area_inspected',  'reserved_distance_correct', 'inspection_stage', 'first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_inspection_seed_disease', 'second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'SubmittedBy', 'created_at', 'updated_at');

    $crud->unset_columns('crop_id', 'crop_variety', 'seed_class', 'area_inspected',  'reserved_distance_correct', 'inspection_stage', 'first_inspection_date', 'first_inspection_report_no', 'first_inspection_of_type', 'first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_inspection_seed_disease', 'second_inspection_date', 'second_inspection_report_no', 'second_inspection_of_type', 'second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease', 'third_inspection_date', 'third_inspection_report_no', 'third_inspection_of_type', 'third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease', 'SubmittedBy', 'created_at', 'updated_at');

    $crud->unset_add();

    switch ($state) {

        case 'edit':
              $submitted_by = $this->ion_auth->user()->row()->id;
              $crud->field_type('SubmittedBy', 'hidden', $submitted_by);
              $crud->field_type('reserved_distance_deducted', 'readonly');
              $crud->field_type('area_inspected', 'readonly');
              $crud->field_type('inspection_stage', 'hidden', 'fourth');
              $crud->callback_field('estimated_yield',array($this,'yieldPerHect'));
          break;

        case 'read':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          break;
        case 'list':
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
          break;
      
      default:
          $crud->set_relation('seed_producer_id', 'users','{first_name} {last_name}');
          $crud->set_relation('farmer_id', 'farmerslist','name');
        break;
    }

     $crud->display_as('seed_producer_id', 'Seed Producer Organisation')
          ->display_as('farmer_id', 'Farmer Name')
          ->display_as('fourth_inspection_date','Fourth Inspection Date')
          ->display_as('fourth_inspection_report_no','Fourth Inspection Report No.')
          ->display_as('fourth_inspection_indivisible_crops','Indivisible Crops')
          ->display_as('fourth_inspection_objectionable_weeds','Objectionable Weeds')
            ->display_as('fourth_inspection_seed_disease','Diseases from Seeds');

      $crud->set_relation_n_n('fourth_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
      $crud->set_relation_n_n('fourth_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
      $crud->set_relation_n_n('fourth_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));
      $crud->unset_texteditor('special_remarks', 'full_text');
    $this->data['crud_type'] = 'fourth_inspection';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->data['calculations_js'] = 'calculations.js';

    $this->render('admin/crud_view');
  }

  function callbackEmail($post_array)
  {
    $this->load->library('email');
    $site = $this->config->item('site');

    $this->load->model('Users_model', 'users');
    $email = $this->users->fields('email')->where('id', $post_array['seed_producer_id'])->get()->email;

    $this->email->from('info@pssca.punjab.gov.in', $site['name']);
    $this->email->to($email);

    $this->email->subject('Inspection Completed');
    $this->email->message('Testing the email class.');

    $this->email->send();

    echo $this->email->print_debugger();

  }

  public function finalreport()
  {
    $this->data['page_title'] = 'Inspection Report';

    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Inspection Report')
         ->set_theme('inspection')
         ->unset_add()
         ->unset_edit()
         ->unset_delete();

    $last = $this->uri->total_segments();
    $seed_producer_id = $this->uri->segment($last);
    
    $this->load->model('Inspection_model', 'inspection');
    $inspection_data = array(
        'inspection_stage'  => 'final'
      );
    $this->inspection->where('seed_producer_id', $seed_producer_id)->update($inspection_data);

    $crud->display_as('farmer_id', 'Seed Grower\'s Name and Address')
          ->display_as('seed_producer_id', 'Seed Producer')
          ->display_as('crop_id', 'Crop')
          ->display_as('crop_variety', 'Crop Variety')
          ->display_as('seed_class', 'Seed Class')
          ->display_as('area_inspected', 'Inspected Area')
          ->display_as('reserved_distance_correct', 'Reserved Distance Correct (Yes/No)');

    $crud->set_relation('seed_producer_id', 'users', '{first_name} {last_name}');
    $crud->set_relation('crop_id', 'crop_master', 'CropName');
    $crud->set_relation('crop_variety', 'crop_variety', 'VarietyName');
    $crud->set_relation('seed_class', 'classes_of_seed', 'ClassName');
    $crud->set_relation('farmer_id', 'farmerslist', '{name} <br> {address} <br> {village}');

    $crud->callback_after_update(array($this, 'callbackEmail'));

    $branch = $this->ion_auth->user()->row()->branch;

    $where = array(
        'inspections.seed_producer_id' => $seed_producer_id,
        'inspections.branch'           => $branch
      );
    
//    $this->load->model('Inspection_model', 'inspections');

//    $this->data['inspections'] = $this->inspections->where('seed_producer_id', 2)->get_all();
//    $this->data['inspections_joined'] = $this->inspections->get_inspections($seed_producer_id);

    $crud->set_relation_n_n('first_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
    $crud->set_relation_n_n('first_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
    $crud->set_relation_n_n('first_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $crud->unset_columns('crop_id', 'crop_variety', 'seed_class', 'seed_producer_id', 'inspection_stage', 'SubmittedBy', 'created_at', 'updated_at');

    $this->data['crud_type'] = 'finalreport';
    $this->data['output'] = $crud->render();

    $this->render('admin/pages/finalreport_view');
  }

  /*public function receipts()
  {
    $this->data['page_title'] = 'Receipts Received';
    $crud = new grocery_CRUD();
    $crud->set_table('receipts');
     $crud->set_subject('Receipt');

   // $crud->unset_add();
    $crud->unset_edit();
    $crud->unset_delete();

    $crud->unset_columns('created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'SeedProducerID');
    $crud->unset_read_fields('created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'SeedProducerID');
   // $crud->add_action('Approve', '' ,'admin/forms/receipt_approve', 'btn btn-success');
     $crud->add_action('Start Inspection', '' ,'admin/inspections/startinspection', 'btn btn-danger');



     $crud->display_as('DateofPerformaA','Date of Performa-A')
           ->display_as('RegionID','Region')
         ->display_as('YearID','Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('BreederProviderID','Breeder Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('ClassID','Seed Class')
         ->display_as('Area','Area of your land')
         ->display_as('Photocopy_of_Breeder_Seed_Purchase_Voucher','Photocopy of Breeder Seed Purchase Voucher')
         ->display_as('Photocopy_of_Monitoring_Report','Photocopy of Monitoring Report')
         ->display_as('Breeder_Seed_Tag_1','Breeder Seed Tag 1')
         ->display_as('Breeder_Seed_Tag_2','Breeder Seed Tag 2')
         ->display_as('Breeder_Seed_Tag_3','Breeder Seed Tag 3')
         ->display_as('Breeder_Seed_Tag_4','Breeder Seed Tag 4')
         ->display_as('Breeder_Seed_Tag_5','Breeder Seed Tag 5');

      $crud->set_relation('RegionID', 'regional_office', 'RegionName');
      $crud->set_relation('YearID', 'year', '{StartYear} - {EndYear}');
      $crud->set_relation('SeasonID', 'season_type', 'SeasonName');
     // $crud->set_relation('SeedProducerID','users','{first_name} {last_name}');
         
      $crud->set_relation('BreederProviderID', 'breeder_seed_provider', 'ProviderName');
      $crud->set_relation('CropID','crop_master','CropName');
      $crud->set_relation('ClassID','classes_of_seed','ClassName');

      $crud->set_field_upload('Breeder_Seed_Tag_1','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_2','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_3','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_4','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_5','assets/uploads/performaa');
      $crud->set_field_upload('Photocopy_of_Breeder_Seed_Purchase_Voucher','assets/uploads/performaa');
      $crud->set_field_upload('Photocopy_of_Monitoring_Report','assets/uploads/performaa');

       $crud->callback_column('Area',array($this,'inHect'));

    $this->data['crud_type'] = 'receipts';
    $this->data['disabling_css'] = 'disabling_css.css';

    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

*/
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

  public function receipts()
  {
      $this->data['page_title'] = 'Receipts Approved';
      $crud = new grocery_CRUD();
      $crud->set_table('receipts');
      $crud->set_subject('Receipt');

     // $crud->unset_add();
      $crud->unset_edit();
      $crud->unset_delete();
      $crud->unset_read();

      $crud->display_as('YearID','Year');

      $crud->add_action('Start Inspection', '' ,'admin/inspections/startinspection', 'btn btn-danger');
      
      $crud->callback_column('PerformaType',array($this,'changePerformaDisplay'));
      $crud->callback_column('status', array($this,'changeStatusDisplay'));

    $crud->set_relation('PerformaID','performa','PerformaID')
        ->set_relation('YearID', 'year', '{StartYear} - {EndYear}')
        ;
    
    $user_id= $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

    $where = array(
        'receipts.branch' => $branch,
        'receipts.status' => 'approved'
      );
      $crud->where($where);
      

      $crud->unset_columns('created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'SeedProducerID', 'branch');

      $this->data['crud_type'] = 'receipts_approved';
      $this->data['disabling_css'] = 'disabling_css.css';

      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
    }

    public function completed()
  {
      $this->data['page_title'] = 'Inspections Completed';
      $crud = new grocery_CRUD();
      $crud->set_table('inspections');
      $crud->set_subject('Inspections');

      $last = $this->uri->total_segments();
      $seed_producer_id = $this->uri->segment($last);

     // $crud->unset_add();
      $crud->unset_edit();
      $crud->unset_delete();
      $crud->unset_read();

      $crud->add_action('Send Sample', '' ,'admin/seedsamples/send/add', 'btn btn-danger');
 
      $branch = $this->ion_auth->user()->row()->branch;

     $where = array(
        'inspections.seed_producer_id' => $seed_producer_id,
        'inspections.inspection_stage' => 'final',
        'inspections.branch'           => $branch,
        'inspections.samplesent'       => 0
      );
      $crud->where($where);
      
      $crud->unset_columns('receipt_id', 'reserved_distance_correct', 'reserved_distance_deducted','inspection_stage','first_inspection_report_no','first_inspection_of_type','first_inspection_indivisible_crops', 'first_inspection_objectionable_weeds', 'first_inspection_seed_disease','second_inspection_report_no', 'second_inspection_of_type','second_inspection_indivisible_crops', 'second_inspection_objectionable_weeds', 'second_inspection_seed_disease','third_inspection_report_no','third_inspection_of_type','third_inspection_indivisible_crops', 'third_inspection_objectionable_weeds', 'third_inspection_seed_disease','fourth_inspection_of_type','fourth_inspection_indivisible_crops', 'fourth_inspection_report_no', 'fourth_inspection_objectionable_weeds', 'fourth_inspection_seed_disease','cancelled_reserved_distance','cancelled_due_to_damage','cancelled_cut_before_inspection','cancelled_less_than_set_quality','cancelled_less_than_set_quality', 'created_at', 'updated_at', 'deleted_at', 'SubmittedBy', 'branch');

      $crud->display_as('performa_id', 'Performa No')
          ->display_as('seed_producer_id', 'Seed Producer Organisation')
          ->display_as('farmer_id', 'Farmer Name')
          ->display_as('crop_id', 'Crop') 
          ->display_as('year_id', 'Year')
            ;

      $crud->set_relation('performa_id', 'performa', 'PerformaID')
            ->set_relation('seed_producer_id', 'users', '{first_name} {last_name}')
            ->set_relation('farmer_id', 'farmerslist', 'name')
            ->set_relation('crop_id', 'crop_master', 'CropName')
            ->set_relation('crop_variety', 'crop_variety', 'VarietyName')
            ->set_relation('seed_class', 'classes_of_seed', 'ClassName')
            ->set_relation('year_id', 'year', '{StartYear} - {EndYear}')
            ;

      $this->data['crud_type'] = 'inspections_completed';
      $this->data['disabling_css'] = 'disabling_css.css';

      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
    }

  function _example_output($output = null)

    {
        $this->load->view('admin/crud_view.php', $output);    
    }

  
}