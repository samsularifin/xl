<?php	
class Mtrending extends CI_Model{
	function fget_first_step_east($level, $fdate, $ldate){
		$peca =explode(" ", $fdate);
		$fdate2 = $peca[0];
		
		$pecah = explode(" ", $ldate);
		$ldate2 = $pecah[1];
	
		
		$sql = $this->db->query("SELECT Period
		
		FROM revbts
		WHERE
		STR_TO_DATE((Substr(Period, 3,6)),'%m%Y') 
		BETWEEN STR_TO_DATE('$fdate2','%m%Y') 
		AND
		STR_TO_DATE('$ldate2','%m%Y')
		GROUP BY((Substr(Period, 3,6)))
		ORDER BY (STR_TO_DATE((Substr(Period, 3,6)),'%m%Y')) ASC");

		if($sql->num_rows() > 0){
			foreach($sql->result() as $data){
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	function query_east($parameter, $datatype, $period, $btstype){
	
	$per = (Substr($period, 2,6));
	$avg = (Substr($period, 0, -6));
	
		if($datatype == 'AVG'){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other) / $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND Region = '$parameter'
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
				$query = $this->db->query("SELECT 
					Period, SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other) / $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND Region = '$parameter'
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
		/* end*/
		}else{
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND Region = '$parameter'
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
				$query = $this->db->query("SELECT 
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND Region = '$parameter'
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
	}
	function query_east_1($parameter, $datatype, $period, $btstype){
	
		$per = (Substr($period, 2,6));
		$avg = (Substr($period, 0, -6));
		
		if($datatype == 'AVG'){
			if($btstype == 'bts_xl'){	
				$query = $this->db->query("SELECT 
					Period, SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other) / $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
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
					Period, SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other) / $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
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
		}else{
			if($btstype == 'bts_xl'){	
				$query = $this->db->query("SELECT 
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
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
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
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
	}
	function first_step_query($getfdate, $getldate){
		$peca = explode(" ", $getfdate);
		$fdate2 = $peca[0];
		
		$pecah = explode(" ", $getldate);
		$ldate2 = $pecah[1];
		
		$sql = $this->db->query("SELECT Period
		
		FROM revbts
		WHERE
		STR_TO_DATE((Substr(Period, 3,6)),'%m%Y') 
		BETWEEN STR_TO_DATE('$fdate2','%m%Y') 
		AND
		STR_TO_DATE('$ldate2','%m%Y')
		GROUP BY((Substr(Period, 3,6)))
		ORDER BY ((Substr(Period, 3,6))) ASC");

		if($sql->num_rows() > 0){
			foreach($sql->result() as $data){
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	function second_step_cluster($parameter, $datatype, $getperiod, $namec, $btstype){
		$per = (Substr($getperiod, 2,6));
		$avg = (Substr($getperiod, 0, -6));
		
		if($datatype == 'AVG'){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$namec'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$namec'
					AND (bts_type = '1:1 AXIS'
					OR bts_type = '2G SA AXIS')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}
			
		}else{
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$namec'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}else if($btstype == 'bts_axis'){
					$query = $this->db->query("SELECT 
						Period, $datatype( voice ) AS voice, 
						$datatype( sms ) AS sms, 
						$datatype( data ) AS data, 
						$datatype( other ) AS other, 
						$datatype( total ) AS total
						FROM
						revbts
						WHERE (Substr(Period, 3,6)) = '$per'
						AND $parameter = '$namec'
						AND (bts_type = '1:1 AXIS'
						OR bts_type = '2G SA AXIS')
						GROUP BY ($parameter)");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $data){
								$hasil[] = $data;
							}
							return $hasil;
				}
			}
		}
	}
	function second_step_kab($parameter, $datatype, $getperiod, $kab, $pcluster, $btstype){
		$per = (Substr($getperiod, 2,6));
		$avg = (Substr($getperiod, 0, -6));
	
		if($datatype == 'AVG'){
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$kab'
					AND Cluster = '$pcluster'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$kab'
					AND Cluster = '$pcluster'
					AND (bts_type = '1:1 AXIS'
					OR bts_type = '2G SA AXIS')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}
			
		}else{
			if($btstype == 'bts_xl'){
					$query = $this->db->query("SELECT 
						Period, $datatype( voice ) AS voice, 
						$datatype( sms ) AS sms, 
						$datatype( data ) AS data, 
						$datatype( other ) AS other, 
						$datatype( total ) AS total
						FROM
						revbts
						WHERE (Substr(Period, 3,6)) = '$per'
						AND $parameter = '$kab'
						AND Cluster = '$pcluster'
						AND (bts_type = '1:1'
						OR bts_type = '2G SA'
						OR bts_type = '3G SA')
						GROUP BY ($parameter)");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $data){
								$hasil[] = $data;
							}
							return $hasil;
					}
				}else if($btstype == 'bts_axis'){
					$query = $this->db->query("SELECT 
						Period, $datatype( voice ) AS voice, 
						$datatype( sms ) AS sms, 
						$datatype( data ) AS data, 
						$datatype( other ) AS other, 
						$datatype( total ) AS total
						FROM
						revbts
						WHERE (Substr(Period, 3,6)) = '$per'
						AND $parameter = '$kab'
						AND Cluster = '$pcluster'
						AND (bts_type = '1:1 AXIS'
						OR bts_type = '2G SA AXIS')
						GROUP BY ($parameter)");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $data){
								$hasil[] = $data;
							}
							return $hasil;
					}
				}
				
			}
	}
	function second_step_kec($parameter, $datatype, $getperiod, $kec, $kab, $pcluster, $btstype){
		$per = (Substr($getperiod, 2,6));
		$avg = (Substr($getperiod, 0, -6));
	
		if($datatype == 'AVG'){
			if($btstype == 'bts_xl'){	
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$kec'
					AND Kab = '$kab'
					AND Cluster = '$pcluster'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
					}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$kec'
					AND Kab = '$kab'
					AND Cluster = '$pcluster'
					AND (bts_type = '1:1 AXIS'
					OR bts_type = '2G SA AXIS')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
					}
			}
		}else{
			if($btstype == 'bts_xl'){
					$query = $this->db->query("SELECT 
						Period, $datatype( voice ) AS voice, 
						$datatype( sms ) AS sms, 
						$datatype( data ) AS data, 
						$datatype( other ) AS other, 
						$datatype( total ) AS total
						FROM
						revbts
						WHERE (Substr(Period, 3,6)) = '$per'
						AND $parameter = '$kec'
						AND Kab = '$kab'
						AND Cluster = '$pcluster'
						AND (bts_type = '1:1'
						OR bts_type = '2G SA'
						OR bts_type = '3G SA')
						GROUP BY ($parameter)");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $data){
								$hasil[] = $data;
							}
							return $hasil;
					}
				}else if($btstype == 'bts_axis'){
					$query = $this->db->query("SELECT 
						Period, $datatype( voice ) AS voice, 
						$datatype( sms ) AS sms, 
						$datatype( data ) AS data, 
						$datatype( other ) AS other, 
						$datatype( total ) AS total
						FROM
						revbts
						WHERE (Substr(Period, 3,6)) = '$per'
						AND $parameter = '$kec'
						AND Kab = '$kab'
						AND Cluster = '$pcluster'
						AND (bts_type = '1:1 AXIS'
						OR bts_type = '2G SA AXIS')
						GROUP BY ($parameter)");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $data){
								$hasil[] = $data;
							}
							return $hasil;
					}
				}
			}
	}
	function second_step_tower_id($parameter, $datatype, $tower, $getperiod, $btstype){
		$per = (Substr($getperiod, 2,6));
		$avg = (Substr($getperiod, 0, -6));
		
		/*echo $per."<br/>";
		echo $avg."<br/>";
		echo $parameter."<br/>";
		echo $datatype."<br/>";
		echo $tower."<br/>";
		
		exit;*/
	
		if($datatype == 'AVG'){
		
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$tower'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
					return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
					Period, 
					SUM(voice) / $avg AS voice, 
					SUM(sms)/ $avg AS sms, 
					SUM(data)/ $avg AS data, 
					SUM(other)/ $avg AS other, 
					SUM(total) / $avg AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$tower'
					AND (bts_type = '1:1 AXIS'
					OR bts_type = '2G SA AXIS')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
					return $hasil;
				}
			}
		}else{
			if($btstype == 'bts_xl'){
				$query = $this->db->query("SELECT 
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$tower'
					AND (bts_type = '1:1'
					OR bts_type = '2G SA'
					OR bts_type = '3G SA')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}else if($btstype == 'bts_axis'){
				$query = $this->db->query("SELECT 
					Period, $datatype( voice ) AS voice, 
					$datatype( sms ) AS sms, 
					$datatype( data ) AS data, 
					$datatype( other ) AS other, 
					$datatype( total ) AS total
					FROM
					revbts
					WHERE (Substr(Period, 3,6)) = '$per'
					AND $parameter = '$tower'
					AND (bts_type = '1:1 AXIS'
					OR bts_type = '2G SA AXIS')
					GROUP BY ($parameter)");
					
					if($query->num_rows() > 0){
						foreach($query->result() as $data){
							$hasil[] = $data;
						}
						return $hasil;
				}
			}
		}
	}
}