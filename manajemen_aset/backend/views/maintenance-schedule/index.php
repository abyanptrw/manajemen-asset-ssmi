<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MaintenanceScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Maintenance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-schedule-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 fs-3 fw-bold text-dark"><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="ph-bold ph-plus-circle"></i> Tambah Jadwal', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'asset_id',
                'label' => 'Aset',
                'value' => function ($model) {
                    return $model->asset ? $model->asset->name : ($model->asset_name ?: '-');
                },
            ],
            'description:ntext',
            'date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    $labels = [
                        'pending' => 'Pending',
                        'done' => 'Done',
                    ];
                    return $labels[$model->status] ?? $model->status;
                },
                'filter' => [
                    'pending' => 'Pending',
                    'done' => 'Done',
                ],
                'contentOptions' => function ($model) {
                    $colors = [
                        'pending' => 'color: orange;',
                        'done' => 'color: green;',
                    ];
                    return ['style' => $colors[$model->status] ?? ''];
                },
            ],
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="ph-bold ph-eye fs-5 mx-1"></i>', $url, ['title' => 'View']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="ph-bold ph-pencil-simple fs-5 mx-1"></i>', $url, ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="ph-bold ph-trash fs-5 mx-1 text-danger"></i>', $url, [
                            'title' => 'Delete',
                            'data-confirm' => 'Apakah Anda yakin ingin menghapus jadwal ini?',
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
