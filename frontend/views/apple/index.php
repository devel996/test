<?php
use yii\helpers\Url;
?>
<div class="container" style="">
    <div class="row">
        <div class="col-md-4">
            <a href="<?= Url::to(['apple/create', ['create' => true]])?>"><button class="btn btn-success">Create Apples</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Size</th>
                    <th scope="col">Status</th>
                    <th scope="col">Fall</th>
                    <th scope="col">Eat</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($apples as $apple) :?>
                    <tr>
                        <td>
                            <img src="<?= $apple->image ?>" alt="" style="height: 50px">
                        </td>
                        <td><?= $apple->size ?></td>
                        <td><?= (new \common\models\FruitStatus(['status' => $apple->status]))->name ?></td>
                        <td><a href="<?= Url::to(['apple/fall', 'id' => $apple->id]) ?>"><button class="btn btn-success">Fall</button></a></td>
                        <td class="oneRow">
                            <button class="btn btn-warning eating" data-url="<?= Url::to(['apple/eat', 'id' => $apple->id]) ?>">Eat</button>
                            <input type="number" min="1" max="<?= $apple->size ?>" value="25" class="form-control eating-size">
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>

        </div>
    </div>
</div>