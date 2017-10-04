<?php

namespace sheillendra\jeasyui\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use common\models\LoginForm;

/**
 * Site controller
 */
class JeasyuiController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'signup', 'forgot-password', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout', 'index', 'setting', 'setting-rbac', 'profile'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            echo $this->renderAjax('_index');
            return Yii::$app->end();
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            echo Json::encode(['redirect' => Yii::$app->getHomeUrl()]);
            return Yii::$app->end();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo Json::encode(['redirect' => Yii::$app->getUser()->getReturnUrl()]);
        } else {
            if ($model->hasErrors()) {
                echo Json::encode(['loginerror' => $model->getErrors()]);
            } else {
                return $this->render('login/login', ['model' => $model]);
            }
        }
        Yii::$app->end();
    }

    /**
     * Signup action.
     *
     * @return string
     */
    public function actionSignup() {
        if (!Yii::$app->user->isGuest) {
            echo Json::encode(['redirect' => Yii::$app->getHomeUrl()]);
            return Yii::$app->end();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo Json::encode(['redirect' => Yii::$app->getUser()->getReturnUrl()]);
        } else {
            if ($model->hasErrors()) {
                echo Json::encode(['loginerror' => $model->getErrors()]);
            } else {
                return $this->render('signup', ['model' => $model]);
            }
        }
        Yii::$app->end();
    }

    /**
     * Signup action.
     *
     * @return string
     */
    public function actionForgotPassword() {
        if (!Yii::$app->user->isGuest) {
            echo Json::encode(['redirect' => Yii::$app->getHomeUrl()]);
            return Yii::$app->end();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo Json::encode(['redirect' => Yii::$app->getUser()->getReturnUrl()]);
        } else {
            if ($model->hasErrors()) {
                echo Json::encode(['loginerror' => $model->getErrors()]);
            } else {
                return $this->render('signup', ['model' => $model]);
            }
        }
        Yii::$app->end();
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['/jeasyui/login']);
    }

    public function actionSetting() {
        if (Yii::$app->request->isAjax) {
            echo $this->renderAjax('setting/_index');
            return Yii::$app->end();
        }
        return $this->render('setting/index');
    }

    public function actionSettingRbac() {
        if (Yii::$app->request->isAjax) {
            echo $this->renderAjax('setting-rbac/_index');
            return Yii::$app->end();
        }
        return $this->render('setting-rbac/index');
    }

    public function actionProfile() {
        if (Yii::$app->request->isAjax) {
            echo $this->renderAjax('profile/_index');
            return Yii::$app->end();
        }
        return $this->render('profile/index');
    }

}
