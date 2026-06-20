<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);
$this->registerCssFile(Yii::getAlias('@web/css/admin-custom.css'));
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Satoshi Font -->
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,600,700&display=swap" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web" defer></script>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="admin-header border-bottom">
    <div class="d-flex align-items-center">
        <div class="brand-logo me-2"></div>
        <span class="app-title">SSMI ERP</span>
    </div>
</div>
<?php if (!(Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'login')): ?>
<div class="admin-wrapper">
    <nav class="admin-sidebar">
        <ul>
            <li><a href="<?= Yii::$app->homeUrl ?>" class="<?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/create']) ?>" class="<?= Yii::$app->controller->action->id == 'create' ? 'active' : '' ?>">Tambah Aset Baru</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/asset-replacement']) ?>" class="<?= Yii::$app->controller->action->id == 'asset-replacement' ? 'active' : '' ?>">Prediksi Penggantian</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/laporan']) ?>" class="<?= Yii::$app->controller->action->id == 'laporan' ? 'active' : '' ?>">Laporan Lengkap</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/calendar']) ?>" class="<?= Yii::$app->controller->action->id == 'calendar' ? 'active' : '' ?>">Jadwal Pemeliharaan</a></li>
            <?php if (Yii::$app->user->isGuest): ?>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">Login</a></li>
            <?php else: ?>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>" data-method="post">Logout (<?= Html::encode(Yii::$app->user->identity->username) ?>)</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main class="admin-main-content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>
</div>
<?php else: ?>
<div class="admin-main-content">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>
<?php endif; ?>
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
