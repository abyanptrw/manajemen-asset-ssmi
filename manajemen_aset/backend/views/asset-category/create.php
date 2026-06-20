<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AssetCategory */

$this->title = 'Tambah Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
