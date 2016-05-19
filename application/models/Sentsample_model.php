<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sentsample_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'sentsamples';
        $this->primary_key = 'id';
        $this->timestamps = TRUE;
		parent::__construct();
	}

}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */