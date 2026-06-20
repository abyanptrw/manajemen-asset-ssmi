<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var int $totalAset */
/** @var int $asetMaintenance */
/** @var int $asetPerluDiganti */
/** @var int $jadwalBulanIni */

$this->title = 'Admin Dashboard';
?>
<div class="site-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fs-3 fw-bold text-dark mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Selamat datang kembali, <?= Html::encode(Yii::$app->user->identity->username) ?>. Berikut ringkasan operasional hari ini.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-subtitle text-muted mb-0 fw-semibold">Total Aset</h6>
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded">
                            <i class="ph-bold ph-package fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title mb-0 fw-bold"><?= $totalAset ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-subtitle text-muted mb-0 fw-semibold">Aset Servis</h6>
                        <div class="bg-warning bg-opacity-10 text-warning p-2 rounded">
                            <i class="ph-bold ph-wrench fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title mb-0 fw-bold"><?= $asetMaintenance ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-subtitle text-muted mb-0 fw-semibold">Perlu Diganti</h6>
                        <div class="bg-danger bg-opacity-10 text-danger p-2 rounded">
                            <i class="ph-bold ph-warning fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title mb-0 fw-bold"><?= $asetPerluDiganti ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-subtitle text-muted mb-0 fw-semibold">Jadwal Bulan Ini</h6>
                        <div class="bg-success bg-opacity-10 text-success p-2 rounded">
                            <i class="ph-bold ph-calendar-check fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title mb-0 fw-bold"><?= $jadwalBulanIni ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0 fw-semibold"><i class="ph-bold ph-lightning"></i> Akses Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= Url::to(['asset/index']) ?>" class="btn btn-outline-primary text-start fw-semibold py-2"><i class="ph-bold ph-list-dashes me-2 fs-5"></i> Kelola Master Data Aset</a>
                        <a href="<?= Url::to(['maintenance-schedule/index']) ?>" class="btn btn-outline-primary text-start fw-semibold py-2"><i class="ph-bold ph-calendar-plus me-2 fs-5"></i> Kelola Jadwal Servis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>