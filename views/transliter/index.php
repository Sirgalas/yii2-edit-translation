<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use sirgalas\translation\Module;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Simple translations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' =>'category',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>Module::t('сategory'),
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                    ];
                }
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' =>'message',
                'format'=>      'ntext',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>Module::t('message'),
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                    ];
                }
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' =>  'translation',
                'header'    =>  Module::t('translation'),
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return $model->getMessagesModel($model->id);
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'displayValue'  => $model->getMessagesModel($model->id),
                        'value'         =>  $model->getMessagesModel($model->id),
                        'valueIfNull'   =>  Yii::t('app','Not value'),
                        'header'=>Module::t('translation'),
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                    ];
                }
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' =>  'language',
                'header'    =>  Module::t('language'),
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return $model->getLanguage($model->id);
                },
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'displayValue'  => $model->getLanguage($model->id),
                        'value'         =>  $model->getLanguage($model->id),
                        'valueIfNull'   =>  Yii::t('app','Not value'),
                        'header'=>Module::t('translation'),
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                    ];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
