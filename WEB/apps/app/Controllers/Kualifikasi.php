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
    
}