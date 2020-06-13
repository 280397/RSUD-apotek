<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengiriman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
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
        $ru = $this->db->query("SELECT tb_ruang.nama_ruang, tb_ruang.id as id_ruang FROM tb_ruang JOIN user ON user.id_ruang = tb_ruang.id WHERE $user = tb_ruang.id")->row();
        $ruang = $this->db->query("SELECT * FROM tb_ruang WHERE id != $user")->result();

        $data = array(
            'ru' => $ru,
            'title' => "Pengiriman",
            'ruang' => $ruang
        );
        // var_dump($ru);
        // die;
        $this->load->view('pengiriman/pengiriman_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        $id = $this->fungsi->user_login()->id_ruang;

        echo $this->Pengiriman_model->json($id);
    }

    public function detail($id)
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
            $this->load->view('pengiriman/tb_pengiriman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Pengiriman'));
        }
        // var_dump($data);
        // die;
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Pengiriman/create_action'),
            'id' => set_value('id'),
            'no_spb' => set_value('no_spb'),
            'id_ruang' => set_value('id_ruang'),
            'id_ruang_tujuan' => set_value('id_ruang_tujuan'),
            'date' => set_value('date')
        );
        $this->load->view('pengiriman/tb_pengiriman_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $user = $this->fungsi->user_login()->id_ruang;
            $query1 = $this->db->query("SELECT tb_ruang.nama_ruang, tb_ruang.id as id_ruang FROM tb_ruang JOIN user ON user.id_ruang = tb_ruang.id WHERE $user = tb_ruang.id")->row();
            $id_ruang_tujuan = $this->input->post('id_ruang_tujuan', TRUE);
            $query2 = $this->db->query("SELECT * FROM tb_ruang WHERE id = '$id_ruang_tujuan'")->row();
            // var_dump($query1);
            // die;
            $spb = $this->input->post('no_spb', TRUE);

            if ($this->Pengiriman_model->check_spb($spb)->num_rows() > 0) {
                $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible show fade'>
                <div class='alert-body'>
                  <button class='close' data-dismiss='alert'>
                    <span>&times;</span>
                  </button>
                  SPB $spb sudah dipakai pengiriman lain!
                </div>
              </div>");
                redirect('Pengiriman');
            } else {

                // $this->Pengiriman_model->insert($insert);
            }

            $data = array(
                'obat' => $this->Pengiriman_model->stok($user)->result(),
                'ruang' => $query1,
                'ruang_tujuan' => $query2,
                'no_spb' => $this->input->post('no_spb', TRUE),
                'id_ruang' => $this->input->post('id_ruang', TRUE),
                'id_ruang_tujuan' => $this->input->post('id_ruang_tujuan', TRUE),
                'date' => $this->input->post('date', TRUE)
            );


            // $this->session->set_flashdata('message', 'Create Record Success');
            // redirect(site_url('Pengiriman'));

            $this->load->view('pengiriman/tb_pengiriman_form', $data);
        }
    }
    function insertCart()
    {
        $user = $this->fungsi->user_login()->id_ruang;
        $query1 = $this->db->query("SELECT tb_ruang.nama_ruang, tb_ruang.id as id_ruang FROM tb_ruang JOIN user ON user.id_ruang = tb_ruang.id WHERE $user = tb_ruang.id")->row();
        $id_ruang_tujuan = $this->input->post('id_ruang_tujuan', TRUE);
        $query2 = $this->db->query("SELECT * FROM tb_ruang WHERE id = '$id_ruang_tujuan'")->row();

        $data = array(
            'obat' => $this->Pengiriman_model->stok($user)->result(),
            'ruang' => $query1,
            'ruang_tujuan' => $query2,
            'no_spb' => $this->input->post('no_spb', TRUE),
            'id_ruang' => $this->input->post('id_ruang', TRUE),
            'id_ruang_tujuan' => $this->input->post('id_ruang_tujuan', TRUE),
            'date' => $this->input->post('date', TRUE)
        );


        $nama_barang['id'] = $this->input->post('nama_barang', TRUE);
        $id = $nama_barang['id'];

        $nama_obat = $this->db->query("SELECT o.kode as kode,o.nama_obat as nama FROM tb_stok as s 
        JOIN tb_obat as o ON o.kode = s.kode_barang WHERE s.id = $id")->row();

        $cart = array(
            'id'      =>  $id,
            'qty'     => $this->input->post('jumlah', TRUE),
            'price'   => 0,
            'name'    =>  $nama_obat->nama,
            'kode'    =>  $nama_obat->kode
        );
        $value_cart = $this->cart->contents();
        $status = $this->checkCart($value_cart, $nama_obat);

        if ($status != null) {
            $cart['rowid'] = $status;

            $this->cart->update($cart);
        } else {
            $this->cart->insert($cart);
        }

        $this->load->view('pengiriman/tb_pengiriman_form', $data);
    }
    public function checkCart($data, $nama_obat)
    {
        foreach ($data as $key) {
            if ($key['kode'] == $nama_obat->kode) {
                return $key['rowid'];
            }
        }

        return null;
    }
    public function simpan()
    {
        $datas = array(
            'no_spb' => $this->input->post('no_spb', TRUE),
            'id_ruang' => $this->input->post('id_ruang', TRUE),
            'id_ruang_tujuan' => $this->input->post('id_ruang_tujuan', TRUE),
            'date' => $this->input->post('date', TRUE)
        );

        $id = $this->Pengiriman_model->insert($datas);

        $cart = $this->cart->contents();

        $data_arr = array();
        foreach ($cart as $data) {
            $temp = array(
                'id_pengiriman' => $id,
                'kode_barang'  => $data['kode'],
                'jumlah' => $data['qty'],
                'status'   => 1
            );
            $data_arr[] = $temp;
            $this->Pengiriman_model->update_stok($temp, $datas);
        }
        $this->Pengiriman_model->insert_detail($data_arr);

        redirect('Pengiriman');
    }
    public function delete_cart()
    {
        $user = $this->fungsi->user_login()->id_ruang;
        $query1 = $this->db->query("SELECT tb_ruang.nama_ruang, tb_ruang.id as id_ruang FROM tb_ruang JOIN user ON user.id_ruang = tb_ruang.id WHERE $user = tb_ruang.id")->row();
        $id_ruang_tujuan = $this->input->post('id_ruang_tujuan', TRUE);
        $query2 = $this->db->query("SELECT * FROM tb_ruang WHERE id = '$id_ruang_tujuan'")->row();
        // var_dump($query1);
        // die;
        $spb = $this->input->post('no_spb', TRUE);

        $data = array(
            'obat' => $this->Pengiriman_model->stok($user)->result(),
            'ruang' => $query1,
            'ruang_tujuan' => $query2,
            'no_spb' => $this->input->post('no_spb', TRUE),
            'id_ruang' => $this->input->post('id_ruang', TRUE),
            'id_ruang_tujuan' => $this->input->post('id_ruang_tujuan', TRUE),
            'date' => $this->input->post('date', TRUE)
        );
        // var_dump($data);
        // die;
        $this->cart->remove($this->input->post('rowid'));
        $this->load->view('pengiriman/tb_pengiriman_form', $data);
    }
    public function update($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengiriman/update_action'),
                'id' => set_value('id', $row->id),
                'kode_obat' => set_value('kode_obat', $row->kode_obat),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'id_ruang' => set_value('id_ruang', $row->id_ruang),
                'date' => set_value('date', $row->date),
                'status' => set_value('status', $row->status),
            );
            $this->load->view('pengiriman/tb_pengiriman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengiriman'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_spb' => $this->input->post('no_spb', TRUE),
                'id_ruang' => $this->input->post('id_ruang', TRUE),
                'id_ruang_tujuan' => $this->input->post('id_ruang_tujuan', TRUE),
                'date' => $this->input->post('date', TRUE)
            );

            $this->Pengiriman_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengiriman'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pengiriman_model->get_by_id($id);

        if ($row) {
            $this->Pengiriman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Pengiriman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Pengiriman'));
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
}

/* End of file Pengiriman.php */
/* Location: ./application/controllers/Pengiriman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-25 04:24:36 */
/* http://harviacode.com */
