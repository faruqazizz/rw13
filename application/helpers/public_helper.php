<?php defined('BASEPATH') OR exit('No direct script access allowed');


function sess($str)
{
  $ci =  &get_instance();
  return $ci->session->userdata($str);
}


function setting($kd = null , $field = "value")
{
  $ci =  &get_instance();
  $kd = strtolower($kd);
  $qry = $ci->db->get_where("setting", ["options" => $kd]);
  if ($qry->num_rows() > 0) {
    return $qry->row()->$field;
  }else {
    return "System not available";
  }
}


function imgView($img = "", $class = "img-thumbnail", $style = "")
{
  $str = '';
  if ($img != "") {
    $img_path = base_url() . '_temp/uploads/img/' . $img;
    $img_info = getimagesize($img_path);
    if ($img_info && ($img_info['mime'] == 'image/jpeg' || $img_info['mime'] == 'image/png' || $img_info['mime'] == 'image/gif' || $img_info['mime'] == 'image/webp' || $img_info['mime'] == 'image/jpg')) {
      $str .= '<a href="' . $img_path . '" data-fancybox="gallery">
                  <img src="' . $img_path . '" alt="' . $img . '" style="' . $style . '" class="' . $class . '" />
                </a>';
    } else {
      $str .= '<a href="' . $img_path . '">Lihat File</a>';
    }
  } else {
    $str .= '<a href="' . base_url() . '_temp/uploads/noimage.jpg" data-fancybox="gallery">
              <img src="' . base_url() . '_temp/uploads/noimage.jpg" alt="noimage" style="' . $style . '" class="' . $class . '" />
            </a>';
  }

  return $str;
}



function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}
