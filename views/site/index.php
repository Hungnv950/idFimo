<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Fimo';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <?php
                foreach ($app as $data=> $value) {
                    ?>
                    <div class="col-lg-3">
                        <h2><?php echo $value['name']?></h2>
                        <p>
                            <?= Html::a( 'Go to '.$value['name'],
                                ['/site/auth-login',
                                    'response_type'=>'code',
                                    'scope'=>'openid email profile',
                                    'client_id'=> $value['client_id'],
                                    'redirect_uri'=> $value['redirect_uris']
                                ],
                                ['class'=>'btn btn-primary']) ?>
                        </p>
                    </div>
            <?php
                }
            ?>
        </div>

    </div>
</div>
