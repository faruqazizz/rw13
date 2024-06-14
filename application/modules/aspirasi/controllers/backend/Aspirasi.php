<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 15/04/2023 20:49*/
/*| Please DO NOT modify this information*/


class Aspirasi extends Backend{

private $title = "Aspirasi";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Aspirasi_model","model");
}

function index()
{
  $this->is_allowed('aspirasi_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('aspirasi_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = $row->nama_pengadu;
                $rows[] = $row->email;
                $rows[] = $row->subjek_aduan;
                $rows[] = $row->isi_aspirasi;
                $rows[] = $row->ip_address;
                $rows[] = $row->tanggal_dibuat != "" ? date("d-m-Y H:i",  strtotime($row->tanggal_dibuat)) : "";
        
        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("aspirasi/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("aspirasi/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("aspirasi/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  if(!is_allowed('aspirasi_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('aspirasi_detail');
    if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $data = array(
          "nama_pengadu" => $row->nama_pengadu,
          "email" => $row->email,
          "subjek_aduan" => $row->subjek_aduan,
          "isi_aspirasi" => $row->isi_aspirasi,
          "ip_address" => $row->ip_address,
          "tanggal_dibuat" => $row->tanggal_dibuat,
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('aspirasi_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("aspirasi/add_action"),
                  'email' => set_value("email"),
                  'subjek_aduan' => set_value("subjek_aduan"),
                  'isi_aspirasi' => set_value("isi_aspirasi"),
                  'ip_address' => set_value("ip_address"),
                  'tanggal_dibuat' => set_value("tanggal_dibuat"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('aspirasi_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("email","* Email","trim|xss_clean|required|valid_email");
    $this->form_validation->set_rules("subjek_aduan","* Subjek aduan","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("isi_aspirasi","* Isi aspirasi","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("ip_address","* Ip address","trim|xss_clean|valid_ip");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['email'] = $this->input->post('email',true);
      $save_data['subjek_aduan'] = $this->input->post('subjek_aduan',true);
      $save_data['isi_aspirasi'] = $this->input->post('isi_aspirasi',true);
      $save_data['ip_address'] = $this->input->post('ip_address',true);
      $save_data['tanggal_dibuat'] = date("Y-m-d H:i");

      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("aspirasi");
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
  $this->is_allowed('aspirasi_update');
  if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("aspirasi/update_action/$id"),
                  'email' => set_value("email", $row->email),
                  'subjek_aduan' => set_value("subjek_aduan", $row->subjek_aduan),
                  'isi_aspirasi' => set_value("isi_aspirasi", $row->isi_aspirasi),
                  'ip_address' => set_value("ip_address", $row->ip_address),
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
    if (!is_allowed('aspirasi_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("email","* Email","trim|xss_clean|required|valid_email");
    $this->form_validation->set_rules("subjek_aduan","* Subjek aduan","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("isi_aspirasi","* Isi aspirasi","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("ip_address","* Ip address","trim|xss_clean|valid_ip");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['email'] = $this->input->post('email',true);
      $save_data['subjek_aduan'] = $this->input->post('subjek_aduan',true);
      $save_data['isi_aspirasi'] = $this->input->post('isi_aspirasi',true);
      $save_data['ip_address'] = $this->input->post('ip_address',true);
      $save_data['tanggal_dibuat'] = date("Y-m-d H:i");

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("aspirasi");
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
    if (!is_allowed('aspirasi_delete')) {
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

/* End of file Aspirasi.php */
/* Location: ./application/modules/aspirasi/controllers/backend/Aspirasi.php */
