<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rn_client_model extends CI_Model
{

    public $table = 'rn_client';
    public $id = 'id_client';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_client,nama_client,perusahaan,divisi,no_telp,alamat,tanggal_client');
        $this->datatables->from('rn_client');
        //add this line for join
        //$this->datatables->join('table2', 'rn_client.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('rn_client/detail/$1'),'<i class="fa fa-book"></i>Read','class="btn btn-info btn-xs edit"')."  ".anchor(site_url('rn_client/edit/$1'),'<i class="fa fa-edit"></i> Update','class="btn btn-success btn-xs edit"')."<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id_client');
        return $this->datatables->generate();
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
    function total_rows($q = NULL) {
        $this->db->like('id_client', $q);
	$this->db->or_like('nama_client', $q);
	$this->db->or_like('perusahaan', $q);
	$this->db->or_like('divisi', $q);
	$this->db->or_like('no_telp', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('tanggal_client', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_client', $q);
	$this->db->or_like('nama_client', $q);
	$this->db->or_like('perusahaan', $q);
	$this->db->or_like('divisi', $q);
	$this->db->or_like('no_telp', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('tanggal_client', $q);
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

}

 