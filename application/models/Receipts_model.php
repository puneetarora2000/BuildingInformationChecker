<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Receipts_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'receipts';
        $this->primary_key = 'id';
        $this->timestamps = TRUE;
		parent::__construct();
	}

   /* public function get_div_value($div) {

        preg_match_all ("/<div.*?>([^`]*?)<\/div>/", $div, $matches);
        //testing the array $matches
        //echo sizeof($matches);
        $val = $matches[1][0];
        return $val;
	}*/
    /*public function get_field($where, $field)
    {
        $data =  $this->db->select($field)
                        ->from('receipts')
                        ->where('id', $where)
                        ->get()
                        ->result();
        if(isset($data[0])):
            return $data[0]->$field;
        else:
            return;
        endif;
    }*/
    public function get_field($table, $where_name, $where_value, $field)
    {
        $data =  $this->db->select($field)
                        ->from($table)
                        ->where($where_name, $where_value)
                        ->get()
                        ->result();
        if(isset($data[0])):
            return $data[0]->$field;
        else:
            return;
        endif;
    }
    
    public function get_fields($table, $field)
    {
        $data =  $this->db->select('*')
                        ->from($table)
                        ->where($field, '1')
                        ->get()
                        ->result();
        return $data;
    }
	

}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */