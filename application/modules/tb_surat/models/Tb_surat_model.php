<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 15/05/2023 09:17*/
/*| Please DO NOT modify this information*/


class Tb_surat_model extends MY_Model{

  private $table        = "tb_surat";
  private $primary_key  = "id";
  private $column_order = array('id_jenis_surat', 'id_warga', 'nomor_surat', 'tgl_ajuan', 'keperluan', 'id_status_surat', 'tgl_keputusan', 'id_group', 'revisi', 'date_updated','no_surat_rw');
  private $order        = array('tb_surat.id'=>"DESC");
  private $select       = "tb_surat.id,tb_surat.id_jenis_surat,tb_surat.id_warga,tb_surat.nomor_surat,tb_surat.tgl_ajuan,tb_surat.keperluan,tb_surat.id_status_surat,tb_surat.tgl_keputusan,tb_surat.id_group,tb_surat.revisi,tb_surat.date_updated,tb_surat.no_surat_rw";

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

    if($this->input->post("id_jenis_surat"))
        {
          $this->db->like("tb_surat.id_jenis_surat", $this->input->post("id_jenis_surat"));
        }

    if($this->input->post("id_warga"))
        {
          $this->db->like("tb_surat.id_warga", $this->input->post("id_warga"));
        }

    if($this->input->post("nomor_surat"))
        {
          $this->db->like("tb_surat.nomor_surat", $this->input->post("nomor_surat"));
        }

    if($this->input->post("tgl_ajuan"))
        {
          $this->db->like("tb_surat.tgl_ajuan", date('Y-m-d H:i',strtotime($this->input->post("tgl_ajuan"))));
        }

    if($this->input->post("keperluan"))
        {
          $this->db->like("tb_surat.keperluan", $this->input->post("keperluan"));
        }

    if($this->input->post("id_status_surat"))
        {
          $this->db->like("tb_surat.id_status_surat", $this->input->post("id_status_surat"));
        }

    if($this->input->post("tgl_keputusan"))
        {
          $this->db->like("tb_surat.tgl_keputusan", date('Y-m-d',strtotime($this->input->post("tgl_keputusan"))));
        }

    if($this->input->post("id_group"))
        {
          $this->db->like("tb_surat.id_group", $this->input->post("id_group"));
        }

    if($this->input->post("revisi"))
        {
          $this->db->like("tb_surat.revisi", $this->input->post("revisi"));
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
      $this->db->select("tb_jenis_surat.nama_surat");
      $this->db->join("tb_jenis_surat","tb_jenis_surat.id = tb_surat.id_jenis_surat","left");
      $this->db->select("warga.no_ktp");
      $this->db->join("warga","warga.id = tb_surat.id_warga","left");
      $this->db->select("tb_status_surat.nama_status");
      $this->db->join("tb_status_surat","tb_status_surat.id = tb_surat.id_status_surat","left");
      $this->db->select("auth_group.group");
      $this->db->join("auth_group","auth_group.id = tb_surat.id_group","left");
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

/* End of file Tb_surat_model.php */
/* Location: ./application/modules/tb_surat/models/Tb_surat_model.php */
