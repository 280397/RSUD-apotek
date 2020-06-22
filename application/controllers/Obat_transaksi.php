<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obat_transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('Obat_transaksi_model');
        $this->load->model('Distributor_model');
        $this->load->model('Obat_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->library('fungsi');
        $this->load->library('cart');
        $this->load->library('javascript');
    }

    public function index()
    {
        $this->cart->destroy();
        $data = array(
            'title' => "Pembelian",
            'distributor' => $this->Distributor_model->get_all()

        );
        $this->load->view('obat_transaksi/obat_transaksi_data', $data);
        // $this->load->view('obat_transaksi/coba');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Obat_transaksi_model->json();
    }

    public function read($id)
    {
        $row = $this->Obat_transaksi_model->get_by_id($id)->row();
        $detail = $this->Obat_transaksi_model->get_by_id_detail($row->id_obat_transaksi)->result();
        $dist = $this->Obat_transaksi_model->get_dist($row->distributor)->row();
        // var_dump($detail);
        // die;
        if ($row) {
            $data = array(
                'title' => 'Pembelian',
                'page' => 'Pembelian',
                'id' => $row->id,
                'id_distributor' => $row->distributor,
                'distributor' => $dist,
                'no_faktur' => $row->faktur,
                'tanggal' => $row->tgl,
                'nama' => $detail
            );
            // var_dump($data['nama']);
            // die;
            $this->load->view('obat_transaksi/tb_obat_transaksi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Obat_transaksi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Obat_transaksi/create_action'),
            'id' => set_value('id'),
            'id_distributor' => set_value('id_distributor'),
            'no_faktur' => set_value('no_faktur'),
            'tanggal' => set_value('tanggal'),
        );
        $this->load->view('obat_transaksi/tb_obat_transaksi_form', $data);
    }

    public function create_action()
    {
        $this->_rules();


        if ($this->form_validation->run() == FALSE) {
            // $this->create(); 
        } else {

            $id_dist = $this->input->post('id_distributor', TRUE);
            $query = $this->db->query("SELECT * FROM tb_distributor WHERE id = '$id_dist'")->row();

            $data = array(
                'obat' => $this->Obat_model->get_all(),
                'distributor' => $query,
                'id_distributor' => $this->input->post('id_distributor', TRUE),
                'no_faktur' => $this->input->post('no_faktur', TRUE),
                'tanggal' => $this->input->post('tanggal', TRUE),
            );

            $this->load->view('obat_transaksi/tb_obat_transaksi', $data);
        }
    }


    public function insert()
    {
        $id_dist = $this->input->post('id_distributor', TRUE);
        $jumlah = $this->input->post('jumlah', TRUE);
        $exp = $this->input->post('exp', TRUE);
        $query = $this->db->query("SELECT * FROM tb_distributor WHERE id = '$id_dist'")->row();

        $nama_barang['id'] = $this->input->post('nama_barang', TRUE);
        $id = $nama_barang['id'];
        $nama_obat = $this->db->query("SELECT nama_obat FROM tb_obat WHERE id = $id")->row();
        $kode_obat = $this->db->query("SELECT kode FROM tb_obat WHERE id = $id")->row();
        $harga = $this->input->post('harga', TRUE);
        $cek_harga = $this->Obat_transaksi_model->check_harga($kode_obat->kode)->row();

        $data = array(
            'obat'              => $this->Obat_model->get_all(),
            'distributor'       => $query,
            'id_distributor'    => $this->input->post('id_distributor', TRUE),
            'no_faktur'         => $this->input->post('no_faktur', TRUE),
            'tanggal'           => $this->input->post('tanggal', TRUE),
            'id'                => $id,
            'kode_obat'         => $kode_obat->kode,
            'cek_harga'         => $cek_harga->harga,
            'harga'             => $harga,
            'nama_obat'         => $nama_obat->nama_obat,
            'jumlah'            => $jumlah,
            'exp'               => $exp
        );
        if ($cek_harga->harga < $harga) {
            echo "<script>
                     
                    alert('Apakah ingin merubah harga ?')
                        window.action='" .  $this->insertCartUpdate($data) . "';                       
                      
             </script>";
        } else if ($cek_harga > $harga) {
            $this->insertCart($data);
        }
    }

    function insertCart($data)
    {
        $value_cart = $this->cart->contents();
        $status = $this->checkCart($value_cart, $data['kode_obat']);

        $cart = array(
            'rowid' => null,
            'id'      =>  $data['id'],
            'qty'     => $data['jumlah'],
            'price'   => $data['cek_harga'],
            'name'    =>  $data['nama_obat'],
            'exp'   => $data['exp'],
            'kode_obat'   => $data['kode_obat']
        );
        // var_dump($value_cart);
        // die;
        if ($status != null) {
            $cart['rowid'] = $status;

            $this->cart->update($cart);
        } else {
            $this->cart->insert($cart);
        }

        $this->load->view('obat_transaksi/tb_obat_transaksi', $data);
    }
    function insertCartUpdate($data)
    {
        // echo 'berhasil';
        $value_cart = $this->cart->contents();
        $status = $this->checkCart($value_cart, $data['kode_obat']);

        $cart = array(
            'rowid' => null,
            'id'      =>  $data['id'],
            'qty'     => $data['jumlah'],
            'price'   => $data['harga'],
            'name'    =>  $data['nama_obat'],
            'exp'   => $data['exp'],
            'kode_obat'   => $data['kode_obat']
        );
        // var_dump($value_cart);
        // die;
        if ($status != null) {
            $cart['rowid'] = $status;

            $this->cart->update($cart);
        } else {
            $this->cart->insert($cart);
        }

        $this->load->view('obat_transaksi/tb_obat_transaksi', $data);
    }

    public function checkCart($data, $kode)
    {
        foreach ($data as $key) {
            if ($key['kode_obat'] == $kode) {
                return $key['rowid'];
            }
        }

        return null;
    }

    public function create_action_save()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_distributor' => $this->input->post('id_distributor', TRUE),
                'no_faktur' => $this->input->post('no_faktur', TRUE),
                'tanggal' => $this->input->post('tanggal', TRUE),
            );
            $this->Obat_transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Obat_transaksi'));
        }
    }

    public function simpan()
    {
        $user = $this->fungsi->user_login()->id_ruang;

        $datas = array(
            'id_distributor' => $this->input->post('id_distributor', TRUE),
            'no_faktur' => $this->input->post('no_faktur', TRUE),
            'tanggal' => $this->input->post('tanggal', TRUE),
        );


        $id = $this->Obat_transaksi_model->insert($datas);

        $cart = $this->cart->contents();

        $data_arr = array();
        foreach ($cart as $data) {
            $temp = array(
                'id_obat_transaksi' => $id,
                'nama_barang'  => $data['name'],
                'kode_barang' => $data['kode_obat'],
                'exp' => $data['exp'],
                'jumlah' => $data['qty'],
                'harga' => $data['price']
            );
            $data_arr[] = $temp;
        }
        $this->Obat_transaksi_model->insert_detail($data_arr);


        foreach ($cart as $stok) {
            $value = array(
                'kode_barang' => $stok['kode_obat'],
                'stok' => $stok['qty'],
                'harga' => $stok['price'],
                'id_ruang' => $user,
            );
            $this->Obat_transaksi_model->insert_stok($value);
        }

        redirect('Obat_transaksi');
    }

    public function delete($id)
    {
        $row = $this->Obat_transaksi_model->get_by_id($id);

        if ($row) {
            $this->Obat_transaksi_model->delete($id);
            $this->Obat_transaksi_model->delete_detail($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Berhasil menghapus data!
            </div>
          </div>');
            redirect(site_url('Obat_transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Obat_transaksi'));
        }
    }
    public function delete_cart()
    {

        $id_dist = $this->input->post('id_distributor', TRUE);
        $query = $this->db->query("SELECT * FROM tb_distributor WHERE id = '$id_dist'")->row();
        $datas['obat'] = $this->Obat_model->get_all();
        $data = array(
            'id_distributor' => $this->input->post('id_distributor', TRUE),
            'distributor' => $query,
            'no_faktur' => $this->input->post('no_faktur', TRUE),
            'tanggal' => $this->input->post('tanggal', TRUE),
            'obat' => $datas['obat']

        );
        // var_dump($data);
        // die;
        $this->cart->remove($this->input->post('rowid'));
        // redirect(site_url('Obat_transaksi/insertCart', $data));
        $this->load->view('obat_transaksi/tb_obat_transaksi', $data);
    }

    // public function update($id)
    // {
    //     $row = $this->Obat_transaksi_model->get_by_id($id);

    //     if ($row) {
    //         $data = array(
    //             'title' => 'Pembelian',
    //             'page' => 'Pembelian',
    //             'button' => 'Update',
    //             'action' => site_url('Obat_transaksi/update_action'),
    //             'id' => set_value('id', $row->id),
    //             'id_distributor' => set_value('id_distributor', $row->id_distributor),
    //             'no_faktur' => set_value('no_faktur', $row->no_faktur),
    //             'tanggal' => set_value('tanggal', $row->tanggal),
    //         );
    //         $this->load->view('obat_transaksi/tb_obat_transaksi_form', $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('Obat_transaksi'));
    //     }
    // }

    // public function update_action()
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->update($this->input->post('id', TRUE));
    //     } else {
    //         $data = array(
    //             'id_distributor' => $this->input->post('id_distributor', TRUE),
    //             'no_faktur' => $this->input->post('no_faktur', TRUE),
    //             'tanggal' => $this->input->post('tanggal', TRUE),
    //         );

    //         $this->Obat_transaksi_model->update($this->input->post('id', TRUE), $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //         redirect(site_url('Obat_transaksi'));
    //     }
    // }

    public function _rules()
    {
        $this->form_validation->set_rules('id_distributor', 'id distributor', 'trim|required');
        $this->form_validation->set_rules('no_faktur', 'no faktur', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
    }
}

/* End of file Obat_transaksi.php */
/* Location: ./application/controllers/Obat_transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-15 03:57:52 */
/* http://harviacode.com */
