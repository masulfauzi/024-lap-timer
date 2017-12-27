<?php
namespace Controllers;
use Resources, Models;

class Kualifikasi extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->home      		= new Models\mhome;
        $this->db               = new Resources\Database;
        $this->kualifikasi 		= new Models\mkualifikasi;
        
        $this->home->cek_login_user(array(1));
    }
        
    public function index()
    {    
        $this->acak_pembalap();
    }
    
    public function acak_pembalap()
    {
	    $data	= array(
	        'title'			=> 'Acak Pembalap',
	        'pembalap'		=> $this->kualifikasi->get_pembalap_acak(),
	        'notification'	=> $this->session->getValue('notification')
        );
        $this->session->setValue('notification', '');
        
        $this->output('kualifikasi/acak_pembalap', $data);
    }
    
    public function aksi_acak_pembalap()
    {
	    if($this->kualifikasi->acak_pembalap())
	    {
		    $this->session->setValue('notification', 'Pembalap sukses diacak.');
	    }
	    else
	    {
		    $this->session->setValue('notification', 'Gagal mengacak pembalap.');
	    }
	    
	    $this->redirect('kualifikasi/acak_pembalap');
    }
    
    public function cetak_acakan()
    {
	    $data	= array(
	        'pembalap'		=> $this->kualifikasi->get_pembalap_acak()
        );
        
        $this->output('kualifikasi/cetak_acakan', $data);
    }
    
    public function run_kualifikasi()
    {
	    $data	= array(
	        'title'			=> 'Daftar Grup Kualifikasi',
	        'grup'			=> $this->kualifikasi->get_grup_kualifikasi(),
	        'notification'	=> $this->session->getValue('notification')
        );
        $this->session->setValue('notification', '');
        
        $this->output('kualifikasi/daftar_grup', $data);
    }
    
    public function detail_grup_kualifikasi($grup = 0)
    {
	    if($grup == 0)
	    {
		    $this->session->setValue('notification', 'Pilih salah satu grup untuk memulai kualifikasi.');
		    $this->redirect('kualifikasi/run_kualifikasi');
	    }
	    
	    $data	= array(
	        'title'			=> 'Detail Grup Kualifikasi',
	        'pembalap'		=> $this->kualifikasi->get_pembalap_by_grup($grup)
        );
        
        $this->output('kualifikasi/detail_grup', $data);
    }
    
    public function get_waktu($channel = 1)
    {
	    $data	= array(
	        'waktu'			=> $this->kualifikasi->get_lap_time($channel)
        );
        
        $this->output('kualifikasi/catatan_waktu', $data);
    }
    
    public function get_sinyal($channel = 1)
    {
	    $data	= array(
	        'sinyal'			=> $this->kualifikasi->get_sinyal($channel)
        );
        
        $this->output('kualifikasi/get_sinyal', $data);
    }
    
    public function start_race()
    {
	    $this->db->query("truncate table catatan_waktu");
	    $this->db->query("truncate table waktu_mulai");
	    
	    $data = array(
		    'waktu_mulai'		=> microtime(true)
	    );
	    
	    $this->db->insert('waktu_mulai', $data);
	    
    }
    
    public function simpan_hasil_kualifikasi($grup_kualifikasi)
    {
	    $data = array();
	    
	    $pembalap = $this->db->select('*')
	    					 ->from('grup_kualifikasi')
	    					 ->where('grup', '=', $grup_kualifikasi)
	    					 ->getAll();
	    					 
	    foreach ($pembalap as $row)
	    {
		    $query = $this->db->select('min(catatan_waktu.lap) as waktu')
		    				  ->from('catatan_waktu')
		    				  ->where('catatan_waktu.channel', '=', $row->channel)
		    				  ->getOne();
		    
		    if($query->waktu)
		    {
			    $waktu = $query->waktu;
		    }
		    else
		    {
			    $waktu = "9999999999";
		    }
		    				  
		    $data = array(
			    'waktu'			=> $waktu,
			    'id_pembalap'	=> $row->id_pembalap,
			    'grup'			=> $row->grup
		    );
		    
		    $this->db->insert('hasil_kualifikasi', $data);
	    }
	    	    
    }
    
    public function cetak_hasil_kualifikasi_grup($grup)
    {
	    $data = array(
		    'hasil'		=> $this->kualifikasi->get_hasil_kualifikasi_grup($grup),
		    'grup'		=> $grup
	    );
	    
	    $this->output('kualifikasi/cetak_hasil_kualifikasi_grup', $data);
    }
    
    public function hasil_kualifikasi()
    {
	    $data	= array(
	        'title'				=> 'Acak Pembalap',
	        'hasil_kualifikasi'	=> $this->kualifikasi->hasil_kualifikasi(),
	        'notification'		=> $this->session->getValue('notification')
        );
        $this->session->setValue('notification', '');
        
        $this->output('kualifikasi/hasil_kualifikasi', $data);
    }
    
    public function cetak_hasil_kualifikasi()
    {
	    $data = array(
		    'hasil'		=> $this->kualifikasi->get_hasil_kualifikasi()
	    );
	    
	    $this->output('kualifikasi/cetak_hasil_kualifikasi', $data);
    }
}