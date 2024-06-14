<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 18/09/2023 19:42*/
/*| Please DO NOT modify this information*/


class Sambutan extends Backend{

private $title = "Sambutan";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Sambutan_model","model");
}

function index()
{
$this->is_allowed('sambutan_list');
$this->template->set_title($this->title);
$this->template->view("index");
}

function json()
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('sambutan_list')) {
show_error("Access Permission", 403,'403::Access Not Permission');
exit();
}

$list = $this->model->get_datatables();
$data = array();
foreach ($list as $row) {
$rows = array();
      $rows[] = $row->judul_sambutan;
        $rows[] = $row->name;
        $rows[] = is_image($row->foto_diri);
        $rows[] = substr($row->sambutan_teks, 0, 100) . '...';
        // $rows[] = $row->dokumentasi_lain;
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("sambutan/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("sambutan/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
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
  $this->is_allowed('sambutan_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "judul_sambutan" => $row->judul_sambutan,
                "nama_rw" => $row->name,
                "foto_diri" => $row->foto_diri,
                "sambutan_teks" => $row->sambutan_teks,
                "dokumentasi_lain" => $row->dokumentasi_lain,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }


  function update($id)
  {
  $this->is_allowed('sambutan_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("sambutan/update_action/$id"),
            'judul_sambutan' => set_value("judul_sambutan", $row->judul_sambutan),
                'nama_rw' => set_value("nama_rw", $row->nama_rw),
                'foto_diri' => set_value("foto_diri", $row->foto_diri),
                'sambutan_teks' => set_value("sambutan_teks", $row->sambutan_teks),
                'dokumentasi_lain' => set_value("dokumentasi_lain", $row->dokumentasi_lain),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('sambutan_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("judul_sambutan","* Judul sambutan","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("nama_rw","* Ketua RW","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("foto_diri","* Foto Diri","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("sambutan_teks","* Sambutan","required");
                $this->form_validation->set_rules("dokumentasi_lain","* Dokumentasi Lain","trim|xss_clean|valid_url");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
            $save_data['judul_sambutan'] = $this->input->post('judul_sambutan',true);
                $save_data['nama_rw'] = $this->input->post('nama_rw',true);
                $save_data['foto_diri'] = $this->imageCopy($this->input->post('foto_diri',true),$_POST['file-dir-foto_diri']);
                $save_data['sambutan_teks'] = $this->input->post('sambutan_teks',true);
                $save_data['dokumentasi_lain'] = $this->input->post('dokumentasi_lain',true);
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = url("sambutan");
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
if (!is_allowed('sambutan_delete')) {
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

/* End of file Sambutan.php */
/* Location: ./application/modules/sambutan/controllers/backend/Sambutan.php */