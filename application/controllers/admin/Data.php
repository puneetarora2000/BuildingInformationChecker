<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends Admin_Controller
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
  /*
  public function tests()
  {
    $this->data['page_title'] = 'Seed Sample Tests';
    $crud = new grocery_CRUD();
    $crud->set_table('sampletests');
    $crud->set_subject('Seed Sample Test');

    $crud->unset_texteditor('TestDescription', 'full_text');

    $this->data['crud_type'] = 'sampletests';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }*/

  public function iscodebook(){

    $this->data['page_title'] = 'Issue While Checking Model';
    $crud = new grocery_CRUD();
    $crud->set_table('iscodebook');
    $crud->set_subject('IS CODE BOOK');
    $this->data['crud_type'] = 'iscodebook';
    $this->data['output'] = $crud->render();
    $this->render('admin/crud_view');
  }

  public function exportrules(){

    $this->data['page_title'] = ' Exporting Rules for Java';
    $crud = new grocery_CRUD();  
    $this->data['exportdata'] = 'export_data';
    $this->data['output'] = $crud->render();

    $this->render('admin/export_view');  

  }


  public function issuetypes(){


    $this->data['page_title'] = 'Issue While Checking Model';
    $crud = new grocery_CRUD();
    $crud->set_table('issuetypes');

    $crud->set_subject('Define Issue Types(s) ');
   // $crud->set_relation('ruleset_id','rule','name');
     
    /* $crud->display_as('salience','Priority')
           ->display_as('ruleset_id','RuleSetName')
           ->display_as('Conseq_class_name','RuleSetName')
           ->display_as('Conseq_taint_mode','RuleSetName')
          ;*/


    $this->data['crud_type'] = 'issuetypes';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');


  }


  public function rule()
  {
    $this->data['page_title'] = 'Making Conformance and Compliance  Rules ';
    $crud = new grocery_CRUD();
    $crud->set_table('rule');
     $crud->order_by('rule_id','desc');

    $crud->set_subject('Define Rule(s) ');
    
    $crud->fields('parent_rule_id',
          'ruleset_id',
          'name',
          'salience',
          'documentation',
          'FORMULA',
          'IS_CODE',
          'ISCLAUSE',
          'conseq_script' 
          );
 
      $crud->columns('parent_rule_id',
          'ruleset_id',
          'name',
          'salience',
          'documentation',
          'FORMULA',
          'IS_CODE',
          'ISCLAUSE',
          'conseq_script' 
          );
 




     $crud->display_as('salience','Priority')
           ->display_as('ruleset_id','RuleSetName')
           ->display_as('documentation','What it Checks')
           ->display_as('parent_rule_id','Root/Parent RuleSetName')
           ->display_as('IS_CODE','IS Code Ref:')
           ->display_as('ISCLAUSE','IS Code clause Ref:')
           ->display_as('FORMULA','FormulaDefination')
           ->display_as('conseq_script','IS Code Book Ref PageNumber')
           
          ;

          

        $crud->set_relation('parent_rule_id', 'rule', 'name');
         $crud->set_relation('ruleset_id', 'ruleset', 'name');     
      
    $this->data['crud_type'] = 'rule';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

public function ruletype()
  {
    $this->data['page_title'] = 'Conformance and Compliance RuleType   Table';
    $crud = new grocery_CRUD();
    $crud->set_table('ruletype');
    $crud->order_by('RuleTypeID','desc');
    $crud->set_subject('Conformance and Compliance   Rule Type ');
    $crud->required_fields('RuleTypeName');
    $this->data['crud_type'] = 'Conformance and Compliance   Rule Type ';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }




 public function ruleset()
  {
    $this->data['page_title'] = 'Conformance and Compliance Rule Set Table';
    $crud = new grocery_CRUD();
    $crud->set_table('ruleset');
      $crud->order_by('ruleset_id','desc');
    $crud->set_subject('Conformance and Compliance Rule Set');
    


    $crud->required_fields('name');


    $this->data['crud_type'] = 'ruleset';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }


// project_sites




 public function elements()
  {
    $this->data['page_title'] = 'Structural  Elements  Record Table';
    $crud = new grocery_CRUD();
    $crud->set_table('structureelements');
    $crud->order_by('StructureElementID','desc'); 
    $crud->set_subject('Structural  Elements  Record');
    $crud->set_relation('StructureElementParentID','structureelements','StructureElementName');
    

    $this->data['crud_type'] = 'Structural  Elements  Record Table';
    

    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }
// 

//ruletype




public function ruleinputparameters()
  {
    $this->data['page_title'] = 'Rule Input Parameters';
    $crud = new grocery_CRUD();
    $crud->set_table('ruleinputparameters');
    $crud->set_subject('Conformance and Compliance  Rule Input Parameters');
   
       $crud->order_by('RuleInputsVariableID','desc'); 
   
    
    $crud->required_fields('rule','name');

     $crud->columns('StructureInputsVariableID',
          'RuleID',
          'DataType',
          'InputsVariableDocumentation',
          'ApplyOnProjectNameID'          
          );

      $crud->fields(
          'StructureInputsVariableID',
          'RuleID',
          'DataType',
          'InputsVariableDocumentation',
          'ApplyOnProjectNameID'          
          );


 

      $crud->set_relation('RuleID','rule','name');
    $crud->set_relation('ApplyOnProjectNameID','projects','ProjectName');     

    $this->data['crud_type'] = 'ruleinputparameters';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }
//weeds 

public function ruleoperators()
  {
    $this->data['page_title'] = 'ruleoperators Table';
    $crud = new grocery_CRUD();
    $crud->set_table('ruleoperators');
    $crud->order_by('RuleOperatorsID','desc'); 
    $crud->set_subject('Conditional  Operators of Conformance Rule ');
    $crud->required_fields('RuleName');
    
    $this->data['crud_type'] = 'Condition Rule Operators';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }


//weeds 

public function structureattributes()
  {
    $this->data['page_title'] = 'Structural  Attributes Record Table';
    $crud = new grocery_CRUD();
    $crud->set_table('structureattributes');
    $crud->set_subject('structureattributes');
     $crud->order_by('StructureAttributeID','desc'); 
    $crud->set_relation('StructureElementID','structureelements','StructureElementName');

   
    $crud->required_fields('StructuralAttributeName');
     $crud->required_fields('StructuralAttributeValue');
    $this->data['crud_type'] = 'structureattributes';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }


//seeds 

public function structuredetails()
  {
    $this->data['page_title'] = 'structuredetails';
    $crud = new grocery_CRUD();
    $crud->set_table('structuredetails');
    $crud->set_subject('Structure Details');
     $crud->order_by('StructuredetailID','desc'); 
    $crud->set_relation('StructureElementID','structureelements','StructureElementName');
     
     $crud->set_relation('UnitID','structureunits','Unit');
     
    $crud->set_relation('StructureAttributeID','structureattributes','StructureAttributesName');
    $this->data['crud_type'] = 'StructureDetails';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

public function structureunits()
  {
    $this->data['page_title'] = 'Structure Units Table';
    $crud = new grocery_CRUD();
    $crud->set_table('structureunits');
    $crud->set_subject('Structure Units Record Master');
     $crud->order_by('UnitID','desc'); 
    $crud->required_fields('Unit');
    


    $this->data['crud_type'] = 'structureunits';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

  //foundation

public function users()
  {
    $this->data['page_title'] = 'Users   Table';
    $crud = new grocery_CRUD();
    $crud->set_table('users');
    $crud->set_subject('Users');
     $crud->order_by('id','desc'); 
     $crud->required_fields('username','password');
    $this->data['crud_type'] = 'users';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

//groups


public function groups()
  {
    $this->data['page_title'] = 'Groups Table';
    $crud = new grocery_CRUD();
    $crud->set_table('groups');
    $crud->set_subject('Groups  Master');
    $crud->order_by('id','desc'); 
     $crud->required_fields('name');
    $this->data['crud_type'] = 'groups';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

//year

public function year()
  {
    $this->data['page_title'] = 'year Table';
    $crud = new grocery_CRUD();
    $crud->set_table('year');
    $crud->order_by('YearID','desc'); 
    $crud->set_subject('year  Master');

    $this->data['crud_type'] = 'year';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }
//menus

public function menus()
  {
    $this->data['page_title'] = 'menus Table';
    $crud = new grocery_CRUD();
    $crud->set_table('menus');
    $crud->set_subject('menus  Master');

    $this->data['crud_type'] = 'menus';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }


  public function projects()
  {
    $this->data['page_title'] = 'The Direct assignment to project, if the building is the outermost spatial container, and no site information is provided for building projects';
    $crud = new grocery_CRUD();
    $crud->set_table('projects');
    $crud->set_subject('Projects');
     $crud->order_by('ProjectID','desc'); 
   // $crud->required_fields('ProjectID');
    $crud->set_relation('ModuleID','modules','ModuleName');
    $this->data['crud_type'] = 'projects';
    $this->data['output'] = $crud->render();
    $this->render('admin/crud_view');
  }
//buildings


public function site()
  {
    $this->data['page_title'] = 'Assignment to site, if the building is the spatial container for the building project with site information ';
    $crud = new grocery_CRUD();
    $crud->set_table('project_sites');
    $crud->set_subject('project_sites : The Location of Work/Structure ');
    $crud->set_relation('ProjectID','projects','ProjectName');
    $crud->display_as('ProjectID','ProjectName');
         $crud->order_by('SiteID','desc'); 
    $crud->required_fields('ProjectID');
    $this->data['crud_type'] = 'Buildings';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }


public function buildings()
  {
    $this->data['page_title'] = ' Assignment to another building as spatial container, e.g. if this building represents a building section.';
    $crud = new grocery_CRUD();
    $crud->set_table('building');
    $crud->order_by('ProjectID','desc');
    $crud->set_subject('Buildings : The Location of Work/Structure ');
    $crud->set_relation('ProjectID','projects','ProjectName');
    $crud->set_relation('SiteID','project_sites','SiteName');
    $crud->display_as('ProjectID','ProjectName');
    $crud->display_as('SiteID','SiteName');
    $crud->set_relation('ModuleID','modules','ModuleName');
    $crud->required_fields('ProjectID','BuildingName');
    $this->data['crud_type'] = 'Buildings';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

//modelfiledb

public function modelfiledb()
  {
    $this->data['page_title'] = 'modelfiledb';
    $crud = new grocery_CRUD();
    $crud->set_table('modelfiledb');
    $crud->set_subject('iFc File Model DB ');

    $crud->required_fields('FilePath');


    $this->data['crud_type'] = 'modelfiledb';
    
    $crud->set_field_Upload('FilePath','assets/uploads/');

    $this->data['output'] = $crud->render();
    
      $crud->required_fields('FilePath');
    $this->render('admin/crud_view');
  }


//condition_script

public function condition_script()
  {
    $this->data['page_title'] = 'condition_script';
    $crud = new grocery_CRUD();
    $crud->set_table('condition_script');
    $crud->set_subject('The Condition Script : When Condition  ');
    $crud->required_fields('script');  
    $this->data['crud_type'] = 'condition_script';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }

  //consequence_script

public function consequence_script()
  {
    $this->data['page_title'] = 'Consequence Script  Output of the Condition';
    $crud = new grocery_CRUD();
    $crud->set_table('consequence_script');
    $crud->set_subject('consequence Script Logic : Output of the Condition');
    $crud->required_fields('script'); 
    $this->data['crud_type'] = 'consequence_script';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }
//modules

public function modules()
  {
    $this->data['page_title'] = 'Modules of IFC Specs';
    $crud = new grocery_CRUD();
    $crud->set_table('modules');
    $crud->set_subject('Modules of IFC Specs');
     $crud->order_by('ModuleID','desc');
    $this->data['crud_type'] = 'modules';
    $this->data['output'] = $crud->render();

    $this->render('admin/crud_view');
  }




  public function takeBackup(){

$this->load->dbutil();
//$backup = $this->dbutil->backup();


$backup =& $this->dbutil->backup(); 

$this->load->helper('file');
write_file('/assest/updates/mybackup.gz', $backup); 
$this->load->helper('download');
force_download('mybackup.gz', $backup);

}

}