<?php
namespace Controllers;
use Resources, Models;

class Home extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->mhome      		= new Models\mhome;
        $this->db               = new Resources\Database;
        
        $this->mhome->cek_login_user(array(1));
    }
        
    public function index()
    {    
        $data	= array(
	        'title'		=> '024 Lap Timer'
        );
        
        $this->output('home/index', $data);
    }
    
    
}