<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class m_admin extends CI_Model
{
    function barang()
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->order_by('id_barang', 'DESC');
        return $this->db->get('')->result_array();
    }
    public function search_barang($keyword)
    {
        $this->db->like('nama', $keyword);
        return $this->db->get('tbl_barang')->result_array();
    }
    function pelanggan()
    {
        $this->db->select('*');
        $this->db->from('tbl_pelanggan');
        $this->db->order_by('id_pelanggan', 'DESC');
        return $this->db->get('')->result_array();
    }
    function slider()
    {
        $this->db->select('*');
        $this->db->from('tbl_slider');
        $this->db->order_by('id_slider', 'DESC');
        return $this->db->get('')->result_array();
    }
    function ambil_slider_terbaru()
    {
        $this->db->limit(3);
        $query = $this->db->get('tbl_slider');
        return $query->result();
    }
    public function ambil_id_gambar_slider($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id_slider', $id);
        $result = $this->db->get('');
        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }
    public function delete_gambar_slider($table, $id)
    {
        $this->db->where('id_slider', $id);
        $this->db->from($table);
        return true;
    }
    function pesan()
    {
        $this->db->select('*');
        $this->db->from('tbl_pesan');
        $this->db->order_by('id_pesan', 'DESC');
        return $this->db->get('')->result_array();
    }
    function riwayat()
    {
        $subquery = $this->db->select('MAX(id_servis) as max_id')
            ->from('tbl_servis')
            ->group_by('id_pelanggan')
            ->get_compiled_select();

        $this->db->select('tbl_servis.id_servis, tbl_pelanggan.id_pelanggan, tbl_pelanggan.nama, tbl_pelanggan.plat, tbl_servis.tgl_servis, tbl_servis.keterangan,tbl_servis.rekomendasi, tbl_servis.id_user');
        $this->db->from('tbl_servis');
        $this->db->join('tbl_pelanggan', 'tbl_servis.id_pelanggan = tbl_pelanggan.id_pelanggan');
        $this->db->join("($subquery) as latest_servis", 'tbl_servis.id_servis = latest_servis.max_id');
        return $this->db->get()->result_array();
    }

    public function getServiceHistoryByCustomer($id_pelanggan)
    {
        $this->db->select('tbl_servis.*, tbl_pelanggan.nama, tbl_pelanggan.plat');
        $this->db->from('tbl_servis');
        $this->db->join('tbl_pelanggan', 'tbl_servis.id_pelanggan = tbl_pelanggan.id_pelanggan');
        $this->db->where('tbl_servis.id_pelanggan', $id_pelanggan);
        return $this->db->get()->result_array();
    }

    function BarangById($id_barang)
    {
        return $this->db->get_where('tbl_barang', ["id_barang" => $id_barang])->row_array();
    }
    function PelangganById($id_pelanggan)
    {
        return $this->db->get_where('tbl_pelanggan', ["id_pelanggan" => $id_pelanggan])->row_array();
    }
    function ServisById($id_servis)
    {
        return $this->db->get_where('tbl_servis', ["id_servis" => $id_servis])->row_array();
    }
    function tambah($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function ubah($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function ambil_id_gambar_barang($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id_barang', $id);
        $result = $this->db->get('');
        if ($result->num_rows() > 0) {
            return $result->row();
        }
    }
    public function delete_gambar_barang($table, $id)
    {
        $this->db->where('id_barang', $id);
        $this->db->from($table);
        return true;
    }
    public function get_user($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('tbl_user');
        return $query->row_array();
    }
    public function update_user($user_id, $user_data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('tbl_user', $user_data);
    }
    public function TotalBarang()
    {
        return $this->db->get_where('tbl_barang')->num_rows();
    }
    public function TotalPelanggan()
    {
        return $this->db->get_where('tbl_pelanggan')->num_rows();
    }

    public function cek_buku_servis($plat, $no_hp)
    {
        $this->db->select('tbl_servis.*, tbl_pelanggan.kendaraan, tbl_pelanggan.plat, tbl_pelanggan.no_hp, tbl_pelanggan.point');
        $this->db->from('tbl_servis');
        $this->db->join('tbl_pelanggan', 'tbl_servis.id_pelanggan = tbl_pelanggan.id_pelanggan');
        $this->db->where('tbl_pelanggan.plat', $plat);
        $this->db->where('tbl_pelanggan.no_hp', $no_hp);
        $query = $this->db->get();
        return $query->result();
    }
}
