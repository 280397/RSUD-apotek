<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Distributor extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    check_admin();
    $this->load->model('Distributor_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
  }

  public function index()
  {
    $data = array(
      'title' => "Data distributor"
    );
    $this->load->view('distributor/distributor_data', $data);
  }

  public function json()
  {
    header('Content-Type: application/json');
    echo $this->Distributor_model->json();
  }

  public function read($id)
  {
    $row = $this->Distributor_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id' => $row->id,
        'nama_distributor' => $row->nama_distributor,
        'nama_perusahaan' => $row->nama_perusahaan,
        'alamat' => $row->alamat,
        'telp' => $row->telp,
        'kota' => $row->kota,
        'kode_pos' => $row->kode_pos,
      );
      $this->load->view('distributor/tb_distributor_read', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Data tidak ditemukan!
            </div>
          </div>');
      redirect(site_url('distributor'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Create',
      'action' => site_url('Distributor/create_action'),
      'id' => set_value('id'),
      'nama_distributor' => set_value('nama_distributor'),
      'nama_perusahaan' => set_value('nama_perusahaan'),
      'alamat' => set_value('alamat'),
      'telp' => set_value('telp'),
      'kota' => set_value('kota'),
      'kode_pos' => set_value('kode_pos'),
    );
    $this->load->view('distributor/tb_distributor_form', $data);
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $data = array(
        'nama_distributor' => $this->input->post('nama_distributor', TRUE),
        'nama_perusahaan' => $this->input->post('nama_perusahaan', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'telp' => $this->input->post('telp', TRUE),
        'kota' => $this->input->post('kota', TRUE),
        'kode_pos' => $this->input->post('kode_pos', TRUE),
      );

      $this->Distributor_model->insert($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil menambah data!
            </div>
          </div>');
      redirect(site_url('Distributor'));
    }
  }

  public function update($id)
  {
    $row = $this->Distributor_model->get_by_id($id);

    if ($row) {
      $data = array(

        'title' => 'Distributor',
        'page' => 'Update Distributor',
        'button' => 'Update',
        'action' => site_url('Distributor/update_action'),
        'id' => set_value('id', $row->id),
        'nama_distributor' => set_value('nama_distributor', $row->nama_distributor),
        'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
        'alamat' => set_value('alamat', $row->alamat),
        'telp' => set_value('telp', $row->telp),
        'kota' => set_value('kota', $row->kota),
        'kode_pos' => set_value('kode_pos', $row->kode_pos),
      );
      $this->load->view('distributor/distributor_edit', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Data tidak ditemukan!
            </div>
          </div>');
      redirect(site_url('Distributor'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'nama_distributor' => $this->input->post('nama_distributor', TRUE),
        'nama_perusahaan' => $this->input->post('nama_perusahaan', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'telp' => $this->input->post('telp', TRUE),
        'kota' => $this->input->post('kota', TRUE),
        'kode_pos' => $this->input->post('kode_pos', TRUE),
      );

      $this->Distributor_model->update($this->input->post('id', TRUE), $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil mengubah data!
            </div>
          </div>');
      redirect(site_url('Distributor'));
    }
  }

  public function delete($id)
  {
    $row = $this->Distributor_model->get_by_id($id);

    if ($row) {
      $this->Distributor_model->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil menghapus data!
            </div>
          </div>');
      redirect(site_url('Distributor'));
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Data tidak ditemukan!
            </div>
          </div>');
      redirect(site_url('Distributor'));
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nama_distributor', 'nama distributor', 'trim|required');
    $this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
    $this->form_validation->set_rules('telp', 'telp', 'trim|required');
    $this->form_validation->set_rules('kota', 'kota', 'trim|required');
  }
}

/* End of file distributor.php */
/* Location: ./application/controllers/distributor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-13 06:06:13 */
/* http://harviacode.com */
