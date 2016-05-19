<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Farmers extends Admin_Controller
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
  function seedInQtls($value, $row)
  {
      return $value.' Qtls';
  }

  function areaInHectare($value, $row)
  {
      return $value.' Hectare'; 
  }

  function callbackAddress($value, $row)
  {
    //print_r($row);
    return $row->address.', '.$row->tehsil.', '.$row->village;
  }

  function callbackName($value, $row)
  {
    //print_r($row);
    return $row->name.' - S/O. '.$row->fathers_name;
  }

  public function index()
  {

    $this->data['page_title'] = 'Farmers List for the Current Session / Year';
    $crud = new grocery_CRUD();
    $crud->set_table('farmerslist');
    $crud->set_subject('Farmers');
    
    $crud->fields('name', 'fathers_name', 'mobile_no', 'district', 'tehsil', 'village', 'crop_name', 'crop_variety', 'seed_class', 'seed_given', 'area_planted', 'yearid', 'submitted_by');

    $crud->columns('yearid', 'name', 'complete_address', 'mobile_no', 'crop_name', 'crop_variety', 'seed_class', 'seed_given', 'area_planted');

    $crud->callback_column('complete_address',array($this,'callbackAddress'));
    $crud->callback_column('name',array($this,'callbackName'));

    $crud->display_as('complete_address','Address')
         ->display_as('yearid','Year')
         ->display_as('crop_name','Crop Name')
         ->display_as('crop_variety','Crop Variety')
         ->display_as('seed_class','Seed Class')
         ->display_as('seed_given','Seed Given')
         ->display_as('area_planted', 'Area Planted')
         ;

    $crud->set_relation('crop_name', 'crop_master', 'CropName');
    $crud->set_relation('crop_variety', 'crop_variety', 'VarietyName');
    $crud->set_relation('seed_class', 'classes_of_seed', 'ClassName');
    $crud->set_relation('tehsil', 'tehsils', 'tehsil_name');
    $crud->set_relation('district', 'districts', 'district_name');
    $crud->set_relation('yearid', 'year', '{StartYear} - {EndYear}');
    $crud->callback_column('seed_given',array($this,'seedInQtls'));
    $crud->callback_column('area_planted',array($this,'areaInHectare'));
    
    $state = $crud->getState();

    $this->load->library('ion_auth');
    $user_id = $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

    $yearid = $this->db->select('YearID')
                    ->from('year')
                    ->where( array(
                            'StartYear' => date('Y') - 1,
                             'EndYear' => date('Y')
                            )
                    )->get()->result();

     // var_dump($yearid);
    //var_dump($user_groups);

    switch ($state) {
      case 'add':
        $crud->field_type('submitted_by', 'hidden', $user_id);
        $crud->field_type('branch', 'hidden', $branch);
      case 'list':
        $user_groups = $this->ion_auth->get_users_groups()->result();
        //var_dump($user_groups);
        if($user_groups[0]->name == 'inspector') {
          $crud->add_action('First Inspection', '' ,'admin/inspections/firstinspection/add', 'btn btn-danger');
        }
    
        $crud->set_relation('submitted_by', 'users', '{first_name} {last_name}');
        break;
      case 'read':
        $crud->set_relation('submitted_by', 'users', '{first_name} {last_name}');
        break;  
    }
    
    
    $where = array(
        'farmerslist.submitted_by' => $user_id,
        'farmerslist.branch'       => $branch,
        'farmerslist.yearid'                   => $yearid[0]->YearID
      );
    $crud->where($where);
    
    $this->data['years'] = $this->db->select('*')->from('year')->get()->result();

    $this->data['crud_type'] = 'farmerslist';
    $this->data['output'] = $crud->render();

    $this->render('admin/farmerslist_view');
    
  }

  public function year()
  {

    $crud = new grocery_CRUD();
    $crud->set_table('farmerslist');
    $crud->set_subject('Farmers');
    
    $year = $this->db->select('StartYear')->from('year')->where('YearID', $_POST['year'])->get()->result()[0]->StartYear;

    if($year < (date('Y')-1)) {
      $crud->unset_delete()
          ->unset_edit()
          ->unset_add();
    }

    $crud->fields('name', 'fathers_name', 'mobile_no', 'district', 'tehsil', 'village', 'crop_name', 'crop_variety', 'seed_class', 'seed_given', 'area_planted', 'yearid', 'submitted_by');

    $crud->columns('yearid', 'name', 'complete_address', 'mobile_no', 'crop_name', 'crop_variety', 'seed_class', 'seed_given', 'area_planted');

    $crud->callback_column('complete_address',array($this,'callbackAddress'));
    $crud->callback_column('name',array($this,'callbackName'));

    $crud->display_as('complete_address','Address')
         ->display_as('yearid','Year')
         ->display_as('crop_name','Crop Name')
         ->display_as('crop_variety','Crop Variety')
         ->display_as('seed_class','Seed Class')
         ->display_as('seed_given','Seed Given')
         ->display_as('area_planted', 'Area Planted')
         ;

    $crud->set_relation('crop_name', 'crop_master', 'CropName');
    $crud->set_relation('crop_variety', 'crop_variety', 'VarietyName');
    $crud->set_relation('seed_class', 'classes_of_seed', 'ClassName');
    $crud->set_relation('tehsil', 'tehsils', 'tehsil_name');
    $crud->set_relation('district', 'districts', 'district_name');
    $crud->set_relation('yearid', 'year', '{StartYear} - {EndYear}');
    $crud->callback_column('seed_given',array($this,'seedInQtls'));
    $crud->callback_column('area_planted',array($this,'areaInHectare'));
    
    $state = $crud->getState();

    $this->load->library('ion_auth');
    $user_id = $this->ion_auth->user()->row()->id;
    $branch = $this->ion_auth->user()->row()->branch;

   // var_dump($_POST);

    switch ($state) {
      case 'add':
        $crud->field_type('submitted_by', 'hidden', $user_id);
        $crud->field_type('branch', 'hidden', $branch);
      case 'list':
        $user_groups = $this->ion_auth->get_users_groups()->result();
        //var_dump($user_groups);
        if($user_groups[0]->name == 'inspector') {
          $crud->add_action('First Inspection', '' ,'admin/inspections/firstinspection/add', 'btn btn-danger');
        }
    
        $crud->set_relation('submitted_by', 'users', '{first_name} {last_name}');
        break;
      case 'read':
        $crud->set_relation('submitted_by', 'users', '{first_name} {last_name}');
        break;  
    }
    
    
    $where = array(
        'farmerslist.submitted_by' => $user_id,
        'farmerslist.branch'       => $branch,
        'farmerslist.yearid'       => $_POST['year']
      );
    $crud->where($where);
    
    $this->data['page_title'] = 'Farmers List for year '.$year.'-'.++$year;
    $this->data['years'] = $this->db->select('*')->from('year')->get()->result();

    $this->data['crud_type'] = 'farmerslist_yearwise';
    $this->data['output'] = $crud->render();

    $this->render('admin/farmerslist_view');
    
  }

  function add() {
    $this->load->helper('form');

    //echo FCPATH.'assets/uploads/farmerslist/';
    
      $config['upload_path'] = FCPATH.'assets/uploads/farmers/';
      $config['allowed_types'] = 'xls|xlsx';
//      $config['max_size']    = '100';
      
      // You can give video formats if you want to upload any video file.
      if($_POST):

      $this->load->library('upload', $config);
       
      if ( ! $this->upload->do_upload('farmers_list'))
      {
        $error = array('error' => $this->upload->display_errors());
        $this->data['message'] = $error;

      // uploading failed. $error will holds the errors.
      }
      else
      {
        $upload_data = array('upload_data' => $this->upload->data());

        $this->load->library('excel');

        //  Read your Excel workbook
        $reader = PHPExcel_IOFactory::createReader('Excel2007');
        $reader->setReadDataOnly(true);
        $excel = $reader->load($upload_data['upload_data']['full_path']);


        //  Get worksheet dimensions
        $sheet = $excel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();

        $row_headings = array();
        $farmers_list = array();
        //  Loop through each row of the worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            if($row == 1) {
              $row_headings = $rowData[0];  
            } else {
              array_push($farmers_list, $rowData[0]);
            }
            //  Insert row data array into your database of choice here
        }
        /*$reader = PHPExcel_IOFactory::createReader('Excel2007');
        $reader->setReadDataOnly(true);
        $excel = $reader->load($upload_data['upload_data']['full_path']);

        $sheet=$excel->setActiveSheetIndex(0);
*/     // unset($farmers_list[0]);

        echo '<pre>';
        print_r($row_headings);
        echo '</pre>';

        echo '<pre>';
     //   print_r($farmers_list);
        echo '</pre>';

        $assc_list = array();

        foreach ($farmers_list as $farmer) {
          $data = array(
              'name'        => $farmer[0],
              'mobile_no'   => $farmer[1],
              'village'     => $farmer[2],
              'tehsil'      => $farmer[3],
              'district'    => $farmer[4],
              'crop_name'   => $farmer[5],
              'crop_variety'=> $farmer[6],
              'seed_class'  => $farmer[7],
              'seed_given'  => $farmer[8],
              'area_planted' => $farmer[9],
            );
          array_push($assc_list, $data);
        }
        echo '<pre>';
        print_r($assc_list);
        echo '</pre>';
        var_dump($this->upload->data());

       $this->db->insert_batch('farmerslist', $assc_list);



      // uploading successfull, now do your further actions
      }
    //  print_r($_FILES);
      endif;
    
    
    $this->data['page_title'] = 'Farmers List';

    $this->render('admin/forms/add_farmerlist_view');

  }
}