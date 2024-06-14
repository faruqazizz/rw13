<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Backend{

  private $title = "User";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
		 );
		parent::__construct($config);
    $this->load->model("User_model","model");
  }

  function cekakses(){
    if(sess('groupnya')== 3 && empty($id)){
      redirect(ADMIN_ROUTE.strtolower('/'. $this->title).'/'.'update/'.enc_url(profile('id_user')));
    }  
  }

  function index()
{
  $this->cekakses();
  $this->is_allowed('user_list');
  $this->template->set_title("User");

  $list = $this->model->get_datatables();
  $data = array();
  foreach ($list as $rows) {
    $row = array();
    $row[] = imgView($rows->photo);
    $row[] = $rows->name;
    $row[] = $rows->email ."|".$rows->id_user;

    if ($rows->id_user == profile('id_user')) {
      $row[] = '<span class="badge badge-success">' . ($rows->group == "" ? '<i>Null</i>' : strtoupper($rows->group)) . '</span>';
    } else {
      $row[] = $rows->group == "" ? '<i>Null</i>':strtoupper($rows->group);
    }

    $row[] = '<label class="switch"><a href="'.url("user/toggle_status/".enc_url($rows->id_user)).'" class="toggle-status" id="delete"><input type="checkbox" ' . ($rows->is_active == 1 ? 'checked' : '') . ($rows->id_user == 1 ? ' disabled' : '') . '><span class="slider round"></span></a></label>';
    $row[] = $rows->created == "" ? "null":date("d/m/Y H:i",strtotime($rows->created));
    $row[] = $rows->last_login == "" ? "null":date("d/m/Y H:i",strtotime($rows->last_login));
    $row[] = '
      <div class="btn-group mx-1" role="group">
        <a href="'.url("user/view/".enc_url($rows->id_user)).'" id="view" class="btn btn-primary" title="'.cclang("detail").'">
          <i class="ti-file"></i>
        </a>
        <a href="'.url("user/resetPassword/".enc_url($rows->id_user)).'" '.($rows->id_user == 1 || $rows->id_user == 2 ? "style='display:none'":"").' id="delete" class="btn btn-dark" title="Reset Password">
          <i class="ti-unlock"></i>
        </a>
      </div>';
    $row[] = '
      <div class="btn-group" role="group">  
        <a href="'.url("user/update/".enc_url($rows->id_user)).'" id="edit" class="btn btn-warning" title="'.cclang("update").'">
          <i class="ti-pencil"></i>
        </a>
        <a href="'.url("user/delete/".enc_url($rows->id_user)).'" '.($rows->id_user == 1 || $rows->id_user == 2 ? "style='display:none'":"").' id="delete" class="btn btn-danger" title="'.cclang("delete").'">
          <i class="ti-trash"></i>
        </a>
      </div>
    ';
    $data[] = $row;
  }

  $this->template->view("index", ['data'=>$data]);
}


  function _rules()
   {
     $this->form_validation->set_rules("nama","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
     $this->form_validation->set_rules("id_group","*&nbsp;","trim|xss_clean|numeric|required");
  	 $this->form_validation->set_rules("id_warga","*&nbsp;","trim|xss_clean|numeric|required");
     $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|required|valid_email|callback__cek_email");
     $this->form_validation->set_rules("is_active","*&nbsp;","trim|xss_clean|numeric|required");
     $this->form_validation->set_rules('photo', '*&nbsp;', 'trim|xss_clean');
     if ($_POST['submit']=="save") {
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|min_length[6]");
       $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password]|required");
     }

     if ($_POST['submit']=="update") {
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|min_length[6]");
       $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password]");
     }

     $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
   }

function add()
{
  $this->cekakses();
  $this->is_allowed('user_add');
  $this->template->set_title(cclang("add")." user");
 
  $data = array('action' => url("user/add_action"),                
                'button' => "save",
                'nama' => set_value("nama"),
                'email' => set_value("email"),
                'is_active' => set_value("is_active"),
                'file_name' => set_value("file_name"),
                'id_group' => set_value("id_group"),
				        'id_warga' => set_value("id_warga"),
                );
  $this->template->view("form",$data);
}

