<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $data array */

$this->title = 'Laporan Penggunaan Aset per Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-usage">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah Aset</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $i => $item): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= Html::encode($item['category']) ?></td>
                            <td class="fw-bold"><?= Html::encode($item['total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
