<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\AssetCategory;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(AssetCategory::find()->all(), 'id', 'name'),
        ['prompt' => '-- Pilih Kategori --']
    ) ?>

    <?= $form->field($model, 'status')->dropDownList([
        'available' => 'Available',
        'checked_out' => 'Checked Out',
        'maintenance' => 'Maintenance',
    ], ['prompt' => '-- Pilih Status --']) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qr_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_date')->input('date') ?>

    <?= $form->field($model, 'economic_life')->input('number', ['min' => 1]) ?>

    <?= $form->field($model, 'user')->textInput(['maxlength' => true]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? '<i class="ph-bold ph-plus-circle"></i> Tambah' : '<i class="ph-bold ph-floppy-disk"></i> Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
