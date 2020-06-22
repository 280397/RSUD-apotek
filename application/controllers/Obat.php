<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Obat extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    check_not_login();
    check_admin();
    $this->load->model('Obat_model');
    $this->load->model('Satuan_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
    $this->load->library('Excel');
  }

  public function index()
  {
    $data = array(
      'title' => "Master Obat",
      'satuan' => $this->Satuan_model->get_all()

    );

    $this->load->view('obat/obat_data', $data);
  }

  public function json()
  {
    header('Content-Type: application/json');
    echo $this->Obat_model->json();
  }

  public function read($id)
  {
    $row = $this->Obat_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id' => $row->id,
        'kode' => $row->kode,
        'kode_siva' => $row->kode_siva,
        'nama_obat' => $row->nama_obat,
        'generik' => $row->generik,
        'satuan' => $row->satuan,
        'harga' => $row->harga,
        'insert_at' => $row->insert_at,
      );
      $this->load->view('obat/tb_obat_read', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
             Data tidak ditemukan!
            </div>
          </div>');
      redirect(site_url('Obat'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Create',
      'action' => site_url('obat/create_action'),
      'id' => set_value('id'),
      'kode' => set_value('kode'),
      'kode_siva' => set_value('kode_siva'),
      'nama_obat' => set_value('nama_obat'),
      'generik' => set_value('generik'),
      'satuan' => set_value('satuan'),
      'harga' => set_value('harga'),
      'insert_at' => set_value('insert_at'),
    );
    $this->load->view('obat/tb_obat_form', $data);
  }

  public function create_action()
  {
    $this->_rules();
    if ($this->input->post('generik', TRUE) == NULL) {
      $generik = 'Tidak';
    } else {
      $generik = 'Ya';
    }

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $data = array(
        'kode' => $this->input->post('kode', TRUE),
        'kode_siva' => $this->input->post('kode_siva', TRUE),
        'nama_obat' => $this->input->post('nama_obat', TRUE),
        'generik' =>  $generik,
        'satuan' => $this->input->post('satuan', TRUE),
        'harga' => $this->input->post('harga', TRUE),
      );

      $kode = $this->input->post('kode', TRUE);
      if ($this->Obat_model->check_kode($kode)->num_rows() > 0) {
        $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible show fade'>
              <div class='alert-body'>
                <button class='close' data-dismiss='alert'>
                  <span>&times;</span>
                </button>
                Kode $kode sudah dipakai barang lain!
              </div>
            </div>");
        redirect('Obat');
      } else {
        $this->Obat_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
              <div class="alert-body">
                <button class="close" data-dismiss="alert">
                  <span>&times;</span>
                </button>
               Berhasil menambah data!
              </div>
            </div>');
        redirect(site_url('Obat'));
      }
    }
  }

  public function update($id)
  {
    $row = $this->Obat_model->get_by_id($id);
    $o_satuan = $this->Satuan_model->get_all();

    if ($row) {
      $data = array(
        'title' => 'Master obat',
        'page' => 'Update master obat',
        'button' => 'Update',
        'action' => site_url('obat/update_action'),
        'id' => set_value('id', $row->id),
        'kode' => set_value('kode', $row->kode),
        'kode_siva' => set_value('kode_siva', $row->kode_siva),
        'nama_obat' => set_value('nama_obat', $row->nama_obat),
        'generik' => set_value('generik', $row->generik),
        'satuan' => set_value('satuan', $row->satuan),
        'o_satuan' => $o_satuan,
        'harga' => set_value('harga', $row->harga),
        'insert_at' => set_value('insert_at', $row->insert_at),
      );
      $this->load->view('obat/obat_edit', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
             Data tidak ditemukan!
            </div>
          </div>');
      redirect(site_url('Obat'));
    }
  }

  public function update_action()
  {
    $this->_rules();
    if ($this->input->post('generik', TRUE) == NULL) {
      $generik = 'Tidak';
    } else {
      $generik = 'Ya';
    }
    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'kode' => $this->input->post('kode', TRUE),
        'kode_siva' => $this->input->post('kode_siva', TRUE),
        'nama_obat' => $this->input->post('nama_obat', TRUE),
        'generik' => $generik,
        'satuan' => $this->input->post('satuan', TRUE),
        'harga' => $this->input->post('harga', TRUE),
        'insert_at' => $this->input->post('insert_at', TRUE),
      );

      $this->Obat_model->update($this->input->post('id', TRUE), $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil memperbarui data!
            </div>
          </div>');
      redirect(site_url('Obat'));
    }
  }

  public function delete($id)
  {
    $row = $this->Obat_model->get_by_id($id);

    if ($row) {
      $this->Obat_model->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil menghapus data!
            </div>
          </div>');
      redirect(site_url('Obat'));
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Data tidak ditemukan!
            </div>
          </div>');
      redirect(site_url('Obat'));
    }
  }

  public function importExcel()
  {
    $fileName = $_FILES['file']['name'];

    $config['upload_path'] = './assets/'; //path upload
    $config['file_name'] = $fileName;  // nama file
    $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
    $config['max_size'] = 10000; // maksimal sizze

    $this->load->library('upload'); //meload librari upload
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('file')) {
      echo $this->upload->display_errors();
      exit();
    }

    $inputFileName = './assets/' . $fileName;

    try {
      $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel = $objReader->load($inputFileName);
    } catch (Exception $e) {
      die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
      $rowData = $sheet->rangeToArray(
        'A' . $row . ':' . $highestColumn . $row,
        NULL,
        TRUE,
        FALSE
      );


      // Sesuaikan key array dengan nama kolom di database                                                         
      $data = array(
        'kode'        =>    $rowData[0][0],
        'kode_siva'            =>    $rowData[0][1],
        'nama_obat'            =>   $rowData[0][2],
        'generik'            =>   $rowData[0][3],
        'satuan'            =>   $rowData[0][4],
        'harga'            =>    $rowData[0][5],
      );
      // $insert = $this->db->insert("tb_obat", $data);
      $this->Obat_model->insertimport($data);
      $deleteFile = './assets/' . $fileName;
      unlink($deleteFile);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        Berhasil mengimport data!
      </div>
    </div>');
    }
    redirect('Obat');
  }
  public function _rules()
  {
    $this->form_validation->set_rules('kode', 'kode', 'trim|required');
    $this->form_validation->set_rules('kode_siva', 'kode siva', 'trim');
    $this->form_validation->set_rules('nama_obat', 'nama obat', 'trim|required');
    $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
    $this->form_validation->set_rules('harga', 'harga', 'trim|required');
  }
}
