<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<?php
if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "Dashboard") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<?php
} elseif ($this->uri->segment(1) == "Obat") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#obat").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#obat_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "obat/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "kode"
          }, {
            "data": "kode_siva"
          }, {
            "data": "nama_obat"
          }, {
            "data": "generik"
          }, {
            "data": "satuan"
          }, {
            "data": "harga"
          }, {
            "data": "insert_at"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],
        order: [
          [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "Ruang") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#ruang").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#ruang_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "ruang/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "nama_ruang"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],
        order: [
          [0, 'asc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "User") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#mytable").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#mytable_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "user/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "username"
          }, {
            "data": "name"
          }, {
            "data": "address"
          }, {
            "data": "level"
          }, {
            "data": "ruang"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],

        columnDefs: [{
          targets: [4],
          render: function(data, type, row) {
            switch (data) {
              case '1':
                return 'Admin';
                break;
              case '2':
                return 'Gudang';
                break;
              case '3':
                return 'Apoteker';
                break;
              default:
                return '';
            }
          }
        }],
        order: [
          [0, 'asc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>

<?php
} elseif ($this->uri->segment(1) == "Satuan") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus')
    });
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#satuan").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#satuan_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "satuan/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "satuan",
            "className": "text-center"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"

          }
        ],
        order: [
          [0, 'asc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "Distributor") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#dist").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#dist_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "distributor/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "nama_distributor"
          }, {
            "data": "nama_perusahaan"
          }, {
            "data": "alamat"
          }, {
            "data": "telp"
          }, {
            "data": "kota"
          }, {
            "data": "kode_pos"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],
        order: [
          [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "Obat_transaksi") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#obat_transaksi").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#obat_transaksi_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "obat_transaksi/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "id_distributor"
          }, {
            "data": "no_faktur"
          }, {
            "data": "item"
          }, {
            "data": "tanggal"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],
        order: [
          [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "Pengiriman") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#pengiriman").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#pengiriman_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "pengiriman/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "date"
          }, {
            "data": "no_spb"
          }, {
            "data": "ruang"
          }, {
            "data": "rtujuan"
          }, {
            "data": "item"
          }, {
            "data": "diterima"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],
        order: [
          [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "Penerimaan") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#penerimaan").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#penerimaan_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "penerimaan/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "date"
          }, {
            "data": "no_spb"
          }, {
            "data": "ruang"
          }, {
            "data": "rtujuan"
          }, {
            "data": "item"
          }, {
            "data": "diterima"
          },
          {
            "data": "action",
            "orderable": false,
            "className": "text-center"
          }
        ],
        order: [
          [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} elseif ($this->uri->segment(1) == "Stok") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var t = $("#stok").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#stok_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
              if (e.keyCode == 13) {
                api.search(this.value).draw();
              }
            });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
          "url": "stok/json",
          "type": "POST"
        },
        columns: [{
            "data": "id",
            "orderable": false
          }, {
            "data": "kode_barang"
          }, {
            "data": "nama"
          }, {
            "data": "stok"
          }, {
            "data": "harga"
          }, {
            "data": "ruang"
          },

        ],
        order: [
          [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });
    });
  </script>
<?php
} ?>

<!-- Page Specific JS File -->
<?php
if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "Dashboard") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/index.js"></script>
<?php
} elseif ($this->uri->segment(2) == "index_0") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/index-0.js"></script>

<?php
} ?>


<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-toastr.js"></script>

<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>

</html>