<?php
namespace Models;
use Resources;
use Libraries;

class Mpembalap {
    
    public function __construct(){
        
        $this->db               = new Resources\Database;
        $this->session          = new Resources\Session;
        $this->controller       = new Resources\Controller;
    }

	public function get_all_pembalap($page)
	{
		$perpage = 10;
		if($page == 1)
		{
			$mulai = 0;
		}
		else
		{
			$mulai = (($page - 1) * $perpage);
		}
		
		
		$query = $this->db->select('*')
						  ->from('pembalap')
						  ->limit($perpage, $mulai)
						  ->getAll();
						  
		return $query;
	}
	
	public function total_page_pembalap()
	{
		$perpage = 10;
		
		$query = $this->db->select('count(*) as total')
						  ->from('pembalap')
						  ->getOne();
						  
		$total_halaman = ceil($query->total/$perpage);
		
		return $total_halaman;
	}
	
	public function insert_pembalap($data)
	{
		$query = $this->db->insert('pembalap', $data);
		
		return $query;
	}
}