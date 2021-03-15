<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 3:42 PM
 */
/** @var array $items */
?>


<div class="card">
    <div class="card-header">
        <h3><?php echo Yii::t('app', 'Your cart items') ?></h3>
    </div>
    <div class="card-body p-0">

        <?php if (!empty($items)): ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?php echo Yii::t('app', 'Product')?></th>
                <th><?php echo Yii::t('app', 'Image')?></th>
                <th><?php echo Yii::t('app', 'Unit Price')?></th>
                <th><?php echo Yii::t('app', 'Quantity')?></th>
                <th><?php echo Yii::t('app', 'Total Price')?></th>
                <th><?php echo Yii::t('app', 'Action')?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr data-id="<?php echo $item['id'] ?>" data-url="<?php echo \yii\helpers\Url::to(['/cart/change-quantity']) ?>">
                    <td><?php echo $item['name'] ?></td>
                    <td>
                        <img src="<?php echo \common\models\Product::formatImageUrl($item['image']) ?>"
                             style="width: 50px;"
                             alt="<?php echo $item['name'] ?>">
                    </td>
                    <td><?php echo Yii::$app->formatter->asCurrency($item['price']) ?></td>
                    <td>
                        <input type="number" min="1" class="form-control item-quantity" style="width: 60px" value="<?php echo $item['quantity'] ?>">
                    </td>
                    <td><?php echo Yii::$app->formatter->asCurrency($item['total_price']) ?></td>
                    <td>
                        <?php echo \yii\helpers\Html::a(Yii::t('app', 'Delete'), ['/cart/delete', 'id' => $item['id']], [
                            'class' => 'btn btn-outline-danger btn-sm',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to remove this product from cart?')
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="card-body text-right">
            <a href="<?php echo \yii\helpers\Url::to(['/cart/checkout']) ?>" class="btn btn-primary">
                <?php echo Yii::t('app', 'Checkout') ?>
            </a>
        </div>
        <?php else: ?>

            <p class="text-muted text-center p-5"><?php echo Yii::t('app', 'There are no items in the cart') ?></p>

        <?php endif; ?>

    </div>
</div>