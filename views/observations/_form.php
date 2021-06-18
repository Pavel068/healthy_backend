<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Observations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="observations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Users::find()->where(['id' => Yii::$app->user->getId()])->all(), 'id', 'full_name')) ?>

    <?= $form->field($model, 'patient_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Users::find()->where(['role' => 'patient'])->all(), 'id', 'full_name')) ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput(['placeholder' => 'Заполняется при закрытии истории болезни']) ?>

    <?= $form->field($model, 'result')->textarea(['rows' => 6, 'placeholder' => 'Заполняется при закрытии истории болезни']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
