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
	
	public function pagination_pembalap($page)
	{
		$perpage = 10;
		$data = array();
		if($page == 1)
		{
			$mulai = 0;
		}
		else
		{
			$mulai = (($page - 1) * $perpage);
		}
		
		$query = $this->db->select('count(*) as total')
						  ->from('pembalap')
						  ->getOne();
						  
		$data['total_halaman'] 	= ceil($query->total/$perpage);
		$data['mulai']			= $mulai;
		
		
		return $data;
	}
	
	public function insert_pembalap($data)
	{
		$query = $this->db->insert('pembalap', $data);
		
		return $query;
	}
	
	public function detail_pembalap($id)
	{
		$query = $this->db->select('*')
						  ->from('pembalap')
						  ->where('id_pembalap', '=', $id)
						  ->getOne();
						  
		return $query;
	}
	
	public function update_Pembalap($data)
	{
		$query = $this->db->where('id_pembalap', '=', $data['id_pembalap'])
						  ->update('pembalap', $data);
						  
		return $query;
	}
	
	public function delete_pembalap($id)
	{
		$query = $this->db->where('id_pembalap', '=', $id)
						  ->delete('pembalap');
						  
		return $query;
	}
}