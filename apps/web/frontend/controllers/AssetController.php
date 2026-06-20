<?php
namespace frontend\controllers;

use Yii;
use common\models\Asset;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AssetController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Asset::find(),
            'pagination' => ['pageSize' => 10],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
public function actionLaporan()
{
    $searchModel = new \backend\models\AssetSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('laporan', [
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]);
}

   public function actionCreate()
{
    $model = new Asset();

    if ($model->load(Yii::$app->request->post())) {
        $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
        if ($model->photoFile) {
            $filename = uniqid() . '.' . $model->photoFile->extension;
            $model->photoFile->saveAs(Yii::getAlias('@webroot/uploads/') . $filename);
            $model->photo = $filename;
        }
        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }

    return $this->render('create', ['model' => $model]);
}


protected function findModel($id)
{
    if (($model = Asset::findOne($id)) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
}

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionReplacement()
    {
        $currentYear = date('Y');
        $data = Asset::getReplacementPrediction($currentYear);

        return $this->render('replacement', ['data' => $data]);
    }

    public function actionCheckedOut()
    {
        $data = Asset::getCheckedOutAssets();
        return $this->render('checked-out', ['data' => $data]);
    }

    


}
