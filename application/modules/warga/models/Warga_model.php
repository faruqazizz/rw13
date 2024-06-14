<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : faservice  */
/*| version : V.1.0.0 */
/*| facebook : https://web.facebook.com/faruq.aziz.14 */
/*| fanspage : https://faservice.github.io/ */
/*| instagram : https://www.instagram.com/faservice */
/*| youtube : https://www.youtube.com/@faruqaziz8019 */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 10/05/2023 15:29*/
/*| Please DO NOT modify this information*/


class Warga_model extends MY_Model{

  private $table        = "warga";
  private $primary_key  = "id";
  private $column_order = array('no_ktp', 'nama_lengkap', 'tgl_lahir', 'hp', 'jenis_kelamin', 'id_group', 'status_warga', 'tgl_dibuat');
  private $order        = array('warga.id'=>"DESC");
  private $select       = "warga.id,warga.no_kk,warga.no_ktp,warga.nama_lengkap,warga.tempat_lahir,warga.tgl_lahir,warga.hp,warga.jenis_kelamin,warga.agama,warga.pendidikan_terakhir,warga.id_profesi,warga.id_group,warga.alamat,warga.status_warga";

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
        // tambahkan kondisi WHERE jika id_group pada sessionnya 4
        $id_group = sess('groupnya');
        if ($id_group > 3) {
            $this->db->where('id_group', $id_group);
        }
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
      $this->db->select("kelamin.nama as nakel");
      $this->db->join("kelamin","kelamin.id = warga.jenis_kelamin","left");
      $this->db->select("agama.nama as naag");
      $this->db->join("agama","agama.id = warga.agama","left");
      $this->db->select("pendidikan_terakhir.nama as napen");
      $this->db->join("pendidikan_terakhir","pendidikan_terakhir.id = warga.pendidikan_terakhir","left");
      $this->db->select("profesi.nama_profesi as profesi");
      $this->db->join("profesi","profesi.id = warga.id_profesi","left");
      $this->db->select("auth_group.group");
      $this->db->join("auth_group","auth_group.id = warga.id_group","left");
      $this->db->select("status_warga.nama_stts_warga");
      $this->db->join("status_warga","status_warga.id = warga.status_warga","left");
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

/* End of file Warga_model.php */
/* Location: ./application/modules/warga/models/Warga_model.php */
