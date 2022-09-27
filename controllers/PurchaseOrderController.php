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
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PurchaseOrderController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
        return $this->render('form-create');
    }

    protected function findModel($id_po)
    {
        if (($modelPo = PurchaseOrder::findOne(['id_po' => $id_po])) !== null) {
            return $modelPo;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
