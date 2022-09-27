<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add('sweetalert2');
\hail812\adminlte3\assets\PluginAsset::register($this)->add('daterangepicker');
\hail812\adminlte3\assets\PluginAsset::register($this)->add('jquery-validation');
\hail812\adminlte3\assets\PluginAsset::register($this)->add('datatables');
\hail812\adminlte3\assets\PluginAsset::register($this)->add('my-script');
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1] . '/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <?= $this->render('control-sidebar') ?>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?= $this->render('footer') ?>
    </div>

    <?php $this->endBody() ?>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });

            $('#purchaseOrderAdd').validate({
                rules: {
                    nama_supplier: {
                        required: true,
                    },
                    payment_method: {
                        required: true,
                    },
                    nama_barang: {
                        required: true,
                    },
                    merk_barang: {
                        required: true,
                    },
                    satuan_barang: {
                        required: true,
                    },
                    harga_satuan: {
                        required: true
                    },
                    qty: {
                        required: true
                    }
                },
                messages: {
                    nama_supplier: {
                        required: "Nama Supplier masih kosong",
                    },
                    payment_method: {
                        required: "Metode Pembayaran belum dipilih",
                    },
                    nama_barang: {
                        required: "Nama Barang masih kosong",
                    },
                    merk_barang: {
                        required: "Merk Barang masih kosong"
                    },
                    satuan_barang: {
                        required: "Satuan Barang belum dipilih"
                    },
                    harga_satuan: {
                        required: "Harga Satuan masih kosong"
                    },
                    qty: {
                        required: "Qty masih kosong"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.error-place').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        const flashdata = $(".flash-data").data("flashdata");

        if (flashdata == "added") {
            Swal.fire({
                title: "SUCCESS",
                text: "Data berhasil disimpan!",
                icon: "success",
                confirmButtonText: "Oke",
            });
        } else if (flashdata == "deleted") {
            Swal.fire({
                title: "SUCCESS",
                text: "Data berhasil dihapus!",
                icon: "success",
                confirmButtonText: "Oke",
            });
        } else if (flashdata == "failed") {
            Swal.fire({
                title: "GAGAL",
                icon: "error",
                confirmButtonText: "Oke",
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".add-barang").click(function(e) {
                e.preventDefault;
                $("#show").append(`<div class="row">
                    <div class="col-lg-2">
                        <div class="form-group error-place">
                            <input type="text" name="nama_barang[]" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group error-place">
                            <input type="text" name="merk_barang[]" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group error-place">
                            <select name="satuan_barang[]" id="" class="form-control">
                                <option value="">--- Pilih Satuan ---</option>
                                <option value="pcs">PCS</option>
                                <option value="unit">Unit</option>
                                <option value="bungkus">Bungkus</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group error-place">
                            <input type="number" name="harga_satuan[]" class="form-control" id="harga-satuan" onkeyup="subTotal()">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group error-place">
                            <input type="number" name="qty[]" class="form-control" id="qty" onkeyup="subTotal()">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group error-place">
                            <input type="number" name="total_harga[]" class="form-control" id="sub-total" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1 text-center">
                        <button type="button" class="btn btn-block btn-danger align-midle remove-barang"><i class="fas fa-trash mr-2"></i> Hapus</button>
                    </div>
                </div>`);
            })

            $(document).on('click', '.remove-barang', function(e) {
                e.preventDefault;
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            })
        })
    </script>
</body>

</html>
<?php $this->endPage() ?>