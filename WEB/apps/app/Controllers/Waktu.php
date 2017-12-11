<?php
namespace Controllers;
use Resources, Models;

class Waktu extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->db               = new Resources\Database;
        
    }
        
    public function insert_waktu($channel = 1)
    {    
        $data	= array(
	        'channel'		=> $channel,
	        'waktu'			=> microtime(true)
        );
        
        $this->db->insert('catatan_waktu', $data);
    }
    
    
}