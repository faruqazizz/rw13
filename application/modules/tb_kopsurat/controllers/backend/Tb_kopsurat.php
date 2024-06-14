<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 07/06/2023 14:41*/
/*| Please DO NOT modify this information*/


class Tb_kopsurat extends Backend{

private $title = "Kop Surat";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Tb_kopsurat_model","model");
}

function index()
{
$this->is_allowed('tb_kopsurat_list');
$this->template->set_title($this->title);
$this->template->view("index");
}

function json()
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('tb_kopsurat_list')) {
show_error("Access Permission", 403,'403::Access Not Permission');
exit();
}

$list = $this->model->get_datatables();
$data = array();
foreach ($list as $row) {
$rows = array();
      $rows[] = $row->group;
        $rows[] = is_image($row->gambar_kop);
        $rows[] = $row->nama;
        $rows[] = substr($row->alamat, 0, 10) . '...';
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("tb_kopsurat/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("tb_kopsurat/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
    </a>
    <a href="'.url("tb_kopsurat/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
    <i class="ti-trash"></i>
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
  $this->is_allowed('tb_kopsurat_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "id_group" => $row->group,
                "gambar_kop" => $row->gambar_kop,
                "nama" => $row->nama,
                "alamat" => $row->alamat,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add()
  {
  $this->is_allowed('tb_kopsurat_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("tb_kopsurat/add_action"),
      'id_group' => set_value("id_group"),
      'gambar_kop' => set_value("gambar_kop"),
      'nama' => set_value("nama"),
      'alamat' => set_value("alamat"),
    );
  $this->template->view("add",$data);
  }

  function add_action()
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_kopsurat_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_group","* RT","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("gambar_kop","* Gambar Kop","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("nama","* RT Berapa","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("alamat","* Alamat","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_group'] = $this->input->post('id_group',true);
                $save_data['gambar_kop'] = $this->imageCopy($this->input->post('gambar_kop',true),$_POST['file-dir-gambar_kop']);
	            $save_data['nama'] = $this->input->post('nama',true);
                $save_data['alamat'] = $this->input->post('alamat',true);
      
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  $json['redirect'] = url("tb_kopsurat");
  $json['success'] = true;
  }else {
  foreach ($_POST as $key => $value) {
  $json['alert'][$key] = form_error($key);
  }
  }

  $this->response($json);
  }
  }

  function update($id)
  {
  $this->is_allowed('tb_kopsurat_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("tb_kopsurat/update_action/$id"),
            'id_group' => set_value("id_group", $row->id_group),
                'gambar_kop' => set_value("gambar_kop", $row->gambar_kop),
                'nama' => set_value("nama", $row->nama),
                'alamat' => set_value("alamat", $row->alamat),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_kopsurat_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_group","* RT","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("gambar_kop","* Gambar Kop","trim|xss_clean|htmlspecialchars");
                $this->form_validation->set_rules("nama","* RT Berapa","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("alamat","* Alamat","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_group'] = $this->input->post('id_group',true);
                $save_data['gambar_kop'] = $this->imageCopy($this->input->post('gambar_kop',true),$_POST['file-dir-gambar_kop']);
                $save_data['nama'] = $this->input->post('nama',true);
                $save_data['alamat'] = $this->input->post('alamat',true);
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = url("tb_kopsurat");
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
if (!is_allowed('tb_kopsurat_delete')) {
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

/* End of file Tb_kopsurat.php */
/* Location: ./application/modules/tb_kopsurat/controllers/backend/Tb_kopsurat.php */