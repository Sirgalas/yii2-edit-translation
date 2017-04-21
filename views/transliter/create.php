<?php

use yii\helpers\Html;
use sirgalas\translation\Module;

/* @var $this yii\web\View */
/* @var $model Zelenin\yii\modules\I18n\models\SourceMessage */

$this->title = Module::t('Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('Simple translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
