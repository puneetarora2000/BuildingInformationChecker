<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
       
        $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));


    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    $this->lang->load('auth');
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
        $this->load->model('employees_model');

        $data['metad']="";
        $data['metak']="";
        $data['title'] = "Organisation";
        $data['view'] = 'pages/organisation';

            
        $organisation =  $this->employees_model->get_all();
        
        $data['employees'] = $organisation;
        
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

    public function register()
      {

           /* if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
            {
                redirect('auth', 'refresh');
            }*/
           /* if($this->ion_auth->logged_in())
            {
              redirect('admin','refresh');
            }*/
            /*$this->load->helper('form');
            $groups = $this->ion_auth->groups()->result();
            //var_dump($groups);
            $group_ids = array();
            foreach ($groups as $group) {
                if(($group->name == $this->input->post('branch')) || ($group->name == 'seedproducer') )
                {
                    array_push($group_ids, $group->id);
                }
            }*/
            //var_dump($group_ids);

            $tables = $this->config->item('tables','ion_auth');
            $identity_column = $this->config->item('identity','ion_auth');
            $this->data['identity_column'] = $identity_column;

            // validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            if($identity_column!=='email')
            {
                $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
            }
            else
            {
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
            }
            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|is_numeric');
            $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

            if ($this->form_validation->run() == true)
            {
                $email    = strtolower($this->input->post('email'));
                $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
                $password = $this->input->post('password');

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'company'    => $this->input->post('company'),
                    'phone'      => $this->input->post('phone'),
                    'branch'     => $this->input->post('branch')
                );
            }
            if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data, $group_ids))
            {
                // check to see if we are creating the user
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("register", 'refresh');
            }
            else
            {
                // display the create user form
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $this->data['first_name'] = array(
                    'name'  => 'first_name',
                    'id'    => 'first_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('first_name'),
                );
                $this->data['last_name'] = array(
                    'name'  => 'last_name',
                    'id'    => 'last_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('last_name'),
                );
                $this->data['identity'] = array(
                    'name'  => 'identity',
                    'id'    => 'identity',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('identity
                    '),
                );
                $this->data['email'] = array(
                    'name'  => 'email',
                    'id'    => 'email',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('email'),
                );
                $this->data['company'] = array(
                    'name'  => 'company',
                    'id'    => 'company',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('company'),
                );
                $this->data['address'] = array(
                    'name'  => 'address',
                    'id'    => 'address',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('address'),
                );
                $this->data['phone'] = array(
                    'name'  => 'phone',
                    'id'    => 'phone',
                    'type'  => 'number',
                    'value' => $this->form_validation->set_value('phone'),
                );
                $this->data['password'] = array(
                    'name'  => 'password',
                    'id'    => 'password',
                    'type'  => 'password',
                    'value' => $this->form_validation->set_value('password'),
                );
                $this->data['password_confirm'] = array(
                    'name'  => 'password_confirm',
                    'id'    => 'password_confirm',
                    'type'  => 'password',
                    'value' => $this->form_validation->set_value('password_confirm'),
                );
                $this->data['branch'] = array(
                    'name'  => 'branch',
                    'id'  => 'branch',
                    'value' => $this->form_validation->set_value('password_confirm'),
                );

                //$this->_render_page('auth/create_user', $this->data);
               // $this->render('pages/register_view','admin_master', $this->data);
                $data['title'] = "Register";
                $data['view'] = 'pages/register';
                $data['fields'] = $this->data;
                
                $data['autocomplete'] = 1;
                
                $this->load->view("pages/index", $data);

            }
       // $this->render('admin/register_view','admin_master');
      }

}

 