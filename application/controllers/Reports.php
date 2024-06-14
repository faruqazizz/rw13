<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\DocumentProperties;
use Dompdf\Dompdf;

class Reports extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
  }
  
  private $path = "_temp/uploads/img/";

public function statistik($tipe,$param){
  $data['tipe'] = $tipe;
  if($param == "agama"){
    $data['judul'] = strtoupper($param);
    $data['chart_data'] = $this->db->query("SELECT nama as label, COUNT(*) as total FROM warga, agama WHERE warga.agama = agama.id GROUP BY warga.agama")->result();
  } 
  elseif($param == "gender"){
    $data['judul'] = strtoupper($param);
    $data['chart_data'] = $this->db->query("SELECT nama as label, COUNT(*) as total FROM warga, kelamin WHERE warga.jenis_kelamin = kelamin.id GROUP BY warga.jenis_kelamin")->result();
  }
  elseif($param == "pendidikan"){
    $data['judul'] = strtoupper($param);
    $data['chart_data'] = $this->db->query("SELECT nama as label, COUNT(*) as total FROM warga, pendidikan_terakhir WHERE warga.pendidikan_terakhir = pendidikan_terakhir.id GROUP BY warga.pendidikan_terakhir")->result();
  }
  elseif($param == "profesi"){
    $data['judul'] = strtoupper($param);
    $data['chart_data'] = $this->db->query("SELECT nama_profesi as label, COUNT(*) as total FROM warga, profesi WHERE warga.id_profesi = profesi.id GROUP BY warga.id_profesi")->result();
  }
  elseif($param == "rt"){
    $data['judul'] = strtoupper($param);
    $data['chart_data'] = $this->db->query("SELECT definition as label, COUNT(*) as total FROM warga, auth_group WHERE warga.id_group = auth_group.id GROUP BY warga.id_group")->result();
  }
  elseif($param == "status"){
    $data['judul'] = strtoupper($param);
    $data['chart_data'] = $this->db->query("SELECT nama_stts_warga as label, COUNT(*) as total FROM warga, status_warga WHERE warga.status_warga = status_warga.id GROUP BY warga.status_warga")->result();
  }
  
  $data['warna'] = ['orange', 'green', 'blue', 'red', 'yellow', 'dark', 'pink','magenta','cyan','purple'];
  $this->load->view('lihat', $data);
}

  function cetak_surat_pdf($id_surat)
  {
    $this->load->library(array("encryption", "my_encrypt"));
    $this->load->helper(['sct', 'format_helper']);
    // Ambil jenis surat
    $jenis = $this->db->query("select * from tb_surat, tb_jenis_surat where tb_surat.id_jenis_surat = tb_jenis_surat.id and tb_surat.id ='".dec_url($id_surat)."'")->row();
    // Ambil data warga dari database (misalkan menggunakan model Warga_model)
    $warga = $this->db->query("select * from warga, tb_surat where warga.id = tb_surat.id_warga and tb_surat.id ='".dec_url($id_surat)."'")->result();
	
    $templateProcessor = new TemplateProcessor(FCPATH . $this->path . $jenis->contoh_dokumen);

    // Looping untuk mengganti variabel template dengan data warga
    foreach ($warga as $data) {
    // Ganti nilai variabel template dengan data warga
    $templateProcessor->setValue('no_kk', $data->no_kk);
    $templateProcessor->setValue('no_ktp', $data->no_ktp);
    $templateProcessor->setValue('nama_lengkap', $data->nama_lengkap);
    $templateProcessor->setValue('tempat_lahir', $data->tempat_lahir);
    $templateProcessor->setValue('tgl_lahir', tgl_indo($data->tgl_lahir,1));
    $templateProcessor->setValue('hp', $data->hp);
    $jk = $this->db->query("select * from kelamin where id='".$data->jenis_kelamin."'")->row();
    $templateProcessor->setValue('jenis_kelamin', $jk->nama);
    $agama = $this->db->query("select * from agama where id='".$data->agama."'")->row();
    $templateProcessor->setValue('agama', $agama->nama);
    $pendidikan = $this->db->query("select * from pendidikan_terakhir where id='".$data->pendidikan_terakhir."'")->row();
    $templateProcessor->setValue('pendidikan', $pendidikan->nama);
  	$profesi = $this->db->query("select * from profesi where id='".$data->id_profesi."'")->row();
    $templateProcessor->setValue('profesi', $profesi->nama_profesi);

    $templateProcessor->setValue('alamat', $data->alamat);
    $templateProcessor->setValue('foto_profil', $data->foto_profil);
    $templateProcessor->setValue('ttd_digital', $data->ttd_digital);
    $templateProcessor->setValue('link_drive', $data->link_drive);
  	$status = $this->db->query("select * from status_warga where id='".$data->status_warga."'")->row();
    $templateProcessor->setValue('status', $status->nama_stts_warga);
    //    $templateProcessor->setValue('tgl_dibuat', $data->tgl_dibuat);

    // Ganti nilai variabel template dengan data surat
    $templateProcessor->setValue('nomor_surat', $data->nomor_surat);
    $templateProcessor->setValue('no_surat_rw', $data->no_surat_rw);
    $templateProcessor->setValue('tgl_ajuan', $data->tgl_ajuan);
    $templateProcessor->setValue('keperluan', $data->keperluan);
    $templateProcessor->setValue('id_status_surat', $data->id_status_surat);
    $templateProcessor->setValue('tgl_keputusan', tgl_indo($data->tgl_keputusan,1));
    $rt = $this->db->query("select * from auth_group where id='".$data->id_group."'")->row();
    $rtGroup = str_replace('rt', '', $rt->group);
    $templateProcessor->setValue('rt_group', $rtGroup);
    $rw = $this->db->query("select * from warga where id='1'")->row();
    $templateProcessor->setValue('nama_rw', $rw->nama_lengkap);
    $rt = $this->db->query("select warga.nama_lengkap as nama_rt from auth_user, auth_user_to_group, warga, tb_surat where auth_user.id_warga = warga.id and auth_user.id_user = auth_user_to_group.id_user and tb_surat.id_group = auth_user_to_group.id_group and tb_surat.id_group = '".$data->id_group."' GROUP BY tb_surat.id")->row();
  	$templateProcessor->setValue('nama_rt', $rt->nama_rt);
    $kop = $this->db->query("select * from tb_kopsurat where id_group='".$data->id_group."'")->row();
    // Path gambar
    $gambarPath = base_url('_temp/uploads/img/') . $kop->gambar_kop; // Ganti dengan nama gambar webp yang sesuai
    // Simpan data gambar webp ke file sementara dengan ekstensi .webp
    $tempWebpFile = tempnam(sys_get_temp_dir(), 'phpword');
    copy($gambarPath, $tempWebpFile);
    // Ubah file sementara menjadi format gambar .png
    $tempPngFile = tempnam(sys_get_temp_dir(), 'phpword') . '.png';
    $image = imagecreatefromwebp($tempWebpFile);
    imagepng($image, $tempPngFile);
    $templateProcessor->setImageValue('gambar', ['path'=> $tempPngFile, 'width' => 795, 'height'=> 530]);
    }

    // Simpan dokumen Word ke file sementara
    $tempDocxFile = tempnam(sys_get_temp_dir(), 'phpword');
    $templateProcessor->saveAs($tempDocxFile);

    // Load dokumen Word menggunakan PHPWord
    $phpWord = IOFactory::load($tempDocxFile);

    // Mengatur informasi dokumen
    $properties = $phpWord->getDocInfo();
    $properties->setCreator('Faruq Aziz');
    $properties->setCompany('FaServ');
    $properties->setTitle('Surat Pengantar');
    $properties->setDescription('Surat Pengantar');
    $properties->setCreated(date('Y-m-d'));
    $properties->setSubject('Surat Pengantar');
    $properties->setKeywords('Surat Pengantar, RW13, Warga');

    // Simpan dokumen Word ke file HTML
    $tempHtmlFile = tempnam(sys_get_temp_dir(), 'phpword');
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    $htmlWriter->save($tempHtmlFile);

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Baca file HTML
    $htmlContent = file_get_contents($tempHtmlFile);

    // Muat konten HTML ke Dompdf
    $dompdf->loadHtml($htmlContent);

    // Render dokumen ke PDF
    $dompdf->render();

    // Set nama file PDF yang akan diunduh
    $filename = $data->nama_lengkap.'.pdf';

    // Mengirimkan header untuk file PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');

    // Mengirimkan konten PDF ke output
    echo $dompdf->output();

//     // Mengirimkan header untuk file ZIP
// header('Content-Type: application/zip');
// header('Content-Disposition: attachment; filename="' . $filename . '.zip"');
// header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0');
// header('Expires: 0');

// // Membuat file ZIP
// $zip = new ZipArchive();
// $tempZipFile = tempnam(sys_get_temp_dir(), 'phpword') . '.zip';
// $zip->open($tempZipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// // Menambahkan file PDF ke dalam ZIP
// $zip->addFromString($filename . '.pdf', $dompdf->output());

// // Menambahkan file HTML ke dalam ZIP
// $htmlContent = file_get_contents($tempHtmlFile);
// $zip->addFromString($filename . '.html', $htmlContent);

// // Tutup ZIP
// $zip->close();

// // Mengirimkan konten ZIP ke output
// echo file_get_contents($tempZipFile);

// // Hapus file sementara
// unlink($tempZipFile);


    // Hapus file sementara dokumen Word dan HTML
    unlink($tempWebpFile);
    unlink($tempPngFile);
    unlink($tempDocxFile);
    unlink($tempHtmlFile);
  }
  
  function cetak_surat($id_surat)
  {
    $this->load->library(array("encryption", "my_encrypt"));
    $this->load->helper(['sct', 'format_helper']);
    // Ambil jenis surat
    $jenis = $this->db->query("select * from tb_surat, tb_jenis_surat where tb_surat.id_jenis_surat = tb_jenis_surat.id and tb_surat.id ='".dec_url($id_surat)."'")->row();
    // Ambil data warga dari database (misalkan menggunakan model Warga_model)
    $warga = $this->db->query("select * from warga, tb_surat where warga.id = tb_surat.id_warga and tb_surat.id ='".dec_url($id_surat)."'")->result();
	
    $templateProcessor = new TemplateProcessor(FCPATH . $this->path . $jenis->contoh_dokumen);

    // Looping untuk mengganti variabel template dengan data warga
    foreach ($warga as $data) {
    $templateProcessor->setValue('no_kk', $data->no_kk);
    $templateProcessor->setValue('no_ktp', $data->no_ktp);
    $templateProcessor->setValue('nama_lengkap', $data->nama_lengkap);
    $templateProcessor->setValue('tempat_lahir', $data->tempat_lahir);
    $templateProcessor->setValue('tgl_lahir', tgl_indo($data->tgl_lahir,1));
    $templateProcessor->setValue('hp', $data->hp);
	$jk = $this->db->query("select * from kelamin where id='".$data->jenis_kelamin."'")->row();
	$templateProcessor->setValue('jenis_kelamin', $jk->nama);
	$agama = $this->db->query("select * from agama where id='".$data->agama."'")->row();
    $templateProcessor->setValue('agama', $agama->nama);
	$pendidikan = $this->db->query("select * from pendidikan_terakhir where id='".$data->pendidikan_terakhir."'")->row();
    $templateProcessor->setValue('pendidikan', $pendidikan->nama);
	$profesi = $this->db->query("select * from profesi where id='".$data->id_profesi."'")->row();
    $templateProcessor->setValue('profesi', $profesi->nama_profesi);
    $templateProcessor->setValue('alamat', $data->alamat);
    $templateProcessor->setValue('foto_profil', $data->foto_profil);
    $templateProcessor->setValue('ttd_digital', $data->ttd_digital);
    $templateProcessor->setValue('link_drive', $data->link_drive);
	$status = $this->db->query("select * from status_warga where id='".$data->status_warga."'")->row();
    $templateProcessor->setValue('status', $status->nama_stts_warga);
    $templateProcessor->setValue('nomor_surat', $data->nomor_surat);
    $templateProcessor->setValue('no_surat_rw', $data->no_surat_rw);
    $templateProcessor->setValue('tgl_ajuan', $data->tgl_ajuan);
    $templateProcessor->setValue('keperluan', $data->keperluan);
    $templateProcessor->setValue('id_status_surat', $data->id_status_surat);
    $templateProcessor->setValue('tgl_keputusan', tgl_indo($data->tgl_keputusan,1));
	$rt = $this->db->query("select * from auth_group where id='".$data->id_group."'")->row();
	$rtGroup = str_replace('rt', '', $rt->group);
	$templateProcessor->setValue('rt_group', $rtGroup);
	$rw = $this->db->query("select * from warga where id='1'")->row();
	$templateProcessor->setValue('nama_rw', $rw->nama_lengkap);
	$rt = $this->db->query("select warga.nama_lengkap as nama_rt from auth_user, auth_user_to_group, warga, tb_surat where auth_user.id_warga = warga.id and auth_user.id_user = auth_user_to_group.id_user and tb_surat.id_group = auth_user_to_group.id_group and tb_surat.id_group = '".$data->id_group."' GROUP BY tb_surat.id")->row();
	$templateProcessor->setValue('nama_rt', $rt->nama_rt);
  $kop = $this->db->query("select * from tb_kopsurat where id_group='".$data->id_group."'")->row();
  // Path gambar
  $gambarPath = base_url('_temp/uploads/img/') . $kop->gambar_kop; // Ganti dengan nama gambar webp yang sesuai
  // Simpan data gambar webp ke file sementara dengan ekstensi .webp
  $tempWebpFile = tempnam(sys_get_temp_dir(), 'phpword');
  copy($gambarPath, $tempWebpFile);
    // Ubah file sementara menjadi format gambar .png
  $tempPngFile = tempnam(sys_get_temp_dir(), 'phpword') . '.png';
  $image = imagecreatefromwebp($tempWebpFile);
  imagepng($image, $tempPngFile);
	$templateProcessor->setImageValue('gambar', ['path'=> $tempPngFile, 'width' => 795, 'height'=> 530]);
    }
 // Simpan dokumen Word ke file sementara
$tempDocxFile = tempnam(sys_get_temp_dir(), 'phpword');
$templateProcessor->saveAs($tempDocxFile);

// Set nama file yang akan diunduh
$filename = $data->nama_lengkap.'.docx';

// Mengirimkan header untuk file Word
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');

// Mengirimkan konten dokumen Word ke output
readfile($tempDocxFile);

// Hapus file sementara
unlink($tempWebpFile);
unlink($tempPngFile);
unlink($tempDocxFile);
  }
}
