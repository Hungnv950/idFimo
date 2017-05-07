<?php
namespace app\controllers;

use app\models\App;
use app\models\User;
use Yii;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\base\Response;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

use app\controllers\AuthController;


class SiteController extends Controller {

    public function behaviors() {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

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
    public function actionIndex() {

        $app = App::find()->asArray()->all();

        return $this->render('index',[
            'app' => $app
        ]);
    }

    /*
     * Login with Oauth 2.0
     * */
    public function actionAuthLogin() {

        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                $this->layout= 'main';
                return $this->render('/site/login', [
                    'model' => $model,
                ]);
            }
        }

        $auth = new AuthController();

        /*
         * Get parameter in url
         * */
        $request = Yii::$app->request;
        $responseType = $request->get('response_type');
        $scope = $request->get('scope');
        $clientId = $request->get('client_id');
        $redirectUri = $request->get('redirect_uri');

        $state = $request->get('state');
        /*
         * create user_sid
         * */
        $auth->actionAuth(Yii::$app->params['url_authorizationSession'], $responseType, $scope, $clientId, $redirectUri );
        $auth->uri = $redirectUri;

        /*
         * sent clame and receive redirect_url, have code
         * */
        $model = Yii::$app->getUser()->identity['attributes'];
        $username = $model['username'];
        $email = $model['email'];
        $data = [
            'name'  => $username,
            'email' => $email
        ];

        $auth->getSubID(Yii::$app->params['url_authorizationSession'].'/'.$auth->sid, $username,$data);

        $scope = array("openid", "email", "profile");
        $clamps = array( "email", "email_verified" );


        $auth->getUri(Yii::$app->params['url_authorizationSession'].'/'.$auth->sid, $scope, $clamps);
        return Yii::$app->getResponse()->redirect($auth->uriRedirect.'&state='.$state)   ;
    }

    public function actionGetUser() {
        $request = Yii::$app->request;
        $accessToken = $request->get('accessToken');
        echo $accessToken;
    }


    function actionUserInfor()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $username = Yii::$app->request->get('username');

        $out = ['results' => ['id' => '', 'text' => '']];

        if (!is_null($username)) {
            $user = User::find()->where(['=','username', $username])->asArray()->all();
        }
        else {
            $user = User::find()->asArray()->all();
        }
//        $out['results'] = ArrayHelper::index($user, 'username');

        return $user;
    }



    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    public function actionAbout() {
        return $this->render('about');
    }
    public function actionRequestPasswordReset() {
        if (Yii::$app->user->can('userManagerment')) {
            $this->layout = 'main';
        } else {
            //        If user dont have permission to Admin, render to customer
            $this->layout = 'customer';
        }
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionConsent() {
        return $this->render('//app/consent');
    }


    //Delete All App
    public function actionDemo() {

        $auth = new AuthController();
        $apps = $auth->getAllApp();

        foreach ($apps as $data=> $value) {
            $apps = $auth->deleteApp(Yii::$app->params['url_clientRegistration'], $value->client_id);
            echo ($value->client_id)."<br>";
        }
    }

    //Delete one app
    public function actionDemo1($id) {
        $auth = new AuthController();
        $apps = $auth->deleteApp(Yii::$app->params['url_clientRegistration'], $id);
    }
}