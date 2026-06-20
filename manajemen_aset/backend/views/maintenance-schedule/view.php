<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceSchedule */

$assetName = $model->asset ? $model->asset->name : ($model->asset_name ?: '-');
$this->title = 'Detail Jadwal: ' . $assetName;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Pemeliharaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-schedule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="ph-bold ph-pencil-simple"></i> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="ph-bold ph-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus jadwal ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'asset_id',
                'label' => 'Aset',
                'value' => $model->asset ? $model->asset->name : ($model->asset_name ?: '-'),
            ],
            'description:ntext',
            'date',
            [
                'attribute' => 'status',
                'value' => $model->status === 'done' ? 'Selesai' : 'Pending',
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
