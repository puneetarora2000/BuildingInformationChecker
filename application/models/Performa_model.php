<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Performa_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'performa';
        $this->primary_key = 'id';
		parent::__construct();
	}

    public function get_div_value($div) {

        preg_match_all ("/<div.*?>([^`]*?)<\/div>/", $div, $matches);
        //testing the array $matches
        //echo sizeof($matches);
        $val = $matches[1][0];
        return $val;
	}
	
    public function get_performa($id){
        $this->db->select('performa.*, regional_office.RegionName as RegionID,
                        CONCAT(year.StartYear, "-", year.EndYear) as YearID,
                        season_type.SeasonName as SeasonID,
                        CONCAT(users.first_name, " ", users.last_name) as SeedProducerID,
                        breeder_seed_provider.ProviderName as BreederProviderID,
                        foundation_seed_provider.FoundationProviderName as FoundationProviderID,
                        crop_master.CropName as CropID,
                        crop_variety.VarietyName as VarietyID,
                        classes_of_seed.ClassName as ClassID
                        ')
            ->from('performa')
            ->join('regional_office', 'performa.RegionID = regional_office.RegionID')
            ->join('year', 'performa.YearID = year.YearID')
            ->join('season_type', 'performa.SeasonID = season_type.SeasonID')
            ->join('users', 'performa.SeedProducerID = users.id')
            ->join('breeder_seed_provider', 'performa.BreederProviderID = breeder_seed_provider.BreederProviderID', 'left')
            ->join('foundation_seed_provider', 'performa.FoundationProviderID = foundation_seed_provider.FoundationProviderID', 'left')
            ->join('crop_master', 'performa.CropID = crop_master.CropID')
            ->join('crop_variety', 'performa.VarietyID = crop_variety.VarietyID')
            ->join('classes_of_seed', 'performa.ClassID = classes_of_seed.ClassID')
            ->where('performa.id', $id);

        return $this->db->get()->result()[0];
    }

    public function check_receipt_generated($id)
    {
        return $this->db->select('ReceiptGenerated')
                        ->from('performa')
                        ->where('id', $id)
                        ->get()
                        ->result()[0];
    }
}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */