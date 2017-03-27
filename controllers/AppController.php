<?php

namespace app\controllers;

use Yii;
use app\models\App;
use app\models\AppSearch;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppController implements the CRUD actions for App model.
 */
class AppController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all App models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single App model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new App model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new App();

        if ($model->load(Yii::$app->request->post())) {

            $auth = new AuthController();

            $redirect_uris = array($model->redirect_uris);
            $name = $model->name;
            $content = $auth->createApp(Yii::$app->params['url_clientRegistration'],$redirect_uris, $name);

            $model->client_id = (string)$content->client_id;
            $model->client_secret = (string) $content->client_secret;
            $model->client_id_issued_at = (integer) $content->client_id_issued_at;

            $model->grant_types = (string) $content->grant_types[0];
            $model->application_type = (string) $content->application_type;
            $model->subject_type = (string) $content->subject_type;
            $model->registration_client_uri = (string) $content->registration_client_uri;
            $model->registration_access_token = (string) $content->registration_access_token;
            $model->token_endpoint_auth_method = (string) $content->token_endpoint_auth_method;
            $model->client_secret_expires_at = (integer)$content->client_id_issued_at;
            $model->id_token_signed_response_alg = (string) $content->id_token_signed_response_alg;
            $model->created_at = time();
            Yii::$app->session->addFlash('success', 'Thêm thành công');
            if ($model->save(false)) {
                Yii::$app->session->addFlash('success', 'Thêm thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing App model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('primary', 'Cập nhật thành công');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing App model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $client_id = $this->findModel($id)->client_id;
        $auth = new AuthController();
        $auth->deleteApp(Yii::$app->params['url_clientRegistration'], $client_id);

        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Xóa thành công');
        return $this->redirect(['index']);
    }

    /**
     * Finds the App model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return App the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = App::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMain() {
        return $this->render('main');
    }

}
