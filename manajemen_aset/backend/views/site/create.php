<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\AssetCategory;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = 'Tambah Asset';
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="asset-create">

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
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
