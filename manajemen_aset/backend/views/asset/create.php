<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = 'Tambah Aset';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
