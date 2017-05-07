<?php

namespace app\controllers;

use Yii;
use yii\httpclient\Client;

class ClientController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRespone() {
        if (Yii::$app->request->get()) {
            $code = Yii::$app->request->get()['code'];

            $key = base64_encode(Client_app::$Clients['client_id'].':'.Client_app::$Clients['client_secret']);
            $auth = new AuthController();
            $auth->getAccessToken(Client_app::$Clients['url_token'], $code, $key, Client_app::$Clients['url_return']);
            $userInfo = $auth->getUserInfo(Client_app::$Clients['url_userInfo'], $auth->accessToken);
        }
        return $this->render('respone',[
                'userInfo' => $userInfo
        ]);
    }

}

class Client_app
{
    public static $Clients = array(
        'domain' => 'http://localhost/auth-fimo/client-auth/',
        'client_id' => 'frxpcnydw3cng',
        'client_secret' => 'HKE_43ZCks3XymPLW4kAGND-Xt9cdN2J5wus_j0BVyI',
//        'auth_url' => 'http://id.projectkit.net/auth/signin',
        'url_return' => 'http://127.0.0.1/auth-fimo/idFimo/web/client/respone',
        'scope' =>'openid email profile name fullname',
        'url_userInfo' => 'http://127.0.0.1:8080/auth-fimo/c2id/userinfo',
        'jwkUrl' => 'http://id.projectkit.net:8080/c2id/jwks.json',
        'url_token' => 'http://localhost:8080/c2id/token',
        'iss' => 'http://id.projectkit.net',
    );
}