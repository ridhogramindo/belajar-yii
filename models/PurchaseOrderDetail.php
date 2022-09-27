<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_po_detail".
 *
 * @property int $id_item
 * @property int $id_po
 * @property string $nama_barang
 * @property string $merk_barang
 * @property string $satuan_barang
 * @property int $qty
 * @property float $harga_satuan
 *
 * @property TPo $po
 */
class PurchaseOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_po_detail';
    }

    /**
     * Gets query for [[Po]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrder()
    {
        return $this->hasOne(PurchaseOrder::class, ['id_po' => 'id_po']);
    }
}
