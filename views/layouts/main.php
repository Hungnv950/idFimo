<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
if (Yii::$app->controller->action->id === 'login') {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    if (Yii::$app->user->isGuest) {
        $username = 'Guest';
        $dateCreated = 12213213;
    } else {
        $username = Yii::$app->user->identity->username;
        $dateCreated = Yii::$app->user->identity->created_at;
    }

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower/admin-lte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-blue">
    <?php $this->beginBody() ?>
    <div class="wrapper">


        <?= $this->render(
            'header.php',
            [
                'directoryAsset' => $directoryAsset,
                'username' => $username,
                'dateCreated' => $dateCreated,
                'visible' =>Yii::$app->user->isGuest
            ]
        ) ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?= $this->render(
                'left.php',
                [
                    'directoryAsset' => $directoryAsset,
                    'username' => $username,
                    'visible' =>Yii::$app->user->isGuest
                ]
            )
            ?>

            <?= $this->render(
                'content.php',
                [
                    'content' => $content, 'directoryAsset' => $directoryAsset,
                    'username' => $username,
                ]
            ) ?>

        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
