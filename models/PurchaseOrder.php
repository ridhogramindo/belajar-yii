<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class PurchaseOrder extends ActiveRecord
{
    public static function tableName()
    {
        return 't_po';
    }

    public function attributeLabels()
    {
        return [
            'id_po' => 'Id Po',
            'kode_po' => 'Kode Po',
            'tanggal_po' => 'Tanggal Po',
            'supplier' => 'Supplier',
            'payment_method' => 'Payment Method',
            'user_id' => 'User ID',
        ];
    }

    public function getPurchaseOrderDetails()
    {
        return $this->hasMany(PurchaseOrderDetail::class, ['id_po' => 'id_po']);
    }
}
