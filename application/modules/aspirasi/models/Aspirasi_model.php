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


class Aspirasi_model extends MY_Model{

  private $table        = "aspirasi";
  private $primary_key  = "id";
  private $column_order = array('nama_pengadu', 'email', 'subjek_aduan', 'isi_aspirasi', 'ip_address', 'tanggal_dibuat');
  private $order        = array('aspirasi.id'=>"DESC");
  private $select       = "aspirasi.id,aspirasi.nama_pengadu,aspirasi.email,aspirasi.subjek_aduan,aspirasi.isi_aspirasi,aspirasi.ip_address,aspirasi.tanggal_dibuat";

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

    if($this->input->post("nama_pengadu"))
        {
          $this->db->like("aspirasi.nama_pengadu", $this->input->post("nama_pengadu"));
        }

    if($this->input->post("email"))
        {
          $this->db->like("aspirasi.email", $this->input->post("email"));
        }

    if($this->input->post("subjek_aduan"))
        {
          $this->db->like("aspirasi.subjek_aduan", $this->input->post("subjek_aduan"));
        }

    if($this->input->post("isi_aspirasi"))
        {
          $this->db->like("aspirasi.isi_aspirasi", $this->input->post("isi_aspirasi"));
        }

    if($this->input->post("ip_address"))
        {
          $this->db->like("aspirasi.ip_address", $this->input->post("ip_address"));
        }

    if($this->input->post("tanggal_dibuat"))
        {
          $this->db->like("aspirasi.tanggal_dibuat", date('Y-m-d H:i',strtotime($this->input->post("tanggal_dibuat"))));
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

/* End of file Aspirasi_model.php */
/* Location: ./application/modules/aspirasi/models/Aspirasi_model.php */
