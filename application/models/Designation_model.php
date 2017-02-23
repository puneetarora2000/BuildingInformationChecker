<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Designation_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'designation_type';
        $this->primary_key = 'DesignationID';
        $this->has_many['employee'] = 'Employee_model';
		parent::__construct();
	}
/*
    public function get_div_value($div) {

        preg_match_all ("/<div.*?>([^`]*?)<\/div>/", $div, $matches);
        //testing the array $matches
        //echo sizeof($matches);
        $val = $matches[1][0];
        return $val;
	}
	*/

}
/* End of file '/Employees_model.php' */
/* Location: ./application/models//Employees_model.php */