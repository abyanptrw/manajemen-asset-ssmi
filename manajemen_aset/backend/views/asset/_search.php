<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-search mb-4">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class' => 'd-flex'
        ],
    ]); ?>

    <?= $form->field($model, 'globalSearch', [
        'options' => ['class' => 'flex-grow-1 me-2'],
    ])->textInput([
        'placeholder' => 'Pencarian universal (Nama, Lokasi, QR Code, User)...',
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="ph-bold ph-magnifying-glass"></i> Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="ph-bold ph-arrow-counter-clockwise"></i> Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
