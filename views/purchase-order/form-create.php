<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Data Purchase Order";
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-title">
                Tambah Data Purchase Order
            </div>
        </div>
        <?php ActiveForm::begin($config = ['action' => '/purchase-order/insert', 'id' => 'purchaseOrderAdd']) ?>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Kode Purchase Order</label>
                        <div class="input-group mb-3 error-place">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" name="kode_po" class="form-control" value="<?= $kode ?>" readonly>
                        </div>
                        <?php //Html::input('text', 'kode_po', $kode, ['class' => 'form-control', 'readonly' => 'readonly']) 
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label for="">Kode Purchase Order</label>
                    <div class="input-group mb-3 error-place">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" name="tanggal_po" class="form-control" value="<?= date("d/m/Y") ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Nama Supplier</label>
                        <div class="input-group mb-3 error-place">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            </div>
                            <input type="text" name="nama_supplier" class="form-control" placeholder="Nama Supplier">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="">Metode Pembayaran</label>
                        <div class="input-group mb-3 error-place">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                            </div>
                            <select name="payment_method" id="" class="form-control">
                                <option value="">--- Pilih Metode Pembayaran ---</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-2">
                    <label for="">Nama Barang</label>
                </div>
                <div class="col-lg-2">
                    <label for="">Merk Barang</label>
                </div>
                <div class="col-lg-2">
                    <label for="">Satuan Barang</label>
                </div>
                <div class="col-lg-2">
                    <label for="">Harga Satuan</label>
                </div>
                <div class="col-lg-1">
                    <label for="">Qty</label>
                </div>
                <div class="col-lg-2">
                    <label for="">Total Harga</label>
                </div>
            </div>
            <div id="show">
                <div class="row">
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
                        <button type="button" class="btn btn-primary align-midle btn-block add-barang"><i class="fas fa-plus mr-2"></i> Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-success float-right" type="submit"><i class="fas fa-paper-plane mr-2"></i>Simpan</button>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
<script>
    function subTotal() {
        const hargaSatuan = document.getElementById("harga-satuan").value;
        const qty = document.getElementById("qty").value;
        const subTotal = hargaSatuan * qty;
        document.getElementById('sub-total').value = subTotal;
    }
</script>