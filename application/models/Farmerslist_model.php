<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Farmerslist_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'farmerslist';
        $this->primary_key = 'id';
        $this->timestamps = TRUE;
		parent::__construct();
	}


}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */