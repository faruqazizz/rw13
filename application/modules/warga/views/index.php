<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-2">
          <a href="<?=url("warga/add")?>" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i><?=cclang("add_new")?></a>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabel" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>#</th>
              <th>Dokumen</th>
							<th>No KK</th>
							<th>No KTP</th>
							<th>Nama Lengkap</th>
							<th>Tempat Lahir</th>
							<th>Tgl Lahir</th>
							<th>Nomor Handphone</th>
							<th>Jenis kelamin</th>
							<th>Agama</th>
							<th>Pendidikan</th>
							<th>Profesi</th>
							<th>RT</th>
							<th>Alamat</th>
							<th>Status</th>              
            </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
    foreach ($data as $row) {
      echo '<tr>';
      echo 
      '<td>'.$row[0].'</td>'.
      '<td><a href="'.$row[1].'" target="_blank">Lihat Dokumen</a></td>'.
      '<td>'.$row[2].'</td>'.
      '<td>'.$row[3].'</td>'.
      '<td>'.$row[4].'</td>'.
      '<td>'.$row[5].'</td>'.
      '<td>'.$row[6].'</td>'.
      '<td>'.$row[7].'</td>'.
      '<td>'.$row[8].'</td>'.
      '<td>'.$row[9].'</td>'.
      '<td>'.$row[10].'</td>'.
      '<td>'.$row[11].'</td>'.
      '<td>'.$row[12].'</td>'.
      '<td>'.$row[13].'</td>'.
      '<td>'.$row[14].'</td>';
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
table = $('#tabel').DataTable({
    "retrieve": true,
    "dom": 'Bfrtip',
    "buttons": [
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            exportOptions: {
                columns: ':visible'
            },
            customize: function(doc) {
                doc.defaultStyle.fontSize = 8; // Ubah ukuran font menjadi 8
                doc.pageMargins = [10, 10, 10, 10]; // Atur margin menjadi 10 pada setiap sisi
            }
        },
        'csv', 'excel'
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
              }).then(() => {
              window.location.href = "<?= base_url(ADMIN_ROUTE.'/warga') ?>";
            });
            }
          });
  });


});
</script>
