<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadexcel extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			
            $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
			$this->load->model('admin/mread');	
			$this->load->model('admin/minsert');
			$this->load->model('admin/mdelete');
	}
	function index()
	{
		$data['page'] = "admin/uploadexcel";
		$data['datarev'] = $this->mread->datarev();
		$data['fielddatarev'] = $this->mread->fieldrev();
		$this->load->view('admin/container', $data);
	}
	function submit(){
		$periode = $this->input->post('periode');
		
		$ambil = explode("-",$periode);
			
		$date= $ambil[0];
		$month = $ambil[1];
		$year = $ambil[2];
		
		$times = $date."".$month."".$year;
		$checktimes = $month."".$year;
		
		$sql = $this->mread->data_times($checktimes);
		
		if(count($sql) > 0){
			$del = $this->mdelete->data_times($checktimes);
				/*
			if($del == true){
				echo "deleted";
				exit;
			}else{
				echo "Not deleted";
				exit;
			}*/
		}
		
		$fileName = time().$_FILES['file']['name'];
		
		$config['upload_path'] = './assets/excelupload/';
		$config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size']        = 10000;
		
		$this->load->library('upload');
        $this->upload->initialize($config);
		
		if(! $this->upload->do_upload('file') )
            $this->upload->display_errors();
			
		$media = $this->upload->data('file');
        $inputFileName = './assets/excelupload/'.$media['file_name'];
		
		try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
			
		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
             $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
				if($rowData[0][7] == NULL){
					$rowData[0][7] = 0;
				}else if($rowData[0][0] == NULL){
					$rowData[0][0] = 0;
				}				
				
				/*if($rowData[0][0] == NULL){
					$rowData[0][0] = 0;
				}
				if($rowData[0][1] == NULL){
					$rowData[0][1] = 0;
				}
				if($rowData[0][2] == NULL){
					$rowData[0][2] = 0;
				}
				if($rowData[0][3] == NULL){
					$rowData[0][3] = 0;
				}
				if($rowData[0][4] == NULL){
					$rowData[0][4] = 0;
				}
				if($rowData[0][5] == NULL){
					$rowData[0][5] = 0;
				}
				if($rowData[0][6] == NULL){
					$rowData[0][6] = 0;
				}
				if($rowData[0][7] == NULL){
					$rowData[0][7] = 0;
				}
				if($rowData[0][8] == NULL){
					$rowData[0][8] = 0;
				}
				if($rowData[0][9] == NULL){
					$rowData[0][9] = 0;
				}*/
                //  Insert row data array into your database of choice here
                $data = array(
                            "period"=> $times,
                            "Tower_ID_adj"=> $rowData[0][0],
							"Region"=> $rowData[0][1],
							"Subregion"=> $rowData[0][2],
                            "Cluster"=> $rowData[0][3],
                            "Kab"=> $rowData[0][4],
                            "Kec"=> $rowData[0][5],
                            "Bts_Type"=> $rowData[0][6],
                            "cvs" => $rowData[0][7],
                            "Voice" => $rowData[0][8],
							"SMS"=> $rowData[0][9],
                            "Data" => $rowData[0][10],
							"Other" => $rowData[0][11],
							"Total" => $rowData[0][12]
                        );
 
                $insert = $this->db->insert("revbts",$data);
				delete_files($media['file_path']);
				if($insert){
					$this->session->set_flashdata('scupload', 'File successfully uploaded');
				}else{
					$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
				}
            }
		redirect('admin/uploadexcel/');
	}
	function logout(){
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('is_logged_in');
			$this->session->unset_userdata('tipe');
			redirect('admin/login'); 
	}
	function is_logged_in(){
			$is_logged_in = $this->session->userdata('is_logged_in');
			$tipe = $this->session->userdata('tipe');
			
			if(!isset($is_logged_in) || $is_logged_in != true || $tipe != "admin"){
				$this->session->set_flashdata('msg', 'Access denied! You don\'t have permission to access this page or session has expired. Please use login form!');
				redirect('admin/login');	
			}
	}
}