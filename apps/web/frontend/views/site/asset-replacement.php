<?php
use yii\helpers\Html;
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="bi bi-arrow-repeat"></i> Prediksi Penggantian Aset</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-primary text-center">
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
                                    <span class="badge bg-danger"><i class="bi bi-exclamation-triangle"></i> <?= Html::encode($asset->replacementStatus) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> <?= Html::encode($asset->replacementStatus) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
