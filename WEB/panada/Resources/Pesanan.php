<?php
namespace Controllers;
use Resources, Models, Libraries;

class Pesanan extends Resources\Controller
{
	public function __construct(){
        
        parent::__construct();
        
        $this->session          = new Resources\Session;
        $this->request          = new Resources\Request;
        $this->mhome      		= new Models\mhome;
        $this->data      		= new Models\mdata;
        $this->pesanan      	= new Models\mpesanan;
        $this->file      		= new Models\mfile;
        $this->db               = new Resources\Database;
        $this->tagihan          = new Resources\Database('tagihan');
        $this->pdf				= Resources\Import::vendor('fpdf/fpdf');
        
        $this->mhome->cek_login_user(array(1,2,4));
    }
        
    public function index()
    {    
        $data	= array(
	        'title'		=> 'Daftar Pesanan',
	        'pesanan'	=> $this->data->get_pesanan('0', NULL, '1')
        );
        
        $this->data->insertLog("Membuka daftar pesanan");
        
        $this->output('pesanan/daftar_pesanan2', $data);
    }
    
    public function daftar_pesanan()
    {
	    //Get page number from Ajax POST
			if(isset($_POST["page"])){
				$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
				if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
			}else{
				$page_number = 1; //if there's no page number, set it to 1
			}
			
			$item_per_page = 20;
			
			//get total number of records from database for pagination
			$get_total_rows = $this->db->getVar("SELECT COUNT('*') FROM pesanan, user, status where pesanan.bayar = '0' and pesanan.id_user = user.id_user AND pesanan.status = status.id_status and pesanan.cekout = '1'");; //hold total records in variable
			//break records into pages
			$total_pages = ceil($get_total_rows/$item_per_page);
			
			//get starting position to fetch the records
			$page_position = (($page_number-1) * $item_per_page);
			
		
			//Limit our results within a specified range. 
			//$results = $mysqli->prepare("SELECT id, name, message FROM paginate ORDER BY id ASC LIMIT $page_position, $item_per_page");
			$query = $this->db->select()->from('pesanan', 'user', 'status')->where('pesanan.bayar', '=', '0', 'AND')->where('pesanan.id_user', '=', 'user.id_user', 'AND')->where('pesanan.status', '=', 'status.id_status', 'AND')->where('pesanan.cekout', '=', '1')->orderBy('pesanan.kode_pesanan', 'DESC')->limit($item_per_page, $page_position)->getAll();
			//$results->execute(); //Execute prepared Query
			//$results->bind_result($id, $name, $message); //bind variables to prepared statement
			
			$data['pesanan'] = $query;
			$data['pagination'] = $this->data->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
			$data['number']		= $page_position;
			
		
			echo '<div align="center">';
			/* We call the pagination function here to generate Pagination link for us. 
			As you can see I have passed several parameters to the function. */
			//echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
			echo '</div>';
			
			$this->data->insertLog("Membuka menu daftar user");
			
			$this->output('pesanan/isi_daftar_pesanan', $data);
    }
    
    public function detail($kode_pesanan)
    {
	    $data	= array(
	        'title'		=> 'Daftar Pesanan',
	        'detail_pesanan'	=> $this->data->get_detail_pesanan($kode_pesanan)
        );
        
        //$data['file'] = $this->data->get_file_legalisasi($data['detail_pesanan']->nim);
        
        $this->data->insertLog("Membuka detail pesanan dengan kode ".$kode_pesanan);
        
        $this->output('pesanan/detail_pesanan', $data);
    }
    
    public function cek_pesanan()
    {
	    $data = $this->tagihan->select('*')
	    					  ->from('tagihan_unnes')
	    					  ->where('kode_periode', '=', 'LEG'.date('Y'), 'AND')
	    					  ->where('paid_flag', '=', '1', 'AND')
	    					  ->where('proses', '=', '0', 'AND')
	    					  ->where('unggah_bni', '=', '1')
	    					  ->getAll();
	    
	    print_r($data);
    }
    
    public function terbayar()
    {
	    $data	= array(
	        'title'		=> 'Daftar Pesanan',
	        'pesanan'	=> $this->data->get_pesanan('1', NULL, '2')
        );
        
        $this->data->insertLog("Membuka menu pesanan terbayar");
        
        $this->output('pesanan/daftar_pesanan', $data);
    }
    
    public function cetaklabel($kode_pesanan)
    {
	    $data	= array(
	        'title'		=> 'Daftar Pesanan',
	        'pesanan'	=> $this->data->get_detail_pesanan($kode_pesanan)
        );
        
        $pesanan = $this->data->get_detail_pesanan($kode_pesanan);
        
        if($pesanan->status < 3)
        {
	        $data_update = array(
		        'kode_pesanan'	=> $kode_pesanan,
		        'status'		=> 3
	        );
	        
	        $this->data->update('pesanan', $data_update, 'kode_pesanan');
        }
        
        $this->data->insertLog("Mencetak label pesanan nomor ".$kode_pesanan);
        
	    $this->output('pesanan/label', $data);
	    
	    
    }
    
    public function batal($kode_pesanan)
    {
	    $data = array(
		    'kode_pesanan'	=> $kode_pesanan,
		    'status'		=> '6'
	    );
	    
	    $this->data->update('pesanan', $data, 'kode_pesanan');
	    
	    $this->data->insertLog("Membatalkan pesanan nomor ".$kode_pesanan);
	    
	    $this->redirect('pesanan/detail/'.$kode_pesanan);
    }
    
    public function terproses()
    {
	    $data	= array(
	        'title'		=> 'Daftar Pesanan',
	        'pesanan'	=> $this->data->get_pesanan('1', NULL, '3')
        );
        
        $this->data->insertLog("Membuka menu pesanan terproses");
        
        $this->output('pesanan/daftar_pesanan', $data);
    }
    
    public function terkirim()
    {
	    $data	= array(
	        'title'		=> 'Daftar Pesanan',
	        'pesanan'	=> $this->data->get_pesanan('1', NULL, '4')
        );
        
        $this->data->insertLog("Membuka menu pesanan terkirim");
        
        $this->output('pesanan/daftar_pesanan', $data);
    }
    
    public function input_resi()
    {
	    $data = array(
		    'resi'		=> $this->request->post('resi'),
		    'status'	=> '4',
		    'kode_pesanan'	=> $this->request->post('kode_pesanan')
	    );
	    
	    $this->data->update('pesanan', $data, 'kode_pesanan');
	    
	    $this->data->insertLog("Menginput resi untuk nomor pesanan ".$data['kode_pesanan']." dengan resi ".$data['resi']);
	    
	    $this->redirect('pesanan/detail/'.$data['kode_pesanan']);
    }
}