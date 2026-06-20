<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="ph-bold ph-envelope"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <p class="mb-4 text-muted">
            If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
        </p>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'Nama lengkap']) ?>

                    <?= $form->field($model, 'email')->input('email', ['placeholder' => 'Alamat email']) ?>

                    <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subjek pesan']) ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Tulis pesan Anda di sini...']) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-4 mb-2">{image}</div><div class="col-lg-8">{input}</div></div>',
                    ]) ?>

                    <div class="form-group mt-3">
                        <?= Html::submitButton('<i class="ph-bold ph-paper-plane-right"></i> Submit', ['class' => 'btn btn-primary btn-lg w-100', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
