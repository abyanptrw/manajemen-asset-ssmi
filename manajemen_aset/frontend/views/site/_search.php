<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-search mb-4">
    <?php $form = ActiveForm::begin([
        'action' => ['laporan'],
        'method' => 'get',
        'options' => ['data-pjax' => 1],
    ]); ?>

    <div class="input-group">
        <?= $form->field($model, 'globalSearch', [
            'options' => ['class' => 'flex-grow-1 me-2', 'style' => 'margin-bottom: 0;'],
            'template' => '{input}'
        ])->textInput(['placeholder' => 'Pencarian Universal (Nama, Lokasi, QR, dll)...', 'class' => 'form-control']) ?>
        
        <?= Html::submitButton('<i class="ph-bold ph-magnifying-glass"></i> Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="ph-bold ph-arrow-counter-clockwise"></i> Reset', ['laporan'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
