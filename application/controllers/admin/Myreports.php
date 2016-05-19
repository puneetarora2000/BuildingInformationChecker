<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myreports extends Admin_Controller
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

  function changePerformaDisplay($value, $row)
  {
    return ucwords(substr_replace($value, ' ' . substr($value, -1), -1) );
  }

  public function performaa()
  {
    $this->data['page_title'] = 'Performa A';
    $crud = new grocery_CRUD();
    $crud->set_table('performa');
    $crud->set_subject('My Performas');

    $this->load->library('ion_auth');

    $seed_producer_id = $this->ion_auth->user()->row()->id;

    $crud->unset_delete();
    $crud->unset_add();
    $crud->unset_read();
    $crud->unset_edit();

    $crud->unset_columns('SubmittedBy','created_at', 'updated_at', 'ReceiptGenerated', 'branc');

    $crud->add_action('Start Inspection', '' ,'admin/myreports/inspectionreport', 'btn btn-danger');


    $crud->display_as('RegionID', 'Region')
         ->display_as('YearID', 'Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('BreederProviderID','Breeder Provider')
         ->display_as('FoundationProviderID','Foundation Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('VarietyID','Crop Variety')
         ->display_as('ClassID','Seed Class')
         ->display_as('DateofPerforma', 'Date of Performa')
         ->display_as('PerformaType', 'Performa Type')
         ;

    $crud->set_relation('RegionID', 'regional_office', 'RegionName')
         ->set_relation('YearID', 'year', '{StartYear} - {EndYear}')
         ->set_relation('SeasonID', 'season_type', 'SeasonName')
         ->set_relation('SeedProducerID', 'users', '{first_name} {last_name}')
         ->set_relation('BreederProviderID', 'breeder_seed_provider', 'ProviderName')
         ->set_relation('FoundationProviderID', 'foundation_seed_provider', 'FoundationProviderName')
         ->set_relation('CropID', 'crop_master', 'CropName')
         ->set_relation('VarietyID', 'crop_variety', 'VarietyName')
         ->set_relation('ClassID', 'classes_of_seed', 'ClassName');

    $crud->callback_column('PerformaType',array($this,'changePerformaDisplay'));

    $where = array(
        'PerformaType' => 'performaa',
        'performa.id'  => $seed_producer_id
      );

    $crud->where($where);

    $this->data['crud_type'] = 'inspections';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');

  }

  public function performab()
  {
    $this->data['page_title'] = 'Performa B';
    $crud = new grocery_CRUD();
    $crud->set_table('performa');
    $crud->set_subject('My Performas');

    $this->load->library('ion_auth');

    $seed_producer_id = $this->ion_auth->user()->row()->id;

    $crud->unset_delete();
    $crud->unset_add();
    $crud->unset_read();
    $crud->unset_edit();

    $crud->unset_columns('SubmittedBy','created_at', 'updated_at', 'ReceiptGenerated', 'branc');

    $crud->add_action('View Report', '' ,'admin/myreports/inspectionreport', 'btn btn-success');

    $crud->display_as('RegionID', 'Region')
         ->display_as('YearID', 'Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('BreederProviderID','Breeder Provider')
         ->display_as('FoundationProviderID','Foundation Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('VarietyID','Crop Variety')
         ->display_as('ClassID','Seed Class')
         ->display_as('DateofPerforma', 'Date of Performa')
         ->display_as('PerformaType', 'Performa Type')
         ;

    $crud->set_relation('RegionID', 'regional_office', 'RegionName')
         ->set_relation('YearID', 'year', '{StartYear} - {EndYear}')
         ->set_relation('SeasonID', 'season_type', 'SeasonName')
         ->set_relation('SeedProducerID', 'users', '{first_name} {last_name}')
         ->set_relation('BreederProviderID', 'breeder_seed_provider', 'ProviderName')
         ->set_relation('FoundationProviderID', 'foundation_seed_provider', 'FoundationProviderName')
         ->set_relation('CropID', 'crop_master', 'CropName')
         ->set_relation('VarietyID', 'crop_variety', 'VarietyName')
         ->set_relation('ClassID', 'classes_of_seed', 'ClassName');

    $crud->callback_column('PerformaType',array($this,'changePerformaDisplay'));

    $where = array(
        'PerformaType' => 'performab',
        'performa.id'  => $seed_producer_id
      );

    $crud->where($where);

    $this->data['crud_type'] = 'inspections';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');

  }

  public function performac()
  {
    $this->data['page_title'] = 'Performa C';
    $crud = new grocery_CRUD();
    $crud->set_table('performa');
    $crud->set_subject('My Performas');

    $this->load->library('ion_auth');

    $seed_producer_id = $this->ion_auth->user()->row()->id;

    $crud->unset_delete();
    $crud->unset_add();
    $crud->unset_read();
    $crud->unset_edit();

    $crud->unset_columns('SubmittedBy','created_at', 'updated_at', 'ReceiptGenerated', 'branc');

    $crud->display_as('RegionID', 'Region')
         ->display_as('YearID', 'Year')
         ->display_as('SeasonID','Crop Season')
         ->display_as('SeedProducerID','Seed Producer')
         ->display_as('BreederProviderID','Breeder Provider')
         ->display_as('FoundationProviderID','Foundation Provider')
         ->display_as('CropID','Crop Name')
         ->display_as('VarietyID','Crop Variety')
         ->display_as('ClassID','Seed Class')
         ->display_as('DateofPerforma', 'Date of Performa')
         ->display_as('PerformaType', 'Performa Type')
         ;

    $crud->set_relation('RegionID', 'regional_office', 'RegionName')
         ->set_relation('YearID', 'year', '{StartYear} - {EndYear}')
         ->set_relation('SeasonID', 'season_type', 'SeasonName')
         ->set_relation('SeedProducerID', 'users', '{first_name} {last_name}')
         ->set_relation('BreederProviderID', 'breeder_seed_provider', 'ProviderName')
         ->set_relation('FoundationProviderID', 'foundation_seed_provider', 'FoundationProviderName')
         ->set_relation('CropID', 'crop_master', 'CropName')
         ->set_relation('VarietyID', 'crop_variety', 'VarietyName')
         ->set_relation('ClassID', 'classes_of_seed', 'ClassName');

    $crud->callback_column('PerformaType',array($this,'changePerformaDisplay'));

    $where = array(
        'PerformaType' => 'performac',
        'performa.id'  => $seed_producer_id
      );

    $crud->where($where);

    $this->data['crud_type'] = 'inspections';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');

  }

  public function inspectionreport()
  {
    $this->data['page_title'] = 'Inspection Report';

    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Inspection Report')
         ->set_theme('myperformas')
         ->unset_add()
         ->unset_edit()
         ->unset_delete();

    $seed_producer_id = $this->ion_auth->user()->row()->id;

    $last = $this->uri->total_segments();
    $perf_id = $this->uri->segment($last);
    
    $this->load->model('Inspection_model', 'inspection');
    $inspection_data = array(
        'inspection_stage'  => 'final'
      );
    $this->inspection->where('seed_producer_id', $seed_producer_id)->update($inspection_data);

    $crud->columns('farmer_id', 'seed_producer_id','crop_id','crop_variety','seed_class', 'area', 'area_inspected', 'reserved_distance_correct', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'other_reasons', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'season');
    $crud->callback_column('area', array($this, 'getArea'));
    $crud->callback_column('season', array($this, 'getSeason'));

    $crud->display_as('farmer_id', 'Seed Grower\'s Name and Address')
          ->display_as('seed_producer_id', 'Seed Producer')
          ->display_as('crop_id', 'Crop')
          ->display_as('crop_variety', 'Crop Variety')
          ->display_as('seed_class', 'Seed Class')
          ->display_as('area_inspected', 'Area Inspected')
          ->display_as('reserved_distance_correct', 'Reserved Distance Correct (Yes/No)')
          ->display_as('certified_area', 'Certified Area (Hectare)')
          ->display_as('cancelled_due_to_damage', 'Damaged Area')
          ->display_as('cancelled_cut_before_inspection', 'Cut Before Final Inspection')
          ->display_as('cancelled_total_area','Total Cancelled Area')
          ->display_as('other_reasons','Other Reasons')
          ->display_as('estimated_yield', 'Estimated Yield (Quintals)');

    $crud->set_relation('seed_producer_id', 'users', '{first_name} {last_name}');
    $crud->set_relation('crop_id', 'crop_master', 'CropName');
    $crud->set_relation('crop_variety', 'crop_variety', 'VarietyName');
    $crud->set_relation('seed_class', 'classes_of_seed', 'ClassName');
    $crud->set_relation('farmer_id', 'farmerslist', '{name} <br> {address} <br> {village}');

    $where = array(
        'inspections.performa_id' => $perf_id,
        'inspections.seed_producer_id'  => $seed_producer_id
      );

    $crud->where($where);
    
//    $this->load->model('Inspection_model', 'inspections');

//    $this->data['inspections'] = $this->inspections->where('seed_producer_id', 2)->get_all();
//    $this->data['inspections_joined'] = $this->inspections->get_inspections($seed_producer_id);

    $crud->set_relation_n_n('first_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
    $crud->set_relation_n_n('first_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
    $crud->set_relation_n_n('first_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $crud->unset_columns('receipt_id', 'performa_id', 'crop_id', 'crop_variety', 'seed_class', 'seed_producer_id', 'inspection_stage', 'SubmittedBy', 'created_at', 'updated_at');

    $this->data['crud_type'] = 'finalreport';
    $this->data['output'] = $crud->render();
    $this->data['performa_id'] = $perf_id;

    $this->render('admin/pages/finalreport_view');
  }

  public function getArea($value, $row) 
  {
    $this->load->model('Performa_model', 'performa');
    $last = $this->uri->total_segments();
    $perf_id = $this->uri->segment($last);
    $val = $this->performa->fields('Area')->where('id', $perf_id)->get();
    return $val->Area;
  }
  public function getSeason($value, $row) 
  {
    $this->load->model('Performa_model', 'performa');
    $last = $this->uri->total_segments();
    $perf_id = $this->uri->segment($last);
    $season_id = $this->performa->fields('SeasonID')->where('id', $perf_id)->get()->SeasonID;
    $val = $this->db->select('SeasonName')
                    ->from('season_type')
                    ->where('SeasonID', $season_id)
                    ->get()
                    ->result();
   // print_r($val) ;
    return $val[0]->SeasonName ;
  }

  public function genpdf()
  {
    $this->data['page_title'] = 'Inspection Report';

    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Inspection Report')
         ->set_theme('inspection')
         ->unset_add()
         ->unset_edit()
         ->unset_delete();


    $seed_producer_id = $this->ion_auth->user()->row()->id;

    $last = $this->uri->total_segments();
    $perf_id = $this->uri->segment($last);
    
    $this->load->model('Inspection_model', 'inspection');
    $inspection_data = array(
        'inspection_stage'  => 'final'
      ); 
    $this->inspection->where('seed_producer_id', $seed_producer_id)->update($inspection_data);

    $crud->columns('farmer_id', 'seed_producer_id','crop_id','crop_variety','seed_class', 'area', 'area_inspected', 'reserved_distance_correct', 'cancelled_due_to_damage', 'cancelled_cut_before_inspection', 'other_reasons', 'cancelled_total_area', 'certified_area', 'estimated_yield', 'season');
    $crud->callback_column('area', array($this, 'getArea'));
    $crud->callback_column('season', array($this, 'getSeason'));

    $crud->display_as('farmer_id', 'Seed Grower\'s Name and Address')
          ->display_as('seed_producer_id', 'Seed Producer')
          ->display_as('crop_id', 'Crop')
          ->display_as('crop_variety', 'Crop Variety')
          ->display_as('seed_class', 'Seed Class')
          ->display_as('area_inspected', 'Area Inspected')
          ->display_as('reserved_distance_correct', 'Reserved Distance Correct (Yes/No)')
          ->display_as('certified_area', 'Certified Area (Hectare)')
          ->display_as('cancelled_due_to_damage', 'Damaged Area')
          ->display_as('cancelled_cut_before_inspection', 'Cut Before Final Inspection')
          ->display_as('cancelled_total_area','Total Cancelled Area')
          ->display_as('other_reasons','Other Reasons')
          ->display_as('estimated_yield', 'Estimated Yield (Quintals)');

    $crud->set_relation('seed_producer_id', 'users', '{first_name} {last_name}');
    $crud->set_relation('crop_id', 'crop_master', 'CropName');
    $crud->set_relation('crop_variety', 'crop_variety', 'VarietyName');
    $crud->set_relation('seed_class', 'classes_of_seed', 'ClassName');
    $crud->set_relation('farmer_id', 'farmerslist', '{name} <br> {address} <br> {village}');

    $where = array(
        'inspections.performa_id' => $perf_id,
        'inspections.seed_producer_id'  => $seed_producer_id
      );

    $crud->where($where);
    
//    $this->load->model('Inspection_model', 'inspections');

//    $this->data['inspections'] = $this->inspections->where('seed_producer_id', 2)->get_all();
//    $this->data['inspections_joined'] = $this->inspections->get_inspections($seed_producer_id);

    $crud->set_relation_n_n('first_inspection_indivisible_crops','inspection_crops','crop_master', 'inspection_id', 'crop_id', 'CropName', null, array('isDivisible'=>0));
    $crud->set_relation_n_n('first_inspection_objectionable_weeds','inspection_weeds','weed_master', 'inspection_id', 'weed_id', 'WeedName', null, array('isObjectionable'=>1));
    $crud->set_relation_n_n('first_inspection_seed_disease','inspection_diseases','disease_master', 'inspection_id', 'disease_id', 'DiseaseName', null, array('isFromSeed'=>1));

    $crud->unset_columns('receipt_id', 'performa_id', 'seed_producer_id', 'inspection_stage', 'SubmittedBy', 'created_at', 'updated_at');

    
    $output = $crud->render();

   // $html = '<script src="'.site_url('assets/sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css').'"></script>';

    $html = $output->output; 

 //   echo $html;
   //$html = $this->load->view('admin/pages/finalreport_view', $data, true);

    //$html = $this->load->view('admin/genpdf', $data, true); 
    //$html = utf8_encode($html);
   // echo $html;
  //  $this->load->view('admin/genpdf', $data); 
    $this->load->model('Performa_model', 'performa');
    $performa_no = $this->performa->fields('PerformaID')->where('id',$perf_id)->get()->PerformaID;

    //this the the PDF filename that user will get to download
    $pdfFilePath = str_replace('/', '-', $performa_no).'.pdf';

    //load mPDF library
    $this->load->library('m_pdf');
    //actually, you can pass mPDF parameter on this load() function
   // $this->m_pdf->pdf('utf-8', 'L');
    //generate the PDF!
    
   // $param = '"en-GB-x","A4","","",10,10,10,10,6,3,"L"'; 
    //Parameters are not working through a variable but need to be hard coded like below. May be its because the function accepts coma seperated values, not a comma seperated string.

    $pdf = new mPDF("en-GB-x","A4-L","","",10,10,10,10,6,3,"L");

    $stylesheet = file_get_contents(site_url('assets/sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css'));
    $pdf->WriteHTML($stylesheet,1);

    $pdf->WriteHTML($html);
    //offer it to user via browser download! (The PDF won't be saved on your server HDD)
    $pdf->Output($pdfFilePath, "D");

  }
  function changeStageDisplay($value, $row)
  {
    switch ($value) {
      case 'first':
          return '<span style="background-color: #ff0000; color: #FFF; padding: 4px">'.ucwords($value).'</span>';
        break;
      case 'second':
          return '<span style="background-color: #ff6700; color: #FFF; padding: 4px">'.ucwords($value).'</span>';
        break;
      case 'third':
          return '<span style="background-color: #fcff00; padding: 4px">'.ucwords($value).'</span>';
        break;
      case 'fourth':
          return '<span style="background-color: #00f6ff; padding: 4px">'.ucwords($value).'</span>';
        break;
      case 'final':
          return '<span style="background-color: #00ff24; padding: 4px">'.ucwords($value).' / Completed</span>';
        break;
      default:
        # code...
        break;
    }
    
  }

  public function inspections()
  {
    $this->data['page_title'] = 'Inspections Status';
    $crud = new grocery_CRUD();
    $crud->set_table('inspections');
    $crud->set_subject('Inspections');

    $crud->unset_add();
    $crud->unset_edit();
    $crud->unset_delete();

    $crud->columns('inspection_stage', 'receipt_id', 'performa_id', 'farmer_id', 'crop_id', 'crop_variety', 'seed_class');

    $crud->set_relation('performa_id','performa','PerformaID');
    $crud->set_relation('farmer_id','farmerslist','name');
    $crud->set_relation('crop_id','crop_master','CropName');
    $crud->set_relation('crop_variety','crop_variety','VarietyName');
    $crud->set_relation('seed_class','classes_of_seed','ClassName');
    $crud->set_relation('receipt_id', 'receipts', 'RecieptID');

    $crud->display_as('crop_id', 'Crop Name')
         ->display_as('farmer_id', 'Farmer / Seed Producer')
         ;

    $crud->callback_column('inspection_stage', array($this,'changeStageDisplay'));

    $seed_producer_id = $this->ion_auth->user()->row()->id;    

    $crud->where('seed_producer_id', $seed_producer_id);

    $this->data['crud_type'] = 'inspections';
    $this->data['output'] = $crud->render();

    $this->data['disabling_css'] = 'disabling_css.css';

    $this->render('admin/crud_view');

  }

}