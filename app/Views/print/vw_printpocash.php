<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<style>
    @media print {
        .btn {
            display: none;
        }

        .form-control-sm {
            display: none;
        }

        .main-footer {
            display: none;
        }
    }
</style>
<section class="content-wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>PRINT REIMBURSEMENT</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">PRINT REIMBURSEMENT</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <form action="" method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control-sm" name="keyword" placeholder="no reimbursement">
                                            <div class="input-group-append">
                                                <button class="btn btn-default btn-sm" type="submit">cari</button>
                                                <a onclick="window.print()" class="btn btn-default btn-sm"><i class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="text-center">
                                        <address>
                                            <b>FORM REIMBURSEMENT</b>
                                        </address>
                                    </div>
                                </div>
                                <div class="row invoice-info">
                                    <!-- /.col -->
                                    <div class="col-sm-2 invoice-col">
                                        <address>
                                            NO REIMBURSEMENT <br>
                                            ORDER BY <br>
                                        </address>
                                    </div>
                                    <div class="col-sm-1 invoice-col">
                                        <address>
                                            : <br>
                                            : <br>
                                        </address>
                                    </div>
                                    <div class="col-sm-6 invoice-col">
                                        <address>
                                            <?= $ket['nota_order']; ?> <br>
                                            <?= $ket['nama']; ?><br>
                                        </address>
                                    </div>
                                    <div class="col-sm-2 float-right">
                                        <img src="<?= base_url(''); ?>/img/<?= $ket['brand_img']; ?>" width="200px" alt="">
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                                <table class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA BARANG</th>
                                            <th>QTY</th>
                                            <th>HARGA</th>
                                            <th>JUMLAH</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $qty = 0;
                                        $harga = 0;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($po as $p) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $p['nama_barang'] ?></td>
                                                <td><?= $p['qty'] ?></td>
                                                <td class="text-right"><?= number_format($p['harga'], 0, ',', '.') ?></td>
                                                <td class="text-right"><?= number_format($p['total'], 0, ',', '.') ?></td>
                                                <td><?= $p['nopol'] ?></td>
                                            </tr>
                                            <?php $qty += $p['qty'] ?>
                                            <?php $harga += $p['harga'] ?>
                                            <?php $total += $p['total'] ?>
                                        <?php endforeach ?>
                                        <tr>
                                            <td colspan="2" class="text-center">Total</td>
                                            <td><?= number_format($qty, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($harga, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($total, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            MENYUTUJUI
                                        </div>
                                        <div class="col-md-3">
                                            LOGISTIK
                                        </div>
                                        <div class="col-md-3">
                                            MENGETAHUI
                                        </div>
                                    </div>
                                </div>
                                <div class="row" class="">
                                    <div class="container mt-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <hr class="border">
                                            </div>
                                            <div class="col-md-3">
                                                <hr class="border">
                                            </div>
                                            <div class="col-md-3">
                                                <hr class="border">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</section>
<?= $this->endsection() ?>