<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-dark">Memo</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Memo</a></li>
                        <li class="breadcrumb-item active">Memo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary btn-block mb-3" onclick="tambah()">Tulis Pesan</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="<?= base_url('memo_read') ?>" class="nav-link active">
                                    <i class="fas fa-inbox"></i> Inbox
                                    <span class="badge bg-primary float-right"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('memo_sent') ?>" class="nav-link">
                                    <i class="far fa-envelope"></i> Sent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-file-alt"></i> Drafts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-filter"></i> Junk
                                    <span class="badge bg-warning float-right"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-trash-alt"></i> Trash
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-10">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Inbox</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search Mail">
                                <div class="input-group-append">
                                    <div class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <div class="float-right">
                                <?= $totalmemo ?>/<?= $totalmemo ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.float-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php foreach ($read_memo as $r) : ?>
                                        <tr>
                                            <td class="mailbox-name"><?= $r['username'] ?></td>
                                            <td class="mailbox-subject"><?= $r['isi_memo'] ?></td>
                                            <td class="mailbox-date"><?= date('d F Y', strtotime($r['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer p-0">
                        <div class="mailbox-controls">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <div class="float-right">
                                <?= $totalmemo ?>/<?= $totalmemo ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.float-right -->
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</section>
<div class="modal fade" id="md-form-pesan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Tulis Pesan Baru</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='batal()'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.card-header -->
                <form id="frm-modal-pesan">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" id="id" name="id">
                            <select class="form-control select2" id="to_id" name="to_id" placeholder="To:"></select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="subject" name="subject" placeholder="Subject:">
                        </div>
                        <div class="form-group">
                            <textarea id="isi_memo" name="isi_memo" class="form-control" style="height: 300px"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </form>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                        <button class="btn btn-primary" onclick="simpan()"><i class=" far fa-envelope"></i> Send</button>
                    </div>
                    <button onclick="batal()" type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    function tambah() {
        method = 'save';
        $('#md-form-pesan').modal('show');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }
    init_select()

    function simpan() {
        if (method == 'save') {
            url = '<?= site_url('memo_sent/save') ?>';
        } else {
            url = '<?= site_url('memo_sent/update') ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-pesan')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('.help-block').empty();
                    $('#frm-modal-pesan')[0].reset();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#md-form-pesan').modal('hide');
                    alertsukses();
                    location.reload();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function batal() {
        $('#frm-modal-pesan')[0].reset();
        $('#md-form-pesan').modal('hide');
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
    }

    function init_select() {
        let dropdown_nopol = $('#to_id');
        dropdown_nopol.empty();
        dropdown_nopol.append('<option value="">Pilih Email</option>');
        dropdown_nopol.prop('selectedIndex', 0);
        const url_nopol = '<?= base_url('memo_sent/getnama/') ?>';
        // Populate dropdown with list
        $.getJSON(url_nopol, function(data) {
            $.each(data, function(key, entry) {
                dropdown_nopol.append($('<option></option>').attr('value', entry.id).text(entry.email));
            })
        });
    }

    function alertsukses() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        if (method == 'save') {
            Toast.fire({
                icon: 'success',
                title: 'Data berhasil disimpan'
            })
        } else {
            Toast.fire({
                icon: 'warning',
                title: 'Data berhasil di ubah'
            })
        }
    }
</script>
<?= $this->endSection('content') ?>
<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<!-- DataTables -->
<script src="<?= base_url(''); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(''); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<?= $this->endSection('js') ?>