<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\MaintenanceSchedule[] $jadwal */

$this->title = 'Kalender Pemeliharaan Aset';
$this->params['breadcrumbs'][] = $this->title;

$bulan = date('n');
$tahun = date('Y');
$jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

$hariNama = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="bi bi-calendar-event"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr class="table-primary text-center">
                        <th>HARI</th>
                        <th>TGL</th>
                        <th>AGENDA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($tgl = 1; $tgl <= $jumlahHari; $tgl++): ?>
                        <?php
                        $tanggalStr = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tgl);
                        $dayOfWeek = date('w', strtotime($tanggalStr));
                        $agenda = array_filter($jadwal, function ($item) use ($tanggalStr) {
                            return $item->date == $tanggalStr;
                        });
                        ?>
                        <tr<?= $dayOfWeek == 0 ? ' class="table-danger"' : '' ?>>
                            <td class="text-center fw-bold"><?= $hariNama[$dayOfWeek] ?></td>
                            <td class="text-center"><?= $tgl ?></td>
                            <td>
                                <?php if (count($agenda) > 0): ?>
                                    <?php foreach ($agenda as $a): ?>
                                        <div class="mb-2">
                                            <span class="badge bg-info text-dark mb-1">Aset: <?= Html::encode($a->asset_name) ?></span><br>
                                            <span class="text-muted small"><i class="bi bi-info-circle"></i> <?= Html::encode($a->description) ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?= Html::a('<i class="bi bi-plus-circle"></i> Tambah Agenda Baru', ['site/add-schedule'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
