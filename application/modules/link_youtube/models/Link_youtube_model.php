<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 13/04/2023 10:41*/
/*| Please DO NOT modify this information*/


class Link_youtube_model extends MY_Model{

  private $table        = "link_youtube";
  private $primary_key  = "id";
  private $column_order = array('nama_berkas', 'lokasi_berkas', 'id_stts', 'tanggal_dibuat');
  private $order        = array('link_youtube.id'=>"DESC");
  private $select       = "link_youtube.id,link_youtube.nama_berkas,link_youtube.lokasi_berkas,link_youtube.id_stts,link_youtube.tanggal_dibuat";

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

    if($this->input->post("nama_berkas"))
        {
          $this->db->like("link_youtube.nama_berkas", $this->input->post("nama_berkas"));
        }

    if($this->input->post("lokasi_berkas"))
        {
          $this->db->like("link_youtube.lokasi_berkas", $this->input->post("lokasi_berkas"));
        }

    if($this->input->post("id_stts"))
        {
          $this->db->like("link_youtube.id_stts", $this->input->post("id_stts"));
        }

    if($this->input->post("tanggal_dibuat"))
        {
          $this->db->like("link_youtube.tanggal_dibuat", date('Y-m-d H:i',strtotime($this->input->post("tanggal_dibuat"))));
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
      $this->db->select("stts.keterangan");
      $this->db->join("stts","stts.id = link_youtube.id_stts","left");
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

/* End of file Link_youtube_model.php */
/* Location: ./application/modules/link_youtube/models/Link_youtube_model.php */
