<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */
class User_model extends MY_Model{

  var $column_order = array();
  var $order = array('auth_user.created'=>"DESC");
  var $select = " auth_user_to_group.id_user,
                  auth_user_to_group.id_group,
                  auth_user.name,
                  auth_user.email,
                  auth_user.is_active,
                  auth_user.photo,
                  auth_user.is_delete,
                  auth_user.created,
                  auth_user.last_login,
                  auth_group.group,
				  auth_user.id_warga,
				  warga.id";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("auth_user_to_group");
      $this->db->join("auth_user","auth_user.id_user = auth_user_to_group.id_user");
      $this->db->join("auth_group","auth_group.id = auth_user_to_group.id_group","left");
	    $this->db->join("warga", "auth_user.id_warga = warga.id", "left");
      $this->db->where("auth_user.is_delete","0");
      $this->db->group_by("auth_user.id_user");
      
      $cek = $this->db->query("SELECT * FROM auth_user_to_group WHERE id_user='".sess("id_user")."'")->row_array();
      if ($cek['id_group'] >= 3) {
          $this->db->like('auth_group.group', 'warga');
          $this->db->or_like('auth_group.group', 'RT');
      }

      if (sess("id_user")!= 1) {
        $this->db->where("auth_user_to_group.id_user !=","1");
      }
      
      
    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        // if($_POST['length'] != -1)
        // $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select($this->select);
        $this->db->from("auth_user_to_group");
        $this->db->join("auth_user","auth_user.id_user = auth_user_to_group.id_user");
        $this->db->join("auth_group","auth_group.id = auth_user_to_group.id_group","left");
		$this->db->join("warga", "auth_user.id_warga = warga.id", "left");
        $this->db->where("auth_user.is_delete","0");
        if (sess("id_user")!= 1) {
          $this->db->where("auth_user_to_group.id_user !=","1");
        }
        return $this->db->count_all_results();
    }


    function get_where_data($id)
    {
      $this->db->select($this->select);
      $this->db->from("auth_user_to_group");
      $this->db->join("auth_user","auth_user.id_user = auth_user_to_group.id_user");
      $this->db->join("auth_group","auth_group.id = auth_user_to_group.id_group","left");
      $this->db->join("warga", "auth_user.id_warga = warga.id", "left");
      $this->db->where("auth_user.is_delete","0");
      if (sess("id_user")!= 1) {
        $this->db->where("auth_user_to_group.id_user !=","1");
      }
      $this->db->where("auth_user.id_user",$id);
      return $this->db->get()->row();
    }

}
