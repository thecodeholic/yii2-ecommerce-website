<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
?>
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image"
         style="background-size: contain; background-repeat: no-repeat; background-image: url('/img/undraw_web_shopping_dd4l.svg')"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'user']
            ]); ?>

            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user',
                    'placeholder' => 'Enter your username'
                ]
            ])->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user',
                    'placeholder' => 'Enter your password'
                ]
            ])->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
            <hr>
            <?php ActiveForm::end() ?>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo \yii\helpers\Url::to(['/site/forgot-password']) ?>">Forgot
                    Password?</a>
            </div>
        </div>
    </div>
</div>