<?php

namespace backend\controllers;

use Yii;
use common\models\Asset;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AssetController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // hanya user login yang boleh akses
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Asset::find(),
            'pagination' => ['pageSize' => 10],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
    public function actionUpdateStatusInline()
{
    $id = Yii::$app->request->post('editableKey');
    $model = Asset::findOne($id);

    $posted = current($_POST['Asset']);
    $output = '';

    if ($model->load(['Asset' => $posted], '') && $model->save(false)) {
        $output = $model->status;
    }

    return \yii\helpers\Json::encode(['output' => $output, 'message' => '']);
}



    public function actionCreate()
{
    $model = new Asset();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data asset.');
            }
        } else {
            Yii::$app->session->setFlash('error', json_encode($model->errors));
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}


    // Tambahkan juga actionView, actionUpdate, actionDelete jika perlu
}
