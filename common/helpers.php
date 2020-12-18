<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 7:31 PM
 */

function isGuest()
{
    return Yii::$app->user->isGuest;
}

function currUserId()
{
    return Yii::$app->user->id;
}

function param($key)
{
    return Yii::$app->params[$key];
}