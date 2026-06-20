<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Asset;
use common\models\MaintenanceSchedule;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * {@inheritdoc}
     */


    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalAset = Asset::find()->count();
        $asetMaintenance = Asset::find()->where(['status' => 'maintenance'])->count();
        if (Yii::$app->db->driverName === 'sqlite') {
            $asetPerluDiganti = Asset::find()->where("date(purchase_date, '+' || economic_life || ' years') <= date('now')")->count();
        } else {
            $asetPerluDiganti = Asset::find()->where('TIMESTAMPDIFF(YEAR, purchase_date, CURDATE()) >= economic_life')->count();
        }
        
        $awalBulan = date('Y-m-01 00:00:00');
        $akhirBulan = date('Y-m-t 23:59:59');
        $jadwalBulanIni = MaintenanceSchedule::find()
            ->where(['between', 'date', $awalBulan, $akhirBulan])
            ->count();

        return $this->render('index', [
            'totalAset' => $totalAset,
            'asetMaintenance' => $asetMaintenance,
            'asetPerluDiganti' => $asetPerluDiganti,
            'jadwalBulanIni' => $jadwalBulanIni,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
