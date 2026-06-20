<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AssetCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? '<i class="ph-bold ph-plus-circle"></i> Tambah' : '<i class="ph-bold ph-floppy-disk"></i> Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
