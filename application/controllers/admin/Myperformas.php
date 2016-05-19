<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myperformas extends Admin_Controller
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

   public function performaa()
  {
    $this->data['page_title'] = 'Performa A';
    $crud = new grocery_CRUD();
    $crud->set_table('performa');

    $crud->unset_edit()
          ->unset_add()
          ->unset_delete();
    

    $user_id= $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

    $crud->fields('RegionID','YearID','SeasonID','SeedProducerID','BreederProviderID','CropID', 'VarietyID','ClassID','Area','Photocopy_of_Breeder_Seed_Purchase_Voucher','Photocopy_of_Monitoring_Report','Breeder_Seed_Tag_1','Breeder_Seed_Tag_2','Breeder_Seed_Tag_3','Breeder_Seed_Tag_4','Breeder_Seed_Tag_5', 'SubmittedBy', 'branch');
    
      
      $crud->set_relation('SeedProducerID','users','{first_name} {last_name}');

      $crud->display_as('DateofPerforma', 'Date')
         ->display_as('RegionID','Region')
         ->display_as('YearID','Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('BreederProviderID','Breeder Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('VarietyID','Crop Variety')
         ->display_as('ClassID','Seed Class')
         ->display_as('Area','Area of your land')
         ->display_as('Photocopy_of_Breeder_Seed_Purchase_Voucher','Photocopy of Breeder Seed Purchase Voucher')
         ->display_as('Photocopy_of_Monitoring_Report','Photocopy of Monitoring Report')
         ->display_as('Breeder_Seed_Tag_1','Breeder Seed Tag 1')
         ->display_as('Breeder_Seed_Tag_2','Breeder Seed Tag 2')
         ->display_as('Breeder_Seed_Tag_3','Breeder Seed Tag 3')
         ->display_as('Breeder_Seed_Tag_4','Breeder Seed Tag 4')
         ->display_as('Breeder_Seed_Tag_5','Breeder Seed Tag 5');
      
      $crud->set_relation('RegionID','regional_office','RegionName');
      $crud->set_relation('CropID','crop_master','CropName');
      $crud->set_relation('VarietyID','crop_variety','VarietyName');
      $crud->set_relation('YearID','year','{StartYear} - {EndYear}');
      $crud->set_relation('SeasonID','season_type','SeasonName');
      $crud->set_relation('BreederProviderID','breeder_seed_provider','ProviderName');
      $crud->set_relation('ClassID','classes_of_seed','ClassName');
      
      //$crud->set_relation('SeedProducerID','seed_producer','SeedProducerName');
      /*$seed_producers = $this->ion_auth->users('seedproducer')->result();
      $seed_producers_list = array();
      foreach ($seed_producers as $val) {
        $seed_producers_list += array(
            $val->id => $val->first_name.' '.$val->last_name
          );
      }*/
      //var_dump($seed_producers_list);
      //$crud->field_type('SeedProducerID', 'dropdown', $seed_producers_list);
      
      
   /*   $crud->set_rules('Quantity_of_Breeder_Seed','Quantity of Breeder Seed','numeric');
      $crud->set_rules('Area_Planted','Area Planted','numeric');
      $crud->display_as('officeCode','Office City');*/
     // $crud->set_subject('Add Data');

      $crud->required_fields('RegionID','ClassID','CropID', 'VarietyID', 'YearID','SeasonID','SeedProducerID','BreederProviderID');

      $crud->set_field_upload('Breeder_Seed_Tag_1','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_2','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_3','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_4','assets/uploads/performaa');
      $crud->set_field_upload('Breeder_Seed_Tag_5','assets/uploads/performaa');
      $crud->set_field_upload('Photocopy_of_Breeder_Seed_Purchase_Voucher','assets/uploads/performaa');
      $crud->set_field_upload('Photocopy_of_Monitoring_Report','assets/uploads/performaa');
      
      $where = array(
        'performa.SubmittedBy'  => $user_id,
        'performa.branch'       => $branch,
        'PerformaType'          => 'performaa'
      );
      $crud->where($where);

      $crud->unset_columns('PerformaType', 'SubmittedBy', 'FoundationProviderID', 'Photocopy_of_Foundation_Seed_Purchase_Voucher', 'Foundation_Seed_Tag_1','Foundation_Seed_Tag_2','Foundation_Seed_Tag_3','Foundation_Seed_Tag_4','Foundation_Seed_Tag_5', 'branch', 'ReceiptGenerated', 'created_at', 'updated_at' );

      $crud->unset_read_fields('PerformaType', 'SubmittedBy', 'FoundationProviderID', 'Photocopy_of_Foundation_Seed_Purchase_Voucher', 'Foundation_Seed_Tag_1','Foundation_Seed_Tag_2','Foundation_Seed_Tag_3','Foundation_Seed_Tag_4','Foundation_Seed_Tag_5', 'branch', 'ReceiptGenerated', 'created_at', 'updated_at');
      
      $crud->set_subject('Performa A');

      $this->data['crud_type'] = 'performaa';
      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
  }

  public function performab()
  {
    $this->data['page_title'] = 'Performa B';
    $crud = new grocery_CRUD();
    $crud->set_table('performa');

    $crud->unset_edit()
          ->unset_add()
          ->unset_delete();
    

    $user_id= $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

    $crud->fields('RegionID','YearID','SeasonID','SeedProducerID','FoundationProviderID','CropID','VarietyID','ClassID','Area','Photocopy_of_Foundation_Seed_Purchase_Voucher','Photocopy_of_Monitoring_Report','Foundation_Seed_Tag_1','Foundation_Seed_Tag_2','Foundation_Seed_Tag_3','Foundation_Seed_Tag_4','Foundation_Seed_Tag_5', 'SubmittedBy', 'branch');

        $crud->set_relation('SeedProducerID','users','{first_name} {last_name}');

      $crud->display_as('RegionID','Region')
         ->display_as('YearID','Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('FoundationProviderID','Foundation Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('VarietyID','Crop Variety')
         ->display_as('ClassID','Certified Seed Class')
         ->display_as('Area','Area of your land')
         ->display_as('Photocopy_of_Foundation_Seed_Purchase_Voucher','Photocopy of Foundation Seed Purchase Voucher')
         ->display_as('Photocopy_of_Monitoring_Report','Photocopy of Monitoring Report')
         ->display_as('Foundation_Seed_Tag_1','Foundation Seed Tag 1')
         ->display_as('Foundation_Seed_Tag_2','Foundation Seed Tag 2')
         ->display_as('Foundation_Seed_Tag_3','Foundation Seed Tag 3')
         ->display_as('Foundation_Seed_Tag_4','Foundation Seed Tag 4')
         ->display_as('Foundation_Seed_Tag_5','Foundation Seed Tag 5');


      $crud->set_relation('RegionID','regional_office','RegionName');
      $crud->set_relation('CropID','crop_master','CropName');
      $crud->set_relation('VarietyID','crop_variety','VarietyName');
      $crud->set_relation('YearID','year','{StartYear} - {EndYear}');
      $crud->set_relation('SeasonID','season_type','SeasonName');
      $crud->set_relation('FoundationProviderID','foundation_seed_provider','FoundationProviderName');
      $crud->set_relation('ClassID','classes_of_seed','ClassName');
   /*   $crud->set_rules('Quantity_of_Breeder_Seed','Quantity of Breeder Seed','numeric');
      $crud->set_rules('Area_Planted','Area Planted','numeric');
      $crud->display_as('officeCode','Office City');*/
     // $crud->set_subject('Add Data');


      $crud->set_field_upload('Foundation_Seed_Tag_1','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_2','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_3','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_4','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_5','assets/uploads/performab');
      $crud->set_field_upload('Photocopy_of_Foundation_Seed_Purchase_Voucher','assets/uploads/performab');
      $crud->set_field_upload('Photocopy_of_Monitoring_Report','assets/uploads/performab');

      $crud->field_type('SubmittedBy', 'hidden', $user_id);
      
      $where = array(
        'performa.SubmittedBy'  => $user_id,
        'performa.branch'       => $branch,
        'PerformaType'          => 'performab'
      );
      $crud->where($where);

      $crud->unset_columns('PerformaType', 'SubmittedBy', 'BreederProviderID', 'Photocopy_of_Breeder_Seed_Purchase_Voucher', 'Breeder_Seed_Tag_1','Breeder_Seed_Tag_2','Breeder_Seed_Tag_3','Breeder_Seed_Tag_4','Breeder_Seed_Tag_5', 'branch', 'ReceiptGenerated', 'created_at', 'updated_at');

      $crud->unset_read_fields('PerformaType', 'SubmittedBy', 'BreederProviderID', 'Photocopy_of_Breeder_Seed_Purchase_Voucher', 'Breeder_Seed_Tag_1','Breeder_Seed_Tag_2','Breeder_Seed_Tag_3','Breeder_Seed_Tag_4','Breeder_Seed_Tag_5', 'branch', 'ReceiptGenerated', 'created_at', 'updated_at');

      $crud->set_subject('Performa B');

      $this->data['crud_type'] = 'performab';
      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
  }

  public function performac()
  {
    $this->data['page_title'] = 'Performa C';
    $crud = new grocery_CRUD();
    $crud->set_table('performa');

    $crud->unset_edit()
          ->unset_add()
          ->unset_delete();

    $user_id= $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

    $crud->fields('RegionID','YearID','SeasonID','SeedProducerID','FoundationProviderID','CropID','VarietyID','ClassID','Area','Photocopy_of_Foundation_Seed_Purchase_Voucher','Photocopy_of_Monitoring_Report','Foundation_Seed_Tag_1','Foundation_Seed_Tag_2','Foundation_Seed_Tag_3','Foundation_Seed_Tag_4','Foundation_Seed_Tag_5', 'SubmittedBy', 'branch');

    $state = $crud->getState();

    switch ($state) {
      case 'add':
        $crud->set_theme('seed');
        $crud->field_type('SubmittedBy', 'hidden', $user_id);
        $crud->field_type('PerformaType', 'hidden', 'performac');
        $crud->field_type('SeedProducerID', 'hidden', $user_id);
        $crud->field_type('branch', 'hidden', $branch);

        break;
      case 'read':
        $crud->set_theme('seed');
        $crud->set_relation('SeedProducerID','users','{first_name} {last_name}');
        break;
      case 'edit':
        $crud->set_theme('seed');
        break;
      case 'list':
        $crud->set_relation('SeedProducerID','users','{first_name} {last_name}');
        break;

      default:
        $crud->set_relation('SeedProducerID','users','{first_name} {last_name}');
        break;
    }

      $crud->display_as('RegionID','Region')
         ->display_as('YearID','Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('FoundationProviderID','Foundation Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('VarietyID','Crop Variety')
         ->display_as('ClassID','Certified Seed Class')
         ->display_as('Area','Area of your land')
         ->display_as('Photocopy_of_Foundation_Seed_Purchase_Voucher','Photocopy of Foundation Seed Purchase Voucher')
         ->display_as('Photocopy_of_Monitoring_Report','Photocopy of Monitoring Report')
         ->display_as('Foundation_Seed_Tag_1','Foundation Seed Tag 1')
         ->display_as('Foundation_Seed_Tag_2','Foundation Seed Tag 2')
         ->display_as('Foundation_Seed_Tag_3','Foundation Seed Tag 3')
         ->display_as('Foundation_Seed_Tag_4','Foundation Seed Tag 4')
         ->display_as('Foundation_Seed_Tag_5','Foundation Seed Tag 5');


      $crud->set_relation('RegionID','regional_office','RegionName');
      $crud->set_relation('CropID','crop_master','CropName');
      $crud->set_relation('VarietyID','crop_variety','VarietyName');
      $crud->set_relation('YearID','year','{StartYear} - {EndYear}');
      $crud->set_relation('SeasonID','season_type','SeasonName');
      $crud->set_relation('FoundationProviderID','foundation_seed_provider','FoundationProviderName');
      $crud->set_relation('ClassID','classes_of_seed','ClassName');
   /*   $crud->set_rules('Quantity_of_Breeder_Seed','Quantity of Breeder Seed','numeric');
      $crud->set_rules('Area_Planted','Area Planted','numeric');
      $crud->display_as('officeCode','Office City');*/
     // $crud->set_subject('Add Data');


      $crud->set_field_upload('Foundation_Seed_Tag_1','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_2','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_3','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_4','assets/uploads/performab');
      $crud->set_field_upload('Foundation_Seed_Tag_5','assets/uploads/performab');
      $crud->set_field_upload('Photocopy_of_Foundation_Seed_Purchase_Voucher','assets/uploads/performab');
      $crud->set_field_upload('Photocopy_of_Monitoring_Report','assets/uploads/performab');

      $crud->field_type('SubmittedBy', 'hidden', $user_id);
      
      $where = array(
        'performa.SubmittedBy'  => $user_id,
        'performa.branch'       => $branch,
        'PerformaType'          => 'performac'
      );
      $crud->where($where);

      $crud->unset_columns('PerformaType', 'SubmittedBy', 'BreederProviderID', 'Photocopy_of_Breeder_Seed_Purchase_Voucher', 'Breeder_Seed_Tag_1','Breeder_Seed_Tag_2','Breeder_Seed_Tag_3','Breeder_Seed_Tag_4','Breeder_Seed_Tag_5', 'branch' );


      $crud->set_subject('Performa C');

      $this->data['crud_type'] = 'performa';
      $this->data['output'] = $crud->render();

      $this->render('admin/crud_view');
  }

  public function performareceipt()
  {
    $perf_id = $this->uri->segment($this->uri->total_segments());
    
    $this->load->model('performa_model', 'performa' );
    $this->load->model('receipts_model', 'receipt' );
    /*$performa = $this->performa->get($perf_id);
    unset($performa->SubmittedBy);
    var_dump($performa);
*/  
    $performa = $this->performa->get_performa($perf_id);
  //  var_dump($performa);

    $receipt_data = array(
        'PerformaID'  => $performa->id,
        'PerformaType' => $performa->PerformaType,
        'branch'      => $performa->branch,
        'SubmittedBy' => $performa->SubmittedBy
      );
    
    $receipt = $this->receipt->where('PerformaID', $performa->id)->get();

    if($receipt) {
      $this->receipt->where('PerformaID', $performa->id)->update($receipt_data);

    } else {
      $this->receipt->insert($receipt_data);
      $receipt_id = $this->db->insert_id();
      $receipt = $this->receipt->get($receipt_id);
      $this->performa->update( array('ReceiptGenerated' => 1), $performa->id );
    }

    //var_dump($receipt);

    $this->data['page_title'] = ucwords(substr_replace($performa->PerformaType, '- ' . substr($performa->PerformaType, -1), -1) ) . ' Receipt';

    $this->data['performa'] = $performa;
    $this->data['receipt']  = $receipt;

    $this->render('admin/forms/performa_receipt_view');
    
    
  }
  
}