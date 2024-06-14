<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 13/05/2023 17:41*/
/*| Please DO NOT modify this information*/


class Warga_dokumen extends Backend{

private $title = "Dokumen Warga";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Warga_dokumen_model","model");
}

function cekakses(){
  if(sess('groupnya')== 3 && empty($id)){
    redirect(ADMIN_ROUTE.'/warga_dokumen/lihat/'.enc_url(profile('id_warga')));
  }  
}

function index()
{
$this->cekakses();
$this->is_allowed('warga_dokumen_list');
$this->template->set_title($this->title);
$this->template->view("index");
}

function lihat($id =null)
{
if(empty($id)):
$this->cekakses();  
endif;
$this->template->set_title($this->title);
$this->template->view("index", ['param' => $id]);
}

function json($param=null)
{
if ($this->input->is_ajax_request()) {

$idnya = $param ? $param : null;
if(!$idnya){
  $list = $this->model->get_datatables();
} else{
$this->db->select('warga_dokumen.*, warga_syarat_dokumen.syarat_dokumen');
$this->db->from('warga_dokumen');
$this->db->join('warga_syarat_dokumen', 'warga_dokumen.id_syarat_dokumen = warga_syarat_dokumen.id');
$this->db->where('warga_dokumen.id_warga', dec_url($idnya));

$query = $this->db->get();
$list = $query->result();
}
$data = array();
foreach ($list as $row) {
$rows = array();
      $rows[] = $row->syarat_dokumen;
      
    $rows[] = is_document($row->lokasi_dokumen);
        $rows[] = $row->datecreated != "" ? date("d-m-Y H:i", strtotime($row->datecreated)) : "";
        $rows[] = $row->datemodified != "" ? date("d-m-Y H:i", strtotime($row->datemodified)) : "";
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("warga_dokumen/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("warga_dokumen/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
    </a>
    <a href="'.url("warga_dokumen/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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


  function detail($id=null)
  {
    if(empty($id)):
      $this->cekakses();  
      endif;
  $this->is_allowed('warga_dokumen_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "id_warga" => $row->id_warga,
                "id_syarat_dokumen" => $row->syarat_dokumen,
                "lokasi_dokumen" => $row->lokasi_dokumen,
                "datecreated" => $row->datecreated,
                "datemodified" => $row->datemodified,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add($id= null)
  {
    if(empty($id)):
      $this->cekakses();  
    endif;
  $this->is_allowed('warga_dokumen_add');
  $this->template->set_title(cclang("add")." ".$this->title);

  $data = array('action' => url("warga_dokumen/add_action"),
      'id_warga' => set_value("id_warga", dec_url($id)),
      'id_syarat_dokumen' => set_value("id_syarat_dokumen"),
      'lokasi_dokumen' => set_value("lokasi_dokumen"),
      'datecreated' => set_value("datecreated"),
      'datemodified' => set_value("datemodified"),
    );
  $this->template->view("add",$data);
  }

  function add_action()
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('warga_dokumen_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_warga","* Warga","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_syarat_dokumen","* Syarat Dokumen","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("lokasi_dokumen","* Lokasi Dokumen","trim|xss_clean|required");
                    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_warga'] = $this->input->post('id_warga',true);
                $save_data['id_syarat_dokumen'] = $this->input->post('id_syarat_dokumen',true);
                $save_data['lokasi_dokumen'] = $this->imageCopy($this->input->post('lokasi_dokumen',true),$_POST['file-dir-lokasi_dokumen']);
                $save_data['datecreated'] = date("Y-m-d H:i");
                $save_data['datemodified'] = date("Y-m-d H:i");
      
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  $json['redirect'] = 'javascript:window.history.go(-1);';
  $json['success'] = true;
  }else {
  foreach ($_POST as $key => $value) {
  $json['alert'][$key] = form_error($key);
  }
  }

  $this->response($json);
  }
  }

  function update($id = null)
  {
    if(empty($id)):
      $this->cekakses();  
    endif;
  $this->is_allowed('warga_dokumen_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("warga_dokumen/update_action/$id"),
            'id_warga' => set_value("id_warga", $row->id_warga),
                'id_syarat_dokumen' => set_value("id_syarat_dokumen", $row->id_syarat_dokumen),
                'lokasi_dokumen' => set_value("lokasi_dokumen", $row->lokasi_dokumen),
                'datecreated' => set_value("datecreated", $row->datecreated),
                'datemodified' => set_value("datemodified", $row->datemodified),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('warga_dokumen_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_warga","* Warga","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("id_syarat_dokumen","* Syarat Dokumen","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("lokasi_dokumen","* Lokasi Dokumen","trim|xss_clean|required");
                    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_warga'] = $this->input->post('id_warga',true);
                $save_data['id_syarat_dokumen'] = $this->input->post('id_syarat_dokumen',true);
                $save_data['lokasi_dokumen'] = $this->imageCopy($this->input->post('lokasi_dokumen',true),$_POST['file-dir-lokasi_dokumen']);
                $save_data['datecreated'] = date("Y-m-d H:i");
                $save_data['datemodified'] = date("Y-m-d H:i");
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = 'javascript:window.history.go(-1);';
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
if (!is_allowed('warga_dokumen_delete')) {
return $this->response([
'type_msg' => "error",
'msg' => "do not have permission to access"
]);
}
$getimg = $this->db->query("select * from warga_dokumen where id='".dec_url($id)."'")->row();
if($getimg){
  $this->imageRemove($getimg->lokasi_dokumen, false);
  $this->delete_file($getimg->lokasi_dokumen);
}
$this->model->remove(dec_url($id));
$this->db->query("ALTER TABLE warga_dokumen AUTO_INCREMENT = 1");
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

/* End of file Warga_dokumen.php */
/* Location: ./application/modules/warga_dokumen/controllers/backend/Warga_dokumen.php */