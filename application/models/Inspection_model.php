<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Inspection_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'inspections';
        $this->primary_key = 'id';
        $this->timestamps = TRUE;

        $this->has_one['user'] = array('foreign_model'=>'Users_model','foreign_table'=>'users','foreign_key'=>'id','local_key'=>'seed_producer_id');

		parent::__construct();	
	}

	public function get_employees(){
        $this->db->select('employees.*, regional_office.RegionName as RegionID, designation_type.DesignationName as DesignationID');
        $this->db->from('employees');
        $this->db->join('designation_type', 'employees.DesignationID = designation_type.DesignationID');
        $this->db->join('regional_office', 'employees.RegionID = regional_office.RegionID');
        $this->db->order_by('employees.RegionID');
        return $this->db->get()->result();
    }

	public function get_inspections($id){
        $this->db->select('inspections.*, users.username as seed_producer_id, farmerslist.name as farmer_id, crop_master.CropName as first_inspection_indivisible_crops');
        //$this->db->select('inspections.*, users.username as seed_producer_id');
        $this->db->from('inspections');
        $this->db->where('seed_producer_id', $id);
        $this->db->join('users', 'inspections.seed_producer_id = users.id');
        $this->db->join('farmerslist', 'inspections.farmer_id = farmerslist.id');
        $this->db->join('');
        
        //$this->db->order_by('inspections.farmer_id');
        return $this->db->get()->result();
    }

}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */