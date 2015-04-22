<?php	
class Mread extends CI_Model{
	function login_validasi(){
	
		   $this->db->select('username, password');
		   $this->db->from('login');
		   
		   $this->db->where('username', $this->input->post('username'));
		   $this->db ->where('password',  md5($this->input->post('password')));
		   $this->db ->where('kategori', 1);
		   $this->db->limit(1);

			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
	function fieldrev(){
		$fields = $this->db->list_fields('revbts');
		foreach ($fields as $field)
		{
		  $hasil[] = $field;
		} 
		return $hasil;
	}
	function datarev(){
		$this->db->select('*');
		$this->db->from('revbts');
		$this->db->limit(100);
		
		$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function data_times($checktimes){
			$query = $this->db->query("SELECT * 
			FROM revbts
			WHERE (Substr(Period, 3,6)) = '032015'");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function submitupload(){
			echo $filename=$_FILES["file"]["tmp_name"];
		
			$file = fopen($filename, "r");
				$count = 0;                                        
				while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE)
				{
					$count++;                                      

					if($count>1){                                 
					  $sql = $this->db->query("INSERT into revbts(id_revbts,period, Tower_ID_adj, Cluster, Kab, Kec, Bts_Type, cvs, Voice, SMS, Data, Other, Total) 
					  values ('','310114','$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]','$emapData[9]','$emapData[10]')");
					 
					 if($sql){
						$this->session->set_flashdata('scupload', 'Upload success');
					 }else{
						$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
					 }
					}                                              
				}
		}
		function baca_data_kpi($period, $type, $kpiname){
			
			if($kpiname == 'cp'){
				$query = $this->db->query("SELECT pperiod, pcluster, voice_pkg, sms_pkg, mass_oth
				FROM clstrpkt_kpi
				WHERE ptype = '$type'
				AND pperiod = '$period'");
			
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($kpiname == 'cu'){
				
			}
		}
		function baca_sum_data_kpi($period, $type, $kpiname){
			if($kpiname == 'cp'){
				$query = $this->db->query("SELECT SUM(voice_pkg) AS totvoice, SUM(sms_pkg) AS totsms, SUM(mass_oth) AS totmass
				FROM clstrpkt_kpi
				WHERE ptype = '$type'
				AND pperiod = '$period'");
			
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
	
	}
	
?>