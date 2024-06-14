<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 11/06/2023 10:08*/
/*| Please DO NOT modify this information*/


class Tb_galeri extends Backend{

private $title = "Galeri";


public function __construct()
{
$config = array(
'title' => $this->title,
);
parent::__construct($config);
$this->load->model("Tb_galeri_model","model");
}

function index()
{
$this->is_allowed('tb_galeri_list');
$this->template->set_title($this->title);
$this->template->view("index");
}

function json()
{
if ($this->input->is_ajax_request()) {
if (!is_allowed('tb_galeri_list')) {
show_error("Access Permission", 403,'403::Access Not Permission');
exit();
}

$list = $this->model->get_datatables();
$data = array();
foreach ($list as $row) {
$rows = array();
$rows[] = '<a href="'.url("tb_galeri_detail/index/".enc_url($row->id)).'" >Tambah Foto</a>';
      $rows[] = $row->nama_kategori;
        $rows[] = $row->nama_galeri;
        $rows[] = substr($row->deskripsi_kegiatan, 0, 10) . '...';
        $rows[] = is_image($row->cover);
        $rows[] = $row->keterangan;
  
$rows[] = '
<div class="btn-group" role="group" aria-label="Basic example">
      <a href="'.url("tb_galeri/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
      <i class="mdi mdi-file"></i>
    </a>
        <a href="'.url("tb_galeri/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
      <i class="ti-pencil"></i>
    </a>
    <a href="'.url("tb_galeri/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  if(!is_allowed('tb_galeri_filter'))
  {
  echo "access not permission";
  }else{
  $this->template->view("filter",[],false);
  }
  }

  function detail($id)
  {
  $this->is_allowed('tb_galeri_detail');
      if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
  $data = array(
            "id_kategori" => $row->nama_kategori,
                "nama_galeri" => $row->nama_galeri,
                "deskripsi_kegiatan" => $row->deskripsi_kegiatan,
                "cover" => $row->cover,
                "status_galeri" => $row->keterangan,
        );
  $this->template->view("view",$data);
  }else{
  $this->error404();
  }
  }

  function add()
  {
  $this->is_allowed('tb_galeri_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("tb_galeri/add_action"),
      'id_kategori' => set_value("id_kategori"),
      'nama_galeri' => set_value("nama_galeri"),
      'deskripsi_kegiatan' => set_value("deskripsi_kegiatan"),
      'cover' => set_value("cover"),
      'status_galeri' => set_value("status_galeri"),
    );
  $this->template->view("add",$data);
  }

  function add_action()
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_galeri_add')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_kategori","* Kategori","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("nama_galeri","* Nama Galeri","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("deskripsi_kegiatan","* Deskripsi kegiatan","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("cover","* Cover","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("status_galeri","* Status galeri","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
                $save_data['id_kategori'] = $this->input->post('id_kategori',true);
                $save_data['nama_galeri'] = $this->input->post('nama_galeri',true);
                $save_data['slug'] = $this->create_slug($this->input->post('nama_galeri',true));
                $save_data['deskripsi_kegiatan'] = $this->input->post('deskripsi_kegiatan',true);
                $save_data['cover'] = $this->imageCopy($this->input->post('cover',true),$_POST['file-dir-cover']);
	            $save_data['status_galeri'] = $this->input->post('status_galeri',true);
  $this->model->insert($save_data);

  set_message("success",cclang("notif_save"));
  $json['redirect'] = url("tb_galeri");
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
  $this->is_allowed('tb_galeri_update');
  if ($row = $this->model->find(dec_url($id))) {
  $this->template->set_title(cclang("update")." ".$this->title);
  $data = array('action' => url("tb_galeri/update_action/$id"),
            'id_kategori' => set_value("id_kategori", $row->id_kategori),
                'nama_galeri' => set_value("nama_galeri", $row->nama_galeri),
                'deskripsi_kegiatan' => set_value("deskripsi_kegiatan", $row->deskripsi_kegiatan),
                'cover' => set_value("cover", $row->cover),
                'status_galeri' => set_value("status_galeri", $row->status_galeri),
        );
  $this->template->view("update",$data);
  }else {
  $this->error404();
  }
  }

  function update_action($id)
  {
  if($this->input->is_ajax_request()){
  if (!is_allowed('tb_galeri_update')) {
  show_error("Access Permission", 403,'403::Access Not Permission');
  exit();
  }

  $json = array('success' => false);
            $this->form_validation->set_rules("id_kategori","* Kategori","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("nama_galeri","* Nama Galeri","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("deskripsi_kegiatan","* Deskripsi kegiatan","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("cover","* Cover","trim|xss_clean|required|htmlspecialchars");
                $this->form_validation->set_rules("status_galeri","* Status galeri","trim|xss_clean|required|htmlspecialchars");
        $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

  if ($this->form_validation->run()) {
                $save_data['id_kategori'] = $this->input->post('id_kategori',true);
                $save_data['nama_galeri'] = $this->input->post('nama_galeri',true);
                $save_data['slug'] = $this->create_slug($this->input->post('nama_galeri',true));
                $save_data['deskripsi_kegiatan'] = $this->input->post('deskripsi_kegiatan',true);
                $save_data['cover'] = $this->imageCopy($this->input->post('cover',true),$_POST['file-dir-cover']);
                $save_data['status_galeri'] = $this->input->post('status_galeri',true);
      
  $save = $this->model->change(dec_url($id), $save_data);

  set_message("success",cclang("notif_update"));

  $json['redirect'] = url("tb_galeri");
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
if (!is_allowed('tb_galeri_delete')) {
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

private function create_slug($string)
{
    $slug = preg_replace('/\s+/', '-', $string);
    $slug = strtolower($slug);
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}


}

/* End of file Tb_galeri.php */
/* Location: ./application/modules/tb_galeri/controllers/backend/Tb_galeri.php */