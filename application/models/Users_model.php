<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'users';
        $this->primary_key = 'id';
        //$this->has_one['details'] = 'User_details_model';
        // $this->has_one['details'] = array('User_details_model','user_id','id');
		parent::__construct();
	}


}
/* End of file '/User_model.php' */
/* Location: ./application/models//User_model.php */