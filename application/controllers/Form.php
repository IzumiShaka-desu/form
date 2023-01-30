<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the followingåß URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{

		$this->load->view('form_view');
	}
	public function submit($index)
	{
		$this->load->model('m_form');

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			//get raw json data from ajax post
			$usedRows = ["Nama PIC", "Shift", "Jam", "Tersedia", "Aktual", "No Wo", "Part number", "ct", "Plan cap", "Actual", "act vs cap", "Jenis", "Proses", "Uraian", "Minute Breakdown", "Reject qty", "Reject jenis"];
			$fixedUsedRows = [];
			// format usedRows to lowercase and replace space with underscore
			foreach ($usedRows as $key => $value) {
				$fixedUsedRows[] = strtolower(str_replace(' ', '_', $value));
			}

			$json = file_get_contents('php://input');
			//decode json data to array
			// $data = json_decode($json, true);

			// get json data from ajax post
			// $data = $this->input->post('data');
			// var_dump($data);
			// decode json data
			// $batchData = json_decode($data);
			// var_dump($batchData);
			// insert data to database
			$data = json_decode($json, true);
			$batchData = [];
			// var_dump($data);
			for ($i = 0; $i < count($data); $i++) {
				$batchData[$i] = [];
				for ($j = 0; $j < count($fixedUsedRows); $j++) {
					$batchData[$i][$fixedUsedRows[$j]] = isset($data[$i][$j]) ? $data[$i][$j] : '';
				}
			}
			$this->m_form->add_multiple($batchData);
			// return success message
			echo 'success';
			// var_dump($data);
			var_dump($data);
		}
	}
}
