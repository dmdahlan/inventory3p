<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-dark">Pembayaran STNK</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Pembayaran STNK</li>
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
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah()">Tambah</a>
                                </div>
                                <div class="col-md-2">
                                    <input id="tglawal" placeholder="tgl awal" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tglakhir" placeholder="tgl akhir" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <select id="brandd" class="form-control form-control-sm">
                                        <option value="">Pilih Brand</option>
                                        <option value="perdana">Perdana</option>
                                        <option value="paramita">Paramita</option>
                                        <option value="pai">Pai</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <button type="button" id="btn-filter" class="btn btn-info btn-sm">Cari</button>
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tb_unit" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NOPOL</th>
                                        <th>BRAND</th>
                                        <th>KET</th>
                                        <th>EXPIRED</th>
                                        <th>TGL BAYAR</th>
                                        <th>NOMINAL</th>
                                        <th>VIA</th>
                                        <th>BANK</th>
                                        <th>VIA BP MAJID</th>
                                        <th>SIMULASI</th>
                                        <th>JASA</th>
                                        <th>OPSI</th>
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
<div class="modal fade" id="md-form-unit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='batal()'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <form id="frm-modal-unit">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">TGL BAYAR</label>
                                    <input id="tgl_bayar" name="tgl_bayar" class="form-control tanggal" placeholder="Tgl Bayar">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NOPOL</label>
                                    <select id="nopol_id" name="nopol_id" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">KET</label>
                                    <select id="stnk_kir" name="stnk_kir" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="stnk">STNK</option>
                                        <option value="kir">KIR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">EXPIRED</label>
                                    <input id="expired" name="expired" class="form-control tanggal" placeholder="Expired">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NOMINAL</label>
                                    <input id="nominall" name="nominall" class="form-control uang" placeholder="Nominal">
                                    <input type="hidden" name="nominal" id="nominal">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">VIA</label>
                                    <select id="via" name="via" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="psp">PSP</option>
                                        <option value="paramita">Paramita</option>
                                        <option value="pai">PAI</option>
                                        <option value="paramita-psp">Paramita-psp</option>
                                        <option value="psp-pai">PSP-PAI</option>
                                        <option value="pai-paramita">PAI-Paramita</option>
                                        <option value="psp-paramita">PSP-Paramita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">BANK</label>
                                    <select id="bank" name="bank" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="danamon">DANAMON</option>
                                        <option value="bca">BCA</option>
                                        <option value="mandiri">MANDIRI</option>
                                        <option value="bni">BNI</option>
                                        <option value="danamon-bca">Danamon-BCA</option>
                                        <option value="kas">KAS</option>
                                        <option value="bri">BRI</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">PAK MAJID</label>
                                    <input id="nominal_pengurusann" name="nominal_pengurusann" class="form-control uang" placeholder="Nominal">
                                    <input type="hidden" name="nominal_pengurusan" id="nominal_pengurusan">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">SIMULASI</label>
                                    <input id="nominal_simulasii" name="nominal_simulasii" class="form-control uang" placeholder="Nominal">
                                    <input type="hidden" name="nominal_simulasi" id="nominal_simulasi">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSaveunit' class="btn btn-primary btn-sm float-right" onclick="simpan()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#tb_unit').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,

            ajax: {
                "url": "<?= base_url('pembayaran_stnk/databayar') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = $('#tglawal').val();
                    data.tgl_akhir = $('#tglakhir').val();
                    data.brandd = $('#brandd').val();
                },
            },
            "columnDefs": [{
                "targets": [6],
                "className": 'text-right'
            }]
        });
        init_select();
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#brandd').change(function() {
        table.ajax.reload();
    });

    function batal() {
        $('#frm-modal-unit')[0].reset();
        $('#md-form-unit').modal('hide');
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
        $("input[type=hidden]").val('');
    }

    function refresh() {
        document.getElementById("tglawal").value = "";
        document.getElementById("tglakhir").value = "";
        document.getElementById("brandd").value = "";
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function tambah() {
        method = 'save';
        $('#md-form-unit').modal('show');
        $('#modal-title').text('Tambah Pembayaran STNK & KIR');
        $('#btnSaveunit').text('Save');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }

    function simpan() {
        if (method == 'save') {
            url = '<?= site_url('pembayaran_stnk/save') ?>';
        } else {
            url = '<?= site_url('pembayaran_stnk/update') ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-unit')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('.help-block').empty();
                    $('#frm-modal-unit')[0].reset();
                    $('.is-invalid').removeClass('is-invalid');
                    $("input[type=hidden]").val('');
                    $('#md-form-unit').modal('hide');
                    alertsukses();
                    reload_table();
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

    function edit_bayar(id) {
        method = 'update';
        $('#btnSaveunit').text('Update');
        $.ajax({
            url: '<?= site_url('pembayaran_stnk/edit/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_bayarstnk);
                $('#nopol_id').val(data.nopol_id).change();
                $('#tgl_bayar').val(data.tgl_bayar);
                $('#stnk_kir').val(data.stnk_kir);
                $('#expired').val(data.expired);
                $('#nominal').val(data.nominal_bayar);
                $('#nominall').val(data.nominal_bayar);
                $('#via').val(data.via);
                $('#bank').val(data.bank);
                $('#nominal_pengurusan').val(data.nominal_pengurusan);
                $('#nominal_pengurusann').val(data.nominal_pengurusan);
                $('#nominal_simulasi').val(data.nominal_simulasi);
                $('#nominal_simulasii').val(data.nominal_simulasi);

                $('#md-form-unit').modal('show');
                $('#modal-title').text('Edit Nopol Pembayaran STNK');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_bayar(id) {
        swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: 'Anda Tidak Akan Bisa Merecover Kembali Data Yang Sudah Anda Hapus !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: false
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: "<?php echo site_url('pembayaran_stnk/delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        swal.fire('Terhapus', 'Data Anda Sudah Dihapus', 'success');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire("Gagal", "Data Anda Tidak Jadi Dihapus", "error");
                    }
                });
            } else {
                swal.fire("Batal", "Data Anda Tidak Jadi Dihapus", "warning");
            }
        });
    }

    function init_select() {
        let dropdown_nopol = $('#nopol_id');
        dropdown_nopol.empty();
        dropdown_nopol.append('<option value="">Pilih Nopol</option>');
        dropdown_nopol.prop('selectedIndex', 0);
        const url_nopol = '<?= base_url('master_unit/getnopol/') ?>';
        // Populate dropdown with list
        $.getJSON(url_nopol, function(data) {
            $.each(data, function(key, entry) {
                dropdown_nopol.append($('<option></option>').attr('value', entry.id_nopol).text(entry.nopol));
            })
        });
    }
    $('.uang').mask('000.000.000.000', {
        reverse: true
    });
    var nominall = document.querySelector('input[name="nominall"]');
    var nominal = document.querySelector('input[name="nominal"]');
    nominall.onkeyup = function() {
        nominal.value = this.value.replace(/\./g, '');
    }
    var nominal_pengurusann = document.querySelector('input[name="nominal_pengurusann"]');
    var nominal_pengurusan = document.querySelector('input[name="nominal_pengurusan"]');
    nominal_pengurusann.onkeyup = function() {
        nominal_pengurusan.value = this.value.replace(/\./g, '');
    }
    var nominal_simulasii = document.querySelector('input[name="nominal_simulasii"]');
    var nominal_simulasi = document.querySelector('input[name="nominal_simulasi"]');
    nominal_simulasii.onkeyup = function() {
        nominal_simulasi.value = this.value.replace(/\./g, '');
    }
    $('.tanggal').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy"
    });
</script>
<?= $this->endSection('content') ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/css/bootstrap-datepicker.min.css">
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
<!-- date-picker -->
<script src="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(''); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- angka -->
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.js"></script>
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.min.js"></script>
<?= $this->endSection('js') ?>