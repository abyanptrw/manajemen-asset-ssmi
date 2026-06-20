<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\BadRequestHttpException;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Asset;
use common\models\AssetCategory;
use common\models\LoginForm;
use common\models\AssetSearch;
use common\models\MaintenanceSchedule;

use frontend\models\ContactForm;
use frontend\models\SignupForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\VerifyEmailForm;
use frontend\models\ResendVerificationEmailForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'except' => ['login', 'error'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Hanya user yang login
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => ['class' => \yii\web\ErrorAction::class],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // ========== HALAMAN BERANDA ==========
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Asset::find(),
            'pagination' => ['pageSize' => 10],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    // ========== LOGIN ==========
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Login berhasil!');
            return $this->redirect(['site/index']); // redirect ke homepage
        }

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    // ========== LOGOUT ==========
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }

    // ========== KALENDER ==========
    public function actionCalendar()
    {
        $jadwal = MaintenanceSchedule::find()->all();
        return $this->render('calendar', ['jadwal' => $jadwal]);
    }

    public function actionAddSchedule()
    {
        $model = new MaintenanceSchedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['calendar']);
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdateSchedule($id)
    {
        $model = MaintenanceSchedule::findOne($id);
        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('Jadwal tidak ditemukan.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['calendar']);
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDeleteSchedule($id)
    {
        $model = MaintenanceSchedule::findOne($id);
        if ($model !== null) {
            $model->delete();
        } else {
            throw new \yii\web\NotFoundHttpException('Jadwal tidak ditemukan.');
        }

        return $this->redirect(['calendar']);
    }

    // ========== CRUD ASET ==========
    public function actionCreate()
    {
        $model = new Asset();

        if ($model->load(Yii::$app->request->post())) {
            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
            if ($model->photoFile) {
                $filename = uniqid() . '.' . $model->photoFile->extension;
                $model->photoFile->saveAs(Yii::getAlias('@webroot/uploads/') . $filename);
                $model->photo = $filename;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
            if ($model->photoFile) {
                $filename = uniqid() . '.' . $model->photoFile->extension;
                $model->photoFile->saveAs(Yii::getAlias('@webroot/uploads/') . $filename);
                $model->photo = $filename;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Asset::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // ========== FORM LAINNYA ==========
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Check your inbox for verification.');
            return $this->redirect(['site/index']);
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['site/index']);
            }

            Yii::$app->session->setFlash('error', 'Unable to reset password for that email.');
        }

        return $this->render('requestPasswordResetToken', ['model' => $model]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Password berhasil diubah.');
            return $this->redirect(['site/index']);
        }

        return $this->render('resetPassword', ['model' => $model]);
    }

    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Email berhasil diverifikasi.');
            return $this->redirect(['site/index']);
        }

        Yii::$app->session->setFlash('error', 'Token tidak valid.');
        return $this->redirect(['site/index']);
    }

    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Email verifikasi dikirim ulang.');
                return $this->redirect(['site/index']);
            }

            Yii::$app->session->setFlash('error', 'Gagal mengirim ulang email verifikasi.');
        }

        return $this->render('resendVerificationEmail', ['model' => $model]);
    }

    public function actionLaporan()
    {
        $searchModel = new AssetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('laporan', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionAssetReplacement()
    {
        $assets = Asset::find()->all();

        return $this->render('asset-replacement', [
            'assets' => $assets,
        ]);
    }
}
