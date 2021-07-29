<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct () {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function generateID () {
		$query = $this->db->order_by('id_item', 'DESC')->limit(1)->get('wa_tbr_item')->row('id_item');
		$lastNo = substr($query, 1);
		$next = $lastNo + 1;
		$kd = 'I';
		return $kd.sprintf('%04s', $next);
	}

	public function index () {
		$data = array (
			'contentView'	=> 'item_view',
			'generateID'	=> $this->generateID(),
			'getMaster'		=> $this->db->select('id_item, name, qty, price, created_dt, created_by, updated_dt, updated_by, flag_del')
										->where('flag_del', 0)
										->order_by('id_item', 'ASC')
										->get('wa_tbr_item')->result()
		);
		$this->load->view('theme_view', $data);
	}

	public function insert () {
		$data['input'] = array (
			'id_item'		=> $this->input->post('ID_Item'),
			'name'  		=> $this->input->post('Name'),
			'qty'  			=> $this->input->post('Qty'),
			'price'  		=> $this->input->post('Price'),
			'created_dt'    => DATE('Y-m-d H:i:s'),
			'created_by'    => 'by Achmad',
			'flag_del'    	=> 0
		);
		if (empty($this->input->post('Name')) || empty($this->input->post('Qty'))
		|| empty($this->input->post('Price'))) {
			$this->session->set_userdata('announceFlashWarning', 'Can not be empty, please check again!');
			echo $y = 'success';
		} else {
			$this->db->insert('wa_tbr_item', $data['input']);
	
			if($this->db->affected_rows() != 0){
				$this->session->set_userdata('announceFlashSuccess', 'Data has been inserted!');
				echo $y = 'success';
			}else{
				$this->session->set_userdata('announceFlashWarning', 'Data failed inserted!');
				echo $y = 'success';
			}
		}
	}

	public function update () {
		$data['input'] = array (
			'id_item'		=> $this->input->post('ID_Item'),
			'name'  		=> $this->input->post('Name'),
			'qty'  			=> $this->input->post('Qty'),
			'price'  		=> $this->input->post('Price'),
			'updated_dt'    => DATE('Y-m-d H:i:s'),
			'updated_by'    => 'by Achmad',
		);
		if (empty($this->input->post('Name')) || empty($this->input->post('Qty'))
		|| empty($this->input->post('Price'))) {
			$this->session->set_userdata('announceFlashWarning', 'Can not be empty, please check again!');
			echo $y = 'success';
		} else {
			$this->db->where('id_item', $this->input->post('ID_Item'))
					->update('wa_tbr_item', $data['input']);
	
			if($this->db->affected_rows() != 0){
				$this->session->set_userdata('announceFlashSuccess', 'Data has been updated!');
				echo $y = 'success';
			}else{
				$this->session->set_userdata('announceFlashWarning', 'Data failed updated!');
				echo $y = 'success';
			}
		}
	}

	public function edit () {
		$id = $this->input->post('eid');
		$data = array (
			'contentView'	=> 'item_view',
			'generateID'	=> $this->generateID(),
			'getMaster'		=> $this->db->select('id_item, name, qty, price, created_dt, created_by, updated_dt, updated_by, flag_del')
										->where('id_item', $id)
										->where('flag_del', 0)
										->order_by('id_item', 'ASC')
										->get('wa_tbr_item')->row()
		);
		$this->load->view('itemEdit_view', $data);
	}

	public function delete ($id) {
		if (empty($id)) {
			$this->session->set_userdata('announceFlashWarning', 'Can not be empty, please check again!');
			redirect('item');
		} else {
			$this->db->set('flag_del', 1)
					->set('updated_dt', DATE('Y-m-d H:i:s'))
					->set('updated_by', 'achmad')
					->where('id_item', $id)
					->update('wa_tbr_item');

			if($this->db->affected_rows() != 0){
				$this->session->set_userdata('announceFlashSuccess', 'Data has been deleted!');
				redirect('item');
			}else{
				$this->session->set_userdata('announceFlashWarning', 'Data failed deleted!');
				redirect('item');
			}
		}
	}
}
