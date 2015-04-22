<?php	
class Mread extends CI_Model{
	function login_validasi(){
	
		   $this->db->select('username, password');
		   $this->db->from('login');
		   
		   $this->db->where('username', $this->input->post('username'));
		   $this->db ->where('password',  md5($this->input->post('password')));
		   $this->db ->where('kategori', 0);
		   $this->db->limit(1);

			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
	}
?>