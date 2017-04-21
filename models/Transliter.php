<?php

namespace sirgalas\translation\models;

use Yii;
use Zelenin\yii\modules\I18n\models\SourceMessage;
use Zelenin\yii\modules\I18n\models\Message;
use sirgalas\translation\Module;
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
            'id'            => Module::t('ID'),
            'category'      => Module::t('Category'),
            'message'       => Module::t('Message'),
            'status'        => Module::t('Translation status'),
            'language'      => Module::t('language'),
            'transliter'    => Module::t('transliter'),
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