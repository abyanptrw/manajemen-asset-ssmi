<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $data array */

$this->title = 'Prediksi Penggantian Aset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-replacement">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-muted">Aset yang sudah berumur 5 tahun atau lebih dari tanggal pembelian perlu dipertimbangkan untuk penggantian.</p>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Aset</th>
                    <th>Tanggal Pembelian</th>
                    <th>Umur (tahun)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $i => $item): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= Html::encode($item['name']) ?></td>
                            <td><?= Html::encode($item['purchase_date']) ?></td>
                            <td class="fw-bold"><?= Html::encode($item['age']) ?></td>
                            <td>
                                <span class="badge bg-danger"><i class="ph-bold ph-warning"></i> Perlu Diganti</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Semua aset masih dalam kondisi layak pakai.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
