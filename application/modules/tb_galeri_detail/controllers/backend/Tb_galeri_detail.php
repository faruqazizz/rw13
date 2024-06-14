<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 10/06/2023 18:00*/
/*| Please DO NOT modify this information*/


class Tb_galeri_detail extends Backend{

private $title = "Galeri Detail";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Tb_galeri_detail_model","model");
}

function index($id)
{
$this->is_allowed('tb_galeri_detail_list');
$row = $this->db->query("select * from tb_galeri where tb_galeri.id ='".dec_url($id)."'")->row();

$this->template->set_title($this->title);
$this->template->view("index", ['param' => $row]);
}

function json($param=null)
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('tb_galeri_detail_list')) {
show_error("Access Permission", 403,'403::Access Not Permission');
exit();
}

$list = $this->db->query("select * from tb_galeri_detail where id_galeri='".dec_url($param)."'")->result();
$data = array();
foreach ($list as $row) {
$rows = array();
        $rows[] = is_image($row->file);
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("tb_galeri_detail/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("tb_galeri_detail/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
    </a>
    <a href="'.url("tb_galeri_detail/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  $this->is_allowed('tb_galeri_detail_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "id_galeri" => $row->nama_galeri,
                "file" => $row->file,
                "idgaleri" => enc_url($row->id_galeri)
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add($id)
  {
  $this->is_allowed('tb_galeri_detail_add');

    $this->template->set_title(cclang("add")." ".$this->title);
    $data = array(
        'action' => url("tb_galeri_detail/add_action/".$id),
        'id_galeri' => set_value("id_galeri"),
        'file' => set_value("file"),
        'idgaleri' => dec_url($id)
      );
    $this->template->view("add",$data);

  }

  function add_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_galeri_detail_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_galeri","* Id galeri","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("file","* File","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_galeri'] = $this->input->post('id_galeri',true);
                $save_data['file'] = $this->imageCopy($this->input->post('file',true),$_POST['file-dir-file']);
	  
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  $json['redirect'] = url("tb_galeri_detail/index/" . $id);
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
  $this->is_allowed('tb_galeri_detail_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("tb_galeri_detail/update_action/$id"),
            'id_galeri' => set_value("id_galeri", $row->id_galeri),
                'file' => set_value("file", $row->file),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_galeri_detail_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_galeri","* Id galeri","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("file","* File","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['id_galeri'] = $this->input->post('id_galeri',true);
                $save_data['file'] = $this->imageCopy($this->input->post('file',true),$_POST['file-dir-file']);
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = url("tb_galeri_detail/index/" . enc_url($save_data['id_galeri']));
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
if (!is_allowed('tb_galeri_detail_delete')) {
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

/* End of file Tb_galeri_detail.php */
/* Location: ./application/modules/tb_galeri_detail/controllers/backend/Tb_galeri_detail.php */