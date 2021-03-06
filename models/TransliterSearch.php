<?php

namespace sirgalas\translation\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use sirgalas\translation\models\Transliter;
use sirgalas\translation\models\Massagesmodules;
/**
 * SourceMessageSearch represents the model behind the search form of `Zelenin\yii\modules\I18n\models\SourceMessage`.
 */
class TransliterSearch extends Transliter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message','language','translation'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transliter::find()->orderBy(['id'=>SORT_DESC]);

        if(isset($params['TransliterSearch']['language'])){
            if($params['TransliterSearch']['language']!=''){
                $language=Massagesmodules::findOne(['language'=>$params['TransliterSearch']['language']]);
            }
        }

        if(isset($params['TransliterSearch']['translation'])){
            if($params['TransliterSearch']['translation']!=''){
                $translations=Massagesmodules::find()->andFilterWhere(['like','translation', $params['TransliterSearch']['translation']])->all();
                $translation=array();
                foreach ($translations as $translat) {
                	$translation[]=$translat->id;
                }
            }
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'message', $this->message]);
        if(isset($language)) {
            $query->andFilterWhere(['id' => $language->id]);
        }
        if(isset($translation)) {
            $query->andFilterWhere(['in', 'id', $translation]);
        }

        return $dataProvider;
    }
}
