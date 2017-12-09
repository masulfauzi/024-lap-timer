<?php
namespace Models;
use Resources;
use Libraries;

class Mlogin {
    
    public function __construct(){
        
        $this->db               = new Resources\Database;
        $this->session          = new Resources\Session;
        $this->controller       = new Resources\Controller;
    }

	public function aksi_login($username = NULL, $password = NULL)
	{
		$query = $this->db->select()
						  ->from('user', 'privileges')
						  ->where('username', '=', $username, 'AND')
						  ->where('password', '=', md5($username.$password), 'AND')
						  ->where('privileges.id_privileges', '=', 'user.id_privileges')
						  ->getOne();
		if($query)
		{
			$data_session = array(
				'logged_in'			=> true,
				'username'			=> $username,
				'id_user'			=> $query->id_user,
				'privileges'		=> $query->privileges,
				'id_privileges'		=> $query->id_privileges,
				'kamuflase'			=> $this->get_kamuflase($username),
				'kode_identitas'	=> $query->kode_identitas
			);
		}
		else
		{
			$query2 = $this->db->select()
							  ->from('user', 'privileges')
							  ->where('username', '=', $username, 'AND')
							  ->where('privileges.id_privileges', '=', 'user.id_privileges')
							  ->getOne();
			if($query2)
			{
				$token = $this->gen_token();
		        $cek_code = 'akreditasi';
		        
		        //$url = 'http://192.168.108.77/engine2/index.php/output/cek_account/'.md5($username).'/'.md5($password).'/'.$cek_code.'/'.$token.'.aspx';
		        //$url = 'http://untuksemua.unnes.ac.id/output/cek_account/'.md5($username).'/'.md5($password).'/'.$cek_code.'/'.$token.'.aspx';
		        $url = 'http://services.unnes.ac.id/engine2/output/cek_account/'.md5($username).'/'.md5($password).'/'.$cek_code.'/'.$token.'.aspx';
		        $data = json_decode(file_get_contents($url), true);
		        
		        $res = $data['res'];
		        $ket = $data['ket'];
		        
		        if ($res == 'TRUE'){
		            $pecah = explode("-", $ket);
		            $kodeidentitas = $pecah[1];
		            $status = $pecah[0];
		            
		            if($status == 'mhs'){
		                $data_session = array(
		                	'logged_in'			=> false,
		                	'username'			=> $username,
		                	'error_messages'	=> "Anda tidak berhak mengakses laman ini!"
		                );
		            }else{
		                $data_session = array(
							'logged_in'			=> true,
							'username'			=> $username,
							'privileges'		=> $query2->privileges,
							'id_privileges'		=> $query2->id_privileges,
							'kamuflase'			=> $this->get_kamuflase($username),
							'kode_identitas'	=> $kodeidentitas
						);
		            }
		        }elseif($res == 'FALSE'){
		            $data_session = array(
		            	'logged_in'			=>false, 
		            	'error_messages'	=>'Username atau Password Salah. Perhatikan besar kecilnya huruf!'
		            );
	        	}else{
	            	$data_session = array(
	            		'logged_in'			=>false, 
	            		'error_messages'	=>'Komunikasi server gagal'
	            	);
	        	}
			}
			else
			{
				$data_session = array(
                	'logged_in'			=> false,
                	'username'			=> $username,
                	'error_messages'	=> "Anda tidak terdaftar di database!"
                );
			}
		}
		
		$this->session->setValue($data_session);
	}
	
	public function get_kamuflase($username)
	{
		$data = $this->db->select()
						 ->from('user')
						 ->where('username', '=', $username)
						 ->getOne();
						 
						 
		return $data->kamuflase;
	}
	
	function awal0($str, $len = 2)
	{
        if(strlen($str)<$len)
        {
            $str = strrev($str);
            $str .= '000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
            $str = substr($str,0,$len);
            $str = strrev($str);
        }
		else
        {}
		return $str;
    }

    function gen_token()
    {
        $timestamp = time();
        $cek = substr($timestamp,0,1)+substr($timestamp,strlen($timestamp)-1,1);
        $key = $this->awal0($cek,5);
        return strrev($timestamp.$key);
    }
    
    public function get_unit_by_identitas($kodeidentitas)
    {
	    $query = $this->db->select('*')
	    				  ->from('unit_kerja', 'user')
	    				  ->where('user.kode_identitas', '=', $kodeidentitas, 'AND')
	    				  ->where('user.id_unit_kerja', '=', 'unit_kerja.id_unit_kerja')
	    				  ->getOne();
	    				  
	    return $query->unit_kerja;
    }
}