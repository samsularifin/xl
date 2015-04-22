<?php	
class Mcompare extends CI_Model{
		function first_step_east(){
			$this->db->select('Region');
			$this->db->from('revbts');
			$this->db->group_by('Region');
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
			
		}
		function first_step_east1($parameter){
			$this->db->select('Subregion');
			$this->db->from('revbts');
			$this->db->where('Subregion', $parameter);
			$this->db->group_by('Subregion');
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function query_east($parameter, $datatype, $fdate, $btstype){
		
			$peca = explode(" ", $fdate);
			$fdate2 = $peca[0];
		
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate2'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Region)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
			else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate2'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Region)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
			
		}
		function query_east2($parameter, $datatype, $ldate, $btstype){
		
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Region)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Region)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_first_east($parameter, $datatype, $fdate, $btstype){
			$pecah = explode(" ", $fdate);
			$fdate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period,
				Bts_Type
					FROM
					revbts
					WHERE (Substr(period, 3,6)) = '$fdate'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					AND Region = 'East'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				AND Region = 'East'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_second_east($parameter, $datatype, $ldate, $btstype){
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
					FROM
					revbts
					WHERE (Substr(period, 3,6)) = '$ldate2'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					AND Region = 'East'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period,
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				AND Region = 'East'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_first_east1($parameter, $datatype, $fdate, $btstype){
			$pecah = explode(" ", $fdate);
			$fdate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period,
				Bts_Type
					FROM
					revbts
					WHERE (Substr(period, 3,6)) = '$fdate'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					AND Subregion = '$parameter'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				AND Subregion = '$parameter'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_second_east1($parameter, $datatype, $ldate, $btstype){
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
					FROM
					revbts
					WHERE (Substr(period, 3,6)) = '$ldate2'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					AND Subregion = '$parameter'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period,
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				AND Subregion = '$parameter'");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_east_1_1($parameter, $datatype, $fdate, $btstype){
			$peca = explode(" ", $fdate);
			$fdate2 = $peca[0];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate2'
				AND Subregion = '$parameter'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Subregion)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate2'
				AND Subregion = '$parameter'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Subregion)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
			
		}
		function query_east_1_2($parameter, $datatype, $ldate, $btstype){
			$peca = explode(" ", $ldate);
			$ldate2 = $peca[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND Subregion = '$parameter'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Subregion)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND Subregion = '$parameter'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Subregion)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function first_step_cluster($parameter, $namec){
			$this->db->select('Cluster');
			$this->db->from('revbts');
			$this->db->where("Cluster = '$namec'");
			$this->db->group_by('Cluster');
			$query = $this->db->get();
			
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function query_cluster_1($namec, $datatype, $fdate, $btstype){
			
			if($btstype == 'bts_xl'){
			
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate'
				AND Cluster = '$namec'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate'
				AND Cluster = '$namec'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
			
		}
		function query_cluster_2($namec, $datatype, $ldate, $btstype){
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Cluster = '$namec'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Cluster = '$namec'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_first_cluster($namec, $datatype, $fdate, $btstype){
			if($btstype == 'bts_xl'){
			
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = '$fdate'
				AND Cluster = '$namec'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				
				$query = $this->db->query("SELECT period,
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$fdate'
				AND Cluster = '$namec'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_second_cluster($namec, $datatype, $ldate, $btstype){
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
			
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND Cluster = '$namec'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				
				$query = $this->db->query("SELECT period,
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND Cluster = '$namec'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_first_kabupaten($kab, $datatype, $fdate, $pcluster, $btstype){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period,
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_second_kabupaten($kab, $datatype, $ldate, $pcluster, $btstype){
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = $ldate2
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period,
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate2
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function first_step_kab($paramter, $kab, $cluster){
			$query = $this->db->query("SELECT $paramter
			FROM revbts
			WHERE
			Kab = '$kab'
			AND Cluster = '$cluster'
			GROUP BY ($paramter)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function query_kab_1($kab, $datatype, $fdate, $pcluster, $btstype){
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_kab_2($kab, $datatype, $ldate, $pcluster, $btstype){
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		
		
		//kecamatan
		function query_pie_first_kecamatan($kec, $kab, $datatype, $fdate, $pcluster, $btstype){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_second_kecamatan($kec, $kab, $datatype, $ldate, $pcluster, $btstype){
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = '$ldate2'
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function first_step_kec($paramter, $kec, $kab, $cluster){
			$query = $this->db->query("SELECT $paramter
			FROM revbts
			WHERE
			$paramter = '$kec'
			AND Cluster = '$cluster'
			AND Kab = '$kab'
			GROUP BY ($paramter)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function query_kec_1($kec, $kab, $datatype, $fdate, $pcluster, $btstype){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_kec_2($kec, $kab, $datatype, $ldate, $pcluster, $btstype){
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT Period,
				SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Kec = '$kec'
				AND Kab = '$kab'
				AND Cluster = '$pcluster'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Cluster)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function query_pie_first_tower_id($parameter, $datatype, $fdate, $btstype){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts	
				WHERE (Substr(period, 3,6)) = $fdate
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
					$query = $this->db->query("SELECT period, 
					Bts_Type
					FROM
					revbts	
					WHERE (Substr(period, 3,6)) = $fdate
					AND Tower_ID_adj = '$parameter'
					AND (bts_type = '1:1 AXIS'
					OR bts_type = '2G SA AXIS')");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
					}	
				}
			
		}
		function query_pie_second_tower_id($parameter, $datatype, $ldate, $btstype){
			$pecah = explode(" ", $ldate);
			$ldate2 = $pecah[1];
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate2
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT period, 
				Bts_Type
				FROM
				revbts
				WHERE (Substr(period, 3,6)) =$ldate2
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
		function first_tower_id($parameter){
			$query = $this->db->query("SELECT Tower_ID_adj
			FROM revbts
			WHERE
			Tower_ID_adj = '$parameter'
			GROUP BY (Tower_ID_adj)");
			
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
		function tower_id_1($parameter, $datatype, $fdate, $btstype){
		
		if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Tower_ID_adj)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
		}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $fdate
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Tower_ID_adj)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}	
			}
		}
		function tower_id_2($parameter, $datatype, $ldate, $btstype){
			
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1'
				OR bts_type = '2G SA'
				OR bts_type = '3G SA')
				GROUP BY (Tower_ID_adj)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
				Period, SUM( voice ) AS voice, 
				SUM( sms ) AS sms, 
				SUM( data ) AS data, 
				SUM( other ) AS other, 
				SUM( total ) AS total
				FROM
				revbts
				WHERE (Substr(period, 3,6)) = $ldate
				AND Tower_ID_adj = '$parameter'
				AND (bts_type = '1:1 AXIS'
				OR bts_type = '2G SA AXIS')
				GROUP BY (Tower_ID_adj)");
				
				if($query->num_rows() > 0){
					foreach($query->result() as $data){
						$hasil[] = $data;
					}
					return $hasil;
				}
			}
		}
}