<?php
/**
 * Created by PhpStorm.
 * User: hungnv950
 * Date: 21/04/2017
 * Time: 10:51
 */

namespace app\controllers;


use app\models\SignupForm;
use app\models\User;
use yii\base\Controller;
use Yii;
use yii\helpers\Url;

class TestController extends Controller
{
    public function actionTest(){
        $model = new SignupForm();
        $model->username = "test4";
        $model->password   = "123456";
        $model->email   = "test4@test.com";

        $user = new User();
        $user->username = $model->username;
        $user->email = $model->email;
        $user->setPassword($model->password);
        $user->generateAuthKey();
        $user->save();
        Yii::$app->getUser()->login($user);
        return Yii::$app->response->redirect(Url::to(['/site/index']));
    }
}