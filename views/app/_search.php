<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'client_secret') ?>

    <?php // echo $form->field($model, 'grant_types') ?>

    <?php // echo $form->field($model, 'subject_type') ?>

    <?php // echo $form->field($model, 'application_type') ?>

    <?php // echo $form->field($model, 'registration_client_uri') ?>

    <?php // echo $form->field($model, 'redirect_uris') ?>

    <?php // echo $form->field($model, 'registration_access_token') ?>

    <?php // echo $form->field($model, 'token_endpoint_auth_method') ?>

    <?php // echo $form->field($model, 'client_secret_expires_at') ?>

    <?php // echo $form->field($model, 'client_id_issued_at') ?>

    <?php // echo $form->field($model, 'id_token_signed_response_alg') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
