<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 08/05/2023 08:32*/
/*| Please DO NOT modify this information*/


class Tb_jenis_surat extends Backend{

private $title = "Jenis Surat";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Tb_jenis_surat_model","model");
}

function index()
{
$this->is_allowed('tb_jenis_surat_list');
$this->template->set_title($this->title);
$this->template->view("index");
}

function json()
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('tb_jenis_surat_list')) {
show_error("Access Permission", 403,'403::Access Not Permission');
exit();
}

$list = $this->model->get_datatables();
$data = array();
foreach ($list as $row) {
$rows = array();
      $rows[] = $row->nama_surat;
      
    $rows[] = is_document($row->contoh_dokumen);
        $rows[] = $row->date_created != "" ? date("d-m-Y H:i", strtotime($row->date_created)) : "";
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("tb_jenis_surat/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("tb_jenis_surat/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
    </a>
    <a href="'.url("tb_jenis_surat/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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

  function filter()
  {
  if(!is_allowed('tb_jenis_surat_filter'))
  {
  echo "access not permission";
  }else{
  $this->template->view("filter",[],false);
  }
  }

  function detail($id)
  {
  $this->is_allowed('tb_jenis_surat_detail');
      if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "nama_surat" => $row->nama_surat,
                "contoh_dokumen" => $row->contoh_dokumen,
                "date_created" => $row->date_created,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add()
  {
  $this->is_allowed('tb_jenis_surat_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("tb_jenis_surat/add_action"),
      'nama_surat' => set_value("nama_surat"),
      'contoh_dokumen' => set_value("contoh_dokumen"),
      'date_created' => set_value("date_created"),
    );
  $this->template->view("add",$data);
  }

  function add_action()
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_jenis_surat_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("nama_surat","* Nama surat","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("contoh_dokumen","* Contoh Dokumen","trim|xss_clean|required");
              $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['nama_surat'] = $this->input->post('nama_surat',true);
                $save_data['contoh_dokumen'] = $this->imageCopy($this->input->post('contoh_dokumen',true),$_POST['file-dir-contoh_dokumen']);
                $save_data['date_created'] = date("Y-m-d H:i");
      
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  $json['redirect'] = url("tb_jenis_surat");
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
  $this->is_allowed('tb_jenis_surat_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("tb_jenis_surat/update_action/$id"),
            'nama_surat' => set_value("nama_surat", $row->nama_surat),
                'contoh_dokumen' => set_value("contoh_dokumen", $row->contoh_dokumen),
                'date_created' => set_value("date_created", $row->date_created),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_jenis_surat_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("nama_surat","* Nama surat","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("contoh_dokumen","* Contoh Dokumen","trim|xss_clean|required");
              $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['nama_surat'] = $this->input->post('nama_surat',true);
                $save_data['contoh_dokumen'] = $this->imageCopy($this->input->post('contoh_dokumen',true),$_POST['file-dir-contoh_dokumen']);
                $save_data['date_created'] = date("Y-m-d H:i");
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = url("tb_jenis_surat");
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
if (!is_allowed('tb_jenis_surat_delete')) {
return $this->response([
'type_msg' => "error",
'msg' => "do not have permission to access"
]);
}
$getimg = $this->db->query("select * from tb_jenis_surat where id='".dec_url($id)."'")->row();
if($getimg){
  $this->imageRemove($getimg->contoh_dokumen, false);
  $this->delete_file($getimg->contoh_dokumen);
}
$this->model->remove(dec_url($id));
$this->db->query("ALTER TABLE tb_jenis_surat AUTO_INCREMENT = 1");
$json['type_msg'] = "success";
$json['msg'] = cclang("notif_delete");


return $this->response($json);
}
}

// hapus juga baris di filemanager
private function delete_file($file_name) {
  $this->db->where('file_name', $file_name);
  $this->db->delete('filemanager');
}

}

/* End of file Tb_jenis_surat.php */
/* Location: ./application/modules/tb_jenis_surat/controllers/backend/Tb_jenis_surat.php */