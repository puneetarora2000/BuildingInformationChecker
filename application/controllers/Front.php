<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
       
        
    }

    public function index()
    {
        /*$data['metad']="";
        $data['metak']="";
        $data['title'] = $this->config->item('site_name').' (PSSCA)';
        $data['view'] = 'front/home';
        
        $this->load->view('front/index', $data);*/

        redirect('/login');
        
    }
    
    public function about()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "About Us";
        $data['view'] = 'front/about';
        
        $this->load->view("front/index", $data);
    }
    public function info()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Information Rule Engine";
        $data['view'] = 'front/info';
        
        $this->load->view("front/index", $data);
    }
    public function contact()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Contact Rule Engine";
        $data['view'] = 'front/contact';
        
        $this->load->view("front/index", $data);
    }
     public function area()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Area & Quantity";
        $data['view'] = 'front/area';
        
        $this->load->view("front/index", $data);
    }
     public function servicerules()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Service Rules";
        $data['view'] = 'front/servicerules';

        $query = $this->db->get('service_rules');
        $data['rules'] = $query->result_array();
        
        $this->load->view("front/index", $data);
    }
     public function guidelines()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Guidelines"; 
        $data['view'] = 'front/guidelines';
        
        $this->load->view("front/index", $data);
    }
   
     public function organisation()
    {
        $this->load->model('employee_model', 'emp');

        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Organisation";
        $data['view'] = 'front/organisation';
        
 //       var_dump($this->emp->get_all());
        //var_dump($this->emp->get_employees());
        
        $data['employees'] =  $this->emp->get_employees();
       /* $data['mohali_employees'] =  $this->emp->where('RegionID', '1')->get_all();
        $data['ludhiana_employees'] =  $this->emp->where('RegionID', '2')->get_all();
        $data['jalandhar_employees'] =  $this->emp->where('RegionID', '3')->get_all();
        $data['kotakpura_employees'] =  $this->emp->where('RegionID', '4')->get_all();*/
        
        $this->load->view("front/index", $data);
    }

     public function testinglabs()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "PSSCA Testing Labs";
        $data['view'] = 'front/testinglabs';
        
        $this->load->view("front/index", $data);
    }
    
    
    public function activities()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Activites";
        $data['view'] = 'front/activities';
        
        $this->load->view("front/index", $data);
    }
    

    public function downloads()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Downloads/Rule Engine";
        $data['view'] = 'front/downloads';
        
        $this->load->view("front/index", $data);
    }
    public function procedure()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Procedure /Rule Engine Guidelines";
        $data['view'] = 'front/procedure';
        
        $this->load->view("front/index", $data);
    }

}