public function activating_all()
{
    $this->is_allowed('user_detail');

    $users = $this->db->query("SELECT * FROM auth_user WHERE is_active ='0'")->result_array();
    
    if($users){
      
      $id_group = profile('id_group');
      $this->db->select('auth_user.id_user');
      $this->db->from('auth_user');
      $this->db->join('auth_user_to_group', 'auth_user.id_user = auth_user_to_group.id_user');
      $this->db->where('auth_user_to_group.id_group', $id_group);
      $query = $this->db->get();
      $result = $query->result_array();
      
      $update_data = array();
      foreach ($users as $user) {
        $update_data[] = array(
          'id_user' => $user['id_user'],
          'is_active' => 1
        );
      }
      
      $this->db->update_batch('auth_user', $update_data, 'id_user');
      
      set_message("success", cclang("notif_save"));
    } else{
      set_message("warning", "Semua user sudah diaktifkan");
    }
    // bersihkan kolom auth_user_to_group yang tidak berelasi
    // cek datanya: SELECT * FROM auth_user_to_group WHERE id_user NOT IN (SELECT id_user FROM auth_user);
    $this->db->query("DELETE FROM auth_user_to_group WHERE id_user NOT IN (SELECT id_user FROM auth_user)");
    $this->db->query("ALTER TABLE auth_user AUTO_INCREMENT = 1");
    $this->db->query("ALTER TABLE warga AUTO_INCREMENT = 1");
    redirect(url("user"));
}


function add_action()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $token =  randomKey();
          $insert = array('name' => $this->input->post('nama',true),
                          'email' => $this->input->post('email',true),
                          'is_active' => $this->input->post('is_active', true),
                          'token' => $token,
                          'photo' =>  $this->imageCopy($this->input->post('photo',true)),
                          'password' => pass_encrypt($token,$this->input->post('konfirmasi_password')),
                          'is_delete' => "0",
                          'created' => date('Y-m-d H:i:s'),
						  'id_warga' => $this->input->post('id_warga'),
                        );

          $this->model->get_insert("auth_user",$insert);

          $last_id_user = $this->db->insert_id();

          $insert_trans = array('id_user' => $last_id_user,
                                'id_group' => $this->input->post('id_group')
                              );

          $this->model->get_insert("auth_user_to_group",$insert_trans);

          set_message("success",cclang("notif_save"));
          $json['redirect'] = url("user");
          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

        return $this->response($json);
    }
}

