<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Crop_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'crop_master';
        $this->primary_key = 'CropID';
        $this->timestamps = TRUE;
		parent::__construct();
	}
}