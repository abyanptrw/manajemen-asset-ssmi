<?php
use yii\helpers\Html;

$this->title = 'Laporan Penggunaan Aset';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Jumlah Aset</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= Html::encode($row['category']) ?></td>
                <td><?= Html::encode($row['total']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
