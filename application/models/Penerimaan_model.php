<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penerimaan_model extends CI_Model
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
            $this->datatables->where('p.id_ruang_tujuan', $session);
        }
        // $this->datatables->where('d.status', 2);
        $this->datatables->group_by('p.id');
        $this->datatables->add_column(
            'action',
            anchor(site_url('Penerimaan/detail/$1'), '<div class="badge badge-warning" title"Terima">Terima</div>'),
            'id'
        );
        return $this->datatables->generate();
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
    function stok()
    {
        $this->db->select('s.*, o.nama_obat as nama');
        $this->db->from('tb_stok as s');
        $this->db->join('tb_obat as o', 'o.kode = s.kode_barang');
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

    function insert_stok($data)
    {
        $this->db->insert($this->table_stok, $data);
    }
    function cek_insert_stok($data)
    {
        $id_ruang = $data['ruang'];
        $harga = $data['harga'];
        $kode_barang = $data['kode_barang'];
        $this->db->select('*');
        $this->db->from('tb_stok');
        $this->db->where('id_ruang', $id_ruang);
        $this->db->where('harga', $harga);
        $this->db->where('kode_barang', $kode_barang);
        $query = $this->db->get();
        // var_dump($query);
        // die;
        return $query;
    }
    function cek_insert_stok_kode($id_ruang, $kode)
    {
        $this->db->select('*');
        $this->db->from('tb_stok');
        $this->db->where('id_ruang', $id_ruang);
        $this->db->where('kode_barang', $kode);
        $query = $this->db->get();
        // var_dump($query);
        // die;
        return $query;
    }
    function terima($id, $data)
    {
    }
}
