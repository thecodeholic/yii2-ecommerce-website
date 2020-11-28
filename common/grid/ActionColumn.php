<?php
/**
 * User: TheCodeholic
 * Date: 11/28/2020
 * Time: 9:45 AM
 */

namespace common\grid;


use Yii;
use yii\helpers\Html;

/**
 * Class ActionColumn
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\grid
 */
class ActionColumn extends \yii\grid\ActionColumn
{
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'far fa-eye');
        $this->initDefaultButton('update', 'far fa-edit');
        $this->initDefaultButton('delete', 'fas fa-trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => $iconName]);

                return Html::a($icon, $url, $options);
            };
        }
    }
}