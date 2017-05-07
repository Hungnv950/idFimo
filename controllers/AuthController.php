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
use Yii;


class AuthController
{
    public $uSid;
    public $sid;
    public $uri;
    public $uriRedirect;
    public $accessToken;
    public $refreshToken;
    public $idToken;
    public $tokenExpiresIn;
    private static $header = [
        'Authorization' => 'Bearer ztucZS1ZyFKgh0tUEruUtiSTXhnexmd6',
        'Content-Type' => 'application/json',
    ];

    /*
     * Send query
     * Get session id
     * */
    public function actionAuth($url, $responseType, $scope, $clientId, $redirectUri)
    {

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
            if (!empty($response->data['sid'])) {
                $this->sid = $response->data['sid'];
            }
        }
        return false;
    }

    /*
     * Send sub (name or email)
     * get user_session id
     *
     * */
    public function getSubID($url, $sub, $data)
    {

        $client = new Client();
        $body = Json::encode([
            'sub' => $sub,
            'max_idle' => Yii::$app->params['max_idle'],
            'data' => $data,
        ]);

        $respone = $client->put($url, $body, AuthController::$header)->send();
        $result = json_decode($respone->content, true);
        if (!empty($result['sub_session'])) {
            $this->uSid = $result['sub_session']['sid'];
        } else {
            $this->uSid = $result['sub_sid'];
            $this->uriRedirect = $result['parameters']['uri'];
        }

        return false;
    }

    /*
     * Send Consent
     * and get Uri, accesstoken
     * */
    public function getUri($url, $scope, $clamps)
    {

        $client = new Client();

        $body = Json::encode([
            'scope' => $scope,
            'claims' => $clamps,
//            'profile' => 'Hungnv950'
        ]);

        $response = $client->put($url, $body, AuthController::$header)->send();
        if ($response->isOk) {
            $this->uriRedirect = json_decode($response->content)->parameters->uri;
        }
    }

    /*
     * Create new App with Server
     * */
    public function createApp($url, $redirect_uris, $name)
    {

        $client = new Client();
        $body = Json::encode([
            'name' => $name,
            'redirect_uris' => $redirect_uris
        ]);

        $response = $client->post($url, $body, AuthController::$header)->send();
        if ($response->isOk) {
            return json_decode($response->content);
        }

        return false;
    }


    /*
     * Reset, delete all application
     * */
    public function deleteApp($url, $id)
    {

        $client = new Client();
        $body = Json::encode([
            'redirect_uris' => $id
        ]);

        $url = $url . '/' . $id;
        $client->delete($url, $body, AuthController::$header)->send();

        return false;
    }

    /*
     * Get all application had in server
     * */
    public function getAllApp()
    {

        $client = new Client();

        $app = $client->get(Yii::$app->params['url_clientRegistration'], null, AuthController::$header)->send();

        return json_decode($app->content);
    }


    /*
     * Funton for Client App Realy Party
     * */
    public function getAccessToken($url, $code, $key, $returnUrl)
    {
        $header = [
            'Authorization' => 'Basic ' . $key,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $client = new Client();
        $body = http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $returnUrl
        ]);
        $response = $client->post($url, $body, $header)->send();
        if ($response->isOk) {
            $result = json_decode($response->content, true);
            $this->accessToken = $result['access_token'];
            $this->idToken = $result['id_token'];
            $this->tokenExpiresIn = $result['expires_in'];
        }
    }

    public function getUserInfo($url, $accessToken)
    {
        $header = array(
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        );

        $client = new Client();
        $response = $client->get($url, null, $header)->send();
        if ($response->isOk) {
            $result = json_decode($response->content, true);
            return $result;
        }
        return false;
    }
}