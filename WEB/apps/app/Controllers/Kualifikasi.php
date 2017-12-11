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
	    
	    $waktu = microtime(true);
	    
	    $data1 = array(
		    'waktu'		=> $waktu,
		    'channel'	=> 1
	    );
	    $data2 = array(
		    'waktu'		=> $waktu,
		    'channel'	=> 3
	    );
	    $data3 = array(
		    'waktu'		=> $waktu,
		    'channel'	=> 6
	    );
	    $data4 = array(
		    'waktu'		=> $waktu,
		    'channel'	=> 8
	    );
	    
	    $this->db->insert('catatan_waktu', $data1);
	    $this->db->insert('catatan_waktu', $data2);
	    $this->db->insert('catatan_waktu', $data3);
	    $this->db->insert('catatan_waktu', $data4);
	    
    }
    
}