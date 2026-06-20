<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Asset */

$this->title = $model->isNewRecord ? 'Tambah Aset Baru' : 'Update Aset: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', ['model' => $model]) ?>
