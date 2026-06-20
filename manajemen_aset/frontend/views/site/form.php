<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MaintenanceSchedule $model */

$this->title = $model->isNewRecord ? 'Tambah Jadwal Pemeliharaan' : 'Edit Jadwal Pemeliharaan';
?>

<div class="schedule-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asset_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'date')->input('datetime-local') ?>

    <div class="form-group mt-4 d-flex justify-content-between">
        <?= Html::submitButton($model->isNewRecord ? '<i class="ph-bold ph-plus-circle"></i> Simpan' : '<i class="ph-bold ph-floppy-disk"></i> Update', ['class' => 'btn btn-primary']) ?>
        
        <?php if (!$model->isNewRecord): ?>
            <?= Html::a('<i class="ph-bold ph-trash"></i> Hapus Agenda', ['delete-schedule', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin menghapus agenda ini secara permanen?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
