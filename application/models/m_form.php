<?php
class M_form extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function add_multiple($batchData)
	{
		//insert multiple data to database using json string

		$this->db->insert_batch('form_data', $batchData);

		// $this->db->insert_batch('document', $data);
		// $this->db->set($data);
		// $this->db->insert_batch('document', $data);
	}
}
