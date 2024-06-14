<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['form', 'helpernya']);
    }

private function callback(){
    // Modular
    $data['pengaturan'] = $this->db->query("select * from pengaturan where id=1")->row();
    $data['namaweb'] = $this->db->query("select * from setting where id_setting=1")->row();
    $data['email'] = $this->db->query("select * from setting where id_setting=4")->row();
    $data['telepon'] = $this->db->query("select * from setting where id_setting=5")->row();
    $data['alamat'] = $this->db->query("select * from setting where id_setting=6")->row();
    // Favicon
    $data['favicon'] = $this->db->query("select * from setting where id_setting=9")->row();
    // Sosmed
    $data['fb'] = $this->db->query("select * from setting where id_setting=50")->row();
    $data['ig'] = $this->db->query("select * from setting where id_setting=51")->row();
    $data['yt'] = $this->db->query("select * from setting where id_setting=52")->row();
    $data['tw'] = $this->db->query("select * from setting where id_setting=53")->row();
    return $data;
}

    public function index()
    {
        $data = $this->callback();
        $data['slider'] = $this->db->query("select * from slider")->result();
        // Pengumuman
        $data['konten'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Pengumuman' and stts.id = 1 order by konten.id desc limit 2")->result();
        // Kegiatan
        // select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Kegiatan' and stts.id = 1 order by konten.id desc limit 3
        // galeri
        $data['kegiatan'] = $this->db->query("select tb_galeri.cover as cover, tb_galeri.tgl_dibuat as tanggal_dibuat, tb_galeri.nama_galeri as judul, tb_galeri.slug as slug, tb_galeri.deskripsi_kegiatan as konten from tb_galeri, kategori_konten, stts where tb_galeri.id_kategori = kategori_konten.id and tb_galeri.status_galeri = stts.id and kategori_konten.nama_kategori ='Kegiatan' and stts.id = 1 order by tb_galeri.id desc limit 3")->result();
        // sambutan
        $data['sambutan'] = $this->db->query("select * from db_sambutan where id=1")->row();
        // Artikel
        $data['artikel'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Artikel' and stts.id = 1 order by konten.id desc limit 4")->result();
        // Link YT
        $data['links'] = $this->db->query("select * from link_youtube")->result();
        // Load view halaman landing page dengan data yang diambil dari model
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer', $data);
    }

    public function kontak()
    {
        $data = $this->callback();

        $this->load->view('header', $data);
        $this->load->view('kontak', $data);
        $this->load->view('footer', $data);
    }

    public function submit()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Subjek', 'required');
        $this->form_validation->set_rules('message', 'Isi Aspirasi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->kontak();
        } else {
            $isi = array(
                'nama_pengadu' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'subjek_aduan' => htmlspecialchars($this->input->post('subject', true)),
                'isi_aspirasi' => htmlspecialchars($this->input->post('message', true)),
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'tanggal_dibuat' => date('Y-m-d')
            );
            $this->db->insert('aspirasi', $isi);
            $this->session->set_flashdata('berhasil', 'Terima kasih, aspirasi kamu sangat berguna bagi kita semua.');
            redirect('aspirasi');
        }
    }

    public function profil()
    {
        $data = $this->callback();
        // sambutan
        $data['sambutan'] = $this->db->query("select * from db_sambutan where id=1")->row();
        // profil
        $data['foto'] = $this->db->query("select * from fotofoto where id_halaman=1")->row();
        $data['fotofoto'] = $this->db->query("select * from fotofoto where id_halaman > 1")->result();

        $this->load->view('header', $data);
        $this->load->view('profil', $data);
        $this->load->view('footer', $data);
    }

    public function artikel($page = 1)
    {
        $data = $this->callback();
        $data['keyword'] = $this->input->get('search_query');

        // Load the pagination library
        $this->load->library('pagination');

        // Set the pagination configuration
        $config['base_url'] = base_url('artikel');
        // total rows, status konten tayang dan id_kategori bukan pengumuman
        $config['total_rows'] = $this->db->where('status_konten', 1)->where_not_in('id_kategori', '1')->count_all_results('konten');
        $config['per_page'] = 4;
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = 2;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="blog-pagination"><ul class="justify-content-center">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        if ($data['keyword'] == '') {
            $data['artikel'] = $this->db->select('*')
                ->from('konten')
                ->join('kategori_konten', 'konten.id_kategori = kategori_konten.id')
                ->join('stts', 'konten.status_konten = stts.id')
                ->where('kategori_konten.nama_kategori =', 'Artikel')
                ->where('stts.id', 1)
                ->order_by('konten.id', 'desc')
                ->limit($config['per_page'], ($page - 1) * $config['per_page'])
                ->get()
                ->result();
        } else {
            $data['artikel'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and konten.konten like '%" . $data['keyword'] . "%' and kategori_konten.nama_kategori ='Artikel' and stts.id = 1 order by konten.id desc")->result();
        }

        $data['pagination_links'] = $this->pagination->create_links();

        // Kegiatan terbaru
        $data['recent_post'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Pengumuman' and stts.id = 1 order by konten.id desc limit 3")->result();
        // Artikel terbaru
        $data['artikel_post'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Artikel' and stts.id = 1 order by konten.id desc limit 3")->result();
        // Load view halaman landing page dengan data yang diambil dari model
        $this->load->view('header', $data);
        $this->load->view('artikel', $data);
        $this->load->view('footer', $data);
    }

    public function pengumuman($page = 1)
    {
        $data = $this->callback();
        $data['keyword'] = $this->input->get('search_query');
        // Load the pagination library
        $this->load->library('pagination');

        // Set the pagination configuration
        $config['base_url'] = base_url('pengumuman');
        // total rows, status konten tayang dan id_kategori bukan pengumuman
        $config['total_rows'] = $this->db->where('status_konten', 1)->where('id_kategori', '1')->count_all_results('konten');
        $config['per_page'] = 4;
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = 2;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="blog-pagination"><ul class="justify-content-center">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        if ($data['keyword'] == '') {
            $data['artikel'] = $this->db->select('*')
                ->from('konten')
                ->join('kategori_konten', 'konten.id_kategori = kategori_konten.id')
                ->join('stts', 'konten.status_konten = stts.id')
                ->where('kategori_konten.nama_kategori =', 'Pengumuman')
                ->where('stts.id', 1)
                ->order_by('konten.id', 'desc')
                ->limit($config['per_page'], ($page - 1) * $config['per_page'])
                ->get()
                ->result();
        } else {
            $data['artikel'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and konten.konten like '%" . $data['keyword'] . "%' and kategori_konten.nama_kategori ='Pengumuman' and stts.id = 1 order by konten.id desc")->result();
        }

        $data['pagination_links'] = $this->pagination->create_links();

        // Kegiatan terbaru
        $data['recent_post'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Pengumuman' and stts.id = 1 order by konten.id desc limit 3")->result();
        // Artikel terbaru
        $data['artikel_post'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Artikel' and stts.id = 1 order by konten.id desc limit 3")->result();
        // Load view halaman landing page dengan data yang diambil dari model
        $this->load->view('header', $data);
        $this->load->view('pengumuman', $data);
        $this->load->view('footer', $data);
    }

    public function detail($slug)
    {
        $data = $this->callback();
        $data['keyword'] = $this->input->get('search_query');

        if ($data['keyword'] == '') {
            $data['artikel'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and stts.id = 1 and konten.slug='" . $slug . "' order by konten.id desc")->row();
        } else {
            $data['artikel'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and konten.konten like '%" . $data['keyword'] . "%' and kategori_konten.nama_kategori ='Pengumuman' and stts.id = 1 order by konten.id desc")->result();
        }

        // Kegiatan terbaru
        $data['recent_post'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Kegiatan' and stts.id = 1 order by konten.id desc limit 3")->result();
        // Artikel terbaru
        $data['artikel_post'] = $this->db->query("select * from konten, kategori_konten, stts where konten.id_kategori = kategori_konten.id and konten.status_konten = stts.id and kategori_konten.nama_kategori ='Artikel' and stts.id = 1 order by konten.id desc limit 3")->result();

        $this->load->view('header', $data);
        $this->load->view('detail', $data);
        $this->load->view('footer', $data);
    }
	
    public function galeri($page = 1)
    {
        $data = $this->callback();
        $data['keyword'] = $this->input->get('search_query');
        // Load the pagination library
        $this->load->library('pagination');

        // Set the pagination configuration
        $config['base_url'] = base_url('galeri');
        // total rows, status konten tayang dan id_kategori bukan pengumuman
        $config['total_rows'] = $this->db->where('status_konten', 1)->where('id_kategori', '2')->count_all_results('konten');
        $config['per_page'] = 4;
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = 2;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="blog-pagination"><ul class="justify-content-center">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        if ($data['keyword'] == '') {
            $data['artikel'] = $this->db->select('*')
                ->from('tb_galeri')
                ->join('kategori_konten', 'tb_galeri.id_kategori = kategori_konten.id')
                ->join('stts', 'tb_galeri.status_galeri = stts.id')
                ->where('kategori_konten.nama_kategori =', 'Kegiatan')
                ->where('stts.id', 1)
                ->order_by('tb_galeri.id', 'desc')
                ->limit($config['per_page'], ($page - 1) * $config['per_page'])
                ->get()
                ->result();
        } else {
            $data['artikel'] = $this->db->query("select * from tb_galeri, kategori_konten, stts where tb_galeri.id_kategori = kategori_konten.id and tb_galeri.status_galeri = stts.id and konten.konten like '%" . $data['keyword'] . "%' and kategori_konten.nama_kategori ='Kegiatan' and stts.id = 1 order by tb_galeri.id desc")->result();
        }

        $data['pagination_links'] = $this->pagination->create_links();

        // Load view halaman landing page dengan data yang diambil dari model
        $this->load->view('header', $data);
        $this->load->view('galeri', $data);
        $this->load->view('footer', $data);
    }

    public function galeridetail($slug)
    {
        $data = $this->callback();
        $data['detail'] = $this->db->query("select * from tb_galeri, tb_galeri_detail, stts where tb_galeri.id = tb_galeri_detail.id_galeri and tb_galeri.status_galeri = stts.id and stts.id = 1 and tb_galeri.slug='" . $slug . "' order by tb_galeri.id desc")->result();
        $data['kegiatan'] = $this->db->query("select * from tb_galeri, tb_galeri_detail, stts where tb_galeri.id = tb_galeri_detail.id_galeri and tb_galeri.status_galeri = stts.id and stts.id = 1 and tb_galeri.slug='" . $slug . "' order by tb_galeri.id desc")->row();
        

        $this->load->view('header', $data);
        $this->load->view('galeri_detail', $data);
        $this->load->view('footer', $data);
    }

	public function register()
	{
        $this->load->library('form_validation');

        // Form Validation
        $this->form_validation->set_rules("no_kk","* No KK","trim|xss_clean|required|htmlspecialchars|numeric|exact_length[16]");
        $this->form_validation->set_rules("no_ktp","* No KTP","trim|xss_clean|required|htmlspecialchars|numeric|exact_length[16]|is_unique[warga.no_ktp]");
        $this->form_validation->set_rules("nama_lengkap","* Nama lengkap","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_rules("id_group","* Group Rukun Tetangga","trim|xss_clean|required");
        $this->form_validation->set_rules("tgl_lahir","* Tgl lahir","trim|xss_clean|required");
        $this->form_validation->set_rules("jenis_kelamin","* Jenis kelamin","trim|xss_clean|required");
        $this->form_validation->set_rules("agama","* Agama","trim|xss_clean|required");
        $this->form_validation->set_rules("pendidikan_terakhir","* Pendidikan terakhir","trim|xss_clean|required");
        $this->form_validation->set_rules("id_profesi","* Profesi","trim|xss_clean|required");
        $this->form_validation->set_rules("status_warga","* Status","trim|xss_clean|required");
        $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|valid_email|is_unique[auth_user.email]");
        $this->form_validation->set_rules("hp","* Nomor Handphone","trim|xss_clean|required|htmlspecialchars|numeric|max_length[13]");

        $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|min_length[6]");
        $this->form_validation->set_rules("confirm_password","*&nbsp;","trim|xss_clean|matches[password]|required");

        $data['favicon'] = $this->db->query("select * from setting where id_setting=9")->row();
		$data['logo'] = $this->db->query("select * from setting where id_setting=7")->row();
		$data['kelamin'] = $this->db->query("select * from kelamin")->result();
		$data['agama'] = $this->db->query("select * from agama")->result();
		$data['pendidikan'] = $this->db->query("select * from pendidikan_terakhir")->result();
		$data['profesi'] = $this->db->query("select id, nama_profesi as nama from profesi")->result();
		$data['status'] = $this->db->query("select id, nama_stts_warga as nama from status_warga where nama_stts_warga <> 'meninggal'")->result();
        $data['rt'] = $this->db->query("SELECT id, `group`, definition AS nama FROM auth_group WHERE `group` LIKE '%rt%'")->result();
        if ($this->form_validation->run() == FALSE) {
		$this->load->view('register', $data);
        } else {
            $this->db->query("ALTER TABLE auth_user AUTO_INCREMENT = 1");
            $this->db->query("ALTER TABLE warga AUTO_INCREMENT = 1");
            $this->warga();            
        }
	}

    private function warga(){
        $input_fields = array(
            'no_kk' => true,
            'no_ktp' => true,
            'nama_lengkap' => true,
            'tgl_lahir' => true,
            // 'email' => true,
            'hp' => true,
            'jenis_kelamin' => true,
            'agama' => true,
            'pendidikan_terakhir' => true,
            'id_profesi' => true,
            'status_warga' => true,
            'id_group' => true
        );
        
        $input_data = $this->input->post(NULL, TRUE);
        $save_data = array_intersect_key($input_data, $input_fields);
        
        $cek = $this->db->query("select * from warga where no_ktp='".$save_data['no_ktp']."'")->row_array();
        // cek NIK
        if($cek){
            $this->session->set_flashdata('peringatan', 'NIK sudah digunakan, silahkan login menggunakan NIK');
                    redirect(site_url(LOGIN_ROUTE));
        } else{
            $tambah = $this->db->insert('warga', $save_data);        
            
            if($tambah){
                $warga = $this->db->query("select * from warga where no_ktp='". $save_data['no_ktp']."'")->row_array();
                    $token =  $this->randomKey();
                    $save_touser['name'] = $save_data['nama_lengkap'];
                    $email = htmlspecialchars($this->input->post('email', true));
                    if($email){
                        $save_touser['email'] = $email;
                    } else{
                        $save_touser['email'] = $this->buat_email($save_data['no_ktp']);
                    }
                    $save_touser['password'] = $this->pass_encrypt($token,$this->input->post('confirm_password'));
                    $save_touser['token'] = $token;
                    $save_touser['is_active'] = "0"; //perlu validasi ketua RT
                    $save_touser['created'] = date('Y-m-d H:i:s');
                    $save_touser['is_delete'] = "0";
                    $save_touser['id_warga'] = $warga['id'];
                    
                    $simpankeuser = $this->db->insert('auth_user', $save_touser);

                    
                    if($simpankeuser){
                        $auth_user = $this->db->query("select * from auth_user where token='".$save_touser['token']."'")->row_array();
                        
                        $save_tousergroup['id_user'] = $auth_user['id_user'];
                        $save_tousergroup['id_group'] = '3'; //ID Group: Warga

                        $this->db->insert('auth_user_to_group', $save_tousergroup);

                        $this->session->set_flashdata('berhasil', 'Silahkan login, jika masih belum bisa harap menunggu validasi dari RT');
                        redirect(site_url(LOGIN_ROUTE));
                    } else{
                        $this->session->set_flashdata('peringatan', 'User sepertinya sudah tersedia, silahkan hubungi admin untuk kata sandi default');
                        redirect(site_url(LOGIN_ROUTE));
                    }
                } else{
                    $this->session->set_flashdata('peringatan', 'NIK sudah digunakan, silahkan login menggunakan NIK');
                    redirect(site_url(LOGIN_ROUTE));
                }
            }
    }

        
}