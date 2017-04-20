<?php

namespace backend\modules\transliter\models;

use Yii;
use Zelenin\yii\modules\I18n\models\SourceMessage;
use Zelenin\yii\modules\I18n\models\Message;
class Transliter extends SourceMessage
{
    public $language;
    public $translation;
    public $transliter;

    public function rules()
    {
        return [
            [['message','language','transliter'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app','ID'),
            'category'      => Yii::t('app','Category'),
            'message'       => Yii::t('app','Message'),
            'status'        => Yii::t('app','Translation status'),
            'language'      => Yii::t('app','language'),
            'transliter'    => Yii::t('app','transliter'),
        ];
    }

    public function saveMassage($id,$languege,$translation){
        $model= new Message();
        $model->id=$id;
        $model->language=$languege;
        $model->translation=$translation;
        $model->save();
    }

    public function updateMassage($id,$languege,$translation){
        $model= Message::findOne($id);
        $model->language=$languege;
        $model->translation=$translation;
        $model->save();
    }
    
    public function getMessagesModel($id)
    {
       $model=Message::findOne($id);
        if(isset($model->translation))
            return $model->translation;
        else
            return false;
    }
    public function getLanguage($id){
        $model=Message::findOne($id);
        if(isset($model->language))
            return $model->language;
        else
            return false;
    }
    public function getMessage()
    {
        return $this->hasOne(Message::className(),['id'=>'id']);
    }
}