<?php
use yii\helpers\Url;
?>
<div class="container-fluid" style="">
    <div class="row">
        <div class="col-md-4">
            <a href="<? Url::toRoute(['apple/create', ['create' => true]])?>"><button class="btn btn-success">Create Apples</button></a>
        </div>
    </div>
    <?php foreach ($apples as $apple) :?>
        <div class="row">
            <img src="<?= $apple->image ?>" alt="">
        </div>
    <?php endforeach;?>
</div>