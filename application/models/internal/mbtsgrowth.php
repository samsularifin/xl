<?php	
class Mbtsgrowth extends CI_Model{
		function getfirstcat($cluster, $level, $fdate, $ldate, $bts_type){
			/*echo $cluster."<br/>";
			echo $level."<br/>";
			echo $fdate."<br/>";
			echo $ldate."<br/>";
			echo $bts_type."<br/>";
			exit;*/
			
			if($bts_type == 'bts_xl'){
				$query = $this->db->query("SELECT DISTINCT $level AS label
				FROM revbts
				WHERE (
				(Substr(period, 3,6)) = '$fdate'
				OR (Substr(period, 3,6)) = '$ldate'
				)
				AND Cluster = '$cluster'
				AND (Bts_Type = '1:1'
				OR Bts_Type = '2G SA'
				OR Bts_Type = '3G SA')
				ORDER BY $level");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($bts_type == 'bts_axis'){
				$query = $this->db->query("SELECT DISTINCT $level AS label
				FROM revbts
				WHERE (
				(Substr(period, 3,6)) = '$fdate'
				OR (Substr(period, 3,6)) = '$ldate'
				)
				AND Cluster = '$cluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				ORDER BY $level");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
				
			}
			
		}
		function showgreatercluster($level){
			$query = $this->db->query("SELECT DISTINCT Cluster 
				FROM `greater` 
				WHERE id_key_greater = '$level' 
				GROUP BY(Cluster)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		
	}
?>