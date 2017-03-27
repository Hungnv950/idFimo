<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Apps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create App'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'description',
            'client_id',
            'client_secret',
            // 'grant_types',
            // 'subject_type',
            // 'application_type',
//             'registration_client_uri',
             'redirect_uris',
            // 'registration_access_token',
            // 'token_endpoint_auth_method',
            // 'client_secret_expires_at',
//             'client_id_issued_at',
            // 'id_token_signed_response_alg',
             'created_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
