<?php

namespace backend\models;

use common\models\User;
use yii\base\InvalidArgumentException;

/**
 * Password reset form
 */
class ResetPasswordForm extends \common\models\ResetPasswordForm
{

    public function findUser($token)
    {
        if (!User::isPasswordResetTokenValid($token)) {
            return null;
        }

        return User::findOne([
            'password_reset_token' => $token,
            'status' => User::STATUS_ACTIVE,
            'admin' => 1
        ]);

    }
}
