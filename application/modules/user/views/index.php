<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      
    <div class="card-body">
          <div class="mb-2">
            <?php if (profile('id_group') <= 2): ?>
            <a href="<?=url("user/add")?>" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i><?=cclang("add_new",ucfirst($title_module))?></a>
            <?php endif; ?>
            <a href="<?=url("user/activating_all")?>" class="mx-2 btn btn-sm btn-info btn-icon-text">Aktifkan Semua User</a>
          </div>

          <style>
            .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

            </style>
		<div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabel" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
    <tr>
      <th>#</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Group</th>
      <th>Is Active</th>
      <th>Join</th>
      <th>Last login</th>
      <th>Aksi</th>
      <?php if (profile('id_group') <= 2): ?>
      <th>Opsional</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($data as $row) {
     
      echo '<tr>';
      
      if (profile('id_group') <= 2):
        echo '<td>'.$row[0].'</td>'.
        '<td>'.$row[1].'</td>'.
        '<td>'.$row[2].'</td>'.
        '<td>'.$row[3].'</td>'.
        '<td>'.$row[4].'</td>'.
        '<td>'.$row[5].'</td>'.
        '<td>'.$row[6].'</td>'.
        '<td>'.$row[7].'</td>'.
        '<td>'.$row[8].'</td>';
      else:
        echo '<td>'.$row[0].'</td>'.
        '<td>'.$row[1].'</td>'.
        '<td>'.$row[2].'</td>'.
        '<td>'.$row[3].'</td>'.
        '<td>'.$row[4].'</td>'.
        '<td>'.$row[5].'</td>'.
        '<td>'.$row[6].'</td>'.
        '<td>'.$row[7].'</td>';
      endif;
      echo '</tr>';
      $no++;
      }
      ?>
      
        </tbody>
      </table>
		</div>
      </div>
    </div>
  </div>
</div>

<style>
  .dataTables_wrapper .dt-buttons {
  float: right;
  margin-bottom: 4px;
}

.dataTables_wrapper .dataTables_filter {
  float: left;
  margin-right: 11px;
}
</style>

<script type="text/javascript">
$(document).ready(function(){

  $('#tabel').DataTable({
      "retrieve": true,
      "dom": 'Bfrtip',
      "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ], });

$(document).on("click","#delete",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('<?=cclang("confirm")?>');
  $('#modalContent').html(`<p class="mb-4"><?= "Yakin dengan pilihan Anda?"?></p>
														<button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
	                          <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`><?=cclang("delete_action")?></button>
														`);
  $("#modalGue").modal('show');
});


$(document).on('click','#ya-hapus',function(e){
  $(this).prop('disabled',true)
          .text('Processing...');
  $.ajax({
          url:$(this).data('url'),
          type:'POST',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            swal(json.msg, {
              icon:json.type_msg
            }).then(() => {
              window.location.href = "<?= base_url(ADMIN_ROUTE.'/user') ?>";
            });
          }
        });
});


});
</script>
