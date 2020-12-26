<?php

namespace common\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int          $id
 * @property float        $total_price
 * @property int          $status
 * @property string       $firstname
 * @property string       $lastname
 * @property string       $email
 * @property string|null  $transaction_id
 * @property string|null  $paypal_order_id
 * @property int|null     $created_at
 * @property int|null     $created_by
 *
 * @property OrderAddress $orderAddress
 * @property OrderItem[]  $orderItems
 * @property User         $createdBy
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PAID = 1;
    const STATUS_FAILED = 2;
    const STATUS_COMPLETED = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_price', 'status', 'firstname', 'lastname', 'email'], 'required'],
            [['total_price'], 'number'],
            [['email'], 'email'],
            [['status', 'created_at', 'created_by'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['email', 'transaction_id', 'paypal_order_id'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'transaction_id' => 'Transaction ID',
            'paypal_order_id' => 'Paypal Order ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[OrderAddress]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderAddressQuery
     */
    public function getOrderAddress()
    {
        return $this->hasOne(OrderAddress::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItem]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderQuery(get_called_class());
    }

    public function saveAddress($postData)
    {
        $orderAddress = new OrderAddress();
        $orderAddress->order_id = $this->id;
        if ($orderAddress->load($postData) && $orderAddress->save()) {
            return true;
        }
        throw new Exception("Could not save order address: " . implode("<br>", $orderAddress->getFirstErrors()));
    }

    public function saveOrderItems()
    {
        $cartItems = CartItem::getItemsForUser(currUserId());
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->product_name = $cartItem['name'];
            $orderItem->product_id = $cartItem['id'];
            $orderItem->unit_price = $cartItem['price'];
            $orderItem->order_id = $this->id;
            $orderItem->quantity = $cartItem['quantity'];
            if (!$orderItem->save()) {
                throw new Exception("Order item was not saved: " . implode('<br>', $orderItem->getFirstErrors()));
            }
        }

        return true;
    }

    public function getItemsQuantity()
    {
        return $sum = CartItem::findBySql(
            "SELECT SUM(quantity) FROM order_items WHERE order_id = :orderId", ['orderId' => $this->id]
        )->scalar();
    }


    public function sendEmailToVendor()
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'order_completed_vendor-html', 'text' => 'order_completed_vendor-text'],
                ['order' => $this]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->params['vendorEmail'])
            ->setSubject('New order has been made at ' . Yii::$app->name)
            ->send();
    }

    public function sendEmailToCustomer()
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'order_completed_customer-html', 'text' => 'order_completed_customer-text'],
                ['order' => $this]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Your orders is confirmed at ' . Yii::$app->name)
            ->send();
    }

    public static function getStatusLabels()
    {
        return [
            self::STATUS_PAID => 'Paid',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_FAILED => 'Failed',
            self::STATUS_DRAFT => 'Draft'
        ];
    }
}
