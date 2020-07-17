<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Penerimaan_model');
        $this->load->model('Pengiriman_model');
        $this->load->model('Ruang_model');
        $this->load->model('Obat_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->library('cart');
    }

    public function index()
    {
        $this->cart->destroy();
        $user = $this->fungsi->user_login()->id_ruang;
        $query1 = $this->db->query("SELECT tb_ruang.nama_ruang, tb_ruang.id as id_ruang FROM tb_ruang JOIN user ON user.id_ruang = tb_ruang.id WHERE user.id_ruang = tb_ruang.id")->row();
        $ru = $this->db->query("SELECT * FROM tb_ruang WHERE id != $user")->result();

        $data = array(
            'ru' => $query1,
            'title' => "Penerimaan",
            'ruang' => $ru
        );

        $this->load->view('penerimaan/penerimaan_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        $id = $this->fungsi->user_login()->id_ruang;

        echo $this->Penerimaan_model->json($id);
    }

    public function detail($id)
    {
        $row = $this->Penerimaan_model->get_by_id($id);

        $query1 = $this->db->query("SELECT tb_pengiriman.*,r1.nama_ruang as asal, r2.nama_ruang as tujuan
        FROM `tb_pengiriman`
        JOIN tb_ruang as r1 ON r1.id = tb_pengiriman.id_ruang
        join tb_ruang as r2 on r2.id = tb_pengiriman.id_ruang_tujuan")->row();

        $detail = $this->Penerimaan_model->get_by_id_detail($row->id)->result();

        if ($row) {
            $data = array(
                'title' => "Penerimaan",
                'no_spb' => $row->no_spb,
                'ruang' => $query1,
                'ruang_tujuan' => $query1,
                'date' => $row->date,
                'status' => $row->status,
                'penerimaan' => $detail,
                'obat' => $this->Obat_model->get_all()
            );

            $this->load->view('penerimaan/tb_penerimaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Penerimaan'));
        }
    }
    public function terima()
    {
        $id = $this->input->post('id', TRUE);
        $id_pengiriman = $this->input->post('id_pengiriman', TRUE);
        $kode_barang = $this->input->post('kode_barang', TRUE);
        $stok = $this->input->post('stok', TRUE);
        $harga = $this->input->post('harga', TRUE);
        $ruang = $this->Pengiriman_model->get($id_pengiriman)->row();


        $to_model_asal = array(
            'ruang' => $ruang->id_ruang,
            'harga' => $harga,
            'kode_barang' => $kode_barang
        );
        $to_model_tujuan = array(
            'ruang' => $ruang->id_ruang_tujuan,
            'harga' => $harga,
            'kode_barang' => $kode_barang
        );

        $cek = $this->Penerimaan_model->cek_insert_stok($to_model_tujuan)->row();
        // $cek_insert = $this->Penerimaan_model->cek_insert_stok_kode($ruang->id_ruang_tujuan, $kode_barang)->row();

        $isi_stok_asal = $this->Penerimaan_model->cek_insert_stok($to_model_asal)->row();
        $isi_stok_tujuan = $this->Penerimaan_model->cek_insert_stok($to_model_tujuan)->row();

        $data = array(
            'status' => 2,
            'tgl_diterima' => date('Y-m-d')
        );

        $this->db->update('tb_pengiriman_detail', $data, [
            'id'   => $id
        ]);

        $insert_stok = array(
            'kode_barang' => $kode_barang,
            'stok' => $stok,
            'harga' => $harga,
            'id_ruang' => $ruang->id_ruang_tujuan

        );
        $update_stok_asal = array(
            'stok' => $isi_stok_asal->stok - $stok
        );
        $update_stok_tujuan = array(
            'stok' => $isi_stok_tujuan->stok + $stok
        );
        // var_dump($isi_stok_asal);
        // die;
        if ($cek == null) {
            echo "insert";
            $this->Penerimaan_model->insert_stok($insert_stok);
            $this->db->update('tb_stok', $update_stok_asal, [
                'id_ruang'   => $ruang->id_ruang,
                'kode_barang'      => $kode_barang,
                'harga'      => $harga
            ]);
        } elseif ($cek != null) {
            $this->db->update('tb_stok', $update_stok_asal, [
                'id_ruang'   => $ruang->id_ruang,
                'kode_barang'      => $kode_barang,
                'harga'      => $harga
            ]);
            $this->db->update('tb_stok', $update_stok_tujuan, [
                'id_ruang'   => $ruang->id_ruang_tujuan,
                'kode_barang'      => $kode_barang,
                'harga'      => $harga
            ]);
        }
        redirect(site_url('Penerimaan/detail/' . $id_pengiriman));
    }

    public function delete($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);

        if ($row) {
            $this->Pengiriman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Penerimaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Penerimaan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_spb', 'SPB', 'trim|required');
        $this->form_validation->set_rules('id_ruang', 'Ruang', 'trim|required');
        $this->form_validation->set_rules('id_ruang_tujuan', 'id ruang tujuan', 'trim|required');
        $this->form_validation->set_rules('date', 'date', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function print($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);
        $query1 = $this->db->query("SELECT tb_pengiriman.*,r1.nama_ruang as asal, r2.nama_ruang as tujuan
        FROM `tb_pengiriman`
        JOIN tb_ruang as r1 ON r1.id = tb_pengiriman.id_ruang
        join tb_ruang as r2 on r2.id = tb_pengiriman.id_ruang_tujuan")->row();
        // var_dump($row);
        // die;
        $detail = $this->Pengiriman_model->get_by_id_detail($row->id)->result();
        // var_dump($detail);
        // die;
        if ($row) {
            $data = array(
                'title' => "Pengiriman",
                'no_spb' => $row->no_spb,
                'ruang' => $query1,
                'ruang_tujuan' => $query1,
                'date' => $row->date,
                'status' => $row->status,
                'pengiriman' => $detail,
                'obat' => $this->Obat_model->get_all()
            );
            $html = $this->load->view('pengiriman/print', $data, true);
            $this->fungsi->PdfGenerator($html, $data['no_spb'], 'A4', 'landscape');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Pengiriman'));
        }
    }
}
