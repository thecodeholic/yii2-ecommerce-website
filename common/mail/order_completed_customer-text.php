<?php
/**
 * User: TheCodeholic
 * Date: 12/17/2020
 * Time: 10:40 AM
 */

/** @var \common\models\Order $order */

$orderAddress = $order->orderAddress;
?>

Order #<?php echo $order->id ?> summary:

Account information
    Firstname: <?php echo $order->firstname ?>
    Lastname: <?php echo $order->lastname ?>
    Email: <?php echo $order->email ?>

Address information
    Address: <?php echo $orderAddress->address ?>
    City: <?php echo $orderAddress->city ?>
    State: <?php echo $orderAddress->state ?>
    Country: <?php echo $orderAddress->country ?>
    ZipCode: <?php echo $orderAddress->zipcode ?>

Products
     Name       Quantity     Price
<?php foreach ($order->orderItems as $item): ?>
    <?php echo $item->product_name ?>  <?php echo $item->quantity ?>    <?php echo Yii::$app->formatter->asCurrency($item->quantity * $item->unit_price) ?>
<?php endforeach; ?>
Total Items: <?php echo $order->getItemsQuantity() ?>
Total Price: <?php echo Yii::$app->formatter->asCurrency($order->total_price) ?>