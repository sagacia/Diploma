<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm as Login;
use app\models\Signup;
use app\models\ContactForm;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\AccountActivation;

class SiteController extends AppController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup() {


        $emailActivation = Yii::$app->params['emailActivation'];
        $model = $emailActivation ? new Signup(['scenario' => 'emailActivation']) : new Signup();
        //$model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {



            if ($user = $model->signup()) {
                //**********
                if ($model->sendActivationEmail($user)):
                    Yii::$app->session->setFlash('warning', 'Письмо отправлено на email <strong>' .
                            Html::encode($user->email) . '</strong> (проверьте папку спам)');
                else:
                    Yii::$app->session->setFlash('warning', 'Ошибка. Письмо не отправлено');
                    Yii::error('Ошибка отправки письма');

                endif;
                //**********
                return $this->goHome();
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    public function actionActivateAccount($key) {
        try {
            $user = new AccountActivation($key);
        } catch (Exception $ex) {
            throw new BadRequestHttpException($ex->getMessage());
        }

        if ($user->activateAccount())
            Yii::$app->session->setFlash('warning', 'Активация прошла успешно!');
        else {
            Yii::$app->session->setFlash('warning', 'Ошибка активации!');
            Yii::error('Ошибка при активации.');
        }

        return $this->redirect(Url::to(['site/login']));
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }
    
    public function actionContacts() {
        
        return $this->render('contacts');
    }
    
     public function actionStores() {
        
        return $this->render('stores');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSendEmail() {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                if ($model->sendEmail()):
                    Yii::$app->getSession()->setFlash('warning', 'Проверьте email');
                    return $this->goHome();
                else:
                    Yii::$app->getSession()->setFlash('warning', 'Нельзя сбросить email');
                endif;
            }
        }

        return $this->render('sendEmail', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($key) {

        try {
            $model = new ResetPasswordForm($key);
        } catch (InvalidParamException $ex) {
            throw new BadRequestHttpException($ex->getMessage());
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Пароль изменен');
                return $this->redirect(Url::to('/site/login'));
            }
        }
        
        

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
