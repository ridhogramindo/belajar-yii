<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Data Purchase Order";
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>

<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= Yii::$app->session->getFlash('status') ?>"></div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Tambah', ['create'], ['class' => 'btn btn-success btn-sm float-right']) ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Purchase Order</th>
                        <th>Tanggal Purchase Order</th>
                        <th>Nama Supplier</th>
                        <th>Metode Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($data_po as $d) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= Html::encode($d->kode_po) ?></td>
                            <td><?= Html::encode(date("d/F/Y"), strtotime($d->tanggal_po)) ?></td>
                            <td><?= Html::encode($d->supplier) ?></td>
                            <td><?= Html::encode(ucfirst($d->payment_method)) ?></td>
                            <td class="text-center">
                                <?php
                                echo Html::a('<i class="fas fa-eye"></i>', '', ['class' => 'btn btn-info btn-sm mr-2', 'title' => 'Detail Data']);
                                echo Html::a('<i class="fas fa-pencil-alt"></i>', '', ['class' => 'btn btn-warning btn-sm', 'title' => 'Ubah Data']);
                                echo Html::a('<i class="fas fa-trash-alt"></i>', 'javascript:void(0)', ['class' => 'btn btn-danger btn-sm ml-2', 'title' => 'Hapus Data', 'data-toggle' => 'modal', 'data-target' => '#modalDelete-' . $d['id_po']]);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($data_po as $data) : ?>
    <div class="modal fade" id="modalDelete-<?= $data['id_po'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <?php ActiveForm::begin($config = ['action' => '/purchase-order/delete']) ?>
                <input type="hidden" name="id_po" id="" value="<?= $data['id_po'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $data["kode_po"] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin Akan Menghapus data Purchase Order <b><?= $data['kode_po'] ?></b> ? Data yang sudah dihapus tidak dapat dikembalikan!
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
<?php endforeach ?>