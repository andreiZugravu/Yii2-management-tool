<?php

/* @var $this yii\web\View */
//use frontend\controllers\SiteController;

/*<a class="btn btn-success btn-lg">*/
use yii\helpers\Html;

$this->title = 'TeamWork';
?>

<style>
    div {
        text-align: center; /* :) */
    }

</style>
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
                <h2> <?php echo Html::a('Create a team', ['/site/create-team'], ['class' => 'btn btn-danger btn-lg btn-block']) ?> </h2>
            </div>
            <div class="col-lg-4">
                <h2> <?php echo Html::a('View my tickets', ['/site/view-my-tickets'], ['class' => 'btn btn-success btn-lg btn-block']) ?> </h2>
            </div>
            <div class="col-lg-4">
                <h2> <?php echo Html::a('Assign tickets', ['/site/choose-team'], ['class' => 'btn btn-info btn-lg btn-block']) ?> </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <h2> <?php echo Html::a('View team tickets', ['/site/view-team-tickets'], ['class' => 'btn btn-primary btn-lg btn-block']) ?> </h2>
            </div>
            <div class="col-lg-3">
                <h2> <?php echo Html::a('View my teams', ['/site/view-my-teams'], ['class' => 'btn btn-warning btn-lg btn-block']) ?> </h2>
            </div>
            <div class="col-lg-3">
                <h2> <?php echo Html::a('View my team invitations', ['/site/view-my-team-invitations'], ['class' => 'btn btn-default btn-lg btn-block']) ?> </h2>
            </div>
            <div class="col-lg-3 mine">
                <h2> <?php echo Html::a('Invite members', ['/site/invite-members'], ['class' => 'btn-default btn-lg btn-block']) ?> </h2>
            </div>
        </div>

    </div>
</div>
