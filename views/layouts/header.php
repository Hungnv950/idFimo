<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <?php
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <?php
                    } else {
                        ?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo Yii::getAlias('@web').'/img/user.png'?>"" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?php echo $username ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo Yii::getAlias('@web').'/img/user.png'?>"" class="img-circle"
                                         alt="User Image"/>

                                    <p>
                                        <?php echo $username ?>
                                        <small><?php echo 'Signed at : '. date("Y-m-d H:i:s", $dateCreated) ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a(
                                            'Sign out',
                                            ['/site/logout'],
                                            ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                <?php
                    }
                ?>

                <!-- User Account: style can be found in dropdown.less -->

            </ul>
        </div>
    </nav>
</header>
