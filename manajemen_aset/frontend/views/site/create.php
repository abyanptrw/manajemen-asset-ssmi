<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = $model->isNewRecord ? 'Tambah Aset Baru' : 'Update Aset: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-transparent border-bottom">
        <h3 class="mb-0 fs-5 fw-semibold text-dark"><i class="ph-bold ph-plus-circle"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>
