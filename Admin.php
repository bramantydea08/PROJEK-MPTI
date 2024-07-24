<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_admin');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 1) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data = [
            'totalbarang' => $this->m_admin->TotalBarang(),
            'totalpelanggan' => $this->m_admin->TotalPelanggan(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function barang()
    {
        $data = [
            'barang' => $this->m_admin->barang(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/barang/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function add_barang()
    {
        $data = [
            'barang' => $this->m_admin->barang(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/barang/add', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function edit_barang($id_barang = null)
    {
        $data = [
            'barang' => $this->m_admin->BarangById($id_barang),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/barang/edit', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function tambah_barang()
    {
        $nama = $this->input->post('nama');
        $stok = $this->input->post('stok');
        $deskripsi = $this->input->post('deskripsi');
        $harga = $this->input->post('harga');
        $tgl_masuk = $this->input->post('tgl_masuk');

        // Validasi stok dan harga tidak boleh negatif
        if ($stok < 0 || $harga < 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok dan Harga tidak boleh kurang dari 1.</div>');
            redirect('admin/add_barang');
            return;
        }
        $deskripsi = strip_tags($deskripsi);

        $gambar = $_FILES['gambar'];

        $config['upload_path'] = './uploads/barang/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['overwrite'] = true;
        $config['max_size'] = '20000';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gambar harus berbentuk png, jpg, atau gif. ' . $error . '</div>');
            redirect('admin/add_barang');
        } else {
            $data = [
                'nama' => $nama,
                'stok' => $stok,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'tgl_masuk' => $tgl_masuk,
                'gambar' => $this->upload->data('file_name')
            ];
            $this->m_admin->tambah('tbl_barang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang Berhasil Ditambah</div>');
            redirect('admin/barang');
        }
    }

    public function update_barang()
    {
        $id_barang = $this->input->post('id_barang');

        $nama = $this->input->post('nama');
        $stok = $this->input->post('stok');
        $deskripsi = $this->input->post('deskripsi');
        $harga = $this->input->post('harga');
        $tgl_masuk = $this->input->post('tgl_masuk');

        if ($stok < 0 || $harga < 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Stok dan Harga tidak boleh kurang dari 0.</div>');
            redirect('admin/barang');
            return;
        }

        $gambar = $_FILES['gambar'];

        if (empty($gambar['name'])) {
            $data = [
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'tgl_masuk' => $tgl_masuk,
            ];
            $this->m_admin->ubah(['id_barang' => $id_barang], 'tbl_barang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Barang Berhasil Diupdate
 </div>');
            redirect('admin/barang');
        } else {
            $config['upload_path'] = './uploads/barang/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['overwrite'] = true;
            $config['max_size']     = '20000';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['error'] = $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gambar harus berbentuk png, jpg, atau gif. ' . $data . '</div>');
                redirect('admin/barang');
            } else {
                $f = $this->db->select('gambar')->get_where('tbl_barang', ['id_barang' => $id_barang])->row();
                unlink('./uploads/barang' . $f->gambar);
                $data = [
                    'nama' => $nama,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                    'stok' => $stok,
                    'tgl_masuk' => $tgl_masuk,
                    'gambar' => $this->upload->data('file_name')
                ];
                $this->m_admin->ubah(['id_barang' => $id_barang], 'tbl_barang', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Barang Berhasil Diupdate
     </div>');
                redirect('admin/barang');
            }
        }
    }
    public function hapus_barang($id_barang)
    {
        $where = array('id_barang' => $id_barang);

        $data = $this->m_admin->ambil_id_gambar_barang('tbl_barang', $id_barang);
        $path = './uploads/barang/';
        @unlink($path . $data->gambar);
        if ($this->m_admin->delete_gambar_barang('tbl_barang', $id_barang) == true) {
            # code...
            $this->m_admin->hapus($where, 'tbl_barang');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Barang Berhasil Dihapus
 </div>');
        }
        redirect('admin/barang');
    }
    public function pelanggan()
    {
        $data = [
            'pelanggan' => $this->m_admin->pelanggan(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/pelanggan/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function add_pelanggan()
    {
        $data = [
            'pelanggan' => $this->m_admin->pelanggan(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/pelanggan/add', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function edit_pelanggan($id_pelanggan = null)
    {
        $data = [
            'pelanggan' => $this->m_admin->pelangganById($id_pelanggan),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/pelanggan/edit', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function tambah_pelanggan()
    {
        $nama = $this->input->post('nama');
        $no_hp = $this->input->post('no_hp');
        $kendaraan = $this->input->post('kendaraan');
        $plat = $this->input->post('plat');
        // $pointbaru = $this->db->get_where('tbl_servis', ['id_pelanggan' => $id_pelanggan])->row()->point;

        $data = [
            'nama' => $nama,
            'no_hp' => $no_hp,
            'kendaraan' => $kendaraan,
            'plat' => $plat,
            'point' => '0',
        ];

        $this->m_admin->tambah('tbl_pelanggan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Pelanggan Baru Berhasil Ditambah
</div>');
        redirect('admin/pelanggan');
    }
    public function update_pelanggan()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');

        $nama = $this->input->post('nama');
        $no_hp = $this->input->post('no_hp');
        $kendaraan = $this->input->post('kendaraan');
        $plat = $this->input->post('plat');
        $point = $this->input->post('point');

        $data = [
            'nama' => $nama,
            'no_hp' => $no_hp,
            'kendaraan' => $kendaraan,
            'plat' => $plat,
            'point' => $point,
        ];
        $this->m_admin->ubah(['id_pelanggan' => $id_pelanggan], 'tbl_pelanggan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Pelanggan Berhasil Diupdate
</div>');
        redirect('admin/pelanggan');
    }
    public function hapus_pelanggan($id_pelanggan)
    {
        $where = array('id_pelanggan' => $id_pelanggan);
        $this->m_admin->hapus($where, 'tbl_pelanggan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Pelanggan Berhasil Dihapus
</div>');
        redirect('admin/pelanggan');
    }
    public function riwayat()
    {
        $data = [
            'riwayat' => $this->m_admin->riwayat(),
        ];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/riwayat/index', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function add_servis()
    {
        $data = [
            'pelanggan' => $this->m_admin->pelanggan(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/riwayat/add', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function detail_servis($id_pelanggan)
    {
        $data['detail'] = $this->m_admin->getServiceHistoryByCustomer($id_pelanggan);

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/riwayat/detail', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function tambah_servis()
    {
        $tgl_servis = $this->input->post('tgl_servis');
        $keterangan = $this->input->post('keterangan');
        $rekomendasi = $this->input->post('rekomendasi');
        $id_pelanggan = $this->input->post('id_pelanggan');
        $point = $this->input->post('point');

        $id_user = $this->db->get_where('tbl_pelanggan', ['id_pelanggan' => $id_pelanggan])->row()->id_user;

        $data = [
            'tgl_servis' => $tgl_servis,
            'keterangan' => $keterangan,
            'rekomendasi' => $rekomendasi,
            'id_pelanggan' => $id_pelanggan,
            'id_user' => $id_user,
            'point' => $point,
        ];

        // Retrieve the current points of the customer
        $pointlama = $this->db->get_where('tbl_pelanggan', ['id_pelanggan' => $id_pelanggan])->row()->point;

        // Calculate the new points
        $pointbaru = $pointlama + $point;

        // Update the customer's points
        $this->db->set('point', $pointbaru);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('tbl_pelanggan');

        // Add the service record
        $this->m_admin->tambah('tbl_servis', $data);

        // Set a success message
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Riwayat Pelanggan Berhasil Ditambah
    </div>');

        // Redirect to the history page
        redirect('admin/riwayat');
    }

    public function edit_servis($id_servis = null)
    {
        $data = [
            'servis' => $this->m_admin->ServisById($id_servis),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/riwayat/edit', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function update_servis()
    {
        $id_servis = $this->input->post('id_servis');

        $id_pelanggan = $this->input->post('id_pelanggan');

        $tgl_servis = $this->input->post('tgl_servis');
        $keterangan = $this->input->post('keterangan');
        $rekomendasi = $this->input->post('rekomendasi');

        $data = [
            'tgl_servis' => $tgl_servis,
            'keterangan' => $keterangan,
            'rekomendasi' => $rekomendasi,
        ];
        $this->m_admin->ubah(['id_servis' => $id_servis], 'tbl_servis', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Pelanggan Berhasil Diupdate
</div>');
        redirect('admin/detail_servis/' . $id_pelanggan);
    }

    public function hapus_servis($id_servis)
    {
        $where = array('id_servis' => $id_servis);
        $this->m_admin->hapus($where, 'tbl_servis');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Servis Berhasil Dihapus
</div>');
        redirect('admin/riwayat');
    }
    public function hapus_servis_pelanggan($id_servis)
    {
        $where = array('id_servis' => $id_servis);
        $this->m_admin->hapus($where, 'tbl_servis');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Servis Berhasil Dihapus
</div>');
        redirect('admin/riwayat');
    }

    public function profile()
    {

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/templates/footer', $data);
    }

    public function edit_profile()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[8]|matches[password2]|regex_match[/[A-Z]/]', [
            'matches' => 'Password harus sama',
            'min_length' => 'Password harus 8 karakter atau lebih',
            'regex_match' => 'Password harus memiliki setidaknya satu huruf besar'
        ]);
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|matches[password1]');
        // $this->form_validation->set_rules('image', 'Foto', 'callback_check_image_type'); // Aturan validasi untuk gambar

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        // Validasi form
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', validation_errors());
            redirect('admin/profile');
        } else {
            $data = [
                'nama' => $nama,
                'email' => $email,
            ];

            // Jika password baru diisi, hash password
            $password1 = $this->input->post('password1');
            if (!empty($password1)) {
                $data['password'] = password_hash($password1, PASSWORD_DEFAULT);
            }

            // Upload gambar profil jika diisi
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './uploads/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png'; // Izinkan format JPG, JPEG, dan PNG
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = $_FILES['image']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $data['image'] = $uploadData['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                    redirect('admin/profile');
                    return;
                }
            }

            // Update data pengguna
            $this->m_admin->ubah(['id' => $id], 'tbl_user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile berhasil Diupdate!</div>');
            redirect('admin/profile');
        }
    }

    // Fungsi callback untuk memeriksa tipe gambar
    public function check_image_type($image)
    {
        // Mendapatkan ekstensi file
        $image_info = pathinfo($_FILES['image']['name']);
        $image_extension = strtolower($image_info['extension']);

        // Memeriksa apakah ekstensi file adalah jpg, jpeg, atau png
        if ($image_extension != 'jpg' && $image_extension != 'jpeg' && $image_extension != 'png') {
            $this->form_validation->set_message('check_image_type', 'Foto harus dalam format JPG, JPEG, atau PNG.');
            return false;
        }

        return true;
    }

    public function pesan()
    {
        $data = [
            'pesan' => $this->m_admin->pesan(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/pesan', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function hapus_pesan($id_pesan)
    {
        $where = array('id_pesan' => $id_pesan);
        $this->m_admin->hapus($where, 'tbl_pesan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
       Pesan Berhasil Dihapus
</div>');
        redirect('admin/pesan');
    }

    public function slider()
    {
        $data = [
            'slider' => $this->m_admin->slider(),
        ];

        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/slider', $data);
        $this->load->view('admin/templates/footer', $data);
    }
    public function tambah_slider()
    {
        $gambar = $_FILES['gambar'];

        $config['upload_path'] = './uploads/slider/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['overwrite'] = true;
        $config['max_size']     = '20000';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $data['error'] = $this->upload->display_errors();

            redirect('admin/slider');
        } else {
            $data = [
                'date_created' => time(),
                'gambar' => $this->upload->data('file_name')
            ];
            $this->m_admin->tambah('tbl_slider', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Menambahkan Slider
    </div>');
        }
        redirect('admin/slider');
    }



    public function edit_slider()
    {
        $id_slider = $this->input->post('id_slider');


        $gambar = $_FILES['gambar'];

        if (empty($gambar['name'])) {
            $data = [
                'date_created' => time(),
            ];
            $this->m_admin->ubah(['id_slider' => $id_slider], 'tbl_slider', $data);
            $this->session->set_flashdata('message', 'Berhasil Update Sliders!');

            redirect('admin/slider');
        } else {
            $config['upload_path'] = './uploads/slider/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['overwrite'] = true;
            $config['max_size']     = '20000';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['error'] = $this->upload->display_errors();
                $this->session->set_flashdata('message', 'Periksa file foto!');

                redirect('admin/slider');
            } else {
                $f = $this->db->select('gambar')->get_where('tbl_slider', ['id_slider' => $id_slider])->row();
                unlink('./uploads/slider/' . $f->gambar);
                $data = [
                    'date_created' => time(),
                    'gambar' => $this->upload->data('file_name')
                ];
                $this->m_admin->ubah(['id_slider' => $id_slider], 'tbl_slider', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
       Berhasil Update Slider
</div>');
            }
            redirect('admin/slider');
        }
    }


    public function hapus_slider($id_slider)
    {
        $where = array('id_slider' => $id_slider);

        $data = $this->m_admin->ambil_id_gambar_slider('tbl_slider', $id_slider);
        $path = './uploads/slider/';
        @unlink($path . $data->gambar);
        if ($this->m_admin->delete_gambar_slider('tbl_slider', $id_slider) == true) {
            # code...
            $this->m_admin->hapus($where, 'tbl_slider');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Slider Berhasil Dihapus
</div>');
        }
        redirect('admin/slider');
    }
}
