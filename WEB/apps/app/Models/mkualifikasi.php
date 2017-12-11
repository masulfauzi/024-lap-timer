<?php
namespace Models;
use Resources;
use Libraries;

class Mkualifikasi {
    
    public function __construct(){
        
        $this->db               = new Resources\Database;
        $this->session          = new Resources\Session;
        $this->controller       = new Resources\Controller;
    }

	public function get_pembalap_acak()
	{
		$query = $this->db->select('*')
						  ->from('acakan', 'pembalap')
						  ->where('acakan.id_pembalap', '=', 'pembalap.id_pembalap')
						  ->orderBy('acakan.grup')
						  ->orderBy('acakan.channel')
						  ->getAll();
						  
		return $query;
	}
	
	public function acak_pembalap()
	{
		//kosongkan tabel acakan
		if($this->db->query('truncate table acakan'))
		{
			//baca pembalap dari tabel pembalap
			if($pembalap = $this->db->orderBy('rand()')->getAll('pembalap'))
			{
				//masukan pembalap ke tabel acakan secara random dan tambah keterangan kelompok
				$no = 1;
				foreach($pembalap as $row)
				{	
					$data = array(
						'id_pembalap'	=> $row->id_pembalap,
						'grup'			=> ceil($no/4),
						'channel'		=> $this->get_channel($no)
					);
					
					$this->db->insert('acakan', $data);
					$no ++;
				}
			}
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function get_channel($no)
	{
		$urutan = ($no+4)%4;
		
		if($urutan == 1)
		{
			$channel = 1;
		}
		else if($urutan == 2)
		{
			$channel = 3;
		}
		else if($urutan == 3)
		{
			$channel = 6;
		}
		else if($urutan == 0)
		{
			$channel = 8;
		}
		
		return $channel;
	}
	
	public function get_grup_kualifikasi()
	{
		$query = $this->db->select('*')
						  ->from('acakan')
						  ->groupBy('grup')
						  ->getAll();
						  
		return $query;
	}
	
	public function get_pembalap_by_grup($grup)
	{
		$query = $this->db->select('*')
						  ->from('acakan', 'pembalap')
						  ->where('acakan.id_pembalap', '=', 'pembalap.id_pembalap', 'AND')
						  ->where('acakan.grup', '=', $grup)
						  ->orderBy('acakan.channel')
						  ->getAll();
						  
		return $query;
	}
	
	public function get_lap_time($channel)
	{
		$query = $this->db->select('*')
						  ->from('catatan_waktu')
						  ->where('channel', '=', $channel)
						  ->getAll();
						  
		return $query;
	}
	
	public function get_sinyal($channel)
	{
		$query = $this->db->select('*')
						  ->from('sinyal')
						  ->where('channel', '=', $channel)
						  ->getOne();
						  
		return $query;
	}
	
	public function hitung_waktu($waktu_sebelumnya, $waktu_sekarang)
	{
		if($waktu_sebelumnya == 0)
		{
			$waktu = "Waktu";
		}
		else
		{
			$waktu = $waktu_sekarang - $waktu_sebelumnya;
			
			list($sec, $usec) = explode('.', $waktu); //split the microtime on .
			
			$usec = str_replace("0.", ".", $usec);     //remove the leading '0.' from usec 
			
			$waktu = date('i:s', $sec).".".$usec;  
		}
		
		return $waktu;
	}
}