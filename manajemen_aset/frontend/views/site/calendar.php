<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/** @var yii\web\View $this */
/** @var app\models\MaintenanceSchedule[] $jadwal */

$this->title = 'Jadwal Pemeliharaan Aset';
$this->params['breadcrumbs'][] = $this->title;

// Buat DataProvider dari array $jadwal
$dataProvider = new ArrayDataProvider([
    'allModels' => $jadwal,
    'pagination' => [
        'pageSize' => 15,
    ],
    'sort' => [
        'attributes' => ['date', 'asset_name', 'status'],
        'defaultOrder' => ['date' => SORT_DESC],
    ],
]);
?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
        <h3 class="mb-0 fs-5 fw-semibold text-dark"><i class="ph-bold ph-list-dashes"></i> <?= Html::encode($this->title) ?></h3>
        <?= Html::a('<i class="ph-bold ph-plus-circle"></i> Tambah Agenda Baru', ['site/add-schedule'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
                'layout' => "{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
                    [
                        'attribute' => 'date',
                        'label' => 'Tanggal & Waktu',
                        'format' => ['datetime', 'php:d M Y, H:i']
                    ],
                    [
                        'attribute' => 'asset_name',
                        'label' => 'Nama Aset',
                        'format' => 'raw',
                        'value' => function($model) {
                            return '<span class="fw-semibold">' . Html::encode($model->asset_name) . '</span>';
                        }
                    ],
                    [
                        'attribute' => 'description',
                        'label' => 'Deskripsi Pemeliharaan'
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($model) {
                            $status = strtolower($model->status);
                            if ($status === 'pending') {
                                return '<span class="status-badge bg-warning text-dark"><i class="ph-bold ph-clock"></i> Pending</span>';
                            } else {
                                return '<span class="status-badge bg-success text-white"><i class="ph-bold ph-check-circle"></i> Selesai</span>';
                            }
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Aksi',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="ph-bold ph-pencil-simple"></i> Edit', 
                                    ['site/update-schedule', 'id' => $model->id], 
                                    ['class' => 'btn btn-sm btn-outline-primary me-2']
                                );
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="ph-bold ph-trash"></i> Hapus', 
                                    ['site/delete-schedule', 'id' => $model->id], 
                                    [
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'data' => [
                                            'confirm' => 'Apakah Anda yakin ingin menghapus agenda ini secara permanen?',
                                            'method' => 'post',
                                        ],
                                    ]
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
