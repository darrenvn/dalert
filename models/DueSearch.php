<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DueSearch represents the model behind the search form of `app\models\Due`.
 */
class DueSearch extends Due{

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['id', 'type', 'expired_at', 'setting_email_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
			[['name'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios(){
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 * @throws \yii\base\InvalidConfigException
	 */
	public function search($params){
		$query = Due::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()){
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'id'               => $this->id,
			'type'             => $this->type,
			'expired_at'       => $this->expired_at,
			'setting_email_id' => $this->setting_email_id,
			'created_at'       => $this->created_at,
			'updated_at'       => $this->updated_at,
			'created_by'       => $this->created_by,
			'updated_by'       => $this->updated_by,
		]);

		$query->andFilterWhere(['like', 'name', $this->name]);
		$query->orderBy(['expired_at' => SORT_ASC]);

		return $dataProvider;
	}
}
