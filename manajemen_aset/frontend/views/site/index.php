<?php 
use yii\helpers\Html;

$this->title = 'Menu Laporan Aset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mb-5">
    <h1 class="display-6 fw-bold mb-2 tracking-tight" style="letter-spacing: -0.04em;">Dashboard</h1>
    <p class="text-muted" style="color: var(--muted-foreground);">Kelola aset, jadwal pemeliharaan, dan pantau laporan secara efisien.</p>
</div>

<div class="row g-4">
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 p-4 border transition-all hover-shadow">
            <div class="mb-3">
                <i class="ph-bold ph-plus-circle fs-3 text-dark"></i>
            </div>
            <h3 class="fs-5 fw-semibold mb-2 text-dark">Tambah Aset Baru</h3>
            <p class="text-muted small mb-4" style="color: var(--muted-foreground);">Daftarkan aset baru ke dalam sistem untuk pelacakan.</p>
            <div class="mt-auto">
                <?= Html::a('Tambah Aset', ['create'], ['class' => 'btn btn-success w-100']) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 p-4 border transition-all hover-shadow">
            <div class="mb-3">
                <i class="ph-bold ph-arrows-clockwise fs-3 text-dark"></i>
            </div>
            <h3 class="fs-5 fw-semibold mb-2 text-dark">Prediksi Penggantian</h3>
            <p class="text-muted small mb-4" style="color: var(--muted-foreground);">Lihat aset mana yang sudah mencapai batas umur ekonomis.</p>
            <div class="mt-auto">
                <?= Html::a('Lihat Prediksi', ['asset-replacement'], ['class' => 'btn btn-info w-100']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card h-100 p-4 border transition-all hover-shadow">
            <div class="mb-3">
                <i class="ph-bold ph-chart-bar fs-3 text-dark"></i>
            </div>
            <h3 class="fs-5 fw-semibold mb-2 text-dark">Laporan Lengkap</h3>
            <p class="text-muted small mb-4" style="color: var(--muted-foreground);">Analisis penggunaan aset dan status per kategori secara detail.</p>
            <div class="mt-auto">
                <?= Html::a('Buka Laporan', ['laporan'], ['class' => 'btn btn-info w-100']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card h-100 p-4 border transition-all hover-shadow">
            <div class="mb-3">
                <i class="ph-bold ph-calendar fs-3 text-dark"></i>
            </div>
            <h3 class="fs-5 fw-semibold mb-2 text-dark">Jadwal Pemeliharaan</h3>
            <p class="text-muted small mb-4" style="color: var(--muted-foreground);">Atur dan pantau jadwal perbaikan/maintenance rutin.</p>
            <div class="mt-auto">
                <?= Html::a('Cek Jadwal', ['calendar'], ['class' => 'btn btn-info w-100']) ?>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border-color: #d4d4d8 !important;
}
.transition-all {
    transition: all 0.2s ease-in-out;
}
</style>

