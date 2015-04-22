<?php 
	class Mdelete extends CI_Model{
	
		function data_times($checktimes){
			$query = $this->db->query("DELETE From revbts WHERE (Substr(Period, 3,6)) = $checktimes");
			
			if(count($query)>0){
				return true;
			}else{
				return false;
			}
		}
	}
?>