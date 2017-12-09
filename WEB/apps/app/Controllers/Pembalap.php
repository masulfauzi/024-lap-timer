<?php
namespace Controllers;
use Resources, Models;

class Pembalap extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->home      		= new Models\mhome;
        $this->db               = new Resources\Database;
        $this->pembalap 		= new Models\mpembalap;
        $this->upload 			= new Resources\Upload;
        
        $this->home->cek_login_user(array(1));
    }
        
    public function index()
    {    
        $this->list_pembalap();
    }
    
    public function list_pembalap($page = 1)
    {
	    $data	= array(
	        'title'				=> 'List Pembalap',
	        'pembalap'			=> $this->pembalap->get_all_pembalap($page),
	        'pagination'		=> $this->pembalap->pagination_pembalap($page),
	        'notification' 		=> $this->session->getValue('notification')
        );
        $this->session->setValue('notification','');
        
        $this->output('pembalap/list_pembalap', $data);
    }
    
    public function tambah_pembalap()
    {
	    $data	= array(
	        'title'		=> 'Tambah Pembalap'
        );
        
        $this->output('pembalap/tambah_pembalap', $data);
    }
    
    public function aksi_tambah_pembalap()
    {
	    $data_post = $this->mhome->get_data_post();
	    
	    $this->upload
                ->setOption(
                    array(
                        'folderLocation'    => 'assets/pembalap',
                        'autoRename'        => true,
                        'setFileName'       => 'pembalap_'.$data_post['nama_pembalap'],
                        'autoCreateFolder'  => true,
                        'permittedFileType' => 'jpg|JPG|png|PNG|jpeg|JPEG',
                        'maximumSize'       => 10000000
                    )
                );
                
        $data['messages']   = '';
        
        if(isset($_FILES['foto']))
        {
            $file   = $this->upload->now($_FILES['foto']);
			
            if($file)
            {
                $files['messages']   = $this->upload->getFileInfo();
                
                $data_post['foto'] = $files['messages']['name'];
                
                if($this->pembalap->insert_pembalap($data_post))
	            {
		            $this->session->setValue('notification', 'Pembalap Berhasil Ditambahkan.');
	            }
	            else
	            {
		            $this->session->setValue('notification', 'Gagal Menambah Pembalap.');
	            }
            }
            else
            {
	            $data['messages']   = $this->upload->getError('message');
                $this->session->setValue('notification', $data['messages']);
            }
            
        }
	    
	    $this->redirect('pembalap/list_pembalap');
    }
    
    public function edit_pembalap($id = 0)
    {
	    if($id == 0)
	    {
		    $this->session->setValue('notification', 'Pilih Pembalap yang akan diedit.');
	    }
	    
	    $data = array(
		    'title'		=> 'Edit Pembalap',
		    'pembalap'	=> $this->pembalap->detail_pembalap($id)
	    );
	    
	    $this->output('pembalap/edit_pembalap', $data);
    }
    
    public function aksi_edit_pembalap()
    {
	    $data_post = $this->home->get_data_post();
	    
	    $this->upload
                ->setOption(
                    array(
                        'folderLocation'    => 'assets/pembalap',
                        'autoRename'        => true,
                        'setFileName'       => 'pembalap_'.$data_post['nama_pembalap'],
                        'autoCreateFolder'  => true,
                        'permittedFileType' => 'jpg|JPG|png|PNG|jpeg|JPEG',
                        'maximumSize'       => 10000000
                    )
                );
                
        $data['messages']   = '';
        
        if(isset($_FILES['foto']))
        {
            $file   = $this->upload->now($_FILES['foto']);
			
            if($file)
            {
                $files['messages']   = $this->upload->getFileInfo();
                
                $data_post['foto'] = $files['messages']['name'];
                   
            }
            
            if($this->pembalap->update_Pembalap($data_post))
            {
	            $this->session->setValue('notification', 'Pembalap Berhasil Diedit.');
            }
            else
            {
	            $this->session->setValue('notification', 'Gagal Mengedit Pembalap.');
            }
            
        }
	    
	    $this->redirect('pembalap/list_pembalap');
    }
    
    public function hapus_pembalap($id = 0)
    {
	    if($id == 0)
	    {
		    $this->session->setValue('notification', 'Pilih salah satu pembalap untuk dihapus.');
		    $this->redirect('pembalap/list_pembalap');
	    }
	    
	    if($this->pembalap->delete_pembalap($id))
	    {
		    $this->session->setValue('notification', 'Pembalap dengan ID '.$id.' berhasil dihapus');
	    }
	    else
	    {
		    $this->session->setValue('notification', 'Gagal menghapus pembalap.');
	    }
	    
	    $this->redirect('pembalap/list_pembalap');
    }
    
}