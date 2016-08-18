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
    $this->load->library('ajax_grocery_CRUD');
    $this->load->helper('url');
     
      $this->load->helper('text');
    $this->load->model('Ruleinputparameters_model', 'freezrule');
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

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "product_rules.csv";
        $query = "SELECT * FROM ruleinputparameters";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
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
          'ISCLAUSE' 
           
          );
 
      $crud->columns('parent_rule_id',
          'ruleset_id',
          'name',
          'salience',
          'documentation',
          'FORMULA',
          'IS_CODE',
          'ISCLAUSE'
           
          );
 




     $crud->display_as('salience','Priority')
           ->display_as('ruleset_id','RuleSetName')
           ->display_as('documentation','What it Checks')
           ->display_as('parent_rule_id','Root/Parent RuleSetName')
           ->display_as('IS_CODE','ISCode Ref:')
           ->display_as('ISCLAUSE','ISCode clause Ref:')
           ->display_as('FORMULA','Formula Definition')
           //->display_as('conseq_script','PageNumber')
           
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

public function ruleoperator()
  {
    $this->data['page_title'] = 'Rules Construction';
     $crud = new grocery_CRUD();
    
    $crud->set_table('ruleinputparameters');
    $crud->set_subject('Select Operator for Rule');
    $crud->order_by('StructureElementID','desc'); 
    $crud->edit_fields('Operator');

    $crud->columns('StructureElementID',
          'Ifc_Structure_Attribute',
          'ruleset_id',
          'RuleID',
          //'FORMULA',
          'IS456_Structure_Attribute_Name',
          'InputsVariableDocumentation',
          'DataType',
          'ApplyOnProjectNameID'          
          );

      $crud->display_as('InputsVariableDocumentation','Ifc-IS456 Semantic Mapping Documentation');
      $crud->display_as('DataType','Input Variable DataType');
      $crud->display_as('ruleset_id','Which RuleSet');
      $crud->display_as('RuleID','Rule Name');
      $crud->display_as('ApplyOnProjectNameID','ProjectName');
      $crud->set_relation('ApplyOnProjectNameID','projects','ProjectName'); 
      $crud->set_relation('ruleset_id','ruleset','name');  
      $crud->set_relation('StructureElementID','structureelements','StructureElementName');    
      $crud->set_relation('Ifc_Structure_Attribute','structureattributes','StructureAttributesName'); 

    ##$state = $crud->getState();
     $crud->unset_add()->unset_delete()->unset_;
//->unset_list()->unset_delete()
    $crud->set_lang_string('update_success_message',
     ' Data has been successfully Updated into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/data/ruleinputparameters').'";
     </script>
     <div style="display:none">');


    $this->data['crud_type'] = 'ruleinputparameters';
    $this->data['output'] = $crud->render();
    $this->render('admin/crud_view');
 
    //$crud->required_fields(
}


public function ruleThresholds()
  {
    $this->data['page_title'] = '  Rule Thresholds';
     $crud = new grocery_CRUD();
    
    $crud->set_table('ruleinputparameters');
    $crud->set_subject('Select Rule Condition Thresholds');
    $crud->order_by('StructureElementID','desc'); 
    $crud->edit_fields('ruleThresholds');

    $crud->columns('StructureElementID',
          'Ifc_Structure_Attribute',
          'ruleset_id',
          'RuleID',
          //'FORMULA',
          'IS456_Structure_Attribute_Name',
          'InputsVariableDocumentation',
          'DataType',
          'ApplyOnProjectNameID'          
          );

      $crud->display_as('InputsVariableDocumentation','Ifc-IS456 Semantic Mapping Documentation');
      $crud->display_as('DataType','Input Variable DataType');
      $crud->display_as('ruleset_id','Which RuleSet');
      $crud->display_as('RuleID','Rule Name');
      $crud->display_as('ApplyOnProjectNameID','ProjectName');
      $crud->set_relation('ApplyOnProjectNameID','projects','ProjectName'); 
      $crud->set_relation('ruleset_id','ruleset','name');  
      $crud->set_relation('StructureElementID','structureelements','StructureElementName');    
      $crud->set_relation('Ifc_Structure_Attribute','structureattributes','StructureAttributesName'); 

    ##$state = $crud->getState();
     $crud->unset_add()->unset_delete()->unset_back_to_list();
//->unset_list()->unset_delete()
    $crud->set_lang_string('update_success_message',
     ' Data has been successfully Updated into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/data/ruleinputparameters').'";
     </script>
     <div style="display:none">');


    $this->data['crud_type'] = 'ruleinputparameters';
    $this->data['output'] = $crud->render();
    $this->render('admin/crud_view');
 

}

//OutputVariable

public function OutputVariable()
  {
    $this->data['page_title'] = 'Rules Constant';
     $crud = new grocery_CRUD();
    
    $crud->set_table('ruleinputparameters');
    $crud->set_subject('Select OutputVariable for Rule');
    $crud->order_by('StructureElementID','desc'); 
    $crud->edit_fields('OutputVariable');

    $crud->columns('StructureElementID',
          'Ifc_Structure_Attribute',
          'ruleset_id',
          'RuleID',
          //'FORMULA',
          'IS456_Structure_Attribute_Name',
          'InputsVariableDocumentation',
          'DataType',
          'ApplyOnProjectNameID'          
          );

      $crud->display_as('InputsVariableDocumentation','Ifc-IS456 Semantic Mapping Documentation');
      $crud->display_as('DataType','Input Variable DataType');
      $crud->display_as('ruleset_id','Which RuleSet');
      $crud->display_as('RuleID','Rule Name');
      $crud->display_as('ApplyOnProjectNameID','ProjectName');
      $crud->set_relation('ApplyOnProjectNameID','projects','ProjectName'); 
      $crud->set_relation('ruleset_id','ruleset','name');  
      $crud->set_relation('StructureElementID','structureelements','StructureElementName');    
      $crud->set_relation('Ifc_Structure_Attribute','structureattributes','StructureAttributesName'); 

    ##$state = $crud->getState();
     $crud->unset_add()->unset_delete();
//->unset_list()->unset_delete()
    $crud->set_lang_string('update_success_message',
     ' Data has been successfully Updated into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/data/ruleinputparameters').'";
     </script>
     <div style="display:none">');


    $this->data['crud_type'] = 'ruleinputparameters';
    $this->data['output'] = $crud->render();
    $this->render('admin/crud_view');
 

}

