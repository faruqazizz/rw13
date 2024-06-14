<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?= ucwords($title_module) ?>
      </div>
      <div class="card-body">
        <div class="mb-2">
          <a href="<?= url("konten/add") ?>" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i><?= cclang("add_new") ?></a>
          <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> Muat Ulang</button>
          <a href="<?= url("konten/filter/") ?>" id="filter-show" class="btn btn-sm btn-primary btn-icon-text"><i class="mdi mdi-magnify btn-icon-prepend"></i> Filter</a>
        </div>

        <form autocomplete="off" class="content-filter">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" id="judul" class="form-control form-control-sm" placeholder="Judul" />
            </div>

            <div class="form-group col-md-6">
              <input type="text" id="slug" class="form-control form-control-sm" placeholder="Slug" />
            </div>

            <div class="form-group col-md-6">
              <input type="text" id="kata_kunci" class="form-control form-control-sm" placeholder="Kata kunci" />
            </div>

            <div class="form-group col-md-6">
              <input type="text" id="konten" class="form-control form-control-sm" placeholder="Konten" />
            </div>

            <div class="form-group col-md-6">
              <!--
                          app_helper.php - methode is_select
                          is_select("table", "attribute`id & name`", "value", "label", "entry_value`optional`");
                        --->
              <?= is_select_filter("kategori_konten", "id_kategori", "id", "nama_kategori", "Id kategori"); ?>
            </div>

            <div class="form-group col-md-6">
              <input type="text" id="cover" class="form-control form-control-sm" placeholder="Cover" />
            </div>

            <div class="form-group col-md-6">
              <!--
                          app_helper.php - methode is_select
                          is_select("table", "attribute`id & name`", "value", "label", "entry_value`optional`");
                        --->
              <?= is_select_filter("stts", "status_konten", "id", "keterangan", "Status konten"); ?>
            </div>

            <div class="form-group col-md-6">
              <input type="datetime-local" id="tanggal_dibuat" class="form-control form-control-sm" placeholder="Tanggal dibuat" />
            </div>

            <div class="col-md-12">
              <button type='button' class='btn btn-default btn-sm' id="filter-cancel"><?= cclang("cancel") ?></button>
              <button type="button" class="btn btn-primary btn-sm" id="filter">Filter</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>Judul</th>
              <th>Slug</th>
              <th>Kata kunci</th>
              <th>Konten</th>
              <th>Kategori</th>
              <th>Cover</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>#</th>
            </tr>
          </thead>

        </table>
</div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  $(document).ready(function() {
    var table;
    //datatables
    table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "ordering": true,
      "searching": false,
      "info": true,
      "bLengthChange": false,
      oLanguage: {
        sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?= url("konten/json") ?>",
        "type": "POST",
        "data": function(data) {
          data.judul = $("#judul").val();
          data.slug = $("#slug").val();
          data.kata_kunci = $("#kata_kunci").val();
          data.konten = $("#konten").val();
          data.id_kategori = $("#id_kategori").val();
          data.cover = $("#cover").val();
          data.status_konten = $("#status_konten").val();
          data.tanggal_dibuat = $("#tanggal_dibuat").val();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [

        {
          "targets": 0,
          "orderable": false
        },

        {
          "targets": 1,
          "orderable": false
        },

        {
          "targets": 2,
          "orderable": false
        },

        {
          "targets": 3,
          "orderable": false
        },

        {
          "targets": 4,
          "orderable": false
        },

        {
          "targets": 5,
          "orderable": false
        },

        {
          "targets": 6,
          "orderable": false
        },

        {
          "targets": 7,
          "orderable": true
        },

        {
          "className": "text-center",
          "orderable": false,
          "targets": 8
        },
      ],
    });

    $("#reload").click(function() {
      $("#judul").val("");
      $("#slug").val("");
      $("#kata_kunci").val("");
      $("#konten").val("");
      $("#id_kategori").val("");
      $("#cover").val("");
      $("#status_konten").val("");
      $("#tanggal_dibuat").val("");
      table.ajax.reload();
    });

    $(document).on("click", "#filter-show", function(e) {
      e.preventDefault();
      $(".content-filter").slideDown();
    });

    $(document).on("click", "#filter", function(e) {
      e.preventDefault();
      $("#table").DataTable().ajax.reload();
    })

    $(document).on("click", "#filter-cancel", function(e) {
      e.preventDefault();
      $(".content-filter").slideUp();
    });

    $(document).on("click", "#delete", function(e) {
      e.preventDefault();
      $('.modal-dialog').addClass('modal-sm');
      $("#modalTitle").text('<?= cclang("confirm") ?>');
      $('#modalContent').html(`<p class="mb-4"><?= cclang("delete_description") ?></p>
  														<button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?= cclang("cancel") ?></button>
  	                          <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=` + $(this).attr('alt') + `  data-url=` + $(this).attr('href') + `><?= cclang("delete_action") ?></button>
  														`);
      $("#modalGue").modal('show');
    });


    $(document).on('click', '#ya-hapus', function(e) {
      $(this).prop('disabled', true)
        .text('Processing...');
      $.ajax({
        url: $(this).data('url'),
        type: 'POST',
        cache: false,
        dataType: 'json',
        success: function(json) {
          $('#modalGue').modal('hide');
          swal(json.msg, {
            icon: json.type_msg
          });
          $('#table').DataTable().ajax.reload();
        }
      });
    });


  });
</script>