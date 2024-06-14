<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 13/04/2023 10:41*/
/*| Please DO NOT modify this information*/


class Link_youtube extends Backend{

private $title = "Link Youtube";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Link_youtube_model","model");
}

function index()
{
  $this->is_allowed('link_youtube_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('link_youtube_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = $row->nama_berkas;
                $rows[] = $row->lokasi_berkas;
                $rows[] = $row->keterangan;
                $rows[] = $row->tanggal_dibuat != "" ? date("d-m-Y H:i",  strtotime($row->tanggal_dibuat)) : "";
        
        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("link_youtube/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("link_youtube/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("link_youtube/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  if(!is_allowed('link_youtube_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('link_youtube_detail');
    if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $data = array(
          "nama_berkas" => $row->nama_berkas,
          "lokasi_berkas" => $row->lokasi_berkas,
          "id_stts" => $row->keterangan,
          "tanggal_dibuat" => $row->tanggal_dibuat,
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('link_youtube_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("link_youtube/add_action"),
                  'nama_berkas' => set_value("nama_berkas"),
                  'lokasi_berkas' => set_value("lokasi_berkas"),
                  'id_stts' => set_value("id_stts"),
                  'tanggal_dibuat' => set_value("tanggal_dibuat"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('link_youtube_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("nama_berkas","* Judul Video","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("lokasi_berkas","* Link Video","trim|xss_clean|valid_url");
    $this->form_validation->set_rules("id_stts","* Status","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['nama_berkas'] = $this->input->post('nama_berkas',true);
      $save_data['lokasi_berkas'] = $this->input->post('lokasi_berkas',true);
      $save_data['id_stts'] = $this->input->post('id_stts',true);
      $save_data['tanggal_dibuat'] = date("Y-m-d H:i");

      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("link_youtube");
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
  $this->is_allowed('link_youtube_update');
  if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("link_youtube/update_action/$id"),
                  'nama_berkas' => set_value("nama_berkas", $row->nama_berkas),
                  'lokasi_berkas' => set_value("lokasi_berkas", $row->lokasi_berkas),
                  'id_stts' => set_value("id_stts", $row->id_stts),
                  'tanggal_dibuat' => set_value("tanggal_dibuat", $row->tanggal_dibuat),
                  );
    $this->template->view("update",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('link_youtube_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("nama_berkas","* Judul Video","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("lokasi_berkas","* Link Video","trim|xss_clean|valid_url");
    $this->form_validation->set_rules("id_stts","* Status","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['nama_berkas'] = $this->input->post('nama_berkas',true);
      $save_data['lokasi_berkas'] = $this->input->post('lokasi_berkas',true);
      $save_data['id_stts'] = $this->input->post('id_stts',true);
      $save_data['tanggal_dibuat'] = date("Y-m-d H:i");

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("link_youtube");
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
    if (!is_allowed('link_youtube_delete')) {
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

/* End of file Link_youtube.php */
/* Location: ./application/modules/link_youtube/controllers/backend/Link_youtube.php */
