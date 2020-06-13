<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		check_login();
		$data = array(
			'title' => "Login"
		);
		$this->load->view('auth', $data);
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('User_model');
			$query = $this->User_model->login($post);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'id' => $row->id,
					'name' => $row->name,
					'level' => $row->level
				);
				$this->session->set_userdata($params);
				redirect('Stok');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Login failed. <br>Please check Username and Password!</div>');
				redirect('Auth');
			}
		}
	}

	public function logout()
	{
		$params = array('id', 'name', 'level');
		$this->session->unset_userdata($params);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged  out!</div>');
		redirect('Auth');
	}
}
