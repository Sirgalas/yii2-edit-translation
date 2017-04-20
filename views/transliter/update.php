<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Zelenin\yii\modules\I18n\models\SourceMessage */

$this->title = Module::t('Update') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('Simple translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="source-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
