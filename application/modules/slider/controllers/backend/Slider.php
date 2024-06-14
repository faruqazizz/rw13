<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 14/04/2023 14:47*/
/*| Please DO NOT modify this information*/


class Slider extends Backend{

private $title = "Slider";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Slider_model","model");
}

function index()
{
  $this->is_allowed('slider_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('slider_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = $row->judul_foto;
                $rows[] = is_image($row->lokasi_foto);
                $rows[] = $row->keterangan;
        
        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("slider/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("slider/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("slider/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  if(!is_allowed('slider_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('slider_detail');
    if ($row = $this->model->get_detail(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $data = array(
          "judul_foto" => $row->judul_foto,
          "lokasi_foto" => $row->lokasi_foto,
          "id_stts" => $row->keterangan,
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('slider_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("slider/add_action"),
                  'judul_foto' => set_value("judul_foto"),
                  'lokasi_foto' => set_value("lokasi_foto"),
                  'id_stts' => set_value("id_stts"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('slider_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("judul_foto","* Judul Foto","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("lokasi_foto","* Lokasi Foto","trim|xss_clean|required");
    $this->form_validation->set_rules("id_stts","* Status","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['judul_foto'] = $this->input->post('judul_foto',true);
      $save_data['lokasi_foto'] = $this->imageCopy($this->input->post('lokasi_foto',true),$_POST['file-dir-lokasi_foto']);
      $save_data['id_stts'] = $this->input->post('id_stts',true);

      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("slider");
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
  $this->is_allowed('slider_update');
  if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("slider/update_action/$id"),
                  'judul_foto' => set_value("judul_foto", $row->judul_foto),
                  'lokasi_foto' => set_value("lokasi_foto", $row->lokasi_foto),
                  'id_stts' => set_value("id_stts", $row->id_stts),
                  );
    $this->template->view("update",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('slider_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("judul_foto","* Judul Foto","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("lokasi_foto","* Lokasi Foto","trim|xss_clean|required");
    $this->form_validation->set_rules("id_stts","* Status","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['judul_foto'] = $this->input->post('judul_foto',true);
      $save_data['lokasi_foto'] = $this->imageCopy($this->input->post('lokasi_foto',true),$_POST['file-dir-lokasi_foto']);
      $save_data['id_stts'] = $this->input->post('id_stts',true);

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("slider");
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
    if (!is_allowed('slider_delete')) {
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

/* End of file Slider.php */
/* Location: ./application/modules/slider/controllers/backend/Slider.php */
