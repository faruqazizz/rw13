<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 23/04/2023 08:04*/
/*| Please DO NOT modify this information*/


class Menu_halaman extends Backend{

private $title = "Menu Halaman Depan";


public function __construct()
{
  $config = array(
    'title' => $this->title,
   );
  parent::__construct($config);
  $this->load->model("Menu_halaman_model","model");
}

function index()
{
  $this->is_allowed('menu_halaman_list');
  $this->template->set_title($this->title);
  $this->template->view("index");
}

function json()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('menu_halaman_list')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $list = $this->model->get_datatables();
    $data = array();
    foreach ($list as $row) {
        $rows = array();
                $rows[] = $row->nama_halaman;
                $rows[] = $row->tautan_menu;
        
        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="'.url("menu_halaman/detail/".enc_url($row->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="'.url("menu_halaman/update/".enc_url($row->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="'.url("menu_halaman/delete/".enc_url($row->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
  if(!is_allowed('menu_halaman_filter'))
  {
    echo "access not permission";
  }else{
    $this->template->view("filter",[],false);
  }
}

function detail($id)
{
  $this->is_allowed('menu_halaman_detail');
    if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title("Detail ".$this->title);
    $data = array(
          "nama_halaman" => $row->nama_halaman,
          "tautan_menu" => $row->tautan_menu,
    );
    $this->template->view("view",$data);
  }else{
    $this->error404();
  }
}

function add()
{
  $this->is_allowed('menu_halaman_add');
  $this->template->set_title(cclang("add")." ".$this->title);
  $data = array('action' => url("menu_halaman/add_action"),
                  'nama_halaman' => set_value("nama_halaman"),
                  'tautan_menu' => set_value("tautan_menu"),
                  );
  $this->template->view("add",$data);
}

function add_action()
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('menu_halaman_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("nama_halaman","* Nama halaman","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("tautan_menu","* Tautan menu","trim|xss_clean");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['nama_halaman'] = $this->input->post('nama_halaman',true);
      $tautan_menu = $this->input->post('tautan_menu',true);
	  if(empty($tautan_menu)){
		  $save_data['tautan_menu'] = '#';
	  } else{
		  $save_data['tautan_menu'] = $tautan_menu;
	  }
      $this->model->insert($save_data);

      set_message("success",cclang("notif_save"));
      $json['redirect'] = url("menu_halaman");
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
  $this->is_allowed('menu_halaman_update');
  if ($row = $this->model->find(dec_url($id))) {
    $this->template->set_title(cclang("update")." ".$this->title);
    $data = array('action' => url("menu_halaman/update_action/$id"),
                  'nama_halaman' => set_value("nama_halaman", $row->nama_halaman),
                  'tautan_menu' => set_value("tautan_menu", $row->tautan_menu),
                  );
    $this->template->view("update",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if($this->input->is_ajax_request()){
    if (!is_allowed('menu_halaman_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

    $json = array('success' => false);
    $this->form_validation->set_rules("nama_halaman","* Nama halaman","trim|xss_clean|required|htmlspecialchars");
    $this->form_validation->set_rules("tautan_menu","* Tautan menu","trim|xss_clean");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');

    if ($this->form_validation->run()) {
      $save_data['nama_halaman'] = $this->input->post('nama_halaman',true);
      $tautan_menu = $this->input->post('tautan_menu',true);
	  if(empty($tautan_menu)){
		  $save_data['tautan_menu'] = '#';
	  } else{
		  $save_data['tautan_menu'] = $tautan_menu;
	  }

      $save = $this->model->change(dec_url($id), $save_data);

      set_message("success",cclang("notif_update"));

      $json['redirect'] = url("menu_halaman");
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
    if (!is_allowed('menu_halaman_delete')) {
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

/* End of file Menu_halaman.php */
/* Location: ./application/modules/menu_halaman/controllers/backend/Menu_halaman.php */
