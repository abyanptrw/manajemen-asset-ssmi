<?php
use yii\helpers\Html;
?>

<h1>Prediksi Penggantian Aset</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Aset</th>
            <th>Tanggal Pembelian</th>
            <th>Umur (tahun)</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><?= Html::encode($item['name']) ?></td>
            <td><?= Html::encode($item['purchase_date']) ?></td>
            <td><?= Html::encode($item['age']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