function update($id)
{
  $this->is_allowed('user_update');
  if ($row = $this->model->get_where_data(dec_url($id))) {
    $panggil_group = $this->db->query("select * from auth_group where id='".$row->id_group."'")->row();
    $this->template->set_title(cclang("update")." User");
    if(profile('id_group') == 3){
      $kembali = 'javascript:window.history.go(-1);';
    } else{
      $kembali = url($this->uri->segment(2));
    }
    $data = array('action' => url("user/update_action/$id"),
                  'button' => "update",
                  'kembali' => $kembali,
                  'panggilgroup' => $panggil_group->group,
                  'nama' => set_value("nama",$row->name),
                  'email' => set_value("email",$row->email),
                  'file_name' => set_value("file_name",$row->photo),
                  'is_active' => set_value("is_active",$row->is_active),
                  'id_group' => set_value("id_group",$row->id_group),
				          'id_warga' => set_value("id_warga", $row->id_warga),
                  );
    $this->template->view("form",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {

          if ($_POST['konfirmasi_password']!="") {
            $token =  randomKey();
            $update['token'] = $token;
            $update['password'] = pass_encrypt($token,$this->input->post('konfirmasi_password'));
          }

          $update['name'] = $this->input->post('nama',true);
          $update['email'] = $this->input->post('email',true);
          $update['photo'] = $this->imageCopy($this->input->post('photo',true));
          $update['is_active'] = $this->input->post('is_active',true);
        //   $update['id_warga'] = $this->input->post('id_warga',true);
          $update['modified'] = date('Y-m-d H:i:s');

          $this->model->get_update("auth_user",$update,["id_user"=>dec_url($id)]);

          $update_trans = array(
                                'id_group' => $this->input->post('id_group')
                              );

          $this->model->get_update("auth_user_to_group",$update_trans,["id_user"=>dec_url($id)]);
          set_message("success",cclang("notif_update"));
          if(sess('groupnya')== 3){
            $json['redirect'] = url("user/update/".enc_url(profile('id_user')));
          } else{
            $json['redirect'] = url("user");
          }
          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

        return $this->response($json);
    }
}

function view($id = null)
{
  $this->is_allowed('user_detail');
  if ($row = $this->model->get_where_data(dec_url($id))) {
    $this->template->set_title(cclang("detail")." User");
    $data = array('nama' => set_value("nama",$row->name),
                  'email' => set_value("email",$row->email),
                  'is_active' => set_value("is_active",$row->is_active),
                  'group' => set_value("id_group",$row->group),
                  'photo' => set_value("photo",$row->photo),
                  'last_login' => set_value("last_login",$row->last_login),
                  'created' => set_value("created",$row->created),
                  );
    $this->template->view("view",$data);
  }else {
    $this->error404();
  }
}

public function delete($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_delete')) {
      return $this->response([
        'type_msg' => "error",
        'msg' => "do not have permission to access"
      ]);
    }
// hapus tabel: SELECT * FROM auth_user, auth_user_to_group where auth_user.id_user = auth_user_to_group.id_user and auth_user.is_delete ='1';
if (dec_url($id) == 1) {
  $json['type_msg'] = "error";
  $json['msg'] = cclang("notif_delete_failed");
}else {
  // Call helper delete_user
      delete_user(dec_url($id));
      $json['type_msg'] = "success";
      $json['msg'] = cclang("notif_delete");
    }

    return $this->response($json);
  }
}

public function resetPassword($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_detail')) {
      return $this->response([
        'type_msg' => "error",
        'msg' => "do not have permission to access"
      ]);
    }

if (dec_url($id) == 1) {
  $json['type_msg'] = "error";
  $json['msg'] = "Reset password gagal!";
}else {
    $row = $this->model->get_where_data(dec_url($id));
    $warga = $this->db->query("select * from warga where id='".$row->id_warga."'")->row();
    $token =  randomKey();
    $update['token'] = $token;
    $update['password'] = pass_encrypt($token,$warga->no_ktp);
    $update['modified'] = date('Y-m-d H:i:s');

    $this->model->get_update("auth_user",$update,["id_user"=>dec_url($id)]);

      $json['type_msg'] = "success";
      $json['msg'] = "Username dan Password adalah NIK";
    }

    return $this->response($json);
  }
}

public function toggle_status($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_delete')) {
      return $this->response([
        'type_msg' => "error",
        'msg' => "do not have permission to access"
      ]);
    }

if (dec_url($id) == 1 || dec_url($id) == 2) {
  $json['type_msg'] = "error";
  $json['msg'] = "Tidak bisa dimatikan";
}else {
    $row = $this->db->query("select * from auth_user where id_user='".dec_url($id)."'")->row();
    $status = $row->is_active == 1 ? 0 : 1;

    $update = [
      'is_active' => $status,
      'modified' => date('Y-m-d H:i:s')
    ];
    $this->model->get_update("auth_user",$update,["id_user"=>dec_url($id)]);

      $json['type_msg'] = "success";
      $json['msg'] = "Status aktif sudah diubah";
    }

    return $this->response($json);
  }
}

function _cek_email($str)
{
  if (isset($_POST['last_email'])) {
    $qry = $this->db->get_where("auth_user",["email" => $str ,"email !=" => $_POST['last_email'] , "is_delete !=" => "1"]);
  }else {
    $qry = $this->db->get_where("auth_user",["email"=> $str , "is_delete !=" => "1"]);
  }
  if ($qry->num_rows() > 0) {
    $this->form_validation->set_message('_cek_email', '*&nbsp;already available');
    return FALSE;
  }else {
    return TRUE;
  }
}


}
