<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 23-Feb-17
 * Time: 11:06 AM
 */

namespace app\controllers;

use yii\helpers\Json;
use yii\httpclient\Client;


class AuthController
{
    public $accessToken;
    public $sid;
    public static $header = [
        'Authorization' => 'Bearer ztucZS1ZyFKgh0tUEruUtiSTXhnexmd6',
        'Content-Type' => 'application/json',
    ];

    public function setAccessToken($accessToken) {
        $this->$accessToken = $accessToken;
    }

    public function getAccessToken() {
        return $this->accessToken;
    }

//    public function actionAuth() {
//
//    }

    // Curl-php
    public function actionAuth($url, $responseType, $scope, $clientId, $redirectUri) {

        $client = new Client();

        $body = Json::encode([
            'query' => http_build_query([
                'response_type' => $responseType,
                'scope' => $scope,
                'client_id' => $clientId,
                'redirect_uri' => $redirectUri
            ])
        ]);

        $response = $client->post($url, $body, AuthController::$header)->send();
        if ($response->isOk) {
            if ($response->data['sid']){
                $this->sid = $response->data['sid'];
            }
        }
        return false;
    }

    public function getSubID($url, $data) {

        $client = new Client();
        $body = Json::encode([
            'query' => http_build_query([
                $data
            ])
        ]);

        $respone = $client->put($url, $body, AuthController::$header)->send();

    }
}