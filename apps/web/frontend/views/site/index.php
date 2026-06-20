<?php 
use yii\helpers\Html;

$this->title = 'Menu Laporan Aset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="bi bi-grid"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="d-grid">
                    <?= Html::a('<i class="bi bi-plus-circle"></i> Tambah Aset Baru', ['create'], ['class' => 'btn btn-success btn-lg mb-2']) ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="d-grid">
                    <?= Html::a('<i class="bi bi-arrow-repeat"></i> Prediksi Penggantian Aset', ['asset-replacement'], ['class' => 'btn btn-warning btn-lg mb-2 text-white']) ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="d-grid">
                    <?= Html::a('<i class="bi bi-bar-chart"></i> Lihat Laporan Lengkap', ['laporan'], ['class' => 'btn btn-info btn-lg mb-2 text-white']) ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="d-grid">
                    <?= Html::a('<i class="bi bi-calendar-event"></i> Jadwal Pemeliharaan Rutin', ['calendar'], ['class' => 'btn btn-info btn-lg mb-2 text-white']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
