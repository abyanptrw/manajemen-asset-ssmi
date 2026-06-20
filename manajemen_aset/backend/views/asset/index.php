<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Aset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 fs-3 fw-bold text-dark"><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="ph-bold ph-plus-circle"></i> Tambah Aset', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
            ],
            [
                'attribute' => 'name',
                'filter' => false,
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Kategori',
                'value' => function ($model) {
                    return $model->category ? $model->category->name : '-';
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\AssetCategory::find()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'location',
                'filter' => false,
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status === 'available') {
                        return '<span class="status-badge bg-success text-white"><i class="ph-bold ph-check-circle"></i> Available</span>';
                    } elseif ($model->status === 'maintenance') {
                        return '<span class="status-badge bg-danger text-white"><i class="ph-bold ph-wrench"></i> Maintenance</span>';
                    } else {
                        return '<span class="status-badge bg-warning text-dark"><i class="ph-bold ph-user-switch"></i> Checked Out</span>';
                    }
                },
                'filter' => [
                    'available' => 'Available',
                    'checked_out' => 'Checked Out',
                    'maintenance' => 'Maintenance',
                ],
            ],
            [
                'attribute' => 'purchase_date',
                'filter' => false, // filter teks dimatikan, sorting tetap jalan dari header
            ],
            [
                'attribute' => 'user',
                'filter' => false,
            ],

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
                            'data-confirm' => 'Apakah Anda yakin ingin menghapus aset ini?',
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
