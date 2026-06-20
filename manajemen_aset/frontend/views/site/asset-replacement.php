<?php
use yii\helpers\Html;
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-transparent border-bottom">
        <h3 class="mb-0 fs-5 fw-semibold text-dark"><i class="ph-bold ph-arrows-clockwise"></i> Prediksi Penggantian Aset</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Aset</th>
                        <th>Tanggal Pembelian</th>
                        <th>Umur (tahun)</th>
                        <th>Status Penggantian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assets as $asset): ?>
                        <tr>
                            <td><?= Html::encode($asset->name) ?></td>
                            <td><?= Html::encode($asset->purchase_date) ?></td>
                            <td class="text-center fw-bold"><?= Html::encode($asset->age) ?></td>
                            <td>
                                <?php if ($asset->replacementStatus === 'Perlu Diganti'): ?>
                                    <span class="status-badge bg-danger text-white"><i class="ph-bold ph-warning"></i> <?= Html::encode($asset->replacementStatus) ?></span>
                                <?php else: ?>
                                    <span class="status-badge bg-success text-white"><i class="ph-bold ph-check-circle"></i> <?= Html::encode($asset->replacementStatus) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
