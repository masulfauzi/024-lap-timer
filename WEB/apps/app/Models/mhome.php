<?php
namespace Models;
use Resources;
use Libraries;

class Mhome {
    
    public function __construct(){
        
        $this->db               = new Resources\Database;
        $this->session          = new Resources\Session;
        $this->controller       = new Resources\Controller;
    }

	public function generate_grup_menu()
	{
		//inisialisasi variabel
		$menu_grup = array();
		
		//ambil seluruh data dari tabel grup_menu
		$grup_menu	= $this->db->select()
							   ->from('grup_menu')
							   ->getAll();
							   
		foreach($grup_menu as $grup)
		{
			$array_privileges = explode('+', $grup->privileges);
			
			if(in_array($this->cek_privileges(), $array_privileges))
			{
				array_push($menu_grup, $grup);
			}
		}
		
		return $menu_grup;
	}
	
	public function generate_menu($id = NULL)
	{
		//inisialisasi variabel
		$menu = array();
		
		//ambil data dari tabel menu dengan id_grup_menu tertentu
		$query	= $this->db->select()
						   ->from('menu')
						   ->where('id_grup_menu', '=', $id)
						   ->getAll();
						   
		foreach($query as $menu_list)
		{
			$array_privileges = explode('+', $menu_list->privileges);
			
			if(in_array($this->cek_privileges(), $array_privileges))
			{
				array_push($menu, $menu_list);
			}
		}
		
		return $menu;
	}
	
	function cek_privileges()
	{
		$privileges = $this->session->getValue('id_privileges');
		if($privileges == '')
		{
			$privileges = '0';
		}
		else
		{
			
		}
		
		return $privileges;
	}
	
	public function generate_token()
    {
	    $char = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9");
		$keys = array();
		while(count($keys) <= 10)
		{
			$x = mt_rand(0, count($char)-1);
			if(!in_array($x, $keys)) 
			{
				$keys[] = $x;  
    		}          
		}
		$token = '';
		foreach($keys as $key => $val)
		{
			$token .= $char[$val];  
		}
		$this->session->setValue('token', $token);
		
		return $token;
    }

    public function cek_login_user($data)
    {
	    if($this->session->getValue('logged_in') == true)
	    {
		    if(in_array($this->session->getValue('id_privileges'), $data))
		    {
			    
		    }
		    else
		    {
			    $this->controller->redirect('home');
		    }
	    }
	    else if($this->session->getValue('logged_in') == false)
	    {
		    $this->controller->redirect('login');
	    }
	    else
	    {
		    $this->controller->redirect('login');
	    }
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
}