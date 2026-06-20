<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = 'Detail Aset: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="ph-bold ph-pencil-simple"></i> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="ph-bold ph-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus aset ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'category_id',
                'label' => 'Kategori',
                'value' => $model->category ? $model->category->name : '-',
            ],
            'location',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    $labels = [
                        'available' => 'Available',
                        'checked_out' => 'Checked Out',
                        'maintenance' => 'Maintenance',
                    ];
                    return $labels[$model->status] ?? $model->status;
                },
            ],
            'qr_code',
            'purchase_date',
            'economic_life',
            'user',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
