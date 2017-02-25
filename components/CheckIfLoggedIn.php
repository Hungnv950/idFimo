<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 18-Feb-17
 * Time: 7:51 PM
 */
//Check User loggedIn and block Guest

namespace app\components;

use yii\base\Behavior;
use Yii;

class CheckIfLoggedIn extends Behavior {

    public function events()
    {
        return [
            \yii\web\Application::EVENT_BEFORE_ACTION => 'checkPermissonLayout',
        ];
    }

    public function checkPermissonLayout() {
        if (Yii::$app->controller->action->id == 'login') {
            Yii::$app->layout = 'main';
        }
        else if (Yii::$app->user->can('userManagerment')) {
            Yii::$app->layout = 'main';
        } else {
            //        If user dont have permission to Admin, render to customer
            Yii::$app->layout = 'customer';
        }
    }
}