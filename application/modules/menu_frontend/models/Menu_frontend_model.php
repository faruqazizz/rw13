<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 17/04/2023 10:29*/
/*| Please DO NOT modify this information*/


class Menu_frontend_model extends MY_Model{

  private $table        = "menu_frontend";
  private $primary_key  = "id";
  private $column_order = array('nama_menu', 'tautan_menu', 'id_halaman');
  private $order        = array('menu_frontend.id'=>"DESC");
  private $select       = "menu_frontend.id,menu_frontend.nama_menu,menu_frontend.tautan_menu,menu_frontend.id_halaman";

public function __construct()
	{
		$config = array(
      'table' 	      => $this->table,
			'primary_key' 	=> $this->primary_key,
		 	'select' 	      => $this->select,
      'column_order' 	=> $this->column_order,
      'order' 	      => $this->order,
		 );

		parent::__construct($config);
	}

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);
      $this->_get_join();

    if($this->input->post("nama_menu"))
        {
          $this->db->like("menu_frontend.nama_menu", $this->input->post("nama_menu"));
        }

    if($this->input->post("tautan_menu"))
        {
          $this->db->like("menu_frontend.tautan_menu", $this->input->post("tautan_menu"));
        }

    if($this->input->post("id_halaman"))
        {
          $this->db->like("menu_frontend.id_halaman", $this->input->post("id_halaman"));
        }

      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
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
      $this->db->from("$this->table");
      $this->_get_join();
      return $this->db->count_all_results();
    }

    public function _get_join()
    {
      $this->db->select("menu_halaman.nama_halaman");
      $this->db->join("menu_halaman","menu_halaman.id = menu_frontend.id_halaman","left");
    }

    public function get_detail($id)
    {
        $this->db->select("".$this->table.".*");
        $this->db->from($this->table);
        $this->_get_join();
        $this->db->where("".$this->table.'.'.$this->primary_key,$id);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
          return $query->row();
        }else{
          return FALSE;
        }
    }

}

/* End of file Menu_frontend_model.php */
/* Location: ./application/modules/menu_frontend/models/Menu_frontend_model.php */
