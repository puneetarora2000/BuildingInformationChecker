<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'employees';
        $this->primary_key = 'EmployeeNumber';
        $this->has_one['desig'] = 'Designation_model';
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
 

}
/* End of file '/Employees_model.php' */
/* Location: ./application/models//Employees_model.php */