public function ruleConstant()
  {
    $this->data['page_title'] = 'Rules Constant';
     $crud = new grocery_CRUD();
    
    $crud->set_table('ruleinputparameters');
    $crud->set_subject('Select Operator for Rule');
    $crud->order_by('StructureElementID','desc'); 
    $crud->edit_fields('ruleConstant');

    $crud->columns('StructureElementID',
          'Ifc_Structure_Attribute',
          'ruleset_id',
          'RuleID',
          //'FORMULA',
          'IS456_Structure_Attribute_Name',
          'InputsVariableDocumentation',
          'DataType',
          'ApplyOnProjectNameID'          
          );

      $crud->display_as('InputsVariableDocumentation','Ifc-IS456 Semantic Mapping Documentation');
      $crud->display_as('DataType','Input Variable DataType');
      $crud->display_as('ruleset_id','Which RuleSet');
      $crud->display_as('RuleID','Rule Name');
      $crud->display_as('ApplyOnProjectNameID','ProjectName');
      $crud->set_relation('ApplyOnProjectNameID','projects','ProjectName'); 
      $crud->set_relation('ruleset_id','ruleset','name');  
      $crud->set_relation('StructureElementID','structureelements','StructureElementName');    
      $crud->set_relation('Ifc_Structure_Attribute','structureattributes','StructureAttributesName'); 

    ##$state = $crud->getState();
     $crud->unset_add()->unset_delete();
//->unset_list()->unset_delete()
    $crud->set_lang_string('update_success_message',
     ' Data has been successfully Updated into the database.<br/>Please wait while you are redirecting to the list page.
     <script type="text/javascript">
      window.location = "'.site_url('admin/data/ruleinputparameters').'";
     </script>
     <div style="display:none">');


    $this->data['crud_type'] = 'ruleinputparameters';
    $this->data['output'] = $crud->render();
    $this->render('admin/crud_view');
 

}

public function updatefreez(){

    $this->load->helper('url');

    $id = $this->uri->segment($this->uri->total_segments());
    $dd = $this->input->server('QUERY_STRING');
    $formula2beupdated = $this->input->get('fz', TRUE);
     
     //$this->data['somedata']= $data;
    // echo $formula2beupdated.'</br>';
    // echo $id ; http://198.199.69.205/admin/data/ruleinputparameters
    
    $updatedata = array('freezedFormula'=>$formula2beupdated);
    $this->freezrule->update($updatedata,$id);
    $redirectionurl = 'admin/data/ruleinputparameters';
    redirect(base_url().$redirectionurl);
     

}



public function freez()
  {
   
    $this->load->helper('form');
    $this->data['page_title'] = 'Freez the Rule Expression';
    //$crud = new grocery_CRUD();
     $rid = $this->uri->segment($this->uri->total_segments());
    

     if(is_numeric($rid)) 
    {
     

      
      $data = $this->freezrule->get_data($rid);





      $this->data['tabledata'] = $data;
    }





    //$this->data['crud_type'] = 'ruleinputparameters';
   // $this->data['output'] = $crud->render();
   
        $this->load->view("admin/forms/freez_view.php",  $this->data);
 

}



public function ruleinputparameters()
  {
    $this->data['page_title'] = 'Rules Construction';
    //$crud = new grocery_CRUD();
     $crud = new Ajax_grocery_CRUD();
    $crud->set_table('ruleinputparameters');
    $crud->set_subject('Conformance and Compliance  Rules  Construction');
   
       $crud->order_by('StructureElementID','desc'); 
    
        
    //$crud->add_action('OutputParameters', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'demo/action_more','ui-icon-plus');
       
    //$crud->add_action('Thresholds', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'demo/action_smiley');  
    
    $crud->add_action('RuleOperators', '' ,'admin/data/ruleoperator', 'edit_button btn btn-info');  
   $crud->add_action('Constants', '' ,'admin/data/ruleConstant', 'btn btn-warning');
    $crud->add_action('Thresholds', '' ,'admin/data/ruleThresholds', 'add_button btn btn-info');  
   
    $crud->add_action('OutputParameters', '' ,'admin/data/OutputVariable', 'btn btn-success'); 
     
    $crud->add_action('Freez', '' ,'admin/data/freez', 'btn btn-info'); 

   //$crud->set_rules('s_phone_mobile','s_phone_mobile','required|numeric');
    
    // $crud->set_relation('ad_country_id','country','c_name');
    $crud->required_fields('rule','name');

     $crud->columns('StructureElementID',
          'Ifc_Structure_Attribute',
          'ruleset_id',
          'RuleID',
          'IS456_Structure_Attribute_Name',
          'InputsVariableDocumentation',
          'DataType',
          'ApplyOnProjectNameID', 
          'OutputVariable',
          'ruleThresholds',
          'ruleConstant',
          'freezedFormula'
          );

    // $crud->edit_fields('StructureElementID');

      
      $crud->edit_fields('StructureElementID','Ifc_Structure_Attribute','ruleset_id','RuleID','IS456_Structure_Attribute_Name','InputsVariableDocumentation','DataType','ApplyOnProjectNameID');  
         

      $crud->display_as('StructureElementID','Ifc Structure ElementName');
  
      $crud->display_as('InputsVariableDocumentation','Ifc-IS456 Semantic Mapping Documentation');
      $crud->display_as('DataType','Input Variable DataType');
      $crud->display_as('ruleset_id','Which RuleSet');
       $crud->display_as('RuleID','Rule Name');
       $crud->display_as('ApplyOnProjectNameID','ProjectName');
       $crud->display_as('freezedFormula','Freez Final Formula');
      //StructureInputsVariableID
 

      $crud->set_relation('RuleID','rule','name');
       
 


    $crud->set_relation('ApplyOnProjectNameID','projects','ProjectName'); 
    $crud->set_relation('ruleset_id','ruleset','name');  
    //$crud->set_relation('StructureElementID','structureelements','StructureInputsVariableID');    
     $crud->set_relation('StructureElementID','structureelements','StructureElementName');    
     $crud->set_relation('Ifc_Structure_Attribute','structureattributes','StructureAttributesName');  

    
     //StructureAttributeID,StructureElementID
     //Select Structure_Attribute from 
     //this is the specific line that specifies the relation.
    // '1st' is the field (drop down) that depends on the field '2nd' (also drop down).
    // 'third' is the foreign key field on the state table that specifies state's country
      $crud->set_relation_dependency('Ifc_Structure_Attribute','StructureElementID','StructureElementID');
       $crud->set_relation_dependency('RuleID','ruleset_id','ruleset_id');
      // $crud->set_relation_dependency('RuleID','FORMULA','FORMULA');
       //$crud->set_relation_dependency('Ifc_Structure_Attribute','StructureElementID','StructureElementID');
      //$crud->set_relation_dependency('First','Second','Third');
  


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