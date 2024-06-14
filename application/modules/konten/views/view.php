<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
	  <div class="table-responsive">
			<table class="table table-bordered table-striped">
			<tr>
			  <td>Judul</td>
			  <td><?=$judul?></td>
			</tr>
			<tr>
			  <td>Slug</td>
			  <td><?=$slug?></td>
			</tr>
			<tr>
			  <td>Kata kunci</td>
			  <td><?=$kata_kunci?></td>
			</tr>
			<tr>
			  <td>Konten</td>
			  <td><?=$konten?></td>
			</tr>
			<tr>
			  <td>Id kategori</td>
			  <td><?=$id_kategori?></td>
			</tr>
			<tr>
			  <td>Cover</td>
			  <td><?=is_image($cover)?></td>
			</tr>
			<tr>
			  <td>Status konten</td>
			  <td><?=$status_konten?></td>
			</tr>
			<tr>
			  <td>Tanggal dibuat</td>
			  <td><?=$tanggal_dibuat != "" ? date('d-m-Y H:i',strtotime($tanggal_dibuat)):""?></td>
			</tr>
			</table>
		</div>
        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
