<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
$asetAktif = Asset::find()->where(['status' => 'available'])->count();
$asetRusak = Asset::find()->where(['status' => 'maintenance'])->count();
$asetDipinjam = Asset::find()->where(['status' => 'checked_out'])->count();
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-transparent border-bottom">
        <h3 class="mb-0 fs-5 fw-semibold text-dark"><i class="ph-bold ph-chart-bar"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <h5 class="mb-3">Statistik Inventaris</h5>
        <div class="row mb-4">
            <div class="col-md-3 col-6 mb-2">
                <div class="p-4 bg-white border rounded text-center transition-all hover-shadow h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 fs-6 text-muted" style="color: var(--muted-foreground) !important; font-weight: 500;">Total Aset</h5>
                        <i class="ph-bold ph-package fs-4" style="color: var(--muted-foreground);"></i>
                    </div>
                    <p class="display-6 fw-bold mb-0 text-dark"><?= $totalAset ?></p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="p-4 bg-white border rounded text-center transition-all hover-shadow h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 fs-6 text-muted" style="color: var(--muted-foreground) !important; font-weight: 500;">Aset Aktif</h5>
                        <i class="ph-bold ph-check-circle fs-4 text-success"></i>
                    </div>
                    <p class="display-6 fw-bold mb-0 text-dark"><?= $asetAktif ?></p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="p-4 bg-white border rounded text-center transition-all hover-shadow h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 fs-6 text-muted" style="color: var(--muted-foreground) !important; font-weight: 500;">Aset Maintenance</h5>
                        <i class="ph-bold ph-wrench fs-4 text-danger"></i>
                    </div>
                    <p class="display-6 fw-bold mb-0 text-dark"><?= $asetRusak ?></p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="p-4 bg-white border rounded text-center transition-all hover-shadow h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 fs-6 text-muted" style="color: var(--muted-foreground) !important; font-weight: 500;">Aset Dipinjam</h5>
                        <i class="ph-bold ph-arrow-circle-right fs-4 text-warning"></i>
                    </div>
                    <p class="display-6 fw-bold mb-0 text-dark"><?= $asetDipinjam ?></p>
                </div>
            </div>
        </div>
        <h5 class="mb-3">Tabel Aset & Umur Ekonomis</h5>
        
        <?= $this->render('_search', ['model' => $searchModel]) ?>
        
        <div class="table-responsive">
        <?php Pjax::begin(['id' => 'laporan-pjax', 'timeout' => 5000]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'filterInputOptions' => [
                        'class' => 'form-control',
                        'placeholder' => 'Filter by name...'
                    ]
                ],
                [
                    'attribute' => 'category_id',
                    'label' => 'Kategori',
                    'value' => function($model) {
                        return $model->category ? $model->category->name : '-';
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(\common\models\AssetCategory::find()->all(), 'id', 'name'),
                ],
                'location',
                [
                    'attribute' => 'status',
                    'filter' => [
                        'available' => 'Available',
                        'checked_out' => 'Checked Out',
                        'maintenance' => 'Maintenance',
                    ],
                ],
                'user',
                [
                    'attribute' => 'purchase_date',
                    'filter' => false,
                ],
                [
                    'label' => 'Umur (tahun)',
                    'value' => function($model) {
                        if (empty($model->purchase_date)) {
                            return '-';
                        }
                        $tanggalBeli = new DateTime($model->purchase_date);
                        $sekarang = new DateTime();
                        return $tanggalBeli->diff($sekarang)->y;
                    },
                ],
                [
                    'label' => 'Keterangan',
                    'value' => function($model) {
                        if (empty($model->purchase_date)) {
                            return '-';
                        }
                        $tanggalBeli = new DateTime($model->purchase_date);
                        $sekarang = new DateTime();
                        $umur = $tanggalBeli->diff($sekarang)->y;
                        return $umur >= 5 ? 'Perlu Diganti' : 'Masih Layak';
                    },
                    'contentOptions' => function($model) {
                        if (empty($model->purchase_date)) {
                            return [];
                        }
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
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="ph-bold ph-pencil-simple fs-5 mx-1"></i>', $url, ['title' => 'Update']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="ph-bold ph-trash fs-5 mx-1 text-danger"></i>', $url, [
                                'title' => 'Delete',
                                'data-confirm' => 'Apakah Anda yakin ingin menghapus aset ini?',
                                'data-method' => 'post',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
        </div>
    </div>
</div>