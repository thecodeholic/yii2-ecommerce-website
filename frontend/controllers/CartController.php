<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 3:32 PM
 */

namespace frontend\controllers;


use common\models\CartItem;
use common\models\Product;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class CartController
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package frontend\controllers
 */
class CartController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            // Get the items from session
        } else {
            $cartItems = CartItem::findBySql("
                            SELECT
                               c.product_id as id,
                               p.image,
                               p.name,
                               p.price,
                               c.quantity,
                               p.price * c.quantity as total_price
                        FROM cart_items c
                                 LEFT JOIN products p on p.id = c.product_id
                         WHERE c.created_by = :userId", [
                'userId' => \Yii::$app->user->id
            ])
                ->asArray()
                ->all();
        }

        return $this->render('index', [
            'items' => $cartItems
        ]);
    }

    public function actionAdd()
    {
        $id = \Yii::$app->request->post('id');
        $product = Product::find()->id($id)->published()->one();
        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }

        if (\Yii::$app->user->isGuest) {
            // todo Save in session
        } else {
            $userId = \Yii::$app->user->id;
            $cartItem = CartItem::find()->userId($userId)->productId($id)->one();
            if ($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->created_by = $userId;
                $cartItem->quantity = 1;
            }
            if ($cartItem->save()) {
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => $cartItem->errors
                ];
            }
        }


    }
}