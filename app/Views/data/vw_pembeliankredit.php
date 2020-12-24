<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-dark">Pembelian Kredit</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pembelian</a></li>
                        <li class="breadcrumb-item active">Pembelian Kredit</li>
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
                                        <option value="1">Perdana</option>
                                        <option value="2">Paramita</option>
                                        <option value="3">Pai</option>
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
                            <table id="tb_kredit" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TGL NOTA</th>
                                        <th>SUPPLIER</th>
                                        <th>BRAND</th>
                                        <th>NOPOL</th>
                                        <th>NOTA SUPP</th>
                                        <th>NOTA ORDER</th>
                                        <th>NAMA BARANG</th>
                                        <th>QTY</th>
                                        <th>HARGA</th>
                                        <th>DISC</th>
                                        <th>PPN</th>
                                        <th>TOTAL</th>
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
<div class="modal fade" id="md-form-kredit">
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
                    <form id="frm-modal-kredit">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">TGL NOTA</label>
                                    <input id="tgl_nota" name="tgl_nota" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">SUPPLIER</label>
                                    <select id="supplier_id" name="supplier_id" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">BRAND</label>
                                    <select id="brand_id" name="brand_id" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">Perdana</option>
                                        <option value="2">Paramita</option>
                                        <option value="3">Pai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">NOPOL</label>
                                    <select id="nopol_id" name="nopol_id" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NOTA SUPP</label>
                                    <input id="nota_supp" name="nota_supp" class="form-control" placeholder="Nota Supp" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NO ORDER (PO)</label>
                                    <input id="nota_order" name="nota_order" class="form-control" placeholder="NO PO" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">NAMA BARANG</label>
                                    <select id="barang_id" name="barang_id" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">QTY</label>
                                    <input id="qtyy" name="qtyy" class="form-control" placeholder="QTY" type="text" onkeyup="hitung()">
                                    <input type="hidden" name="qty" id="qty">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">HARGA</label>
                                    <input id="hargaa" name="hargaa" class="form-control" placeholder="HARGA" type="text" onkeyup="hitung()">
                                    <input type="hidden" name="harga" id="harga">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">DISKON</label>
                                    <input id="discc" name="discc" class="form-control" placeholder="DISKON" type="text" onkeyup="hitung()">
                                    <input type="hidden" name="disc" id="disc">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">PPN</label>
                                    <input id="ppnn" name="ppnn" class="form-control" placeholder="PPN" type="text">
                                    <input type="hidden" name="ppn" id="ppn">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">TOTAL</label>
                                    <input id="totall" name="totall" class="form-control" type="text">
                                    <input type="hidden" name="total" id="total">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Tax</label>
                                    <input id="tax" name="tax" class="form-control" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSavekredit' class="btn btn-primary btn-sm float-right" onclick="simpan()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var textqtyy = document.getElementById('qtyy');
    var textqty = document.getElementById('qty');
    var texthargaa = document.getElementById('hargaa');
    var textharga = document.getElementById('harga');
    var textdiscc = document.getElementById('discc');
    var textdisc = document.getElementById('disc');
    textqtyy.addEventListener('keyup', function(e) {
        textqtyy.value = currencyIDR(this.value);
        textqty.value = this.value.replace(/\./g, '');
    });
    texthargaa.addEventListener('keyup', function(e) {
        texthargaa.value = currencyIDR(this.value);
        textharga.value = this.value.replace(/\./g, '');
    });
    textdiscc.addEventListener('keyup', function(e) {
        textdiscc.value = currencyIDR(this.value);
        textdisc.value = this.value.replace(/\./g, '');
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
        var getqty = document.getElementById('qtyy').value;
        var getharga = document.getElementById('hargaa').value;
        var getdisc = document.getElementById('discc').value;
        var tax = $('#tax').val();
        var qtyy = getqty.split(".").join("");
        var harga = getharga.split(".").join("");
        var disc = getdisc.split(".").join("");

        var total = qtyy * harga - disc;
        var ppnx = total * tax / 100;
        var grand = total + ppnx;

        var currencytotal = currencyIDR(grand, '');
        var currencyppn = currencyIDR(ppnx, '');
        document.getElementById('totall').value = currencytotal;
        document.getElementById('total').value = grand;
        document.getElementById('ppnn').value = currencyppn;
        document.getElementById('ppn').value = ppnx;
    }
    var table;
    $(document).ready(function() {
        table = $('#tb_kredit').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,

            ajax: {
                "url": "<?= base_url('pembelian_kredit/datakredit') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = $('#tglawal').val();
                    data.tgl_akhir = $('#tglakhir').val();
                    data.brandd = $('#brandd').val();
                },
            }
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
        $('#frm-modal-kredit')[0].reset();
        $('#md-form-kredit').modal('hide');
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
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
        $('#md-form-kredit').modal('show');
        $('#modal-title').text('Tambah pembelian kredit');
        $('#btnSavekredit').text('Save');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }

    function simpan() {
        if (method == 'save') {
            url = '<?= site_url('pembelian_kredit/save') ?>';
        } else {
            url = '<?= site_url('pembelian_kredit/update') ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-kredit')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('.help-block').empty();
                    $('#frm-modal-kredit')[0].reset();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#md-form-kredit').modal('hide');
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

    function edit_kredit(id) {
        method = 'update';
        $('#btnSavekredit').text('Update');
        $(".select2").select2({
            theme: "bootstrap4"
        });
        $.ajax({
            url: '<?= site_url('pembelian_kredit/edit/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_kredit);
                $('#tgl_nota').val(data.tgl_nota);
                $('#supplier_id').val(data.supplier_id).change();
                $('#nopol_id').val(data.nopol_id).change();
                $('#brand_id').val(data.brand_id).change();
                $('#nota_supp').val(data.nota_supp);
                $('#nota_order').val(data.nota_order);
                $('#barang_id').val(data.barang_id).change();
                $('#qty').val(data.qty);
                $('#qtyy').val(data.qty);
                $('#harga').val(data.harga);
                $('#hargaa').val(data.harga);
                $('#disc').val(data.disc);
                $('#discc').val(data.disc);
                $('#ppn').val(data.pembelianppn);
                $('#ppnn').val(data.pembelianppn);
                // $('#ppnnn').val(data.pembelianppn);
                $('#total').val(data.total);
                $('#totall').val(data.total);

                $('#md-form-kredit').modal('show');
                $('#modal-title').text('Edit pembelian kredit');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_kredit(id) {
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
                    url: "<?php echo site_url('pembelian_kredit/delete') ?>/" + id,
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
    $('#supplier_id').change(function() {
        var data = $('#supplier_id').val();
        $.ajax({
            url: '<?= site_url('master_supplier/edit/') ?>' + data,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#tax').val(data.ppn);
                hitung();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    });

    function init_select() {
        let dropdown_supplier = $('#supplier_id');
        dropdown_supplier.empty();
        dropdown_supplier.append('<option value="">Pilih supplier</option>');
        dropdown_supplier.prop('selectedIndex', 0);
        const url_supplier = '<?= base_url('master_supplier/getsupplier/') ?>';
        // Populate dropdown with list
        $.getJSON(url_supplier, function(data) {
            $.each(data, function(key, entry) {
                dropdown_supplier.append($('<option></option>').attr('value', entry.id_supplier).text(entry.supplier));
            })
        });
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
        let dropdown_barang = $('#barang_id');
        dropdown_barang.empty();
        dropdown_barang.append('<option value="">Pilih barang</option>');
        dropdown_barang.prop('selectedIndex', 0);
        const url_barang = '<?= base_url('master_barang/getbarang/') ?>';
        // Populate dropdown with list
        $.getJSON(url_barang, function(data) {
            $.each(data, function(key, entry) {
                dropdown_barang.append($('<option></option>').attr('value', entry.id_barang).text(entry.nama_barang));
            })
        });
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
in.js"></script>
<!-- angka -->
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.js"></script>
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.min.js"></script>
<?= $this->endSection('js') ?>