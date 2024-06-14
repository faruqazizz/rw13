<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Warga extends Backend{

private $title = "Warga";

public function __construct()
{
  $config = array(
    'title' => $this->title,
  );
  parent::__construct($config);
  $this->load->helper("sct");
  $this->load->model("Warga_model","model");
}

function cekakses(){
  if(sess('groupnya')== 3 && empty($id)){
    redirect(ADMIN_ROUTE.strtolower('/'.$this->title).'/'.'update/'.enc_url(profile('id_warga')));
  }  
}

function index()
{
$this->cekakses();
$this->is_allowed('warga_list');
$this->template->set_title($this->title);
// cek apakah ini Rw atau bukan
$rw = $this->db->query("select warga.id as idwarga from warga, auth_user, auth_user_to_group where auth_user.id_warga = warga.id and auth_user.id_user = auth_user_to_group.id_user and auth_user_to_group.id_group = 2")->row();
$list = $this->model->get_datatables();
$data = array();
foreach ($list as $row) {
$rows = array();
          
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("warga/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
      </a>
        <a href="'.url("warga/update/".enc_url($row->id)).'"'.(profile('id_group') <= 2?"":$row->id == $rw->idwarga?"style='display:none'":"").' id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
      </a>
      <a href="'.url("warga/delete/".enc_url($row->id)).'" '.($row->id == $rw->idwarga?"style='display:none'":"").' id="delete" class="btn btn-danger" title="'.cclang("delete").'">
          <i class="ti-trash"></i>
        </a>
      <a href="'.url("warga/buat_user/".enc_url($row->id)).'" id="buat_user" class="btn btn-dark" title="Buat User">
      <i class="mdi mdi-account"></i>
      </a>
</div>';

        $rows[] = url("warga_dokumen/lihat/".enc_url($row->id));
        $rows[] = $row->no_kk;
        $rows[] = $row->no_ktp;
        $rows[] = $row->nama_lengkap;
        $rows[] = $row->tempat_lahir;
        $rows[] = date("d-m-Y", strtotime($row->tgl_lahir));
        $rows[] = $row->hp . '|'. $row->id;
        $rows[] = $row->nakel;
        $rows[] = $row->naag;
        $rows[] = $row->napen;
        $rows[] = $row->profesi;
        $rows[] = strtoupper($row->group);
        $rows[] = $row->alamat;
        $rows[] = $row->nama_stts_warga;

$data[] = $rows;
}

$this->template->view("index", ['data' => $data]);
}

  function detail($id)
  {
  $this->is_allowed('warga_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "no_kk" => $row->no_kk,
                "no_ktp" => $row->no_ktp,
                "nama_lengkap" => $row->nama_lengkap,
                "tempat_lahir" => $row->tempat_lahir,
                "tgl_lahir" => $row->tgl_lahir,
                "hp" => $row->hp,
                "jenis_kelamin" => $row->nakel,
                "agama" => $row->naag,
                "pendidikan_terakhir" => $row->napen,
                "id_profesi" => $row->profesi,
                "id_group" => $row->group,
                "alamat" => $row->alamat,
                "foto_profil" => $row->foto_profil,
                "ttd_digital" => $row->ttd_digital,
                "link_drive" => $row->link_drive,
                "status_warga" => $row->nama_stts_warga,
                "tgl_dibuat" => $row->tgl_dibuat,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add()
  {
  $this->cekakses();
  $this->is_allowed('warga_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("warga/add_action"),
      'no_kk' => set_value("no_kk"),
      'no_ktp' => set_value("no_ktp"),
      'nama_lengkap' => set_value("nama_lengkap"),
      'tempat_lahir' => set_value("tempat_lahir"),
      'tgl_lahir' => set_value("tgl_lahir"),
      'hp' => set_value("hp"),
      'jenis_kelamin' => set_value("jenis_kelamin"),
      'agama' => set_value("agama"),
      'pendidikan_terakhir' => set_value("pendidikan_terakhir"),
      'id_profesi' => set_value("id_profesi"),
      'id_group' => set_value("id_group"),
      'alamat' => set_value("alamat"),
      'foto_profil' => set_value("foto_profil"),
      'ttd_digital' => set_value("ttd_digital"),
      'link_drive' => set_value("link_drive"),
      'status_warga' => set_value("status_warga"),
      'tgl_dibuat' => set_value("tgl_dibuat"),
    );
  $this->template->view("add",$data);
  }

  function add_action()
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('warga_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("no_kk","* No KK","trim|xss_clean|required|htmlspecialchars|numeric");
                $this->form_validation->set_rules("no_ktp","* No KTP","trim|xss_clean|required|htmlspecialchars|numeric|is_unique[warga.no_ktp]");
                $this->form_validation->set_rules("nama_lengkap","* Nama Lengkap","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("tempat_lahir","* Tempat Lahir","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("tgl_lahir","* Tgl Lahir","trim|xss_clean|required");
                $this->form_validation->set_rules("hp","* Nomor Handphone","trim|xss_clean|required|htmlspecialchars|numeric");
                $this->form_validation->set_rules("jenis_kelamin","* Jenis kelamin","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("agama","* Agama","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("pendidikan_terakhir","* Pendidikan Terakhir","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_profesi","* Profesi","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_group","* RT","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("alamat","* Alamat (No Rumah)","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("foto_profil","* Foto Profil","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("ttd_digital","* Tandatangan Digital","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("link_drive","* Link Berkas","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("status_warga","* Status","trim|xss_clean|required|htmlspecialchars");
              $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['no_kk'] = $this->input->post('no_kk',true);
                $save_data['no_ktp'] = $this->input->post('no_ktp',true);
                $save_data['nama_lengkap'] = $this->input->post('nama_lengkap',true);
                $save_data['tempat_lahir'] = $this->input->post('tempat_lahir',true);
                $save_data['tgl_lahir'] = date("Y-m-d", strtotime($this->input->post('tgl_lahir', true)));
                $save_data['hp'] = $this->input->post('hp',true);
                $save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
                $save_data['agama'] = $this->input->post('agama',true);
                $save_data['pendidikan_terakhir'] = $this->input->post('pendidikan_terakhir',true);
                $save_data['id_profesi'] = $this->input->post('id_profesi',true);
                $save_data['id_group'] = $this->input->post('id_group',true);
                $save_data['alamat'] = $this->input->post('alamat',true);
                $save_data['foto_profil'] = $this->imageCopy($this->input->post('foto_profil',true),$_POST['file-dir-foto_profil']);
	            $save_data['ttd_digital'] = $this->imageCopy($this->input->post('ttd_digital',true),$_POST['file-dir-ttd_digital']);
	            $save_data['link_drive'] = $this->input->post('link_drive',true);
                $save_data['status_warga'] = $this->input->post('status_warga',true);
                $save_data['tgl_dibuat'] = date("Y-m-d H:i");
      
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  $json['redirect'] = url("warga");
  $json['success'] = true;
  }else {
  foreach ($_POST as $key => $value) {
  $json['alert'][$key] = form_error($key);
  }
  }

  $this->response($json);
  }
  }

  function lihat($id =null)
  {
  if(empty($id)):
  $this->cekakses();  
  endif;
  $this->update($id);
  }

  function update($id)
  {
  $this->is_allowed('warga_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  if(profile('id_group') == 3){
    $kembali = 'javascript:window.history.go(-1);';
  } else{
    $kembali = url($this->uri->segment(2));
  }
  $data = array('action' => url("warga/update_action/$id"),
  'kembali' => $kembali,
            'no_kk' => set_value("no_kk", $row->no_kk),
                'no_ktp' => set_value("no_ktp", $row->no_ktp),
                'nama_lengkap' => set_value("nama_lengkap", $row->nama_lengkap),
                'tempat_lahir' => set_value("tempat_lahir", $row->tempat_lahir),
                'tgl_lahir' => $row->tgl_lahir == "" ? "":date("Y-m-d", strtotime($row->tgl_lahir)),
                'hp' => set_value("hp", $row->hp),
                'jenis_kelamin' => set_value("jenis_kelamin", $row->jenis_kelamin),
                'agama' => set_value("agama", $row->agama),
                'pendidikan_terakhir' => set_value("pendidikan_terakhir", $row->pendidikan_terakhir),
                'id_profesi' => set_value("id_profesi", $row->id_profesi),
                'id_group' => set_value("id_group", $row->id_group),
                'alamat' => set_value("alamat", $row->alamat),
                'foto_profil' => set_value("foto_profil", $row->foto_profil),
                'ttd_digital' => set_value("ttd_digital", $row->ttd_digital),
                'link_drive' => set_value("link_drive", $row->link_drive),
                'status_warga' => set_value("status_warga", $row->status_warga),
                'tgl_dibuat' => set_value("tgl_dibuat", $row->tgl_dibuat),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('warga_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("no_kk","* No KK","trim|xss_clean|required|htmlspecialchars|numeric");
                $this->form_validation->set_rules("no_ktp","* No KTP","trim|xss_clean|required|htmlspecialchars|numeric");
                $this->form_validation->set_rules("nama_lengkap","* Nama Lengkap","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("tempat_lahir","* Tempat Lahir","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("tgl_lahir","* Tgl Lahir","trim|xss_clean|required");
                $this->form_validation->set_rules("hp","* Nomor Handphone","trim|xss_clean|required|htmlspecialchars|numeric");
                $this->form_validation->set_rules("jenis_kelamin","* Jenis kelamin","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("agama","* Agama","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("pendidikan_terakhir","* Pendidikan Terakhir","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_profesi","* Profesi","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_group","* RT","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("alamat","* Alamat (No Rumah)","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("foto_profil","* Foto Profil","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("ttd_digital","* Tandatangan Digital","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("link_drive","* Link Berkas","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("status_warga","* Status","trim|xss_clean|required|htmlspecialchars");
              $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
                $save_data['no_kk'] = $this->input->post('no_kk',true);
                $save_data['no_ktp'] = $this->input->post('no_ktp',true);
                $save_data['nama_lengkap'] = $this->input->post('nama_lengkap',true);
                $save_data['tempat_lahir'] = $this->input->post('tempat_lahir',true);
                $save_data['tgl_lahir'] = date("Y-m-d", strtotime($this->input->post('tgl_lahir', true)));
                $save_data['hp'] = $this->input->post('hp',true);
                $save_data['jenis_kelamin'] = $this->input->post('jenis_kelamin',true);
                $save_data['agama'] = $this->input->post('agama',true);
                $save_data['pendidikan_terakhir'] = $this->input->post('pendidikan_terakhir',true);
                $save_data['id_profesi'] = $this->input->post('id_profesi',true);
                $save_data['id_group'] = $this->input->post('id_group',true);
                $save_data['alamat'] = $this->input->post('alamat',true);
                $save_data['foto_profil'] = $this->imageCopy($this->input->post('foto_profil',true),$_POST['file-dir-foto_profil']);
                $save_data['ttd_digital'] = $this->imageCopy($this->input->post('ttd_digital',true),$_POST['file-dir-ttd_digital']);
                $save_data['link_drive'] = $this->input->post('link_drive',true);
                $save_data['status_warga'] = $this->input->post('status_warga',true);
                $save_data['tgl_dibuat'] = date("Y-m-d H:i");
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  if(profile('id_group') == 3){
    $update['name'] = $this->input->post('nama_lengkap',true);
    $update['photo'] = $this->imageCopy($this->input->post('foto_profil',true),$_POST['file-dir-foto_profil']);

    $this->model->get_update("auth_user",$update,["id_user"=>profile('id_user')]);
    $json['redirect'] = url("warga/update/".enc_url(profile('id_warga')));
  } else{
    $json['redirect'] = url("warga");
  }
  $json['success'] = true;
  }else {
  foreach ($_POST as $key => $value) {
  $json['alert'][$key] = form_error($key);
  }
  }

  $this->response($json);
  }
  }

function delete($id)
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('warga_delete')) {
return $this->response([
'type_msg' => "error",
'msg' => "do not have permission to access"
]);
}

$panggil= $this->db->query("SELECT * FROM auth_user WHERE id_warga='".dec_url($id)."'")->row(); 
// Remove dulu user
if($panggil){
  delete_user($panggil->id_user);
}
$this->model->remove(dec_url($id));
$json['type_msg'] = "success";
$json['msg'] = cclang("notif_delete");


return $this->response($json);
}
}

function buat_user($id){
  $auth = $this->db->query("select * from warga, auth_user where warga.id = auth_user.id_warga and warga.id='".dec_url($id)."'")->row_array();
  $token = randomKey();
  if($auth){
    if($auth['is_delete'] == "1"){
                        $this->db->query("UPDATE `auth_user` SET `modified` = '".date('Y-m-d H:i:s')."', `is_delete` = '0', `token`='".$token."', `password`='".pass_encrypt($token, $auth['no_ktp'])."', `email`='".$this->buat_email($auth['no_ktp'])."' WHERE `auth_user`.`id_user` ='".$auth['id_user']."'");
                        set_message("success","Silahkan login kembali, Username dan Password= No KTP");
                        redirect(ADMIN_ROUTE.'/warga');
                      } else{
                        set_message("warning","Warga sudah terdapat usernya");
                        redirect(ADMIN_ROUTE.'/warga');
                      }
                    } else{
                    $warga = $this->db->query("select * from warga where id='".dec_url($id)."'")->row_array();
                    $save_touser['name'] = $warga['nama_lengkap'];
                    $save_touser['photo'] = $warga['foto_profil'];
                    $save_touser['email'] = $this->buat_email($warga['no_ktp']);
                    $save_touser['password'] = pass_encrypt($token, $warga['no_ktp']);
                    $save_touser['token'] = $token;
                    $save_touser['is_active'] = "1"; //jika di halaman admin berarti sudah validasi ketua RT
                    $save_touser['created'] = date('Y-m-d H:i:s');
                    $save_touser['modified'] = date('Y-m-d H:i:s');
                    $save_touser['is_delete'] = "0";
                    $save_touser['id_warga'] = dec_url($id);

                    $simpankeuser = $this->db->insert('auth_user', $save_touser);
                    
                    
                    if($simpankeuser){
                        $auth_user = $this->db->query("select * from auth_user where token='".$save_touser['token']."'")->row_array();
                        
                        $save_tousergroup['id_user'] = $auth_user['id_user'];
                        $save_tousergroup['id_group'] = '3'; //ID Group: Warga

                        $this->db->insert('auth_user_to_group', $save_tousergroup);

                        set_message("success","User sudah terbuat");
                        redirect(ADMIN_ROUTE.'/warga');
                      } else{
                        set_message("warning","Tidak bisa buat user");
                        redirect(ADMIN_ROUTE.'/warga');
                    }
                  }
}

private function buat_email($param){
  $emailnya_ini= $this->db->query("select * from setting where id_setting=10")->row();
  return $param = $param . $emailnya_ini->value;
}


}

/* End of file Warga.php */
/* Location: ./application/modules/warga/controllers/backend/Warga.php */