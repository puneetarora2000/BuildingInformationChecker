<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Resultregister_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'resultregister';
        $this->primary_key = 'id';
        $this->timestamps = TRUE;
		parent::__construct();
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

	public function get_report_data($where_in, $where){
		$this->db->select('resultregister.*,
						CONCAT(users.first_name, " ", users.last_name) as SeedProducerID,
						farmerslist.name as FarmerID,
						crop_master.CropName as CropID,
                        crop_variety.VarietyName as CropVariety,
                        classes_of_seed.ClassName as SeedClass,
                        seed_laboratory.LabName as Laboratory,
                        regional_office.RegionName as SeedCertificationAuthority
                        ')
			->group_start()
			->from('resultregister')
			->where_in('FarmerID', $where_in)
			->where($where)
			->group_end()

			->join('users', 'resultregister.SeedProducerID = users.id')
			->join('farmerslist', 'resultregister.FarmerID = farmerslist.id')
			->join('crop_master', 'resultregister.CropID = crop_master.CropID')
            ->join('crop_variety', 'resultregister.CropVariety = crop_variety.VarietyID')
            ->join('classes_of_seed', 'resultregister.SeedClass = classes_of_seed.ClassID')
            ->join('seed_laboratory', 'resultregister.Laboratory = seed_laboratory.LabID')
            ->join('regional_office', 'resultregister.SeedCertificationAuthority = regional_office.RegionID')
			;

		return $this->db->get()->result();
	}

}
/* End of file '/Performaa_model.php' */
/* Location: ./application/models//Performaa_model.php */