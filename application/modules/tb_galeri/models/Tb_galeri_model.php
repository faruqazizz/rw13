<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 11/06/2023 10:08*/
/*| Please DO NOT modify this information*/


class Tb_galeri_model extends MY_Model{

  private $table        = "tb_galeri";
  private $primary_key  = "id";
  private $column_order = array('id_kategori', 'nama_galeri', 'deskripsi_kegiatan', 'cover', 'status_galeri');
  private $order        = array('tb_galeri.id'=>"DESC");
  private $select       = "tb_galeri.id,tb_galeri.id_kategori,tb_galeri.nama_galeri,tb_galeri.deskripsi_kegiatan,tb_galeri.cover,tb_galeri.status_galeri";

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

    if($this->input->post("status_galeri"))
        {
          $this->db->like("tb_galeri.status_galeri", $this->input->post("status_galeri"));
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
      $this->db->select("kategori_konten.nama_kategori");
      $this->db->join("kategori_konten","kategori_konten.id = tb_galeri.id_kategori","left");
      $this->db->select("stts.keterangan");
      $this->db->join("stts","stts.id = tb_galeri.status_galeri","left");
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

/* End of file Tb_galeri_model.php */
/* Location: ./application/modules/tb_galeri/models/Tb_galeri_model.php */
