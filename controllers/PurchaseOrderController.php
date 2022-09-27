<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PurchaseOrder;
use app\models\PurchaseOrderDetail;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PurchaseOrderController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index'],
                    'rules' => [
                        [
                            'actions' => ['index'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $getAll = PurchaseOrder::find()->all();
        $data = [
            'data_po' => $getAll,
        ];

        return $this->render('index', $data);
    }

    public function actionCreate()
    {
        $model = new PurchaseOrder();
        $prefix_kode = "PO";
        $result = $model->findBySql("SELECT max(right(kode_po,5)) AS kode_po FROM t_po WHERE DATE(tanggal_po) = CURDATE()");
        $query = $model->findBySql("SELECT max(right(kode_po,5)) AS kode_po FROM t_po WHERE DATE(tanggal_po) = CURDATE()")->all();
        if ($result->count() > 0) {
            foreach ($query as $q) {
                $no = ((int)$q['kode_po']) + 1;
                $kd = sprintf("%05s", $no);
            }
        } else {
            $kd = "00001";
        }

        date_default_timezone_set('Asia/Jakarta');
        $generateKode = $prefix_kode . date("dmy") . $kd;

        $data = ['kode' => $generateKode, 'no_urut' => $kd];
        return $this->render('form-create', $data);
    }

    public function actionInsert()
    {
        try {
            $modelPurchaseOrder = new PurchaseOrder();
            $modelPurchaseOrderDetail = new PurchaseOrderDetail();

            if (PurchaseOrder::find()->count() == 0) {
                $id_po = 1;
            } else {
                $id_po = PurchaseOrder::find()->count() + 1;
            }

            $request = Yii::$app->request;
            $session = Yii::$app->session;
            $db = Yii::$app->db;

            $modelPurchaseOrder->id_po = $id_po;
            $modelPurchaseOrder->kode_po = $request->post('kode_po');
            $modelPurchaseOrder->tanggal_po = date("Y-m-d");
            $modelPurchaseOrder->supplier = $request->post('nama_supplier');
            $modelPurchaseOrder->payment_method = $request->post('payment_method');
            $modelPurchaseOrder->user_id = "1";
            $storePo = $modelPurchaseOrder->save();

            foreach ($request->post('nama_barang') as $key => $value) {
                $nama_barang = $value;
                $merk_barang = $_POST['merk_barang'][$key];
                $satuan_barang = $_POST['satuan_barang'][$key];
                $qty = $_POST['qty'][$key];
                $harga_satuan = $_POST['harga_satuan'][$key];
                $db->createCommand("INSERT INTO t_po_detail(id_po, nama_barang, merk_barang, satuan_barang, qty, harga_satuan) VALUES(:id_po, :nama_barang, :merk_barang, :satuan_barang, :qty, :harga_satuan)")
                    ->bindValue(':id_po', $id_po)
                    ->bindValue(':nama_barang', $nama_barang)
                    ->bindValue(':merk_barang', $merk_barang)
                    ->bindValue(':satuan_barang', $satuan_barang)
                    ->bindValue(':qty', $qty)
                    ->bindValue(':harga_satuan', $harga_satuan)
                    ->execute();
            }
            $session->setFlash('status', 'added');
            return $this->redirect(['purchase-order/index']);
        } catch (\Throwable $e) {
            $session->setFlash('status', 'failed');
            return $this->redirect(['purchase-order/index']);
        }
    }

    public function actionDelete()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $id_po = $request->post('id_po');
        $modelPurchaseOrder = PurchaseOrder::findOne($id_po);
        $delete = $modelPurchaseOrder->delete();
        if ($delete) {
            $session->setFlash('status', 'deleted');
            return $this->redirect(['purchase-order/index']);
        } else {
            $session->setFlash('status', 'failed');
            return $this->redirect(['purchase-order/index']);
        }
    }

    public function actionDetail($id_po)
    {

        $po = PurchaseOrder::findOne($id_po);
        $data = ['detail' => $po->purchaseOrderDetails, 'po' => $po];

        // echo "<pre>";
        // print_r($data['po']);
        // echo "</pre>";
        return $this->render('view-detail', $data);
    }

    protected function findModel($id_po)
    {
        if (($modelPo = PurchaseOrder::findOne(['id_po' => $id_po])) !== null) {
            return $modelPo;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
