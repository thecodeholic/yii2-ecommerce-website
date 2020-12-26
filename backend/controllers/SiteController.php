<?php
namespace backend\controllers;

use common\models\Order;
use common\models\OrderItem;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'forgot-password', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalEarnings = Order::find()->paid()->sum('total_price');
        $totalOrders = Order::find()->paid()->count();
        $totalProducts = OrderItem::find()
            ->alias('oi')
            ->innerJoin(Order::tableName().' o', 'o.id = oi.order_id')
            ->andWhere(['o.status' => Order::STATUS_COMPLETED])
            ->sum('quantity');
        $totalUsers = User::find()->andWhere(['status' => User::STATUS_ACTIVE])->count();

        $orders = Order::findBySql("
                        SELECT
                            CAST(DATE_FORMAT(FROM_UNIXTIME(o.created_at), '%Y-%m-%d %H:%i:%s') as DATE) as `date`,
                            SUM(o.total_price) as `total_price`
                            FROM orders o
                        WHERE o.status = :status
                        GROUP BY CAST(DATE_FORMAT(FROM_UNIXTIME(o.created_at), '%Y-%m-%d %H:%i:%s') as DATE)
                        ORDER BY o.created_at", ['status' => Order::STATUS_COMPLETED])
            ->asArray()
            ->all();
        // Line Chart
        $earningsData = [];
        $labels = [];
        if (!empty($orders)) {
            $minDate = $orders[0]['date'];
            $orderByPriceMap = ArrayHelper::map($orders, 'date', 'total_price');
            $d = new \DateTime($minDate);
            $nowDate = new \DateTime();
            while ($d->getTimestamp() < $nowDate->getTimestamp()) {
                $label = $d->format('d/m/Y');
                $labels[] = $label;
                $earningsData[] = (float)($orderByPriceMap[$d->format('Y-m-d')] ?? 0);
                $d->setTimestamp($d->getTimestamp() + 86400);
            }
        }

        // Pie Chart
        $countriesData = Order::findBySql("
            SELECT country,
                   SUM(total_price) as total_price
            FROM orders o
                     INNER JOIN order_addresses oa on o.id = oa.order_id
            WHERE o.status = :status
            GROUP BY country
        ", ['status' => Order::STATUS_COMPLETED])
            ->asArray()
            ->all();

        $countryLabels = ArrayHelper::getColumn($countriesData, 'country');

        $colorOptions = ['#4e73df', '#1cc88a', '#36b9cc'];
        $bgColors = [];
        foreach ($countryLabels as $i => $country) {
            $bgColors[] = $colorOptions[$i % count($colorOptions)];
        }


        return $this->render('index', [
            'totalEarnings' => $totalEarnings,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'data' => $earningsData,
            'labels' => $labels,
            'countries' => $countryLabels,
            'bgColors' => $bgColors,
            'countriesData' => ArrayHelper::getColumn($countriesData, 'total_price'),
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionForgotPassword()
    {
        return "Forgot password";
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
