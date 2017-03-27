<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\App */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'App',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="app-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
