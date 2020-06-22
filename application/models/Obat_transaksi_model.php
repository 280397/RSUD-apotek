<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obat_transaksi_model extends CI_Model
{

    public $table = 'tb_obat_transaksi';
    public $table_detail = 'tb_obat_transaksi_detail';
    public $table_stok = 'tb_stok';
    public $id_transaksi = 'id_transaksi';
    public $id = 'id';
    public $id_obat_transaksi = 'id_obat_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('o.id,o.id_distributor,o.no_faktur,o.tanggal, d.nama_perusahaan as id_distributor, COUNT(z.id_obat_transaksi) as item');
        $this->datatables->from('tb_obat_transaksi as o');
        //add this line for join
        $this->datatables->join('tb_distributor as d', 'o.id_distributor = d.id');
        $this->datatables->join('tb_obat_transaksi_detail as z', 'o.id = z.id_obat_transaksi');
        $this->datatables->group_by('o.id');
        $this->datatables->add_column('action', anchor(site_url('Obat_transaksi/read/$1'), '<div class="badge badge-warning">Detail</div>') .  anchor(site_url('Obat_transaksi/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id_detail($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_obat_transaksi_detail');
        $this->db->join('tb_obat_transaksi', 'tb_obat_transaksi.id = tb_obat_transaksi_detail.id_obat_transaksi');
        $this->db->where('tb_obat_transaksi_detail.id_obat_transaksi', $id);
        $query = $this->db->get();
        // var_dump($query);
        // die;
        return $query;
    }
    function get_by_id($id)
    {
        $this->db->select('tb_obat_transaksi_detail.*,tb_obat_transaksi.id_distributor as distributor, tb_obat_transaksi.no_faktur as faktur, tb_obat_transaksi.tanggal as tgl');
        $this->db->from('tb_obat_transaksi_detail');
        $this->db->join('tb_obat_transaksi', 'tb_obat_transaksi.id = tb_obat_transaksi_detail.id_obat_transaksi');
        $this->db->where('tb_obat_transaksi_detail.id_obat_transaksi', $id);
        $query = $this->db->get();
        // var_dump($query);
        // die;
        return $query;
    }
    public function get_dist($id = null)
    {
        $this->db->from('tb_distributor');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('id_distributor', $q);
        $this->db->or_like('no_faktur', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('id_distributor', $q);
        $this->db->or_like('no_faktur', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return  $this->db->insert_id();
    }
    function insert_detail($data)
    {
        $this->db->insert_batch($this->table_detail, $data);
    }
    function insert_stok($data)
    {
        $kode_barang = $data['kode_barang'];
        $id_ruang = $data['id_ruang'];
        $kodeb = $this->db->query("SELECT * FROM tb_stok WHERE kode_barang = " . "'$kode_barang'")->row()->kode_barang;

        $stok_awal = $this->db->query("SELECT stok FROM tb_stok WHERE kode_barang = " . "'$kode_barang'" . " AND id_ruang =" . " '$id_ruang'")->row()->stok;
        $stok_input = $data['stok'];
        $harga_awal = $this->db->query("SELECT harga FROM tb_stok WHERE kode_barang = " . "'$kode_barang'" . " AND id_ruang =" . " '$id_ruang'")->row()->harga;
        $harga_input = $data['harga'];
        // var_dump($harga_input);
        // die;
        if ($kodeb != null) {
            if ($harga_awal == $harga_input) {
                $jumlah = $stok_awal + $stok_input;

                $this->db->set('stok', $jumlah);
                $this->db->where('kode_barang', $kode_barang);
                $this->db->where('id_ruang', $id_ruang);
                $this->db->where('harga', $harga_input);
                $this->db->update($this->table_stok);
            } else {
                $this->db->insert($this->table_stok, $data);
                # code...
            }
        } else {
            $this->db->insert($this->table_stok, $data);
        }
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function delete_detail($id)
    {
        $this->db->where($this->id_obat_transaksi, $id);
        $this->db->delete($this->table_detail);
    }

    function cek_stok_update($kode)
    {
        $this->db->from('tb_stok');
        $this->db->where('kode_barang', $kode);

        $query = $this->db->get();
        return $query;
    }
    function check_harga($code)
    {
        $this->db->select('harga');
        $this->db->from('tb_obat');
        $this->db->where('kode', $code);

        $query = $this->db->get();
        return $query;
    }
}

/* End of file Obat_transaksi_model.php */
/* Location: ./application/models/Obat_transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-15 03:57:52 */
/* http://harviacode.com */
