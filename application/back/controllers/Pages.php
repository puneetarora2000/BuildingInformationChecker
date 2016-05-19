<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
       
        
    }

    public function index()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = $this->config->item('site_name').' (PSSCA)';
        $data['view'] = 'pages/home';
        
        $this->load->view('pages/index', $data);
    }
    
    public function about()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "About US";
        $data['view'] = 'pages/about';
        
        $this->load->view("pages/index", $data);
    }
    public function info()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Information";
        $data['view'] = 'pages/info';
        
        $this->load->view("pages/index", $data);
    }
    public function contact()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Contact PSSCA";
        $data['view'] = 'pages/contact';
        
        $this->load->view("pages/index", $data);
    }
     public function area()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Area & Quantity";
        $data['view'] = 'pages/area';
        
        $this->load->view("pages/index", $data);
    }
     public function servicerules()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Service Rules";
        $data['view'] = 'pages/servicerules';

        $query = $this->db->get('service_rules');
        $data['rules'] = $query->result_array();
        
        $this->load->view("pages/index", $data);
    }
     public function guidelines()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Guidelines";
        $data['view'] = 'pages/guidelines';
        
        $this->load->view("pages/index", $data);
    }
     public function fees()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Fees  / Charges";
        $data['view'] = 'pages/fees';
        
        $this->load->view("pages/index", $data);
    }
     public function organisation()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Organisation";
        $data['view'] = 'pages/organisation';
        
        $this->load->view("pages/index", $data);
    }

     public function testinglabs()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "PSSCA Testing Labs";
        $data['view'] = 'pages/testinglabs';
        
        $this->load->view("pages/index", $data);
    }
     public function crops()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Crops List";
        $data['view'] = 'pages/crops';
        
        $this->load->view("pages/index", $data);
    }
    public function achievements()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Achievements of PSSCA";
        $data['view'] = 'pages/achievements';
        
        $this->load->view("pages/index", $data);
    }
    public function activities()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Activites";
        $data['view'] = 'pages/activities';
        
        $this->load->view("pages/index", $data);
    }
    public function tenders()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Tenders";
        $data['view'] = 'pages/tenders';
        
        $this->load->view("pages/index", $data);
    }
    public function downloads()
    {
        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Downloads";
        $data['view'] = 'pages/downloads';
        
        $this->load->view("pages/index", $data);
    }

}

