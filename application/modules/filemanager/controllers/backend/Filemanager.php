<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends Backend{

  private $title = "File manager";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
		 );
		parent::__construct($config);
    $this->load->model("Filemanager_model","model");
  }

  function _rules()
  {
		$this->form_validation->set_rules('file_name', 'File Name', 'trim|xss_clean|htmlspecialchars|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('filemanager_list');
    $this->template->set_title("$this->title");
    $this->template->view("index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('filemanager_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
          $row[] = '<div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="id" value="'.enc_url($get->id).'" class="form-check-input">
                      <i class="input-helper"></i></label>
                    </div>';
          $row[] = imgView($get->file_name);
					$row[] = "<span class='text-primary'>" . substr($get->file_name, -10) . "</span>";
          $row[] = $get->ket;
          $row[] = date('d/m/Y H:i', strtotime($get->created));
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" data-text="'.base_url("_temp/uploads/img/$get->file_name").'" class="btn btn-info" id="copyboard"  title="copy path img">
                            <i class="ti-files"></i>
                          </button>
                        </div>

                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" data-text="'.$get->file_name.'" class="btn btn-warning" id="copyboard"  title="copy name img">
                              <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                            </button>
                          </div>
                   ';
          $data[] = $row;
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
    $this->template->view("filter",[],false);
  }



  function add()
  {
    $this->is_allowed('filemanager_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => url("filemanager/add_action"),
                  'params' => "add",
									'file_name' => set_value('file_name')
                  );
    $this->template->view("form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!is_allowed('filemanager_add')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['file_name'] = $this->imageCopy($this->input->post('file_name',true),$_POST['file-dir']);
        $save_data['ket'] = $this->input->post('ket',true);
				$save_data['created'] = date('Y-m-d H:i:s');

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = url("filemanager");
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }
      return $this->response($json);
    }
  }



  function delete()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('type' =>"error" , "msg" => "error delete");
        if (!is_allowed('filemanager_delete')) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }


        if ($this->input->post('id')) {
          $id = $this->input->post('id');
          $exp = explode(",", $id);
          for ($i=0; $i <count($exp) ; $i++) {
            $getimg = $this->model->find(dec_url($exp[$i]));
            $this->imageRemove($getimg->file_name, false);
            $this->model->remove(dec_url($exp[$i]));
          }

          $json['type_msg'] = "success";
          $json['msg'] = cclang("notif_delete");

        }else {
          $json['type_msg'] = "error";
          $json['msg'] = cclang("notif_delete_failed");
        }

        return $this->response($json);
    }
  }


  private function cekgambar(){
    // tampilkan semua tabel yang mengandung file    
    $files = $this->db->query("SELECT * FROM `filemanager` WHERE ket not like '%text-editor%'")->result(); 
    foreach ($files as $file) {
      $fileExists = $this->checkIfFileExists($file->file_name);
  
      if (!$fileExists) {
        $this->imageRemove($file->file_name, false);
        $this->model->remove($file->id);
      }
    }  
  }

  public function cek_gambar()
  {
    $this->cekgambar();
    set_message("success","Berhasil disinkronkan");            
    redirect(ADMIN_ROUTE.'/filemanager');
  }

  private function checkIfFileExists($fileName)
    {
        $tables = array(
            'auth_user' => 'photo',
            'fotofoto' => 'lokasi_foto',
            'konten' => 'cover',
            'pengaturan' => 'foto',
            'slider' => 'lokasi_foto',
            'tb_jenis_surat' => 'contoh_dokumen',
            'tb_kopsurat' => 'gambar_kop',
            'tb_galeri' => 'cover',
            'tb_galeri_detail' => 'file',
            'warga' => 'foto_profil',
            'setting' => 'value',
            'warga_dokumen' => 'lokasi_dokumen',
            'db_sambutan' => 'foto_diri',
        );
        foreach ($tables as $table => $column) {
            $this->db->from($table)->where($column, $fileName);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return true;
            }
            // dilakukan kembali karena pada warga dan pengaturan terdapat 2 image dalam 1 tabel
            $tables_lagi = array(              
              'warga' => 'ttd_digital',
              'pengaturan' => 'header',
          );
          foreach ($tables_lagi as $table => $column) {
            $this->db->from($table)->where($column, $fileName);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return true;
            }
          }
        }

        return false;
    }
  
    public function bersihkan_tabel(){
      if ($this->input->is_ajax_request()) {
      $this->truncateTable('fotofoto');
      $this->truncateTable('kategori_konten');
      $this->truncateTable('konten');
      $this->truncateTable('link_youtube');
      $this->truncateTable('menu_frontend');
      $this->truncateTable('menu_halaman');
      $this->truncateTable('slider');
      $this->truncateTable('tb_jenis_surat');
      $this->truncateTable('tb_kopsurat');
      $this->truncateTable('tb_surat');
      $this->truncateTable('tb_galeri');
      $this->truncateTable('tb_galeri_detail');
      $this->truncateTable('warga');
      $this->truncateTable('warga_dokumen');

      $this->cekgambar();
      $teks_editor = $this->db->query("select * from filemanager where ket like '%text-editor%'")->result();
      foreach($teks_editor as $file){
        $this->imageRemove($file->file_name, false);
        $this->model->remove($file->id);
      }
      $json['type_msg'] = "success";
      $json['msg'] = cclang("notif_delete");
      $json['redirect'] = url("filemanager");

      return $this->response($json);
      }
    }

    private function truncateTable($tableName) {
      $this->db->truncate($tableName);
  }
}