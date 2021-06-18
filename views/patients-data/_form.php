<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientsData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patients-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Users::find()->where(['role' => 'patient'])->all(), 'id', 'full_name')) ?>

    <?= $form->field($model, 'birthday')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'extra')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
