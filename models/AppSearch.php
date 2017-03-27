<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\App;

/**
 * AppSearch represents the model behind the search form about `app\models\App`.
 */
class AppSearch extends App
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_secret_expires_at', 'client_id_issued_at', 'created_at'], 'integer'],
            [['name', 'description', 'client_id', 'client_secret', 'grant_types', 'subject_type', 'application_type', 'registration_client_uri', 'redirect_uris', 'registration_access_token', 'token_endpoint_auth_method', 'id_token_signed_response_alg'], 'safe'],
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
        $query = App::find();

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
            'client_secret_expires_at' => $this->client_secret_expires_at,
            'client_id_issued_at' => $this->client_id_issued_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'client_id', $this->client_id])
            ->andFilterWhere(['like', 'client_secret', $this->client_secret])
            ->andFilterWhere(['like', 'grant_types', $this->grant_types])
            ->andFilterWhere(['like', 'subject_type', $this->subject_type])
            ->andFilterWhere(['like', 'application_type', $this->application_type])
            ->andFilterWhere(['like', 'registration_client_uri', $this->registration_client_uri])
            ->andFilterWhere(['like', 'redirect_uris', $this->redirect_uris])
            ->andFilterWhere(['like', 'registration_access_token', $this->registration_access_token])
            ->andFilterWhere(['like', 'token_endpoint_auth_method', $this->token_endpoint_auth_method])
            ->andFilterWhere(['like', 'id_token_signed_response_alg', $this->id_token_signed_response_alg]);

        return $dataProvider;
    }
}
