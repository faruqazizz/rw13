<?php 

function randomKey()
{
  $this->load->library('encryption');
  return bin2hex($this->encryption->create_key(16));
}

  function pass_encrypt($token,$str)
  {
	  $ecrypt = password_hash($str."".$token,PASSWORD_DEFAULT);
	  return $ecrypt;
  }

  function buat_email($param){
	  $emailnya_ini= $this->db->query("select * from setting where id_setting=10")->row();
	  return $param = $param . $emailnya_ini->value;
	  }

	function is_image($params = false)
	{
		$str = '';
		if ($params) {
			if (file_exists(FCPATH."_temp/uploads/img/$params")) {
				$str.='<a href="'.base_url().'_temp/uploads/img/'.$params.'" data-fancybox="gallery" title="'.$params.'">
		              <img src="'.base_url().'_temp/uploads/img/'.$params.'" class="img-fluid" alt="'.$params.'" />
		            </a>';
			}else {
				$str.='<a href="'.base_url().'_temp/uploads/noimage.jpg" data-fancybox="gallery" title="No Image Available">
		              <img src="'.base_url().'_temp/uploads/noimage.jpg" class="img-fluid" alt="noimage" />
		            </a>';
			}
		}else {
			$str.='<a href="'.base_url().'_temp/uploads/noimage.jpg" data-fancybox="gallery" title="Tidak Ada Kegiatan">
	              <img src="'.base_url().'_temp/uploads/noimage.jpg" class="img-fluid" alt="noimage" />
	            </a>';
		}

		return $str;
	}