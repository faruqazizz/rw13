<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Signin{

  function _tokens()
  {
    if (!$this->session->token) {
      $this->session->set_userdata("token",randomKey(26));
    }
    return;
  }

  function index()
  {
        // Load library reCAPTCHA
        $this->load->library('captcha');
        if ($this->auth->is_logged()) {
          redirect(url("dashboard"),"refresh");
        }
        // Render reCAPTCHA di view
        $data['captcha_html'] = $this->captcha->render();
    
       $this->_tokens();
       $this->load->view("login-clasic", $data);

  }

  function action()
  {
    if ($this->input->is_ajax_request()) {
          if ($this->input->post("token") or $this->session->token == $this->input->post("token")) {
            $this->load->model("Login_model","model");
            $this->load->library("form_validation");
            $json = array('success'=>false, 'alert'=>array(), "valid" => false, "url" => null, 'token'=>'');
            $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|required");
            $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required");
            $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
            if ($this->form_validation->run()) {
              $json['success'] =  true;
              $email = $this->input->post('email');
              $password = $this->input->post('password');

              if($email){
                // Cek apakah nilai kolom email mengandung "@" dan ".com"
                  if (strpos($email, '@') !== false && strpos($email, '.') !== false) {
                    // Atur nilai kolom tersebut sebagai email
                    $email;
                  } else {
                    $no_ktp = $this->db->query("SELECT * FROM auth_user, warga WHERE auth_user.id_warga = warga.id AND warga.no_ktp='".$email."'")->row_array();                    
                    $email = $no_ktp['email'];
                  }
              }

              // reCAPTCHA valid, lanjutkan dengan proses login
              $recaptchaResponse = $this->input->post('g-recaptcha-response');
              $captcha = new Captcha(); // Load library Captcha
              $captchaResponse = $captcha->verifyResponse($recaptchaResponse);
              if ($captchaResponse['success']) {   
                $account = $this->model->get_data($email);
                if ($account->num_rows() > 0) {
                  $row = $account->row();
                  $token = $row->token;
                  $password_account = $row->password;
                  if (pass_decrypt($token,$password,$password_account)) {    
                    $session = array('id_user' => $row->id_user, 'groupnya' => $row->id_group, "login_status" => true );
                    $this->session->set_userdata($session);
  
                    $data = ['last_login'=> date("Y-m-d H:i"), "ip_address" => $this->input->ip_address()];
                    $this->db->where(['id_user'=> $row->id_user]);
                    $this->db->update("auth_user", $data);
  
                    $json['valid'] = true;
                    $json["url"] = site_url(ADMIN_ROUTE."/dashboard");
                
                  }else {
                    $json['alert'] = "Email atau password salah";
                  }
                }else {
                  $json['alert'] = "User tidak ditemukan";
                }
              } else {
                    // reCAPTCHA tidak valid, tampilkan pesan error atau ambil tindakan yang sesuai
                    $json['alert'] = "Harap verifikasi reCAPTCHA";
                }
              $this->session->unset_userdata("token");
              $this->_tokens();
              $json['token'] = $this->session->token;
            }else {
              foreach ($_POST as $key => $value)
                {
                  $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
          }else {
            $this->output->set_status_header(403);
            show_error("Token Invalid", 403,'403::Token');
          }
      }
  }

  function logout()
  {
    $this->session->unset_userdata('id_user'); // Untuk menghapus 'id_user' dari session
    $this->session->unset_userdata('groupnya'); // Untuk menghapus 'groupnya' dari session
    $this->session->unset_userdata('login_status'); // Untuk menghapus 'login_status' dari session
    $this->session->unset_userdata('token'); // Untuk menghapus 'login_status' dari session
    $session_path = $this->config->item('sess_save_path');
    // Hapus file ci_session terkait pengguna yang logout
    $session_files = $session_path ."ci_session_".$this->session->userdata('session_id');
    foreach ($session_files as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
    $this->session->sess_destroy();
    redirect(LOGIN_ROUTE,"refresh");
  }




}
