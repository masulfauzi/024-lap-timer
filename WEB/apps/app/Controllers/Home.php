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
        $this->data      		= new Models\mdata;
        $this->db               = new Resources\Database;
        $this->gallery 			= new Models\mgallery;
        
        //$this->mhome->cek_login_user(array(1, 2, 3));
    }
        
    public function index()
    {    
        $data	= array(
	        'title'		=> 'Hello word!',
	        'berita'	=> $this->mhome->get_berita(),
	        'peraturan'	=> $this->data->get_data_all('peraturan'),
	        'slide'		=> $this->gallery->get_slide()
        );
        
        $this->output('front/landing_page', $data);
    }
    
    
}