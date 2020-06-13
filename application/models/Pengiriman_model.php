<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengiriman_model extends CI_Model
{

    public $table = 'tb_pengiriman';
    public $table_detail = 'tb_pengiriman_detail';
    public $table_stok = 'tb_stok';
    public $id = 'id';
    public $order = 'DESC';


    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($session = null)
    {
        $this->datatables->select("p.id,p.no_spb,p.id_ruang,p.id_ruang_tujuan,p.date, r.nama_ruang as ruang,r2.nama_ruang as rtujuan, COUNT(d.id_pengiriman) as item, concat(round(( COUNT(IF(d.status=2, p.id, null))/COUNT(IF(d.status, p.id, null))* 100)),' % ') as diterima");
        $this->datatables->from('tb_pengiriman as p');
        //add this line for join
        $this->datatables->join('tb_ruang as r', 'p.id_ruang = r.id');
        $this->datatables->join('tb_ruang as r2', 'p.id_ruang_tujuan = r2.id');
        $this->datatables->join('tb_pengiriman_detail as d', 'p.id = d.id_pengiriman');
        if ($session != null) {
            $this->datatables->where('p.id_ruang', $session);
        }
        $this->datatables->group_by('p.id');
        $this->datatables->add_column(
            'action',
            anchor(site_url('Pengiriman/detail/$1'), '<div class="badge badge-warning">Detail</div>')
            // . anchor(site_url('pengiriman/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"')
            ,
            'id'
        );
        return $this->datatables->generate();
    }
    function get($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pengiriman');
        $this->db->where('tb_pengiriman.id', $id);
        $query = $this->db->get();

        return $query;
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_all_detail()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function get_by_id_detail($id)
    {

        $this->db->select('tb_pengiriman_detail.*, tb_obat.nama_obat as nama');
        $this->db->from('tb_pengiriman_detail');
        $this->db->join('tb_pengiriman', 'tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman');
        $this->db->join('tb_obat', 'tb_obat.kode = tb_pengiriman_detail.kode_barang');
        $this->db->where('tb_pengiriman_detail.id_pengiriman', $id);
        $query = $this->db->get();
        // var_dump($query);
        // die;
        return $query;
    }
    function stok($user)
    {
        $this->db->select('s.*, o.nama_obat as nama');
        $this->db->from('tb_stok as s');
        $this->db->join('tb_obat as o', 'o.kode = s.kode_barang');
        $this->db->where('s.id_ruang', $user);
        $query = $this->db->get();
        // var_dump($query);
        // die;
        return $query;
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('kode_obat', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->or_like('id_ruang', $q);
        $this->db->or_like('date', $q);
        $this->db->or_like('status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('kode_obat', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->or_like('id_ruang', $q);
        $this->db->or_like('date', $q);
        $this->db->or_like('status', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    function check_spb($code)
    {
        $this->db->from('tb_pengiriman');
        $this->db->where('no_spb', $code);

        $query = $this->db->get();
        return $query;
    }
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    function insert_detail($data)
    {
        $this->db->insert_batch($this->table_detail, $data);
    }
    function update_stok($data, $datas)
    {
        $kode_barang = $data['kode_barang'];
        $id_ruang = $datas['id_ruang'];
        $stok_awal = $this->db->query("SELECT stok FROM tb_stok WHERE id_ruang = $id_ruang AND kode_barang = " . "'$kode_barang'")->row()->stok;
        $stok_input = $data['jumlah'];
        $jumlah = $stok_awal - $stok_input;
        // var_dump($id_ruang);
        // die;
        $this->db->set('stok', $jumlah);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('id_ruang', $id_ruang);
        $this->db->update($this->table_stok);
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
}

/* End of file Pengiriman_model.php */
/* Location: ./application/models/Pengiriman_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-25 04:24:36 */
/* http://harviacode.com */
