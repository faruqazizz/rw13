<?php defined('BASEPATH') or exit('No direct script access allowed');
/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 11/04/2023 22:24*/
/*| Please DO NOT modify this information*/


class Konten extends Backend
{

  private $title = "Konten";


  public function __construct()
  {
    $config = array(
      'title' => $this->title,
    );
    parent::__construct($config);
    $this->load->model("Konten_model", "model");
  }

  function index()
  {
    $this->is_allowed('konten_list');
    $this->template->set_title($this->title);
    $this->template->view("index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('konten_list')) {
        show_error("Access Permission", 403, '403::Access Not Permission');
        exit();
      }

      $list = $this->model->get_datatables();
      $data = array();
      foreach ($list as $row) {
        $rows = array();
        $rows[] = substr($row->judul, 0, 10) . '...';
        $rows[] = substr($row->slug, 0, 10) . '...';
        $rows[] = $row->kata_kunci;
        $rows[] = substr($row->konten, 0, 10) . '...';
        $rows[] = $row->nama_kategori;
        $rows[] = is_image($row->cover);
        $rows[] = $row->keterangan;
        $rows[] = $row->tanggal_dibuat != "" ? date("d-m-Y",  strtotime($row->tanggal_dibuat)) : "";

        $rows[] = '
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="' . url("konten/detail/" . enc_url($row->id)) . '" id="detail" class="btn btn-primary" title="' . cclang("detail") . '">
                        <i class="mdi mdi-file"></i>
                      </a>
                      <a href="' . url("konten/update/" . enc_url($row->id)) . '" id="update" class="btn btn-warning" title="' . cclang("update") . '">
                        <i class="ti-pencil"></i>
                      </a>
                      <a href="' . url("konten/delete/" . enc_url($row->id)) . '" id="delete" class="btn btn-danger" title="' . cclang("delete") . '">
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
    if (!is_allowed('konten_filter')) {
      echo "access not permission";
    } else {
      $this->template->view("filter", [], false);
    }
  }

  function detail($id)
  {
    $this->is_allowed('konten_detail');
    if ($row = $this->model->get_detail(dec_url($id))) {
      $this->template->set_title("Detail " . $this->title);
      $data = array(
        "judul" => $row->judul,
        "slug" => $row->slug,
        "kata_kunci" => $row->kata_kunci,
        "konten" => $row->konten,
        "id_kategori" => $row->nama_kategori,
        "cover" => $row->cover,
        "status_konten" => $row->keterangan,
        "tanggal_dibuat" => $row->tanggal_dibuat,
      );
      $this->template->view("view", $data);
    } else {
      $this->error404();
    }
  }

  function add()
  {
    $this->is_allowed('konten_add');
    $this->template->set_title(cclang("add") . " " . $this->title);
    $data = array(
      'action' => url("konten/add_action"),
      'judul' => set_value("judul"),
      'slug' => set_value("slug"),
      'kata_kunci' => set_value("kata_kunci"),
      'konten' => set_value("konten"),
      'id_kategori' => set_value("id_kategori"),
      'cover' => set_value("cover"),
      'status_konten' => set_value("status_konten"),
      'tanggal_dibuat' => set_value("tanggal_dibuat"),
    );
    $this->template->view("add", $data);
  }

  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('konten_add')) {
        show_error("Access Permission", 403, '403::Access Not Permission');
        exit();
      }

      $json = array('success' => false);
      $this->form_validation->set_rules("judul", "* Judul", "trim|xss_clean|required");
      $this->form_validation->set_rules("slug", "* Slug", "trim|xss_clean|required");
      $this->form_validation->set_rules("kata_kunci", "* Kata kunci", "trim|xss_clean|required");
      $this->form_validation->set_rules("konten", "* Konten", "trim|required");
      $this->form_validation->set_rules("id_kategori", "* Id kategori", "trim|xss_clean|required");
      $this->form_validation->set_rules("cover", "* Cover", "trim|xss_clean");
      $this->form_validation->set_rules("status_konten", "* Status konten", "trim|xss_clean|required");
      $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">', '</i>');

      if ($this->form_validation->run()) {
        $save_data['judul'] = $this->input->post('judul', true);
        $save_data['slug'] = $this->input->post('slug', true);
        $save_data['kata_kunci'] = $this->input->post('kata_kunci', true);
        $save_data['konten'] = $this->input->post('konten');
        $save_data['id_kategori'] = $this->input->post('id_kategori', true);
        $save_data['cover'] = $this->imageCopy($this->input->post('cover', true), $_POST['file-dir-cover']);
        $save_data['status_konten'] = $this->input->post('status_konten', true);
        $save_data['tanggal_dibuat'] = date("Y-m-d H:i");

        $this->model->insert($save_data);

        set_message("success", cclang("notif_save"));
        $json['redirect'] = url("konten");
        $json['success'] = true;
      } else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }

      $this->response($json);
    }
  }

  function update($id)
  {
    $this->is_allowed('konten_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update") . " " . $this->title);
      $data = array(
        'action' => url("konten/update_action/$id"),
        'judul' => set_value("judul", $row->judul),
        'slug' => set_value("slug", $row->slug),
        'kata_kunci' => set_value("kata_kunci", $row->kata_kunci),
        'konten' => set_value("konten", $row->konten),
        'id_kategori' => set_value("id_kategori", $row->id_kategori),
        'cover' => set_value("cover", $row->cover),
        'status_konten' => set_value("status_konten", $row->status_konten),
        'tanggal_dibuat' => set_value("tanggal_dibuat", $row->tanggal_dibuat),
      );
      $this->template->view("update", $data);
    } else {
      $this->error404();
    }
  }

  function update_action($id)
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('konten_update')) {
        show_error("Access Permission", 403, '403::Access Not Permission');
        exit();
      }

      $json = array('success' => false);
      $this->form_validation->set_rules("judul", "* Judul", "trim|xss_clean|required");
      $this->form_validation->set_rules("slug", "* Slug", "trim|xss_clean|required");
      $this->form_validation->set_rules("kata_kunci", "* Kata kunci", "trim|xss_clean|required");
      $this->form_validation->set_rules("konten", "* Konten", "trim|required");
      $this->form_validation->set_rules("id_kategori", "* Id kategori", "trim|xss_clean|required");
      $this->form_validation->set_rules("cover", "* Cover", "trim|xss_clean");
      $this->form_validation->set_rules("status_konten", "* Status konten", "trim|xss_clean|required");
      $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">', '</i>');

      if ($this->form_validation->run()) {
        $save_data['judul'] = $this->input->post('judul', true);
        $save_data['slug'] = $this->input->post('slug', true);
        $save_data['kata_kunci'] = $this->input->post('kata_kunci', true);
        $save_data['konten'] = $this->input->post('konten');
        $save_data['id_kategori'] = $this->input->post('id_kategori', true);
        $save_data['cover'] = $this->imageCopy($this->input->post('cover', true), $_POST['file-dir-cover']);
        $save_data['status_konten'] = $this->input->post('status_konten', true);
        $save_data['tanggal_dibuat'] = date("Y-m-d H:i");

        $save = $this->model->change(dec_url($id), $save_data);

        set_message("success", cclang("notif_update"));

        $json['redirect'] = url("konten");
        $json['success'] = true;
      } else {
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
      if (!is_allowed('konten_delete')) {
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

/* End of file Konten.php */
/* Location: ./application/modules/konten/controllers/backend/Konten.php */
