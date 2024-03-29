<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obat_model extends CI_Model
{

    public $table = 'tb_obat';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('o.id,o.kode,o.kode_siva,o.nama_obat,o.generik,o.satuan,o.harga,o.insert_at');
        $this->datatables->from('tb_obat as o');
        //add this line for join
        // $this->datatables->join('tb_satuan as s', 'o.satuan = s.id');
        $this->datatables->add_column('action', anchor(site_url('Obat/update/$1'), '<div class="badge badge-warning">Update</div>') . anchor(site_url('Obat/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }
    function check_kode($code)
    {
        $this->db->from('tb_obat');
        $this->db->where('kode', $code);

        $query = $this->db->get();
        return $query;
    }
    // get all
    function get_all()
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

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('kode', $q);
        $this->db->or_like('kode_siva', $q);
        $this->db->or_like('nama_obat', $q);
        $this->db->or_like('generik', $q);
        $this->db->or_like('satuan', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('insert_at', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('kode', $q);
        $this->db->or_like('kode_siva', $q);
        $this->db->or_like('nama_obat', $q);
        $this->db->or_like('generik', $q);
        $this->db->or_like('satuan', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('insert_at', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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

    public function insertimport($data)
    {
        $this->db->insert('tb_obat', $data);
        return $this->db->insert_id();
    }
}
