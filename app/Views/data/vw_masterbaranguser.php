<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-dark">Data Barang</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active">Data Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-5">
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tb_barang" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA BARANG</th>
                                        <th>KODEBARANG</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</section>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#tb_barang').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,

            ajax: {
                "url": "master_baranguser/databarang",
                "type": "POST",
            }
        });
    });


    function refresh() {
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }
</script>
<?= $this->endSection('content') ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<!-- DataTables -->
<script src="<?= base_url(''); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.js"></script>
<?= $this->endSection('js') ?>