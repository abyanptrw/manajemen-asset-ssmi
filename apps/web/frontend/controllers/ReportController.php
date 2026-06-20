<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\models\Asset;
use common\models\ReportHelper;

class ReportController extends Controller
{
    public function actionUsage()
    {
        $rawData = Asset::getUsageReport();
        $data = ReportHelper::formatUsageReport($rawData);

        return $this->render('/site/report/usage', ['data' => $data]);
    }

    public function actionReplacement()
    {
        $currentYear = date('Y');
        $data = Asset::getReplacementPrediction($currentYear);

        return $this->render('/site/report/replacement', ['data' => $data]);
    }
}
