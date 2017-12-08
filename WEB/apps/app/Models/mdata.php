<?php
namespace Models;
use Resources;
use Libraries;

class Mdata {
    
    public function __construct(){
        
        $this->db               = new Resources\Database;
        $this->session          = new Resources\Session;
        $this->controller       = new Resources\Controller;
    }

	//ambil semua data dari satu tabel
	public function get_data_all($tabel)
	{
		$query	= $this->db->getAll($tabel);
		return $query;
	}

    //ambil data dari satu tabel dengan value tertentu banyak
    public function get_data_where($tabel, $kolom, $id)
    {
	    $query	= $this->db->select()
	    				   ->from($tabel)
	    				   ->where($kolom, '=', $id)
	    				   ->getAll();
	    return $query;
    }
    
    //ambil data dari satu tabel dengan value tertentu tunggal
    public function get_detail($tabel, $kolom, $id)
    {
	    $query	= $this->db->select()
	    				   ->from($tabel)
	    				   ->where($kolom, '=', $id)
	    				   ->getOne();
	    return $query;
    }
    
    public function get_data_post()
    {
	    unset($data);
	    $data = array();
	    
	    foreach ($_POST as $key => $value)
	    {
			$data[htmlspecialchars($key)] = $value;
	    }
		
		return $data;
    }
    
    public function insert_data($tabel, $data)
    {
	    $this->db->insert($tabel, $data);
    }
    
    public function get_detail_pesanan($kode_pesanan)
    {
	    $query = $this->db->select('*')
	    				  ->from('pesanan', 'user', 'kecamatan', 'kabupaten', 'provinsi')
	    				  ->where('pesanan.kode_pesanan', '=', $kode_pesanan, 'AND')
	    				  ->where('pesanan.id_user', '=', 'user.id_user', 'AND')
	    				  ->where('user.id_kecamatan', '=', 'kecamatan.id_kecamatan', 'AND')
	    				  ->where('user.id_kabupaten', '=', 'kabupaten.id_kabupaten', 'AND')
	    				  ->where('user.id_provinsi', '=', 'provinsi.id_provinsi')
	    				  ->getOne();
	    				  
	    return $query;
    }
    
    public function get_pesanan($id_user)
    {
	    $query = $this->db->select('*')
	    				  ->from('pesanan', 'user')
	    				  ->where('pesanan.id_user', '=', $id_user, 'AND')
	    				  ->where('pesanan.id_user', '=', 'user.id_user')
	    				  ->getAll();
	    return $query;
    }
    
    public function edit_data($data, $tabel, $id)
    {
        $query = $this->db->where($id, '=', $data[$id])
                    	  ->update($tabel, $data);
        
        return TRUE;
        
    }
    
    
    
    public function check_selected($data1, $data2)
    {
	    if($data1 == $data2)
	    {
		    $selected = "selected";
	    }
	    else
	    {
		    $selected = "";
	    }
	    
	    return $selected;
    }
    
    public function get_setting()
    {
	    $data = array();
	    
	    $query = $this->db->select('*')
	    				  ->from('setting')
	    				  ->getAll();
	    				  
	    foreach($query as $row)
	    {
		    $data[$row->setting] = $row->value;
	    }
	    
	    return $data;
    }
    
}