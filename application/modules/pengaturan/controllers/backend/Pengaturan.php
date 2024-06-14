<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 18/09/2023 14:07*/
/*| Please DO NOT modify this information*/


class Pengaturan extends Backend{

private $title = "Pengaturan";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Pengaturan_model","model");
}

function index()
{
$this->is_allowed('pengaturan_list');
$this->template->set_title($this->title);
$this->template->view("index");
}

function json()
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('pengaturan_list')) {
show_error("Access Permission", 403,'403::Access Not Permission');
exit();
}

$list = $this->model->get_datatables();
$data = array();
foreach ($list as $row) {
$rows = array();
      $rows[] = substr($row->deskripsi_web, 0, 10) . '...';
        $rows[] = substr($row->alamat_gmaps, 0, 10) . '...';
        $rows[] = substr($row->visi, 0, 10) . '...';
        $rows[] = substr($row->misi, 0, 10) . '...';
        $rows[] = is_image($row->foto);
        $rows[] = is_image($row->header);
        $rows[] = $row->marquee;
        $rows[] = $row->tagline;
        $rows[] = substr($row->motto, 0, 10) . '...';
        $rows[] = substr($row->tujuan, 0, 10) . '...';
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("pengaturan/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("pengaturan/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
    </a>
</div>
';

$data[] = $rows;
}

$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->model->count_all(),
"recordsFiltered" => $this->model->count_filtered(),
"data" => $data,
);
//output to json format
return $this->response($output);
}
}


  function detail($id)
  {
  $this->is_allowed('pengaturan_detail');
      if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "deskripsi_web" => $row->deskripsi_web,
                "alamat_gmaps" => $row->alamat_gmaps,
                "visi" => $row->visi,
                "misi" => $row->misi,
                "foto" => $row->foto,
                "header" => $row->header,
                "marquee" => $row->marquee,
                "tagline" => $row->tagline,
                "motto" => $row->motto,
                "tujuan" => $row->tujuan,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }


  function update($id)
  {
  $this->is_allowed('pengaturan_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("pengaturan/update_action/$id"),
            'deskripsi_web' => set_value("deskripsi_web", $row->deskripsi_web),
                'alamat_gmaps' => set_value("alamat_gmaps", $row->alamat_gmaps),
                'visi' => set_value("visi", $row->visi),
                'misi' => set_value("misi", $row->misi),
                'foto' => set_value("foto", $row->foto),
                'header' => set_value("header", $row->header),
                'marquee' => set_value("marquee", $row->marquee),
                'tagline' => set_value("tagline", $row->tagline),
                'motto' => set_value("motto", $row->motto),
                'tujuan' => set_value("tujuan", $row->tujuan),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('pengaturan_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("deskripsi_web","* Deskripsi Web","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("alamat_gmaps","* Alamat gmaps","trim|xss_clean|required");
                $this->form_validation->set_rules("visi","* Visi","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("misi","* Misi","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("foto","* Foto","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("header","* Header","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("marquee","* Marquee","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("tagline","* Tagline","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("motto","* Motto","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("tujuan","* Tujuan","trim|xss_clean|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['deskripsi_web'] = $this->input->post('deskripsi_web',true);
                $save_data['alamat_gmaps'] = $this->input->post('alamat_gmaps',true);
                $save_data['visi'] = $this->input->post('visi',true);
                $save_data['misi'] = $this->input->post('misi',true);
                $save_data['foto'] = $this->imageCopy($this->input->post('foto',true),$_POST['file-dir-foto']);
                $save_data['header'] = $this->imageCopy($this->input->post('header',true),$_POST['file-dir-header']);
                $save_data['marquee'] = $this->input->post('marquee',true);
                $save_data['tagline'] = $this->input->post('tagline',true);
                $save_data['motto'] = $this->input->post('motto',true);
                $save_data['tujuan'] = $this->input->post('tujuan',true);
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = url("pengaturan");
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
if (!is_allowed('pengaturan_delete')) {
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


}

/* End of file Pengaturan.php */
/* Location: ./application/modules/pengaturan/controllers/backend/Pengaturan.php */