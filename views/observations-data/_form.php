<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObservationsData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="observations-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'observation_id')->textInput() ?>

    <?= $form->field($model, 'top_pressure')->textInput() ?>

    <?= $form->field($model, 'bottom_pressure')->textInput() ?>

    <?= $form->field($model, 'pulse')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
