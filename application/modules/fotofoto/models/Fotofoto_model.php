<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 16/04/2023 16:17*/
/*| Please DO NOT modify this information*/


class Fotofoto_model extends MY_Model{

  private $table        = "fotofoto";
  private $primary_key  = "id";
  private $column_order = array('judul_foto', 'lokasi_foto', 'link_berkas', 'id_halaman');
  private $order        = array('fotofoto.id'=>"DESC");
  private $select       = "fotofoto.id,fotofoto.judul_foto,fotofoto.lokasi_foto,fotofoto.link_berkas,fotofoto.id_halaman";

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

    if($this->input->post("judul_foto"))
        {
          $this->db->like("fotofoto.judul_foto", $this->input->post("judul_foto"));
        }

    if($this->input->post("lokasi_foto"))
        {
          $this->db->like("fotofoto.lokasi_foto", $this->input->post("lokasi_foto"));
        }

    if($this->input->post("link_berkas"))
        {
          $this->db->like("fotofoto.link_berkas", $this->input->post("link_berkas"));
        }

    if($this->input->post("id_halaman"))
        {
          $this->db->like("fotofoto.id_halaman", $this->input->post("id_halaman"));
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
      $this->db->select("halaman.nama_halaman");
      $this->db->join("halaman","halaman.id = fotofoto.id_halaman","left");
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

/* End of file Fotofoto_model.php */
/* Location: ./application/modules/fotofoto/models/Fotofoto_model.php */
