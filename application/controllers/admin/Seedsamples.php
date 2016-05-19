<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seedsamples extends Admin_Controller
{
  protected $resultlist_count = 0;
  protected $resultlist_completed = FALSE;

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
  public function samples_tested() {
    
    $update_data = array(
        'Status' => 'tested'
      );
    $last = $this->uri->total_segments();
    $id = $this->uri->segment($last);
  //  echo 'tt'.$id;

    $this->db->where('id', $id)
                  ->update('sentsamples', $update_data);
    //$this->load->helper('url');
    redirect_back();
  }
  public function samples_pending() {
    
    $update_data = array(
        'Status' => 'pending'
      );
    $last = $this->uri->total_segments();
    $id = $this->uri->segment($last);
  //  echo 'tt'.$id;

    $this->db->where('id', $id)
                  ->update('sentsamples', $update_data);
    //$this->load->helper('url');
    redirect_back();
  }

  public function callbackSampleSent() {
    
    $update_data = array(
        'samplesent' => 1
      );
    $last = $this->uri->total_segments();
    $inspection_id = $this->uri->segment($last);
  //  echo 'tt'.$id;

    $this->db->where('id', $inspection_id)
                  ->update('inspections', $update_data);
    //$this->load->helper('url');
    return true;
  }

  function changeStatusDisplay($value, $row)
  {
    if($value == 'pending') 
    {
      return '<span style="background-color: #ff0000; color: #FFF; padding: 2px">'.$value.'</span>';
    }
    else {
      return '<span style="background-color: #00ff24; padding: 4px">'.$value.'</span>';
    }
    
  }
  function changeResultDisplay($value, $row)
  {
    if($value == '0') 
    {
      return '<span style="background-color: #ff0000; color: #FFF; padding: 2px 4px"> NO </span>';
    }
    else {
      return '<span style="background-color: #00ff24; padding: 4px 6px"> Yes </span>';
    }
    
  }

  public function sampleResultButton($value, $row)
  {
  //  var_dump($row);
    if(($row->Status == 'tested') && ($row->ResultAdded == 0) ) {
      return '<a title="'.$row->Status.'" style="font-size:11px !important; color: white; padding: 2px !important;" class="btn btn-danger " href="'.base_url('admin/seedsamples/result/add').'/'.$row->id.'">Add</a>';
    } 
    else if(($row->Status == 'tested') && ($row->ResultAdded == 1) ) {
      $this->resultlist_count++;
    }
    else {
      return;
    }
  }

  public function seedproducers()
  {
    $this->data['page_title'] = 'List of Seedproducers';
 
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

    //var_dump($users);

    $columns = array_keys($newusers[0]);

    //var_dump($columns);

    $sortkey_array = array();
    foreach ($users as $key => $row)
    {
        $sortkey_array[$key] = $row->user_id;
    }
    array_multisort($sortkey_array, SORT_DESC, $users);

    //var_dump($users);
   
    $this->data['crud_type'] = 'sendsamples_seedproducers';
    $this->data['columns'] = $columns;
    $this->data['list'] = $users;

    $this->render('admin/pages/sendsamples_view');

  }

  public function send()
  {
    
    $crud = new grocery_CRUD();
    $crud->set_table('sentsamples');
    $crud->set_subject('Send Sample');

    $crud->unset_delete() 
          ->unset_edit()
          ->unset_back_to_list();
    $state = $crud->getstate();

    switch ($state) {
      case 'add':
        $this->data['page_title'] = 'Send Sample';
        
        $last = $this->uri->total_segments();
        $inspection_id = $this->uri->segment($last);

        $this->load->model('Inspection_model', 'inspections');
        $inspection = $this->inspections->where('id', $inspection_id)->get();

        //var_dump($inspection);
        $branch = $this->ion_auth->user()->row()->branch;

        $crud->fields('InspectionID', 'ForwardingNo', 'SamplePackingDate', 'SeedProducerID', 'FarmerID', 'CropID', 'CropVariety', 'SeedClass', 'LotNo', 'GradedSeedQty', 'RequiredTests', 'YearID', 'branch');

        $crud->field_type('InspectionID', 'hidden', $inspection_id)
          ->field_type('SeedProducerID', 'hidden', $inspection->seed_producer_id)
          ->field_type('FarmerID', 'hidden', $inspection->farmer_id)
          ->field_type('CropID', 'hidden', $inspection->crop_id)
          ->field_type('CropVariety', 'hidden', $inspection->crop_id)
          ->field_type('SeedClass', 'hidden', $inspection->seed_class)
          ->field_type('branch', 'hidden', $inspection->branch)
          ->field_type('YearID', 'hidden', $inspection->year_id)
          ;

        break;
      
      default:

        $last = $this->uri->total_segments();
        $seed_producer_id = $this->uri->segment($last);

        $this->data['page_title'] = 'Samples Sent';
        $crud->columns('AddResult', 'ResultAdded', 'Status', 'LotNo', 'SamplePackingDate', 'SeedProducerID', 'FarmerID', 'YearID', 'CropID', 'CropVariety', 'SeedClass', 'GradedSeedQty', 'RequiredTests');
        $crud->set_relation('SeedProducerID', 'users', '{first_name} {last_name}')
            ->set_relation('FarmerID', 'farmerslist', 'name')
            ->set_relation('CropID', 'crop_master', 'CropName')
            ->set_relation('CropVariety', 'crop_variety', 'VarietyName')
            ->set_relation('SeedClass', 'classes_of_seed', 'ClassName')
            ->set_relation('YearID', 'year', '{StartYear} - {EndYear}')
            ;

        $crud->add_action('Tested', '' ,'admin/seedsamples/samples_tested', 'btn btn-success');
        $crud->add_action('Pending', '' ,'admin/seedsamples/samples_pending', 'btn btn-danger');

        $branch = $this->ion_auth->user()->row()->branch;

        $where = array(
        'sentsamples.SeedProducerID' => $seed_producer_id,
        'sentsamples.branch'         => $branch
          );

        $crud->where($where);

        break;
    }

    $crud->callback_column('Status', array($this,'changeStatusDisplay'));
    $crud->callback_column('ResultAdded', array($this,'changeResultDisplay'));

    $crud->callback_column('AddResult', array($this,'sampleResultButton'));

    $crud->callback_after_insert(array($this, 'callbackSampleSent'));

    $crud->display_as('GradedSeedQty', 'Graded Seeds Quantity')
          ->display_as('RequiredTests', 'Tests Required')
          ->display_as('SamplePackingDate', 'Sample Packing Date')
          ->display_as('SeedProducerID', 'Seed Producer')
          ->display_as('FarmerID', 'Farmer Name')
          ->display_as('CropID', 'Crop')
          ->display_as('CropVariety', 'Crop Variety')
          ->display_as('SeedClass', 'Seed Class')
          ->display_as('AddResult', 'Add Sample Test Result')
        ;
          
    $crud->set_relation_n_n('RequiredTests','sentsamples_tests','sampletests', 'SampleSentID', 'SampleTestID', 'TestName');

    $crud->set_lang_string('insert_success_message',
     'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/seedsamples/seedproducers').'";
     </script>
     <div style="display:none">
     '
    );
    
    $this->data['crud_type'] = 'send_sample';
    $this->data['output'] = $crud->render();
    $this->data['disabling_css'] = 'disabling_css.css';
    //var_dump($crud);
    $this->render('admin/crud_view');

  }


  public function callback_LotNo() {
    $last = $this->uri->total_segments();
    $sentsample_id = $this->uri->segment($last);

    $this->load->model('Sentsample_model', 'sentsamples');
    $val = $this->sentsamples->fields('LotNo')->where('id', $sentsample_id)->get()->LotNo;
    
    return '<input id="field-LotNo" type="text" class="form-control" value="'.$val.'" name="LotNo" readonly>';
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }

  public function callback_LotQty() {
    $last = $this->uri->total_segments();
    $sentsample_id = $this->uri->segment($last);

    $this->load->model('Sentsample_model', 'sentsamples');
    $val = $this->sentsamples->fields('GradedSeedQty')->where('id', $sentsample_id)->get()->GradedSeedQty;
    
    return '<input id="field-LotQty" type="text" class="form-control" value="'.$val.'" name="LotQty" readonly>';
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }

  public function callback_ForwardingNo() {
    $last = $this->uri->total_segments();
    $sentsample_id = $this->uri->segment($last);

    $this->load->model('Sentsample_model', 'sentsamples');
    $val = $this->sentsamples->fields('ForwardingNo')->where('id', $sentsample_id)->get()->ForwardingNo;
    
    return '<input id="field-ForwardingNo" type="text" class="form-control" value="'.$val.'" name="ForwardingNo" readonly>';
    //$req_date = $this->reqform->get_field($reqid, 'request_date_time');
  }
  
  public function callbackResultAdded($post_array,$primary_key)
  {
//    var_dump($post_array);
    $this->db->set('ResultAdded', 1)
        ->where('id', $post_array['SentSampleID'])
        ->update('sentsamples');
    $this->load->helper('url');
    //redirect(base_url('admin/seedsamples/send'));
    

  //  return true;
  }

  public function result()
  {
    
    $crud = new grocery_CRUD();
    $crud->set_table('resultregister');
    $crud->set_subject('Seed Sample Result');

    $crud->unset_back_to_list()
        ->unset_delete()
        ->unset_texteditor('SpecialRemarks', 'full_text');

    $state = $crud->getstate();

    $crud->fields('SentSampleID', 'SeedProducerID', 'FarmerID', 'CropID', 'CropVariety', 'SeedClass', 'LotNo', 'LotQty', 'SeedSampleDate', 'SampleResultDate','ForwardingNo','GrowingPower','PhysicalStrength','FullGrown','HalfGrown','FreshUngrown','Hardened','DeadSeeds','SeedPurity','PureSeeds','SeedsOfOtherCrops','SeedsOfOtherVariety','Garbage','SeedsOfWeeds','Moisture','Bunt','SpoiledByInsects', 'ODV', 'Laboratory', 'Result', 'SpecialRemarks', 'SeedCertificationAuthority', 'RegionalCertificationOfficerSignature', 'YearID', 'branch');

    switch ($state) {
      case 'add':
        $this->data['page_title'] = 'Add Seed Sample Result';

        $last = $this->uri->total_segments();
        $sentsample_id = $this->uri->segment($last);

        $this->load->model('Sentsample_model', 'sentsamples');
        $sentsample = $this->sentsamples->where('id', $sentsample_id)->get();

  //      var_dump($sentsample);

        $crud->field_type('SentSampleID', 'hidden', $sentsample_id)
          ->field_type('SeedSampleDate', 'hidden', $sentsample->SamplePackingDate)
          ->field_type('SeedProducerID', 'hidden', $sentsample->SeedProducerID)
          ->field_type('FarmerID', 'hidden', $sentsample->FarmerID)
          ->field_type('CropID', 'hidden', $sentsample->CropID)
          ->field_type('CropVariety', 'hidden', $sentsample->CropVariety)
          ->field_type('SeedClass', 'hidden', $sentsample->SeedClass)
          ->field_type('branch', 'hidden', $sentsample->branch)
          ->field_type('YearID', 'hidden', $sentsample->YearID)
          ;

          $crud->callback_add_field('LotNo', array($this, 'callback_LotNo'));
          $crud->callback_add_field('LotQty', array($this, 'callback_LotQty'));
          $crud->callback_add_field('ForwardingNo', array($this, 'callback_ForwardingNo'));

      break;
      case 'edit':
        $this->data['page_title'] = 'Edit Seed Sample Result';
        $crud->edit_fields('SentSampleID', 'SampleResultDate','Result','GrowingPower','PhysicalStrength','Moisture','SeedsOfOtherCrops','Weeds','Bunt','SpoiledByInsects','ODV','Laboratory', 'SeedCertificationAuthority', 'RegionalCertificationOfficerSignature');
        

      break;
      default:
        $this->data['page_title'] = 'Seed Sample Result Register';
         $crud->set_relation('CropID', 'crop_master', 'CropName')
         ->set_relation('CropVariety', 'crop_variety', 'VarietyName')
         ->set_relation('SeedClass', 'classes_of_seed', 'ClassName')
         ->set_relation('SeedProducerID', 'users', '{first_name} {last_name}')
         ->set_relation('FarmerID', 'farmerslist', 'name')
          ;


      break;
    }

    $crud->display_as('FarmerID', 'Farmer')
          ->display_as('SeedProducerID', 'Seed Producer')
          ->display_as('SeedClass', 'Seed Class')
          ->display_as('CropVariety', 'Crop Variety')
          ->display_as('LotNo', 'Lot No.')
          ->display_as('LotQty', 'Lot Quantity')
          ->display_as('SampleResultDate', 'Date of Sample Result')
          ->display_as('ForwardingNo', 'Forwarding No.')
          ->display_as('GrowingPower', 'Growing Power')
          ->display_as('PhysicalStrength', 'Physical Strength')
          ->display_as('SeedsOfOtherCrops', 'Seeds of other Crops')
          ->display_as('SpoiledByInsects', 'Spoiled by Insects')
          ->display_as('SeedCertificationAuthority', 'Seed Certification Authority')
          ->display_as('RegionalCertificationOfficerSignature', 'Signature of Regional Certification Officer')
          ->display_as('YearID', 'Year')
          ;

   $crud->columns('SeedProducerID', 'FarmerID', 'YearID', 'LotNo', 'LotQty', 'SeedSampleDate', 'SampleResultDate', 'Result', 'ForwardingNo','GrowingPower','PhysicalStrength','FullGrown','HalfGrown','FreshUngrown','Hardened','DeadSeeds','SeedPurity','PureSeeds','SeedsOfOtherCrops','SeedsOfOtherVariety','Garbage','SeedsOfWeeds','Moisture','Bunt','SpoiledByInsects', 'ODV', 'Laboratory', 'SpecialRemarks', 'SeedCertificationAuthority', 'RegionalCertificationOfficerSignature', 'branch');
    //$crud->unset_columns('SentSampleID');

   $crud->set_relation('Laboratory', 'seed_laboratory', 'LabName')
        ->set_relation('SeedCertificationAuthority', 'regional_office', 'RegionName');

/*    $crud->set_relation_n_n('SeedsOfOtherCrops','resultregister_crops','crop_master', 'resultregister_id', 'crop_id', 'CropName');
    $crud->set_relation_n_n('Weeds','resultregister_weeds','weed_master', 'resultregister_id', 'weed_id', 'WeedName');
*/
    $crud->set_field_upload('RegionalCertificationOfficerSignature','assets/uploads/signatures');

    $crud->callback_after_insert(array($this, 'callbackResultAdded'));
    $crud->callback_after_update(array($this, 'callbackResultAdded'));

    $branch = $this->ion_auth->user()->row()->branch;
    $last = $this->uri->total_segments();
    $seed_producer_id = $this->uri->segment($last);
        
    $where = array(
     'resultregister.SeedProducerID' => $seed_producer_id,
     'resultregister.branch'         => $branch
      );

    $crud->where($where);


    //Auto redirect through javascipt.
    $crud->set_lang_string('insert_success_message',
     'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/seedsamples/send').'";
     </script>
     <div style="display:none">
     '
    );

    $crud->set_lang_string('update_success_message',
     'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/seedsamples/send').'";
     </script>
     <div style="display:none">
     '
    );

    $this->data['crud_type'] = 'resultregister';
    $this->data['disabling_css'] = 'disabling_css.css';

    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');

  }
  
  public function reports()
  {
     $this->data['page_title'] = 'Seed Sample Reports';
    $crud = new grocery_CRUD();

    //$crud->set_model('custom_query_model');
    $crud->set_table('resultregister');
    
    $crud->columns('SampleResultDate', 'FarmerID', 'CropVariety', 'SeedClass', 'LotNo', 'LotQty', 'FullGrown','HalfGrown','FreshUngrown','Hardened','DeadSeeds','PureSeeds','SeedsOfOtherCrops','SeedsOfOtherVariety','Garbage','SeedsOfWeeds','Moisture','Bunt','SpoiledByInsects','Result', 'SpecialRemarks', 'branch');

      $crud->display_as('SampleResultDate', 'Testing Date')
           ->display_as('FarmerID', 'Farmer')
           ->display_as('CropVariety','Crop Variety')
           ->display_as('SeedClass','Seed Class')
           ->display_as('LotNo','Lot No.')
           ->display_as('FullGrown','Full Grown')
           ->display_as('HalfGrown','Half Grown')
           ->display_as('FreshUngrown','Fresh Ungrown')
           ->display_as('DeadSeeds','Dead Seeds')
           ->display_as('PureSeeds','Pure Seeds')
           ->display_as('SeedsOfOtherCrops','Seeds of Other Crops / Kg')
           ->display_as('SeedsOfOtherVariety','Seeds of Other Variety / Kg')
           ->display_as('SeedsOfWeeds','Seeds of Weeds / Kg')
           ->display_as('SpoiledByInsects','Spoiled by Insects')
           ->display_as('SpecialRemarks','Special Remarks')
           ;    

       $crud->set_subject('Seed Sample Result');

     $crud->set_relation('CropID', 'crop_master', 'CropName')
           ->set_relation('FarmerID','farmerslist','name')
           ->set_relation('CropVariety','crop_variety','VarietyName')
           ->set_relation('SeedClass','classes_of_seed','ClassName')
           ;
  

     $seed_producer_id = $this->ion_auth->user()->row()->id;
     $branch = $this->ion_auth->user()->row()->branch;

//     echo $branch;

     $crud->unset_delete()
         ->unset_edit()
         ->unset_add();

     /*$crud->basic_model->set_query_str("
                       SELECT * FROM resultregister
                       WHERE SeedProducerID = ".$seed_producer_id."
                       AND 
                       branch = '".$branch."'

                        ");*/ 
     $result = $this->db->select('FarmerID')
                           ->from('sentsamples')
                           ->where('SeedProducerID', $seed_producer_id)
                           ->where('ResultAdded', 1)
                           ->where('Status', 'tested')
                           ->get()
                           ->result();
     $farmer_ids = array();
     foreach ($result as $id) {
       array_push($farmer_ids, $id->FarmerID);
     }
    // var_dump($farmer_ids);
    
     $crud->where_in('resultregister.FarmerID', $farmer_ids);

     $where = array(
      'resultregister.SeedProducerID' => $seed_producer_id,
      'resultregister.branch'         => $branch
 //     'resultregister.FarmerID'       => $farmer_ids
       );

     $crud->where($where);

     $state = $crud->getstate();
     switch ($state) {
       case 'list':
           $this->data['crud_type'] = 'resultregister_download';
         break;
     
       default:
         # code...
         break;
     }

    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');

  }

  public function downloadreport()
  {

    $seed_producer_id = $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

    $this->load->model('Sentsample_model', 'sentsample');
    $result = $this->sentsample->fields('FarmerID')->where('ResultAdded', 1)->get_all();

    $farmer_ids = array();
    foreach ($result as $id) {
      array_push($farmer_ids, $id->FarmerID);
    }

    $where = array(
     'resultregister.SeedProducerID' => $seed_producer_id,
     'resultregister.branch'         => $branch
//     'resultregister.FarmerID'       => $farmer_ids
      );

    $this->load->model('Resultregister_model', 'register');

   // var_dump($list);

    $data['list'] =  $list = $this->register->get_report_data($farmer_ids, $where);

    $html = $this->load->view('admin/pages/seedsamplereport_view', $data, true);
 //   echo $html; 

    $pdfFilePath = $list[0]->ForwardingNo.".pdf";

    //load mPDF library
    $this->load->library('m_pdf');
    $this->load->helper('url');
    //generate the PDF! 
   // $param = '"en-GB-x","A4","","",10,10,10,10,6,3,"L"'; 
    //Parameters are not working through a variable but need to be hard coded like below. May be its because the function accepts coma seperated values, not a comma seperated string.

    $pdf = new mPDF("en-GB-x","A4-L","","",10,10,10,10,6,3,"L");

    $stylesheet = file_get_contents(base_url('assets/sbadmin/bower_components/bootstrap/dist/css/bootstrap.min.css'));
    $pdf->WriteHTML($stylesheet,1);

    $pdf->WriteHTML($html);
    //offer it to user via browser download! (The PDF won't be saved on your server HDD)
    $pdf->Output($pdfFilePath, "D");
  }
  
  
}