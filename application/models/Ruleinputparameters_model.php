<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ruleinputparameters_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'ruleinputparameters';
        $this->primary_key = 'RuleInputsVariableID';
        $this->timestamps = TRUE;
		parent::__construct();
	}



   // public function get_employees(){
   //      $this->db->select('employees.*, regional_office.RegionName as RegionID, designation_type.DesignationName as DesignationID');
   //      $this->db->from('employees');
   //      $this->db->join('projects', 'employees.DesignationID = designation_type.DesignationID');
   //      $this->db->join('regional_office', 'employees.RegionID = regional_office.RegionID');
   //      $this->db->join('regional_office', 'employees.RegionID = regional_office.RegionID');
   //      $this->db->order_by('employees.RegionID');
   //      return $this->db->get()->result();
   //  }


public function get_data($rid){
        $this->db->select('ruleinputparameters.*, projects.ProjectName as ApplyOnProjectNameID, ruleset.name as ruleset_id,structureelements.StructureElementID as StructureElementName,structureattributes.StructureAttributeID as Ifc_Structure_AttributeName');
        $this->db->from('ruleinputparameters');
        $this->db->join('projects', 'ruleinputparameters.ApplyOnProjectNameID = projects.ProjectID');
        $this->db->join('structureelements', 'ruleinputparameters.StructureElementID = structureelements.StructureElementID');
        $this->db->join('structureattributes', 'ruleinputparameters.Ifc_Structure_Attribute = structureattributes.StructureAttributeID');
        $this->db->join('ruleset', 'ruleinputparameters.ruleset_id = ruleset.ruleset_id');
        $this->db->join('rule', 'ruleinputparameters.RuleID = rule.rule_id');
        $this->db->order_by('ruleinputparameters.ApplyOnProjectNameID');

        return $this->db->where('RuleInputsVariableID', $rid)->get()->result();
    }



}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */