<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-dark">Pembayaran Cash</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pembelian</a></li>
                        <li class="breadcrumb-item active">Pembayaran Cash</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <input id="tglawal" placeholder="tgl awal" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tglakhir" placeholder="tgl akhir" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <select id="brandd" class="form-control form-control-sm">
                                        <option value="">Pilih Brand</option>
                                        <option value="1">Perdana</option>
                                        <option value="2">Paramita</option>
                                        <option value="3">Pai</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="ketlunas" class="form-control form-control-sm">
                                        <option value="">Ket Lunas</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="blmbayar">Belum Bayar</option>
                                        <option value="blmlunas">Belum Lunas</option>
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
                            <table id="tb_cash" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TGL NOTA</th>
                                        <th>DRIVER</th>
                                        <th>NOTA ORDER</th>
                                        <th>TOTAL</th>
                                        <th>TGL BAYAR</th>
                                        <th>BANK</th>
                                        <th>VIA</th>
                                        <th>NOMINAL</th>
                                        <th>TGL BAYAR</th>
                                        <th>BANK</th>
                                        <th>VIA</th>
                                        <th>NOMINAL</th>
                                        <th>SISA HUTANG</th>
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
<div class="modal fade" id="md-form-cash">
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
                    <form id="frm-modal-cash">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">SUPPLIER</label>
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="cash_id" name="cash_id">
                                    <input type="text" id="driver" name="driver" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NO ORDER (PO)</label>
                                    <input id="nota_order" name="nota_order" class="form-control" placeholder="NO PO" type="text" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">TOTAL</label>
                                    <input id="totall" name="totall" class="form-control" type="text" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl Bayar1</label>
                                    <input id="tgl_bayar1" name="tgl_bayar1" class="form-control tanggal" type="text" placeholder="Tanggal Bayar" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Via</label>
                                    <select id="via1" name="via1" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="psp">PSP</option>
                                        <option value="paramita">Paramita</option>
                                        <option value="pai">PAI</option>
                                        <option value="paramita-psp">Paramita-psp</option>
                                        <option value="psp-pai">PSP-PAI</option>
                                        <option value="pai-paramita">PAI-Paramita</option>
                                        <option value="psp-paramita">PSP-Paramita</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Bank</label>
                                    <select id="bank1" name="bank1" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="danamon">DANAMON</option>
                                        <option value="bca">BCA</option>
                                        <option value="mandiri">MANDIRI</option>
                                        <option value="bni">BNI</option>
                                        <option value="danamon-bca">Danamon-BCA</option>
                                        <option value="kas">KAS</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Nominal</label>
                                    <input id="nominall1" name="nominall1" class="form-control" type="text" placeholder="Nominal" onkeyup="hitung()">
                                    <input type="hidden" id="nominal1" name="nominal1">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl Bayar1</label>
                                    <input id="tgl_bayar2" name="tgl_bayar2" class="form-control tanggal" type="text" placeholder="Tanggal Bayar" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Via</label>
                                    <select id="via2" name="via2" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="psp">PSP</option>
                                        <option value="paramita">Paramita</option>
                                        <option value="pai">PAI</option>
                                        <option value="paramita-psp">Paramita-psp</option>
                                        <option value="psp-pai">PSP-PAI</option>
                                        <option value="pai-paramita">PAI-Paramita</option>
                                        <option value="psp-paramita">PSP-Paramita</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Bank</label>
                                    <select id="bank2" name="bank2" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="danamon">DANAMON</option>
                                        <option value="bca">BCA</option>
                                        <option value="mandiri">MANDIRI</option>
                                        <option value="bni">BNI</option>
                                        <option value="danamon-bca">Danamon-BCA</option>
                                        <option value="kas">KAS</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Nominal</label>
                                    <input id="nominall2" name="nominall2" class="form-control" type="text" placeholder="Nominal" value="0" onkeyup="hitung()">
                                    <input type="hidden" id="nominal2" name="nominal2">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Sisa Hutang</label>
                                    <input id="sisa_hutangg" name="sisa_hutangg" class="form-control" type="text" placeholder="Nominal" readonly>
                                    <input type="hidden" id="sisa_hutang" name="sisa_hutang">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSavecash' class="btn btn-primary btn-sm float-right" onclick="simpan()">Simpan</button>
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
        table = $('#tb_cash').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,

            ajax: {
                "url": "<?php echo site_url('pembelian_bayarcash/datacash') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = $('#tglawal').val();
                    data.tgl_akhir = $('#tglakhir').val();
                    data.brandd = $('#brandd').val();
                    data.ketlunas = $('#ketlunas').val();
                },
            }
        });
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#brandd').change(function() {
        table.ajax.reload();
    });
    $('#ketlunas').change(function() {
        table.ajax.reload();
    });

    function batal() {
        $('#frm-modal-cash')[0].reset();
        $('#md-form-cash').modal('hide');
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
        $("input[type=hidden]").val('');
    }

    function refresh() {
        document.getElementById("tglawal").value = "";
        document.getElementById("tglakhir").value = "";
        document.getElementById("brandd").value = "";
        document.getElementById("ketlunas").value = "";
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function tambah_bayar(id) {
        method = 'save';
        $('#md-form-cash').modal('show');
        $('#modal-title').text('Tambah pembayaran cash');
        $('#btnSavecash').text('Save');

        $.ajax({
            url: '<?= site_url('pembelian_bayarcash/edit/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#cash_id').val(data.id_cash);
                $('#driver').val(data.nama);
                $('#nota_order').val(data.nota_order);
                $('#totall').val(data.total);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function simpan() {
        if (method == 'save') {
            url = '<?= site_url('pembelian_bayarcash/save') ?>';
        } else {
            url = '<?= site_url('pembelian_bayarcash/update') ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-cash')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('.help-block').empty();
                    $('#frm-modal-cash')[0].reset();
                    $('.is-invalid').removeClass('is-invalid');
                    $("input[type=hidden]").val('');
                    $('#md-form-cash').modal('hide');
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

    function edit_bayar(id) {
        method = 'update';
        $('#btnSavecash').text('Update');
        $.ajax({
            url: '<?= site_url('pembelian_bayarcash/edit/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_bayarcash);
                $('#cash_id').val(data.id_cash);
                $('#nama').val(data.nama);
                $('#nota_order').val(data.nota_order);
                $('#totall').val(data.total);
                $('#tgl_bayar1').val(data.tgl_bayar1);
                $('#bank1').val(data.bank1);
                $('#via1').val(data.via1);
                $('#nominal1').val(data.nominal1);
                $('#nominall1').val(data.nominal1);
                $('#tgl_bayar2').val(data.tgl_bayar2);
                $('#bank2').val(data.bank2);
                $('#via2').val(data.via2);
                $('#nominal2').val(data.nominal2);
                $('#nominall2').val(data.nominal2);
                $('#sisa_hutang').val(data.sisa_hutang);
                $('#sisa_hutangg').val(data.sisa_hutang);

                $('#md-form-cash').modal('show');
                $('#modal-title').text('Edit pembayaran cash');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_cash(id) {
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
                    url: "<?php echo site_url('pembelian_bayarcash/delete') ?>/" + id,
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
    var textnominall1 = document.getElementById('nominall1');
    var textnominal1 = document.getElementById('nominal1');
    var textnominall2 = document.getElementById('nominall2');
    var textnominal2 = document.getElementById('nominal2');

    textnominall1.addEventListener('keyup', function(e) {
        textnominall1.value = currencyIDR(this.value);
        textnominal1.value = this.value.replace(/\./g, '');
    });
    textnominall2.addEventListener('keyup', function(e) {
        textnominall2.value = currencyIDR(this.value);
        textnominal2.value = this.value.replace(/\./g, '');
    });

    function currencyIDR(angka, prefix) {
        if (prefix != "") {
            var num_string = angka.replace(/[^,\d]/g, '').toString(),
                split = num_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        } else {
            var num_string = angka.toString(),
                sisa = num_string.length % 3,
                rupiah = num_string.substr(0, sisa),
                ribuan = num_string.substr(sisa).match(/\d{3}/g);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }
    }

    function hitung() {
        var total = document.getElementById('totall').value;
        var getnominal1 = document.getElementById('nominall1').value;
        var nominal1 = getnominal1.split(".").join("");
        var getnominal2 = document.getElementById('nominall2').value;
        var nominal2 = getnominal2.split(".").join("");
        var bayar = parseInt(nominal1) + parseInt(nominal2)
        var grand = parseInt(total) - parseInt(bayar);

        var currencygrand = currencyIDR(grand, '');
        document.getElementById('sisa_hutangg').value = currencygrand;
        document.getElementById('sisa_hutang').value = grand;
    }

    $('.tanggal').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy"
    });


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