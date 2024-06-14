<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-2">
          <a href="<?=url("tb_surat/add")?>" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i><?=cclang("add_new")?></a>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
							<th>Cetak Surat</th>
							<th>Jenis surat</th>
							<th>Pengaju</th>
							<th>Tgl ajuan</th>
							<th>Keperluan</th>
							<th>Status surat</th>
							<th>Tgl keputusan</th>
							<th>Validator</th>
							<th>Catatan</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
    foreach ($data as $row) {
      echo '<tr>';
      echo 
      '<td>'.$row[0].'</td>'.
      '<td>'.$row[1].'</td>'.
      '<td>'.$row[2].'</td>'.
      '<td>'.$row[3].'</td>'.
      '<td>'.$row[4].'</td>'.
      '<td>'.$row[5].'</td>'.
      '<td>'.$row[6].'</td>'.
      '<td>'.$row[7].'</td>'.
      '<td>'.$row[8].'</td>'.
      '<td>'.$row[9].'</td>';
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
var table;
//datatables
  table = $('#table').DataTable({
      "retrieve": true,
      "dom": 'Bfrtip',
      "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
    });

  $(document).on("click","#delete",function(e){
    e.preventDefault();
    $('.modal-dialog').addClass('modal-sm');
    $("#modalTitle").text('<?=cclang("confirm")?>');
    $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
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
              });
              $('#table').DataTable().ajax.reload();
            }
          });
  });


});
</script>
