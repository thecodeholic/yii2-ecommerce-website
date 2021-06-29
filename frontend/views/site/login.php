<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>

            <p><?php echo Yii::t('app', 'Please fill out the following fields to login:') ?></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?php echo Yii::t('app', 'If you forgot your password you can {0}', Html::a(Yii::t('app', 'Reset it'), ['site/request-password-reset'])) ?>.
                <br>
                <?php echo Yii::t('app', 'Need new verification email?') ?> <?= Html::a(Yii::t('app', 'Resend'), ['site/resend-verification-email']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
