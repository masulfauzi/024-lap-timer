<?php
namespace Libraries;
use Resources;

class Fungsi {
    
    public function __construct(){
        
    }
    
    public function jenis_file($id_jenis=NULL)
    {
	    if($id_jenis == '1')
	    {
		    $jenis_file = 'Ijazah';
	    }
	    else if($id_jenis == '2')
	    {
		    $jenis_file = 'Transkrip Nilai';
	    }
	    else if($id_jenis == '3')
	    {
		    $jenis_file = 'Akta Mengajar';
	    }
	    else
	    {
		    $jenis_file = 'Error. Jenis file tidak diketahui.';
	    }
	    
	    return $jenis_file;
    }
    
    public function tanggal($date)
    {
	    $pecah = explode('-', $date);
	    
	    if($pecah[1] == '01')
	    {
		    $bulan = 'Januari';
	    }
	    else if($pecah[1] == '02')
	    {
		    $bulan = 'Februari';
	    }
	    else if($pecah[1] == '03')
	    {
		    $bulan = 'Maret';
	    }
	    else if($pecah[1] == '04')
	    {
		    $bulan = 'April';
	    }
	    else if($pecah[1] == '05')
	    {
		    $bulan = 'Mei';
	    }
	    else if($pecah[1] == '06')
	    {
		    $bulan = 'Juni';
	    }
	    else if($pecah[1] == '07')
	    {
		    $bulan = 'Juli';
	    }
	    else if($pecah[1] == '08')
	    {
		    $bulan = 'Agustus';
	    }
	    else if($pecah[1] == '09')
	    {
		    $bulan = 'September';
	    }
	    else if($pecah[1] == '10')
	    {
		    $bulan = 'Oktober';
	    }
	    else if($pecah[1] == '11')
	    {
		    $bulan = 'November';
	    }
	    else if($pecah[1] == '12')
	    {
		    $bulan = 'Desember';
	    }
	    
	    return $pecah[2]." ".$bulan." ".$pecah[0];
    }
}
