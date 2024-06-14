<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 16/04/2023 16:17*/
/*| Please DO NOT modify this information*/


class Fotofoto extends Backend{

private $title = "Foto Dokumen";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Fotofoto_model","model");
}

function index()
{
  $this->is_allowed('fotofoto_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('fotofoto_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = $row->judul_foto;
                $rows[] = is_image($row->lokasi_foto);
                $rows[] = $row->link_berkas;
                $rows[] = $row->nama_halaman;
        
        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("fotofoto/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("fotofoto/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("fotofoto/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  if(!is_allowed('fotofoto_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('fotofoto_detail');
    if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $data = array(
          "judul_foto" => $row->judul_foto,
          "lokasi_foto" => $row->lokasi_foto,
          "link_berkas" => $row->link_berkas,
          "id_halaman" => $row->nama_halaman,
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('fotofoto_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("fotofoto/add_action"),
                  'judul_foto' => set_value("judul_foto"),
                  'lokasi_foto' => set_value("lokasi_foto"),
                  'link_berkas' => set_value("link_berkas"),
                  'id_halaman' => set_value("id_halaman"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('fotofoto_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("judul_foto","* Judul foto","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("lokasi_foto","* Lokasi foto","trim|xss_clean|required");
    $this->form_validation->set_rules("link_berkas","* Link berkas","trim|xss_clean|valid_url");
    $this->form_validation->set_rules("id_halaman","* Untuk Halaman","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['judul_foto'] = $this->input->post('judul_foto',true);
      $save_data['lokasi_foto'] = $this->imageCopy($this->input->post('lokasi_foto',true),$_POST['file-dir-lokasi_foto']);
      $save_data['link_berkas'] = $this->input->post('link_berkas',true);
      $save_data['id_halaman'] = $this->input->post('id_halaman',true);

      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("fotofoto");
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
  $this->is_allowed('fotofoto_update');
  if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("fotofoto/update_action/$id"),
                  'judul_foto' => set_value("judul_foto", $row->judul_foto),
                  'lokasi_foto' => set_value("lokasi_foto", $row->lokasi_foto),
                  'link_berkas' => set_value("link_berkas", $row->link_berkas),
                  'id_halaman' => set_value("id_halaman", $row->id_halaman),
                  );
    $this->template->view("update",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('fotofoto_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("judul_foto","* Judul foto","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("lokasi_foto","* Lokasi foto","trim|xss_clean|required");
    $this->form_validation->set_rules("link_berkas","* Link berkas","trim|xss_clean|valid_url");
    $this->form_validation->set_rules("id_halaman","* Untuk Halaman","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['judul_foto'] = $this->input->post('judul_foto',true);
      $save_data['lokasi_foto'] = $this->imageCopy($this->input->post('lokasi_foto',true),$_POST['file-dir-lokasi_foto']);
      $save_data['link_berkas'] = $this->input->post('link_berkas',true);
      $save_data['id_halaman'] = $this->input->post('id_halaman',true);

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("fotofoto");
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
    if (!is_allowed('fotofoto_delete')) {
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

/* End of file Fotofoto.php */
/* Location: ./application/modules/fotofoto/controllers/backend/Fotofoto.php */
