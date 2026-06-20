<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */ 
/* @var $model common\models\Asset */

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'name')->textInput(['maxlength' => true]);

echo $form->field($model, 'category_id')->dropDownList( \yii\helpers\ArrayHelper::map(\common\models\AssetCategory::find()->all(), 'id', 'name'),
    ['prompt' => 'Pilih Kategori']
);

echo $form->field($model, 'status')->dropDownList([
    'available' => 'Available',
    'checked_out' => 'Checked Out',
    'maintenance' => 'Maintenance',
], ['prompt' => 'Pilih Status']);

echo $form->field($model, 'location')->textInput(['maxlength' => true]);
echo $form->field($model, 'qr_code')->textInput(['maxlength' => true]);
echo $form->field($model, 'purchase_date')->input('date');
echo $form->field($model, 'economic_life')->input('number', ['min' => 1]);
echo $form->field($model, 'user')->textInput(['maxlength' => true]);

/* echo $form->field($model, 'photoFile')->fileInput(); */

echo '<div class="form-group mt-4">';
echo Html::submitButton(
    $model->isNewRecord ? '<i class="ph-bold ph-plus-circle"></i> Tambah Aset' : '<i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan', 
    ['class' => 'btn btn-primary w-100 py-2 fw-semibold']
);
echo '</div>';
ActiveForm::end();
?>
