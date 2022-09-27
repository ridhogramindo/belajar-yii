<?php

use yii\helpers\Html;

$this->title = "Data Purchase Order";
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>

<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <?= Html::a('<i class="fas fa-plus-circle mr-2"></i> Tambah', ['create'], ['class' => 'btn btn-success btn-sm float-right']) ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                            <td><?= Html::encode($d->tanggal_po) ?></td>
                            <td><?= Html::encode($d->supplier) ?></td>
                            <td><?= Html::encode(ucfirst($d->payment_method)) ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>