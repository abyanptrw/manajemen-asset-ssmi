<?php
use yii\helpers\Html;
?>

<h1>Aset yang Sedang Dipinjam</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Aset</th>
            <th>Status</th>
            <th>User</th>
            <th>Tanggal Pembelian</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><?= Html::encode($item['name']) ?></td>
            <td><?= Html::encode($item['status']) ?></td>
            <td><?= Html::encode($item['user']) ?></td>
            <td><?= Html::encode($item['purchase_date']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
