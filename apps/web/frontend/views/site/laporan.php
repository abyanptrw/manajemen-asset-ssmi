<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\Asset;

$this->title = 'Laporan Aset';
$this->params['breadcrumbs'][] = $this->title;

function hitungUmurInternal($purchaseDate) {
    $tanggalBeli = new DateTime($purchaseDate);
    $sekarang = new DateTime();
    return $tanggalBeli->diff($sekarang)->y;
}

// Statistik
$totalAset = $dataProvider->getTotalCount();
$asetAktif = Asset::find()->where(['status' => 'aktif'])->count();
$asetRusak = Asset::find()->where(['status' => 'rusak'])->count();
$asetDipinjam = Asset::find()->where(['status' => 'dipinjam'])->count();
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="bi bi-bar-chart"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <h5 class="mb-3">Statistik Inventaris</h5>
        <div class="row mb-4">
            <div class="col-md-3 col-6 mb-2">
                <div class="p-3 bg-white border rounded text-center">
                    <div class="fw-bold" style="font-size:1.3rem; color:#1976d2;">Total Aset</div>
                    <div class="display-6 fw-bold"><?= $totalAset ?></div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="p-3 bg-white border rounded text-center">
                    <div class="fw-bold" style="color:#388e3c;">Aset Aktif</div>
                    <div class="fs-4 fw-bold"><?= $asetAktif ?></div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="p-3 bg-white border rounded text-center">
                    <div class="fw-bold" style="color:#d32f2f;">Aset Rusak</div>
                    <div class="fs-4 fw-bold"><?= $asetRusak ?></div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="p-3 bg-white border rounded text-center">
                    <div class="fw-bold" style="color:#fbc02d;">Aset Dipinjam</div>
                    <div class="fs-4 fw-bold"><?= $asetDipinjam ?></div>
                </div>
            </div>
        </div>
        <h5 class="mb-3">Tabel Aset & Umur Ekonomis</h5>
        <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'category_id',
                    'label' => 'Kategori',
                    'value' => function($model) {
                        return $model->category ? $model->category->name : '-';
                    },
                ],
                'location',
                'status',
                'user',
                'purchase_date',
                [
                    'label' => 'Umur (tahun)',
                    'value' => function($model) {
                        $tanggalBeli = new DateTime($model->purchase_date);
                        $sekarang = new DateTime();
                        return $tanggalBeli->diff($sekarang)->y;
                    },
                ],
                [
                    'label' => 'Keterangan',
                    'value' => function($model) {
                        $tanggalBeli = new DateTime($model->purchase_date);
                        $sekarang = new DateTime();
                        $umur = $tanggalBeli->diff($sekarang)->y;
                        return $umur >= 5 ? 'Perlu Diganti' : 'Masih Layak';
                    },
                    'contentOptions' => function($model) {
                        $tanggalBeli = new DateTime($model->purchase_date);
                        $sekarang = new DateTime();
                        $umur = $tanggalBeli->diff($sekarang)->y;
                        return ['style' => $umur >= 5 ? 'color:red;' : 'color:green;'];
                    }
                ],
                /*
                [
                    'label' => 'Foto',
                    'format' => 'html',
                    'value' => function($model) {
                        if ($model->photo) {
                            return Html::img(Url::to('@web/uploads/' . $model->photo, true), [
                                'width' => '80px',
                                'style' => 'border-radius:5px;',
                            ]);
                        }
                        return '(no image)';
                    },
                ],
                */
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'
                ],
            ],
        ]); ?>
        </div>
    </div>
</div>