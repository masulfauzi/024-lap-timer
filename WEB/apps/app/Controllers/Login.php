<?php
namespace Controllers;
use Resources, Models;

class Login extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->mhome      		= new Models\mhome;
        $this->data      		= new Models\mdata;
        $this->mlogin      		= new Models\mlogin;
        $this->db               = new Resources\Database;
    }
        
    public function index()
    {    
        $this->login_page();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
    }
    
    public function login_page()
    {
	    if($this->session->getValue('logged_in') == TRUE)
	    {
		    $this->redirect('dashboard');
	    }
	    
	    $data = $this->data->get_data_post();
		
		if(empty($data['token']))
		{
			$data = array(
			    'title'	=> "Selamat Datang di SiAgung",
			    'token'	=> $this->mhome->generate_token(),
			    'error'	=> $this->session->getValue('error_messages')
		    );
		    
		    $this->session->deleteValue('error_messages');
	    
			$this->output('login/form_login', $data);
		}
		else if($data['token'] != $this->session->getValue('token'))
		{
			$this->session->setValue('error', "Login gagal, silahkan coba lagi.");
			$this->redirect('login');
		}
		else
		{
			$this->mlogin->aksi_login($data['username'], $data['password']);
			
			$this->redirect('dashboard');
			
			
			
		}
    }
    
    
    
    public function logout()
    {
	    $this->session->destroy();
	    $this->redirect('home');
    }
}