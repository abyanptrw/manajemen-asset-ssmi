<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Asset;

/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maintenance-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asset_id')->dropDownList(
        ArrayHelper::map(Asset::find()->all(), 'id', 'name'),
        ['prompt' => '-- Pilih Aset --']
    ) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'date')->input('datetime-local') ?>

    <?= $form->field($model, 'status')->dropDownList([
        'pending' => 'Pending',
        'done' => 'Selesai',
    ]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? '<i class="ph-bold ph-plus-circle"></i> Tambah' : '<i class="ph-bold ph-floppy-disk"></i> Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
