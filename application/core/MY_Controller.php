<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{

  private $title = 'title';

  public function __construct($config = array())
  {
    parent::__construct();

    if (DEFAULT_CONTROLLER == "wizard") {
      show_404();
      die();
    }

    $this->load->library("auth");
    $this->auth->is_logged(true);

    foreach ($config as $key => $val) {
      if (isset($this->$key))
        $this->$key = $val;
    }

    $this->load->library(array("Template", "Userize", "form_validation", "security", "user_agent", "Encryption", "My_encrypt"));
    $this->load->helper(array("app", "sct", "public", "language"));
    $this->lang->load("app", $this->config->item("language"));
    if (setting("user_log_status") == "Y") {
      $this->getlog();
    }
  }


  public function response($data, $status = 200)
  {
    // $data['csrf_name'] = $this->security->get_csrf_token_name();
    // $data['csrf_token'] = $this->security->get_csrf_hash();

    header('Content-type:application/json');
    die(json_encode($data));
    $this->output
      ->set_content_type('application/json')
      ->set_status_header($status)
      ->set_output(json_encode($data));
  }

  function error404()
  {
    $this->template->set_title("Error 404 - Page Not Found");
    $this->template->view("core/error404");
  }
    
  function imageUpload()
{
    if ($this->input->is_ajax_request()) {
        $json = array('success' => false);
        $this->load->helper('file');
        $max_upload = $this->config->item('max_upload');
        $nama_data = $this->input->post('nama_data');
        if ($nama_data == "img") {
            $allowed_types = 'png|jpeg|jpg|gif|ico';
        } elseif ($nama_data == "persyaratan") {
            $allowed_types = 'png|pdf|jpeg|jpg|docx|doc';
        } else {
            $allowed_types = 'pdf|docx|xlsx|doc|xls';
        }

        // $hash = sha1()
        if (!empty($_FILES['file']['name'])) {
            if ($_FILES['file']['size'] <= $max_upload . "000") {
                $dir = sess('id_user') . "-" . sha1(date("YmdHis"));
                $path = FCPATH . '/_temp/uploads/tmp';

                if (is_dir($path . "/" . $dir)) {
                    delete_files($path . "/" . $dir);
                } else {
                    mkdir($path . "/" . $dir, 0777);
                }

                $config = [
                    'upload_path'     => './_temp/uploads/tmp/' . $dir . '/',
                    'allowed_types'   => $allowed_types,
                    'max_size'        => $max_upload,
                    'max_filename'    => '20'
                ];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();

                    // Mengambil path file yang diupload
                    $file_path = $upload_data['full_path'];

                    // Mengecek apakah file yang diupload adalah gambar
                    $is_image = strpos($upload_data['file_type'], 'image') !== false;

                    if ($is_image) {
                        // Mengambil ekstensi file
                        $ext = pathinfo($upload_data['file_name'], PATHINFO_EXTENSION);
						
                        // Menentukan output file yang dihasilkan
                        $output_file = sha1($upload_data['raw_name']) . '.webp';	
						
                        // Menghitung persentase kompresi (80%)
                        $quality = 80;

                        // Melakukan kompresi gambar
                        $image = imagecreatefromstring(file_get_contents($file_path));
						
						if ($ext == 'png') {
							imagepalettetotruecolor($image);
						}
						
                        imagewebp($image, $path . "/" . $dir . '/' . $output_file, $quality);
                        imagedestroy($image);

                        // Menghapus file asli yang diupload
                        unlink($file_path);

                        $json = [
                            'file_name' => $output_file,
                            'file_dir'  => $dir,
                            'success'   => true
                        ];
                    } else {
                        $json = [
                            'file_name' => $upload_data['file_name'],
                            'file_dir'  => $dir,
                            'success'   => true
                        ];
                    }
                } else {
                    $json = [
                        'msg' => $this->upload->display_errors()
                    ];
                }
            } else {
                $json['msg'] = "Max file upload $max_upload Kb";
            }

        } else {
            $json['select'] = false;
            $json['success'] = true;
        }
        return $this->response($json);
    }
}

  function imageCopy($img_name = null, $file_dir = '', $title = "")
  {
    if (isset($_POST['file-dir'])) {
      $file_dir = $_POST['file-dir'];
    }

    if (!empty($file_dir)) {
      if (!empty($img_name)) {
        $image_copy = date("dmyHis") . '_' . str_replace("-", "_", $img_name);
        rename(
          FCPATH . '/_temp/uploads/tmp/' . $file_dir . '/' . $img_name,
          FCPATH . '/_temp/uploads/img/' . $image_copy
        );

        rmdir(FCPATH . '/_temp/uploads/tmp/' . $file_dir);

        if (!is_file(FCPATH . '/_temp/uploads/img/' . $image_copy)) {
          return $this->response([
            'alert' => 'Error uploading image'
          ]);
          exit();
        }


        if ($this->uri->segment(2) != "filemanager") {
          $this->db->insert("filemanager", [
            "file_name" => $image_copy,
            "ket" => "Di upload melalui module " . ($title == "" ? $this->title : $title),
            "created" => date("Y-m-d H:i")
          ]);
        }

        return $image_copy;
      } else {
        return $img_name;
      }
    } else {
      return $img_name;
    }
  }


  function imageRemove($img = null, $ajax = true)
  {
    $json['success'] = false;
	
// image
    if ($this->input->post("img")) {
		  $img = $this->input->post("img");
    }

    if (!empty($img)) {
      if (file_exists(FCPATH . "/_temp/uploads/img/" . $img)) {
        unlink(FCPATH . "/_temp/uploads/img/" . $img);
        $json['success'] = true;
      }
    }

//document
	if ($this->input->post("document")) {
		  $doc = $this->input->post("document");
    }

    if (!empty($doc)) {
      if (file_exists(FCPATH . "/_temp/uploads/img/" . $doc)) {
        unlink(FCPATH . "/_temp/uploads/img/" . $doc);
        $json['success'] = true;
      }
    }

    if ($ajax) {

      echo json_encode($json);
    } else {
      return true;
    }
  }

  function compress($file_names)
{
    foreach ($file_names as $file_name) {
        // Check if file exists
        if (!empty($file_name) && file_exists(FCPATH . "/_temp/uploads/img/" . $file_name)) {
            // Load library image_lib
            $this->load->library('image_lib');
          
            // Get the full path to the uploaded file
            $file_path = FCPATH .'_temp/uploads/img/' . $file_name;
            
            // Set the config options for image compression
            $config['image_library'] = 'gd2';
            $config['source_image'] = $file_path;
            $config['quality'] = 80; // Set image quality

            // Check if the file is an image before compressing it
            if (getimagesize($file_path)) {
                // Initialize library with the config options
                $this->image_lib->initialize($config);
                
                // Resize/compress the image
                $this->image_lib->resize();
    
                // Clear the cache of the image library
                $this->image_lib->clear();
            }
        }
    }
}




  function imageUploadEditor()
{
  $this->load->helper('file');
  $max_upload = $this->config->item('max_upload');

  $dir = sess('id_user') . "-" . sha1(date("Y-m-d"));
  $path = FCPATH . '/_temp/uploads/tmp';

  if (is_dir($path . "/" . $dir)) {
    delete_files($path . "/" . $dir);
  } else {
    mkdir($path . "/" . $dir, 0777);
  }

  $config = [
    'upload_path'     => './_temp/uploads/tmp/' . $dir . '/',
    'allowed_types'   => 'png|jpeg|jpg|gif',
    'max_size'        => $max_upload,
    'max_filename'    => '20'
  ];

  $this->load->library('upload', $config);

  if ($this->upload->do_upload('file')) {
    $upload_data = $this->upload->data();
    $file_name   = $upload_data['file_name'];
    $file_ext    = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_path   = $upload_data['file_path'];
    $file_size   = $upload_data['file_size'];
    $file_temp   = $upload_data['full_path'];
    
    // Kompres gambar jika lebih dari 1 MB
    if($file_size > 1000000){
      $config['image_library']  = 'gd2';
      $config['source_image']   = $file_temp;
      $config['create_thumb']   = FALSE;
      $config['maintain_ratio'] = TRUE;
      $config['quality']        = "75%";
      $config['width']          = 800;
      $config['height']         = 800;
      $this->load->library('image_lib', $config);
      $this->image_lib->resize();
    }
    
    // Ubah ekstensi file menjadi png
    if($file_ext !== 'png'){
      $new_file_name = pathinfo($file_name, PATHINFO_FILENAME).'.png';
      $new_file_path = $file_path.$new_file_name;
      $this->load->library('image_lib');
      $config['source_image']   = $file_temp;
      $config['new_image']      = $new_file_path;
      $config['create_thumb']   = FALSE;
      $config['maintain_ratio'] = TRUE;
      $config['quality']        = "100%";
      $config['width']          = 800;
      $config['height']         = 800;
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      unlink($file_temp);
      $file_name = $new_file_name;
    }

    $file = $this->imageCopy($file_name, $dir, "$this->title (text-editor)");
    $json['success'] = true;
    $json['file'] = base_url() . "_temp/uploads/img/" . $file;
  } else {
    $json['success'] = false;
    $json['msg'] = "Format FIle : png | jpeg | jpg | gif , Max file upload $max_upload Kb";
  }

  echo json_encode($json);
}


  function imageRemoveEditor()
  {
    $src = $this->input->post('src');
    $file_name = str_replace(base_url() . "_temp/uploads/img/", '', $src);
    if (unlink("./_temp/uploads/img/" . $file_name)) {
      $this->db->where('file_name', $file_name);
      $this->db->delete('filemanager');
    }
  }

  function is_allowed($permission = null, $redirect = true)
  {
    if ($permission == null) {
      die("parameter `is_allowed` not empty");
    } else {
      // $this->load->library("auth");
      $this->auth->created_permission($permission);
      if ($this->auth->is_allowed($permission)) {
        return true;
      } else {
        if ($redirect) {
          redirect(url("core/notPermission"));
        }
        return false;
      }
    }
  }

  //CEK PASSWORD FORM VALIDATION
  function _cek_password($str)
  {
    if ($str != "") {
      if (pass_decrypt(profile("token"), $str, profile("password"))) {
        return true;
      } else {
        $this->form_validation->set_message('_cek_password', '%s Invalid');
        return false;
      }
    } else {
      return true;
    }
  }


  function getlog()
  {
    $post = $_POST;
    $postman = json_encode($post) != "[]" ? json_encode($post) : null;
    if (!array_key_exists("draw", $post)) {
      $data = array(
        'user' => profile("id_user"),
        'controller' => $this->title,
        'url' => $_SERVER['REQUEST_URI'],
        'ip_address' => $this->input->ip_address(),
        'data' => $postman,
        'created_at' => date("Y-m-d H:i:s")
      );
      $this->db->insert("ci_user_log", $data);
    }
  }
}

// end class backend


// login class


/**
 * LOGIN
 */
class Signin extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    if (DEFAULT_CONTROLLER == "wizard") {
      show_404();
      die();
    }

    $this->load->library(array("encryption", "auth"));
    $this->load->helper(array("app", "public", "sct"));
  }
}