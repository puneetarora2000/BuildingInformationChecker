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
    $this->load->model('Receipts_Model', 'receipts');
    $this->load->helper('url');
  }

  public function index()
  {
    $this->data['page_title'] = 'Inspections';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
     $crud->set_subject('inspection');
  }
  
  // Helper Functions for Callback Values

  public function callback_seed_producer() {
    $last = $this->uri->total_segments();
    $reqid = $this->uri->segment($last);
    $val = $this->receipts->get_field($reqid, 'SeedProducerID');
    return $val;
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }
  public function callback_seed_producer_address_id() {
    $last = $this->uri->total_segments();
    $reqid = $this->uri->segment($last);
    $val = $this->reqform->get_field($reqid, 'SeedProducerID');
    return '<input id="field-seed_producer_id" type="text" class="form-control" value="'.$val.'" name="seed_producer_id" readonly>';
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
      return $value.' Hectare';
  }

  public function firstinspection()
  {
    $this->data['page_title'] = 'First Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('first_inspection');
    $crud->set_subject('First Inspection');

    $crud->add_action('Second Inspection', '' ,'admin/inspections/secondinspection/add', 'btn btn-danger');

    $crud->fields('date_of_inspection','seed_producer_id','area_alloted','area_inspected','khet_no','date_of_sowing','reserved_distance','reserved_distance_correct','first_inspection_report_no','indivisible_crops','objectionable_weeds','seed_disease', 'SubmittedBy');

    $state = $crud->getstate();
    $crud->unset_read_fields('created_at', 'updated_at', 'SubmittedBy');
    $crud->unset_columns('created_at', 'updated_at');

    switch ($state) {
      case 'add':

         $last = $this->uri->total_segments();
         $reqid = $this->uri->segment($last);

          if(is_numeric($reqid)) {
            $seed_producer_id = $this->callback_seed_producer();
            $crud->field_type('seed_producer_id', 'hidden', $seed_producer_id);

            $submitted_by = $this->ion_auth->user()->row()->id;
            $crud->field_type('SubmittedBy', 'hidden', $submitted_by);

          }
        break;

        case 'edit':
           $last = $this->uri->total_segments();
           $reqid = $this->uri->segment($last);

            if(is_numeric($reqid)) {
              $seed_producer_id = $this->callback_seed_producer();
              $crud->field_type('seed_producer_id', 'hidden', $seed_producer_id);

              $submitted_by = $this->ion_auth->user()->row()->id;
              $crud->field_type('SubmittedBy', 'hidden', $submitted_by);

            }
          break;

        case 'read':
           $crud->set_relation('seed_producer_id','users','{first_name} {last_name}');
           $crud->set_relation('seed_producer_address_id','users','address');
          break;
        case 'list':
           $crud->set_relation('seed_producer_id','users','{first_name} {last_name}');
           $crud->set_relation('seed_producer_address_id','users','address');
          break;
      
      default:
        # code...
        break;
    }
     $crud->display_as('seed_producer_id','Seed Producer')
          ->display_as('reserved_distance_correct','Is Reserved Distance Correct?')
          ->display_as('first_inspection_type','Inspection Type');
      
      $crud->callback_column('Area',array($this,'inHect'));

      $indivisible_crops = $this->callback_indivisible_crops();
      $objectionable_weeds = $this->callback_objectionable_weeds();
      $seed_diseases = $this->callback_seed_diseases();
      
    //  var_dump($indivisible_crops_list);
      $crud->field_type('indivisible_crops', 'multiselect', $indivisible_crops);
      $crud->field_type('objectionable_weeds', 'multiselect', $objectionable_weeds);
      $crud->field_type('seed_disease', 'multiselect', $seed_diseases);

  //    $crud->set_relation('indivisible_crops','crop_master','CropName',array('isDivisible' => 1));
  //    $crud->set_relation('objectionable_weeds','weed_master','WeedName',array('isObjectionable' => 1));
  //    $crud->set_relation('seed_disease','disease_master','DiseaseName',array('isFromSeed' => 1));

     

    $this->data['crud_type'] = 'receipts';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');
  }

  public function secondinspection()
  {
    $this->data['page_title'] = 'Second Inspection';
    $crud = new grocery_CRUD();
    $crud->set_table('second_inspection');
    $crud->set_subject('Second Inspection');

    $crud->fields('date_of_inspection','first_inspection_id','second_inspection_report_no','second_inspection_type','indivisible_crops','objectionable_weeds','seed_disease', 'SubmittedBy');

    $crud->display_as('first_inspection_id','First Inspection Date')
          ->display_as('second_inspection_report_no','Second Inspection Report No')
          ->display_as('second_inspection_type','Inspection Type');

    $state = $crud->getstate();
    $crud->unset_read_fields('created_at', 'updated_at', 'SubmittedBy');
    $crud->unset_columns('created_at', 'updated_at');

    switch ($state) {
      case 'add':

         $last = $this->uri->total_segments();
          $reqid = $this->uri->segment($last);

          if(is_numeric($reqid)) {
            
            $crud->field_type('first_inspection_id', 'hidden', $reqid);

            $submitted_by = $this->ion_auth->user()->row()->id;
            $crud->field_type('SubmittedBy', 'hidden', $submitted_by);

          }
        break;

        case 'read':
           $crud->set_relation('first_inspection_id','first_inspection','date_of_inspection');
          break;
        case 'list':
           $crud->set_relation('first_inspection_id','first_inspection','date_of_inspection');
          break;
      
      default:
            $crud->set_relation('first_inspection_id','first_inspection','date_of_inspection');
        break;
    }
      

      $crud->set_relation('indivisible_crops','crop_master','CropName',array('isDivisible' => 1));
      $crud->set_relation('objectionable_weeds','weed_master','WeedName',array('isObjectionable' => 1));
      $crud->set_relation('seed_disease','disease_master','DiseaseName',array('isFromSeed' => 1));

     

    $this->data['crud_type'] = 'receipts';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');
  }

  public function receipts()
  {
    $this->data['page_title'] = 'Receipts Received';
    $crud = new grocery_CRUD();
    $crud->set_table('receipts');
     $crud->set_subject('Receipt');

   // $crud->unset_add();
    $crud->unset_edit();
    $crud->unset_delete();

    
   // $crud->add_action('Approve', '' ,'admin/forms/receipt_approve', 'btn btn-success');
     $crud->add_action('First Inspection', '' ,'admin/inspections/firstinspection/add', 'btn btn-danger');

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



      $crud->fields('RegionID','YearID','SeasonID','SeedProducerID','BreederProviderID','CropID','ClassID','Area','Photocopy_of_Breeder_Seed_Purchase_Voucher','Photocopy_of_Monitoring_Report','Breeder_Seed_Tag_1','Breeder_Seed_Tag_2','Breeder_Seed_Tag_3','Breeder_Seed_Tag_4','Breeder_Seed_Tag_5', 'SubmittedBy');

      $crud->set_relation('RegionID', 'regional_office', 'RegionName');
      $crud->set_relation('YearID', 'year', '{StartYear} - {EndYear}');
      $crud->set_relation('SeasonID', 'season_type', 'SeasonName');
     
     // $crud->set_relation('SeedProducerID', 'users', 'SeedProducerName');
      $seed_producers = $this->ion_auth->users(2)->result();
      $seed_producers_list = array();
      foreach ($seed_producers as $val) {
        $seed_producers_list += array(
            $val->id => $val->first_name.' '.$val->last_name
          );
      }
      //var_dump($seed_producers_list);
      $crud->field_type('SeedProducerID', 'dropdown', $seed_producers_list);

      $crud->set_relation('BreederProviderID', 'breeder_seed_provider', 'ProviderName');
      $crud->set_relation('CropID','crop_master','CropName');
      $crud->set_relation('ClassID','classes_of_seed','ClassName');
      $crud->set_relation('SubmittedBy','users','{first_name} {last_name}');

      $crud->set_field_upload('Breeder_Seed_Tag_1','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_2','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_3','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_4','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_5','assets/uploads/performaa');
      $crud->set_field_upload('Photocopy_of_Breeder_Seed_Purchase_Voucher','assets/uploads/performaa');
      $crud->set_field_upload('Photocopy_of_Monitoring_Report','assets/uploads/performaa');

       $crud->callback_column('Area',array($this,'inHect'));

    $this->data['crud_type'] = 'receipts';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }



  function _example_output($output = null)

    {
        $this->load->view('admin/crud_view.php', $output);    
    }

  
}