<?php	
class Mread extends CI_Model{
	function login_validasi(){
	
		   $this->db->select('username, password, kategori, level, valid, lcluster');
		   $this->db->from('login');
		   
		   $this->db->where('username', $this->input->post('username'));
		   $this->db ->where('password',  md5($this->input->post('password')));
		   $this->db ->where('kategori', 2);
		   $this->db->where('valid', 1);
		   $this->db->limit(1);

			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function level(){
			$this->db->select('*');
		    $this->db->from('level');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function leveleast(){
			$this->db->select('*');
		    $this->db->from('level');
			$this->db->where('value', $this->session->userdata('log_level'));
			$this->db->or_where('ordering > 1');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function levelgreater($val){
			$this->db->select('*');
		    $this->db->from('level');
			$this->db->or_where('ordering >= 2');
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function kab(){
			$this->db->select("Kab");
		    $this->db->from("revbts");
			$this->db->where('Region', $this->session->userdata('log_level'));
			$this->db->or_where('Subregion', $this->session->userdata('log_level'));
			$this->db->group_by("Kab");
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function kec(){
			$this->db->select("Kec");
		    $this->db->from("revbts");
			$this->db->where('Region', $this->session->userdata('log_level'));
			$this->db->or_where('Subregion', $this->session->userdata('log_level'));
			$this->db->group_by("Kec");
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function tower_id(){
			$this->db->select("Tower_ID_adj");
		    $this->db->from("revbts");
			$this->db->where('Region', $this->session->userdata('log_level'));
			$this->db->or_where('Subregion', $this->session->userdata('log_level'));
			$this->db->group_by("Tower_ID_adj");
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function ccluster(){
			$this->db->select("Cluster");
		    $this->db->from("revbts");
			$this->db->where('Region', $this->session->userdata('log_level'));
			$this->db->or_where('Subregion', $this->session->userdata('log_level'));
			$this->db->group_by("Cluster");
			
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function pcluster($c){
			$this->db->select("Cluster");
		    $this->db->from("revbts");
			$this->db->where("Kab = '$c'");
			$this->db->group_by("Cluster");
			
			$query = $this->db->get();
			
			//$query = $this->db->query("SELECT Cluster FROM revbts WHERE Kab = '$c' GROUP BY (Cluster)")
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function pclusterkec($c){
			$this->db->select("Cluster");
		    $this->db->from("revbts");
			$this->db->where("Kec = '$c'");
			$this->db->group_by("Cluster");
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		
		function month(){
			
			$query = $this->db->query("SELECT period
			FROM revbts
			GROUP BY period");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
			
			
		}
		function query_month($bmonth, $byear, $lmonth, $lyear){
			
			$query = $this->db->query("
			SELECT Period
			FROM revbts
			WHERE
			(Substr(period, 3,2)) = '$bmonth'
			AND (Substr(period, 7,2)) = '$byear'
			OR (Substr(period, 3,2)) = '$lmonth'
			AND (Substr(period, 7,2)) = '$lyear'
			GROUP BY(Period)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
			
		}
		function kabkec($kk){
			$this->db->select("Kab");
		    $this->db->from("revbts");
			$this->db->where("Kec = '$kk'");
			$this->db->group_by("Kab");
			
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function kpi_level(){
			$query = $this->db->query("SELECT *
			FROM kpilevel
			WHERE param != 'greater'");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function kpi_leveleast(){
			$query = $this->db->query("SELECT *
			FROM kpilevel
			WHERE ordering > 0
			AND param != 'greater'");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function kpi_levelgreater(){
			$query = $this->db->query("SELECT *
			FROM kpilevel
			WHERE 
			ordering > 1
			or param = 'greater'");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function kpi_data(){
			$query = $this->db->query("SELECT *
			FROM kpicategory");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function showkpiregion(){
			$query = $this->db->query("SELECT DISTINCT (clustercat), val
			FROM nas_cluster
			ORDER BY(clustercat)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function showkpisubregion(){
			$name = $this->session->userdata('log_level');
			
			if($name == 'East'){
				$query = $this->db->query("SELECT *
				FROM subrlevel
				ORDER BY nameast ASC");
			}else{
				$query = $this->db->query("SELECT *
				FROM subrlevel
				WHERE
				nameast = '$name'
				ORDER BY nameast ASC");
			}
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function shownascluster(){
			$cat_cluster = $this->session->userdata('log_cluster');
			
			$query = $this->db->query("SELECT *
			FROM nas_cluster
			WHERE ncluster LIKE '$cat_cluster%'
			GROUP BY(ncluster)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
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
		function showgreaterkab($level){
			$query = $this->db->query("SELECT DISTINCT Kab 
				FROM `greater` 
				WHERE id_key_greater = '$level' 
				GROUP BY(Kab)");
				
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function greaterkec($param){
			$query = $this->db->query("SELECT DISTINCT r.Kec AS Kec, g.Kab AS Kab
			FROM revbts r, greater g
			WHERE
			g.id_key_greater = '$param'
			AND r.Kab = g.Kab");
				
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		
	}
?>