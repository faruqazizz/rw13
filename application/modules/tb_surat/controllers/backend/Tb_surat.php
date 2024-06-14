<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 15/05/2023 09:17*/
/*| Please DO NOT modify this information*/


class Tb_surat extends Backend{

private $title = "Surat";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Tb_surat_model","model");
}

function cekakses(){
  if(sess('groupnya')== 3 && empty($id)){
    redirect(ADMIN_ROUTE.'/tb_surat/update/'.enc_url(profile('id_warga')));
  }  
}

function index()
{
if(sess('groupnya')== 3){
    redirect(ADMIN_ROUTE.'/tb_surat/pengajuan/'.enc_url(profile('id_warga')));
}  
$this->is_allowed('tb_surat_list');
$this->template->set_title($this->title);
$this->template->view("index", ["data" => $this->json()]);
}

function pengajuan($id =null)
{
$this->template->set_title($this->title);
$this->template->view("index", ['param' => $id, "data" => $this->json()]);
}

function json()
{
// View
// 1 = baru pengajuan
// 2 = status disahkan RT
//  3 = Revisi dari RT
//  4 Revisi dari RW
// 5 = sudah disahkan RW

// id group 1= admin, 2= RW, 3= warga, 4 dst = RT
if(profile('id_group') == 2){
  $tampilkan = $this->db->query("select tb_surat.id, tb_jenis_surat.nama_surat, warga.no_ktp, tb_surat.nomor_surat, tb_surat.tgl_ajuan, tb_surat.keperluan, tb_status_surat.nama_status, tb_surat.tgl_keputusan, auth_group.group, tb_surat.revisi, tb_surat.date_updated, tb_surat.id_status_surat from tb_surat, warga, tb_status_surat, tb_jenis_surat, auth_group where tb_surat.id_jenis_surat = tb_jenis_surat.id and tb_surat.id_warga = warga.id and tb_surat.id_status_surat = tb_status_surat.id and tb_surat.id_group = auth_group.id and tb_surat.id_status_surat > 1")->result();
} 
elseif(profile('id_group') == 3){
  $tampilkan = $this->db->query("select tb_surat.id, tb_jenis_surat.nama_surat, warga.no_ktp, tb_surat.nomor_surat, tb_surat.tgl_ajuan, tb_surat.keperluan, tb_status_surat.nama_status, tb_surat.tgl_keputusan, auth_group.group, tb_surat.revisi, tb_surat.date_updated, tb_surat.id_status_surat from tb_surat, warga, tb_status_surat, tb_jenis_surat, auth_group where tb_surat.id_jenis_surat = tb_jenis_surat.id and tb_surat.id_warga = warga.id and tb_surat.id_status_surat = tb_status_surat.id and tb_surat.id_group = auth_group.id and tb_surat.id_warga='".profile('id_warga')."'")->result();
} 
elseif(profile('id_group') >= 4){
  $tampilkan = $this->db->query("select tb_surat.id, tb_jenis_surat.nama_surat, warga.no_ktp, tb_surat.nomor_surat, tb_surat.tgl_ajuan, tb_surat.keperluan, tb_status_surat.nama_status, tb_surat.tgl_keputusan, auth_group.group, tb_surat.revisi, tb_surat.date_updated, tb_surat.id_status_surat from tb_surat, warga, tb_status_surat, tb_jenis_surat, auth_group where tb_surat.id_jenis_surat = tb_jenis_surat.id and tb_surat.id_warga = warga.id and tb_surat.id_status_surat = tb_status_surat.id and tb_surat.id_group = auth_group.id and warga.id_group='".sess('groupnya')."'")->result();
} 
else{
  $tampilkan = $this->model->get_datatables();
}

$list = $tampilkan;
$data = array();
foreach ($list as $row) {
        $rows = array();
        if ($row->id_status_surat == 1) {
          $status_surat= '<span class="badge badge-info">' . $row->nama_status . '</span>';
          $cetak_surat = "<small><i>belum bisa dicetak</i></small>";
        } elseif ($row->id_status_surat == 2) {
          $status_surat= '<span class="badge badge-warning">' . $row->nama_status . '</span>';
          $cetak_surat = "<small><i>belum bisa dicetak</i></small>";
        } elseif ($row->id_status_surat == 3 || $row->id_status_surat == 4) {
          $status_surat= '<span class="badge badge-warning">' . $row->nama_status . '</span>';
          $cetak_surat = "<small><i>belum bisa dicetak</i></small>";
        } elseif ($row->id_status_surat == 5) {
          $status_surat= '<span class="badge badge-success">' . $row->nama_status . '</span>';
          $cetak_surat = '<a href="'.base_url("cetak/".enc_url($row->id)).'" class="btn btn-info" title="Cetak PDF"><i class="mdi mdi-download"></i>Unduh</a>';
        }
        $rows[] = $cetak_surat;
        $rows[] = $row->nama_surat;
        $rows[] = $row->no_ktp;
        $rows[] = $row->tgl_ajuan != "" ? date("d-m-Y H:i", strtotime($row->tgl_ajuan)) : "";
        $rows[] = substr($row->keperluan, 0, 10) . '...';
        $rows[] = $status_surat;
        $rows[] = date("d-m-Y", strtotime($row->tgl_keputusan));
        $rows[] = $row->group;
        $rows[] = substr($row->revisi, 0, 10) . '...';

        if(profile('id_group') == 1){
          $tombol ='<div class="btn-group" role="group" aria-label="Administrator">'.
          '<a href="'.url("tb_surat/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'"><i class="mdi mdi-file"></i></a>'.
          '<a href="'.url("tb_surat/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'"><i class="ti-pencil"></i></a>'.
          '<a href="'.url("tb_surat/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'"><i class="ti-trash"></i></a>'.
          '</div>';
        } else{
		if($row->id_status_surat == 5){
		$tombol ='<div class="btn-group" role="group" aria-label="RW">'.
        '<a href="'.url("tb_surat/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'"><i class="mdi mdi-file"></i></a>'.
        '</div>';	
		} 
    else if($row->id_status_surat == 3 AND profile('id_group') == 2){	
          $tombol ='<div class="btn-group" role="group" aria-label="RW">'.
                '<a href="'.url("tb_surat/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'"><i class="mdi mdi-file"></i></a>'.
                '</div>';	
      }  
    else{
		$tombol ='<div class="btn-group" role="group" aria-label="RW">'.
          '<a href="'.url("tb_surat/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'"><i class="mdi mdi-file"></i></a>'.
          '<a href="'.url("tb_surat/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'"><i class="ti-pencil"></i></a>'.
          '</div>';	
		}
        }
        $rows[] = $tombol;
        
        $data[] = $rows;        
}

return $data;
}

  function detail($id)
  {
  $this->is_allowed('tb_surat_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "id_jenis_surat" => $row->nama_surat,
                "id_warga" => $row->no_ktp,
                "nomor_surat" => $row->nomor_surat,
                "no_surat_rw" => $row->no_surat_rw,
                "tgl_ajuan" => $row->tgl_ajuan,
                "keperluan" => $row->keperluan,
                "id_status_surat" => $row->nama_status,
                "tgl_keputusan" => $row->tgl_keputusan,
                "id_group" => $row->group,
                "revisi" => $row->revisi,
                "date_updated" => $row->date_updated,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add()
  {
  $this->is_allowed('tb_surat_add');
  $this->template->set_title(cclang("add")." ".$this->title);

  if(sess('groupnya') == 3){
    // warga
    $warga = profile('id_warga');
    $id_status_surat = 1; //Tahap 1 (Baru diajukan)
    $panggil_warga = $this->db->query("select * from warga where id='".$warga."'")->row();
    $id_group = $panggil_warga->id_group;
  } 
  elseif(sess('groupnya') >= 4){
    // RT
    $warga = null;
    $id_status_surat = 2; //Tahap 2 (Sudah disahkan RT)
    $id_group = profile('id_group');
  } 
  elseif(sess('groupnya') == 2){
    // RT
    $warga = null;
    $id_status_surat = 1; //Tahap 1 (Baru diajukan)
    $id_group = null;
  } 
  else{
    $warga = null;
    $id_status_surat = null;
    $id_group = null;
  }
  $data = array(
      'action' => url("tb_surat/add_action"),
      'id_jenis_surat' => set_value("id_jenis_surat"),
      'id_warga' => set_value("id_warga", $warga),
      'nomor_surat' => set_value("nomor_surat"),
      'tgl_ajuan' => set_value("tgl_ajuan"),
      'keperluan' => set_value("keperluan"),
      'id_status_surat' => set_value("id_status_surat", $id_status_surat),
      'tgl_keputusan' => set_value("tgl_keputusan"),
      'id_group' => set_value("id_group",$id_group),
      'revisi' => set_value("revisi"),
      'date_created' => set_value("date_created"),
      'date_updated' => set_value("date_updated"),
    );
  $this->template->view("add",$data);
  }

  function add_action()
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_surat_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
$this->form_validation->set_rules("id_jenis_surat","* Jenis surat","trim|xss_clean|required|htmlspecialchars");
$this->form_validation->set_rules("id_warga","* Warga","trim|xss_clean|required|htmlspecialchars");
$this->form_validation->set_rules("nomor_surat","* Nomor surat","trim|xss_clean");
$this->form_validation->set_rules("keperluan","* Keperluan","trim|xss_clean|htmlspecialchars");
$this->form_validation->set_rules("id_status_surat","* Status surat","trim|xss_clean|required|htmlspecialchars");
$this->form_validation->set_rules("tgl_keputusan","* Tgl keputusan","trim|xss_clean");
$this->form_validation->set_rules("id_group","* Validator","trim|xss_clean|required|htmlspecialchars");
$this->form_validation->set_rules("revisi","* Revisi","trim|xss_clean|htmlspecialchars");
$this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
  $save_data['id_jenis_surat'] = $this->input->post('id_jenis_surat',true);
  $save_data['id_warga'] = $this->input->post('id_warga',true);
  $save_data['nomor_surat'] = $this->input->post('nomor_surat',true);
  $save_data['tgl_ajuan'] = date("Y-m-d");
  $save_data['keperluan'] = $this->input->post('keperluan',true);
  $save_data['id_status_surat'] = $this->input->post('id_status_surat',true);
  $save_data['tgl_keputusan'] = date("Y-m-d", strtotime($this->input->post('tgl_keputusan', true)));
  $save_data['id_group'] = $this->input->post('id_group',true);
  $save_data['revisi'] = $this->input->post('revisi',true);
  $save_data['date_created'] = date("Y-m-d H:i");
  $save_data['date_updated'] = date("Y-m-d H:i");
  
  if(profile('id_group') == 3):

    $id_warga = profile('id_warga');

    // Panggil dokumen warga dengan id_warga tertentu
    $dok = $this->db->query("SELECT * FROM warga_dokumen WHERE id_warga='".$id_warga."'");
    
    if ($dok->num_rows() > 0) {
        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));
        $json['redirect'] = url("tb_surat/pengajuan/".enc_url($id_warga));
        $json['success'] = true;
    }
    else{
      set_message("warning","Silahkan upload dahulu dokumen persyaratannya!");
      $json['redirect'] = url("tb_surat/pengajuan/".enc_url($id_warga));
      $json['success'] = true;
    }


  else:
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  
  $json['redirect'] = url("tb_surat");
  $json['success'] = true;

  endif;
  
  } else {
    foreach ($_POST as $key => $value) {
    $json['alert'][$key] = form_error($key);
    }
  }

  $this->response($json);
  }
  }

  function update($id)
  {
  $this->is_allowed('tb_surat_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("tb_surat/update_action/$id"),
                'idnya'=> url("tb_surat/hapus_aku/$id"),
                'id_jenis_surat' => set_value("id_jenis_surat", $row->id_jenis_surat),
                'id_warga' => set_value("id_warga", $row->id_warga),
                'nomor_surat' => set_value("nomor_surat", $row->nomor_surat),
                'tgl_ajuan' => set_value("tgl_ajuan", $row->tgl_ajuan),
                'keperluan' => set_value("keperluan", $row->keperluan),
                'id_status_surat' => set_value("id_status_surat", $row->id_status_surat),
                'tgl_keputusan' => $row->tgl_keputusan == "" ? "":date("Y-m-d", strtotime($row->tgl_keputusan)),
                'id_group' => set_value("id_group", $row->id_group),
                'revisi' => set_value("revisi", $row->revisi),
                'no_surat_rw' => set_value("no_surat_rw", $row->no_surat_rw),
                'date_updated' => set_value("date_updated", $row->date_updated),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_surat_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_jenis_surat","* Jenis surat","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_warga","* Warga","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("nomor_surat","* Nomor surat","trim|xss_clean");
                $this->form_validation->set_rules("no_surat_rw","* Nomor surat rw","trim|xss_clean");
                $this->form_validation->set_rules("keperluan","* Keperluan","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("id_status_surat","* Status surat","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("tgl_keputusan","* Tgl keputusan","trim|xss_clean");
                $this->form_validation->set_rules("id_group","* Validator","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("revisi","* Revisi","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_jenis_surat'] = $this->input->post('id_jenis_surat',true);
                $save_data['id_warga'] = $this->input->post('id_warga',true);
                $save_data['nomor_surat'] = $this->input->post('nomor_surat',true);
                $save_data['tgl_ajuan'] = date("Y-m-d");
                $save_data['keperluan'] = $this->input->post('keperluan',true);
                $save_data['id_status_surat'] = $this->input->post('id_status_surat',true);
                $save_data['tgl_keputusan'] = date("Y-m-d", strtotime($this->input->post('tgl_keputusan', true)));
                $save_data['id_group'] = $this->input->post('id_group',true);
                $save_data['revisi'] = $this->input->post('revisi',true);
                $save_data['no_surat_rw'] = $this->input->post('no_surat_rw',true);
                $save_data['date_updated'] = date("Y-m-d H:i");
      
  if(profile('id_group') == 3){
    $redirect= url("tb_surat/pengajuan/".enc_url($id));
    }else{
      $redirect= url("tb_surat");
      }
      
    $save = $this->model->change(dec_url($id), $save_data);
    set_message("success",cclang("notif_update"));
  
    $json['redirect'] = $redirect;
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
if (!is_allowed('tb_surat_delete')) {
return $this->response([
'type_msg' => "error",
'msg' => "do not have permission to access"
]);
}

$this->model->remove(dec_url($id));

  $json['type_msg'] = "success";
  $json['msg'] = cclang("notif_delete");
  
return $this->response($json);
}
}

function hapus_aku($id){
  if (!is_allowed('tb_surat_delete')) {
    return $this->response([
    'type_msg' => "error",
    'msg' => "do not have permission to access"
    ]);
    }
  
  $this->db->query("delete from tb_surat where id = '".dec_url($id)."'");
  
  set_message("success",cclang("notif_delete"));
  redirect(url("tb_surat/pengajuan/".enc_url(profile('id_warga'))));
}

}

/* End of file Tb_surat.php */
/* Location: ./application/modules/tb_surat/controllers/backend/Tb_surat.php */