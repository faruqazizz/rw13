<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 08/05/2023 08:29*/
/*| Please DO NOT modify this information*/


class Tb_status_surat_model extends MY_Model{

  private $table        = "tb_status_surat";
  private $primary_key  = "id";
  private $column_order = array('nama_status', 'date_created');
  private $order        = array('tb_status_surat.id'=>"ASC");
  private $select       = "tb_status_surat.id,tb_status_surat.nama_status,tb_status_surat.date_created";

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

    if($this->input->post("nama_status"))
        {
          $this->db->like("tb_status_surat.nama_status", $this->input->post("nama_status"));
        }

    if($this->input->post("date_created"))
        {
          $this->db->like("tb_status_surat.date_created", date('Y-m-d H:i',strtotime($this->input->post("date_created"))));
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
      return $this->db->count_all_results();
    }



}

/* End of file Tb_status_surat_model.php */
/* Location: ./application/modules/tb_status_surat/models/Tb_status_surat_model.php */
