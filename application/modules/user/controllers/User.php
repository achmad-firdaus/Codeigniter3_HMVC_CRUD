<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct () {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function generateID () {
		$query = $this->db->order_by('id_user', 'DESC')->limit(1)->get('wa_tbr_user')->row('id_user');
		$lastNo = substr($query, 1);
		$next = $lastNo + 1;
		$kd = 'U';
		return $kd.sprintf('%04s', $next);
	}

	public function index () {
		$data = array (
			'contentView'	=> 'user_view',
			'generateID'	=> $this->generateID(),
			'getMaster'		=> $this->db->select('id_user, username, password, last_login, `role`, full_name, gender, telp, address, created_dt, created_by, updated_dt, updated_by, flag_del')
										->where('flag_del', 0)
										->order_by('id_user', 'ASC')
										->get('wa_tbr_user')->result()
		);
		$this->load->view('theme_view', $data);
	}

	public function insert () {
		$data['input'] = array (
			'id_user'		=> $this->input->post('ID_User'),
			'username'  	=> $this->input->post('Username'),
			'password'  	=> password_hash($this->input->post('Username').$this->input->post('ID_User'), PASSWORD_DEFAULT),
			'role'      	=> $this->input->post('Role'),
			'full_name' 	=> $this->input->post('Full_Name'),
			'gender'    	=> $this->input->post('Gender'),
			'telp'      	=> $this->input->post('Telepon'),
			'address'   	=> $this->input->post('Address'),
			'created_dt'    => DATE('Y-m-d H:i:s'),
			'created_by'    => 'by Achmad',
			'flag_del'    	=> 0
		);
		if (empty($this->input->post('Username')) || empty($this->input->post('Role'))
		|| empty($this->input->post('Full_Name')) || empty($this->input->post('Gender'))
		|| empty($this->input->post('Telepon')) || empty($this->input->post('Address'))) {
			$this->session->set_userdata('announceFlashWarning', 'Can not be empty, please check again!');
			echo $y = 'success';
		} else {
			$this->db->insert('wa_tbr_user', $data['input']);
	
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
			'username'  	=> $this->input->post('Username'),
			'role'      	=> $this->input->post('Role'),
			'full_name' 	=> $this->input->post('Full_Name'),
			'gender'    	=> $this->input->post('Gender'),
			'telp'      	=> $this->input->post('Telepon'),
			'address'   	=> $this->input->post('Address'),
			'updated_dt'    => DATE('Y-m-d H:i:s'),
			'updated_by'    => 'by Achmad',
		);
		if (empty($this->input->post('Username')) || empty($this->input->post('Role'))
		|| empty($this->input->post('Full_Name')) || empty($this->input->post('Gender'))
		|| empty($this->input->post('Telepon')) || empty($this->input->post('Address'))) {
			$this->session->set_userdata('announceFlashWarning', 'Can not be empty, please check again!');
			echo $y = 'success';
		} else {
			$this->db->where('id_user', $this->input->post('ID_User'))
					->update('wa_tbr_user', $data['input']);
	
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
			'contentView'	=> 'user_view',
			'generateID'	=> $this->generateID(),
			'getMaster'		=> $this->db->select('id_user, username, password, last_login, `role`, full_name, gender, telp, address, created_dt, created_by, updated_dt, updated_by, flag_del')
										->where('id_user', $id)
										->where('flag_del', 0)
										->order_by('id_user', 'ASC')
										->get('wa_tbr_user')->row()
		);
		$this->load->view('userEdit_view', $data);
	}

	public function delete ($id) {
		if (empty($id)) {
			$this->session->set_userdata('announceFlashWarning', 'Can not be empty, please check again!');
			redirect('user');
		} else {
			$this->db->set('flag_del', 1)
					->set('updated_dt', DATE('Y-m-d H:i:s'))
					->set('updated_by', 'achmad')
					->where('id_user', $id)
					->update('wa_tbr_user');

			if($this->db->affected_rows() != 0){
				$this->session->set_userdata('announceFlashSuccess', 'Data has been deleted!');
				redirect('user');
			}else{
				$this->session->set_userdata('announceFlashWarning', 'Data failed deleted!');
				redirect('user');
			}
		}
	}
}
