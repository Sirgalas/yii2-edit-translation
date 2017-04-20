<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.04.17
 * Time: 14:39
 */

namespace backend\modules\transliter\models;

use Zelenin\yii\modules\I18n\models\Message;

class Massagesmodules extends Message
{
    public function rules()
    {
        return [
            //['language', 'required'],
            ['language', 'string', 'max' => 16],
            ['translation', 'string']
        ];
    }
}