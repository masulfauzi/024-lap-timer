<?php
namespace Controllers;
use Resources, Models;

class Login extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->home      		= new Models\mhome;
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
		    $this->redirect('home');
	    }
	    
	    $data = $this->home->get_data_post();
		
		if(empty($data['token']))
		{
			$data = array(
			    'title'	=> "Selamat Datang di SiAgung",
			    'token'	=> $this->home->generate_token(),
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
			
			$this->redirect('home');
			
			
			
		}
    }
    
    
    
    public function logout()
    {
	    $this->session->destroy();
	    $this->redirect('home');
    }
}