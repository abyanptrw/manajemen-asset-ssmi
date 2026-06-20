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
        $searchModel = new \common\models\AssetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data asset berhasil diperbarui.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Data asset berhasil dihapus.');

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Asset::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data yang diminta tidak ditemukan.');
    }
}
