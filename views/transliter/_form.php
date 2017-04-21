<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Zelenin\yii\modules\I18n\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'language')->textInput() ?>

    <?= $form->field($model, 'translation')->textInput() ?>
    
    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'message')->textInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton(Module::t('Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
