<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php
        if (Yii::$app->user->isGuest) {
            ?>
            <h1>Hello</h1>
            <p class="lead">Click <a href="/properties">here</a> to see the list of objects.</p>
            <?php
        } else {
            ?>
            <h1>Welcome</h1>

            <p class="lead">Change password</p>
            <?php
        }
        ?>


    </div>

</div>
