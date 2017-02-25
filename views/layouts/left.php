<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <?php
        if (Yii::$app->user->isGuest) {
        ?>
            <section class="sidebar">

                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/<?php echo Yii::$app->params['img'].'user.png'?>" class="img-circle" alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $username?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <?=
                Nav::widget(
                    [
                        'encodeLabels' => false,
                        'options' => ['class' => 'sidebar-menu'],
                        'items' => [
//                            ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
//                            ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
                            [
                                'class' => 'btn btn-login',
                                'label' => '<span class="glyphicon glyphicon-lock"></span> Sing in', //for basic
                                'url' => ['/site/login'],
                                'visible' =>Yii::$app->user->isGuest
                            ],
                        ],
                    ]
                );
                ?>
            </section>
    <?php
        } else{
            ?>
            <section class="sidebar">

                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/<?php echo Yii::$app->params['img'].'user.png'?>" class="img-circle" alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $username?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <?=
                Nav::widget(
                    [
                        'encodeLabels' => false,
                        'options' => ['class' => 'sidebar-menu'],
                        'items' => [
                            '<li class="header">Menu Dashboard</li>',
                            [
                                'label' => '<span class="glyphicon glyphicon-user"></span> User', 'url' => ['/user'],
                                'visible' => Yii::$app->user->can('userManagerment'),
                            ],
                            [
                                'label' => '<span class="glyphicon glyphicon-pencil"></span> Assignment', 'url' => ['/admin/assignment'],
                                'visible' => Yii::$app->user->can('Admin'),
                            ],
                            [
                                'label' => '<span class="glyphicon glyphicon-modal-window"></span> App', 'url' => ['/app'],
                            ],
//                            ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
//                            ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
                            [
                                'label' => '<span class="glyphicon glyphicon-lock"></span> Sing in', //for basic
                                'url' => ['/site/login'],
                                'visible' =>Yii::$app->user->isGuest
                            ],
                        ],
                    ]
                );
                ?>

<!--                <ul class="sidebar-menu">-->
<!--                    <li class="treeview">-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-share"></i> <span>Same tools</span>-->
<!--                            <i class="fa fa-angle-left pull-right"></i>-->
<!--                        </a>-->
<!--                        <ul class="treeview-menu">-->
<!--                            <li><a href="--><?//= \yii\helpers\Url::to(['/gii']) ?><!--"><span class="fa fa-file-code-o"></span> Gii</a>-->
<!--                            </li>-->
<!--                            <li><a href="--><?//= \yii\helpers\Url::to(['/debug']) ?><!--"><span class="fa fa-dashboard"></span> Debug</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>-->
<!--                                <ul class="treeview-menu">-->
<!--                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>-->
<!--                                    <li>-->
<!--                                        <a href="#">-->
<!--                                            <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>-->
<!--                                        </a>-->
<!--                                        <ul class="treeview-menu">-->
<!--                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>-->
<!--                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->

            </section>
    <?php
        }
    ?>

</aside>
