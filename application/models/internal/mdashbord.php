<?php	
class Mdashbord extends CI_Model{
	function fget_first_step_region(){
		
		$sql = $this->db->query("SELECT pperiod
			FROM clstrpkt_kpi p, clstrusage_kpi u
			WHERE
			STR_TO_DATE((Substr(p.pperiod, 3,6)),'%m%Y') 
			BETWEEN STR_TO_DATE('012015','%m%Y') 
			AND
			STR_TO_DATE('032015','%m%Y')
			AND
			STR_TO_DATE((Substr(u.uperiod, 3,6)),'%m%Y') 
			BETWEEN STR_TO_DATE('012015','%m%Y') 
			AND
			STR_TO_DATE('032015','%m%Y')
			GROUP BY((Substr(p.pperiod, 3,6)))
			ORDER BY (STR_TO_DATE((Substr(pperiod, 3,6)),'%m%Y')) ASC");
		
		
		if($sql->num_rows() > 0){
			foreach($sql->result() as $data){
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	function query_region($param, $period){
	$level = $this->session->userdata('log_level');
		
		if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
			$lcluster = $this->session->userdata('log_cluster');
		}else{
			$lcluster = urldecode($param);
		}
	
	$per = (Substr($period, 2,6));
	$avg = (Substr($period, 0, -6));
	
		$query = $this->db->query("
		SELECT 
		SUM(p.voice_pkg + u.uvoice_usg) AS svoice, 
		SUM(p.sms_pkg + u.usms_usg) AS ssms,			 
		SUM((m.swp_blackberry+m.swp_blackberry151+m.swp_internet+m.swp_internet151+m.swp_cyborg+m.swp_garuda+m.swp_premiumrush+m.swp_smarthphone+m.swp_xlbebas+m.swp_xtraon) + u.ugprs) AS sdata,
		SUM(p.mass_oth + m.swp_mass151) AS sother,
		SUM((p.voice_pkg + u.uvoice_usg)+(p.sms_pkg + u.usms_usg)+((m.swp_blackberry+m.swp_blackberry151+m.swp_internet+m.swp_internet151+m.swp_cyborg+m.swp_garuda+m.swp_premiumrush+m.swp_smarthphone+m.swp_xlbebas+m.swp_xtraon) + u.ugprs)
		+(p.mass_oth + m.swp_mass151)) AS stotal,
		SUM(m.swp_blackberry + swp_internet) AS s123,
		SUM(m.swp_internet151 + m.swp_blackberry151) AS s151,
		SUM(u.ugprs) AS spayu,
		p.pperiod
		FROM
		clstrpkt_kpi p, clstrusage_kpi u, mdsrev_kpi m
		WHERE (Substr(p.pperiod, 3,6)) = '$per'
		AND (Substr(u.uperiod, 3,6)) = '$per'
		AND (Substr(m.speriod, 3,6)) = '$per'
		AND u.ucluster LIKE '$lcluster%'
		AND p.pcluster LIKE '$lcluster%'
		AND m.rowlabels LIKE '$lcluster%'
		AND u.ucluster = p.pcluster
		AND u.ucluster = m.rowlabels
		AND u.utype = 'KPI_XL'
		AND p.ptype = 'KPI_XL'
		AND m.swp_type = 'KPI_XL'
		");
				
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
		
		/* end*/
	
	}
	function query_region_second($param, $period){
		$per = (Substr($period, 2,6));
		$avg = (Substr($period, 0, -6));
		
		$level = $this->session->userdata('log_level');
		
		if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
			$lcluster = $this->session->userdata('log_cluster');
		}else{
			$lcluster = urldecode($param);
		}
	
		$query = $this->db->query("
			SELECT 
			SUM(p.voice_pkg + u.uvoice_usg) AS svoice, 
			SUM(p.sms_pkg + u.usms_usg) AS ssms,			 
			SUM((m.swp_blackberry+m.swp_blackberry151+m.swp_internet+m.swp_internet151+m.swp_cyborg+m.swp_garuda+m.swp_premiumrush+m.swp_smarthphone+m.swp_xlbebas+m.swp_xtraon) + u.ugprs) AS sdata,
			SUM(p.mass_oth + m.swp_mass151) AS sother,
			SUM((p.voice_pkg + u.uvoice_usg)+(p.sms_pkg + u.usms_usg)+((m.swp_blackberry+m.swp_blackberry151+m.swp_internet+m.swp_internet151+m.swp_cyborg+m.swp_garuda+m.swp_premiumrush+m.swp_smarthphone+m.swp_xlbebas+m.swp_xtraon) + u.ugprs)
			+(p.mass_oth + m.swp_mass151)) AS stotal,
			SUM(m.swp_blackberry + swp_internet) AS s123,
			SUM(m.swp_internet151 + m.swp_blackberry151) AS s151,
			SUM(u.ugprs) AS spayu,
			p.pperiod
			FROM
			clstrpkt_kpi p, clstrusage_kpi u, mdsrev_kpi m
			WHERE (Substr(p.pperiod, 3,6)) = '$per'
			AND (Substr(u.uperiod, 3,6)) = '$per'
			AND (Substr(m.speriod, 3,6)) = '$per'
			AND u.ucluster LIKE '$lcluster%'
			AND p.pcluster LIKE '$lcluster%'
			AND m.rowlabels LIKE '$lcluster%'
			AND u.ucluster = p.pcluster
			AND u.ucluster = m.rowlabels
			AND u.utype = 'KPI_AXIS'
			AND p.ptype = 'KPI_AXIS'
			AND m.swp_type = 'KPI_AXIS'
			");
				
			if($query->num_rows() > 0){
				foreach($query->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
	}
	
}