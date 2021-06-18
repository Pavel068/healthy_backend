<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\History */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'observation_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Observations::find()->all(), 'id', 'id')) ?>

    <?= $form->field($model, 'patient_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Users::find()->where(['role' => 'patient'])->all(), 'id', 'full_name')) ?>

    <?= $form->field($model, 'drug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'drug_meta')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
