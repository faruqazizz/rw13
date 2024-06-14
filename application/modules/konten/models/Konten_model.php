<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 11/04/2023 22:24*/
/*| Please DO NOT modify this information*/


class Konten_model extends MY_Model{

  private $table        = "konten";
  private $primary_key  = "id";
  private $column_order = array('judul', 'slug', 'kata_kunci', 'konten', 'id_kategori', 'cover', 'status_konten', 'tanggal_dibuat');
  private $order        = array('konten.id'=>"DESC");
  private $select       = "konten.id,konten.judul,konten.slug,konten.kata_kunci,konten.konten,konten.id_kategori,konten.cover,konten.status_konten,konten.tanggal_dibuat";

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

    if($this->input->post("judul"))
        {
          $this->db->like("konten.judul", $this->input->post("judul"));
        }

    if($this->input->post("slug"))
        {
          $this->db->like("konten.slug", $this->input->post("slug"));
        }

    if($this->input->post("kata_kunci"))
        {
          $this->db->like("konten.kata_kunci", $this->input->post("kata_kunci"));
        }

    if($this->input->post("konten"))
        {
          $this->db->like("konten.konten", $this->input->post("konten"));
        }

    if($this->input->post("id_kategori"))
        {
          $this->db->like("konten.id_kategori", $this->input->post("id_kategori"));
        }

    if($this->input->post("cover"))
        {
          $this->db->like("konten.cover", $this->input->post("cover"));
        }

    if($this->input->post("status_konten"))
        {
          $this->db->like("konten.status_konten", $this->input->post("status_konten"));
        }

    if($this->input->post("tanggal_dibuat"))
        {
          $this->db->like("konten.tanggal_dibuat", date('Y-m-d H:i',strtotime($this->input->post("tanggal_dibuat"))));
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
      $this->db->join("kategori_konten","kategori_konten.id = konten.id_kategori","left");
      $this->db->select("stts.keterangan");
      $this->db->join("stts","stts.id = konten.status_konten","left");
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

/* End of file Konten_model.php */
/* Location: ./application/modules/konten/models/Konten_model.php */
