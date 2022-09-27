<?php

namespace app\models;

use yii\db\ActiveRecord;

class PurchaseOrder extends ActiveRecord
{
    public static function tableName()
    {
        return 't_po';
    }

    public function rules()
    {
        return [
            [['kode_po', 'tanggal_po', 'supplier', 'user_id'], 'required'],
            [['tanggal_po'], 'safe'],
            [['payment_method'], 'string'],
            [['user_id'], 'integer'],
            [['kode_po'], 'string', 'max' => 20],
            [['supplier'], 'string', 'max' => 200],
        ];
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

    public function getPoDetails()
    {
        return $this->hasMany(PurchaseOrderDetail::class, ['id_po' => 'id_po']);
    }

    public function generateKode()
    {
        $_d = date("ym");
        $_i = "PO-";
        $_left = $_i . $_d;
        $_first = "00001";
        $_len = strlen($_left);
        $kode = $_left . $_first;

        $last_po = $this->find([
            "select" => "kode_po",
            "condition" => "left(kode_po," . $_len . ")=:_left",
            "params" => [":_left" => $_left],
            "order" => "id_po DESC"
        ]);

        if ($last_po != NULL) {
            $_no = substr($last_po->kode_po, $_len);
            $_no++;
            $_no = substr("00000", strlen($_no)) . $_no;
            $kode = $_left . $_no;
        }

        return $kode;
    }
}
