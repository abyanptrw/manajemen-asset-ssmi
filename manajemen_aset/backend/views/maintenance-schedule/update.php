<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceSchedule */

$assetName = $model->asset ? $model->asset->name : ($model->asset_name ?: 'Jadwal #' . $model->id);
$this->title = 'Update Jadwal: ' . $assetName;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Pemeliharaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $assetName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maintenance-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
