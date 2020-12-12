<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 11:53 AM
 */
/** @var \common\models\Product $model */
?>
    <div class="card h-100">
        <a href="#">
            <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" alt="">
        </a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#"><?php echo $model->name ?></a>
            </h4>
            <h5><?php echo Yii::$app->formatter->asCurrency($model->price) ?></h5>
            <div class="card-text">
                <?php echo $model->getShortDescription() ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?php echo \yii\helpers\Url::to(['/cart/add']) ?>" class="btn btn-primary btn-add-to-cart">
                Add to Cart
            </a>
        </div>
    </div>