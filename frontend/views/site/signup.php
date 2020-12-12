<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <div class="row justify-content-center">

        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to signup:</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>
                </div>
            </div>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
