<?php

/* @var $this yii\web\View */
//use frontend\controllers\SiteController;

/*<a class="btn btn-success btn-lg">*/
use yii\helpers\Html;

$this->title = 'TeamWork';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to TeamWork!</h1>

        <p class="lead">Take team management to the next level (hopefully).</p>

        <!--<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with TeamWork</a></p>-->
        <!-- Won't be needing this for now-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2> <?php echo Html::a('View team tickets', ['/site/view-team-tickets'], ['class' => 'btn btn-primary btn-lg']) ?> </h2>

                <p>To display : list of team members, with a list of tickets following each member.</p>

                <!--<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
                <!-- Won't be needing this for now-->
            </div>
            <div class="col-lg-4">
                <h2> <?php echo Html::a('View my tickets', ['/site/view-my-tickets'], ['class' => 'btn btn-success btn-lg']) ?> </h2>

                <p>To display : list of my tickets, maybe with status. Each ticket can be clicked on to jump to a page where you can edit the ticket, if you
                    have the corresponding privileges.</p>

                <!--<p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
                <!-- Won't be needing this for now-->
            </div>
            <div class="col-lg-4">
                <h2> <?php echo Html::a('Assign tickets', ['/site/assign-tickets'], ['class' => 'btn btn-info btn-lg']) ?> </h2>

                <p>To display : Not sure yet. Might just make it a button.</p>

                <!--<p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
                <!-- Won't be needing this for now-->
            </div>
        </div>

    </div>
</div>
