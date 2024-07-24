<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('session');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {

        $data = [
            'barang' => $this->m_admin->barang(),
            'slider' => $this->m_admin->ambil_slider_terbaru(),

        ];
        $this->load->view('user/templates/header');
        $this->load->view('user/index', $data);
        $this->load->view('user/templates/footer');
    }

    public function produk()
    {

        $data = [

            'barang' => $this->m_admin->barang(),

        ];
        $this->load->view('user/templates/header');
        $this->load->view('user/produk', $data);
        $this->load->view('user/templates/footer');
    }
    public function kontak()
    {
        $this->load->view('user/templates/header');
        $this->load->view('user/kontak');
        $this->load->view('user/templates/footer');
    }
    public function tentang()
    {

        $this->load->view('user/templates/header');
        $this->load->view('user/tentang');
        $this->load->view('user/templates/footer');
    }
    public function cek_buku()
    {
        $this->load->view('user/templates/header');
        $this->load->view('user/cek_buku');
        $this->load->view('user/templates/footer');
    }

    public function cek_buku_servis()
    {
        $plat = $this->input->post('plat');
        $no_hp = $this->input->post('no_hp');

        $data['servis'] = $this->m_admin->cek_buku_servis($plat, $no_hp);

        if ($data['servis']) {
            $this->load->view('user/templates/header');
            $this->load->view('user/buku_servis', $data);
            $this->load->view('user/templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Servis tidak ditemukan.</div>');
            redirect('home/cek_buku');
        }
    }

    public function pesan()
    {
        $nama = $this->input->post('nama');
        $no_hp = $this->input->post('no_hp');
        $subjek = $this->input->post('subjek');
        $pesan = $this->input->post('pesan');

        $data = [
            'nama' => $nama,
            'no_hp' => $no_hp,
            'subjek' => $subjek,
            'pesan' => $pesan,
            'date_created' => date('Y-m-d H:i:s'),
        ];
        $this->m_admin->tambah('tbl_pesan', $data);

        redirect('home/kontak');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['barang'] = $this->m_admin->search_barang($keyword);
        $this->load->view('user/templates/header');
        $this->load->view('user/produk', $data);
        $this->load->view('user/templates/footer');
    }
}
