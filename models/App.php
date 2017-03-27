<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $client_id
 * @property string $client_secret
 * @property string $grant_types
 * @property string $response_types
 * @property string $subject_type
 * @property string $application_type
 * @property string $registration_client_uri
 * @property string $redirect_uris
 * @property string $registration_access_token
 * @property string $token_endpoint_auth_method
 * @property integer $client_secret_expires_at
 * @property integer $client_id_issued_at
 * @property string $id_token_signed_response_alg
 * @property integer $created_at
 */
class App extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'redirect_uris'], 'required'],
            [['client_secret_expires_at', 'client_id_issued_at', 'created_at'], 'integer'],
            [['name', 'description', 'client_id', 'client_secret', 'grant_types', 'response_types', 'subject_type', 'application_type', 'registration_client_uri', 'redirect_uris', 'registration_access_token', 'token_endpoint_auth_method', 'id_token_signed_response_alg'], 'string', 'max' => 255],
            [['client_id'], 'unique'],
            [['client_secret'], 'unique'],
            [['name'], 'unique'],
            [['redirect_uris'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'client_id' => Yii::t('app', 'Client ID'),
            'client_secret' => Yii::t('app', 'Client Secret'),
            'grant_types' => Yii::t('app', 'Grant Types'),
            'response_types' => Yii::t('app', 'Response Types'),
            'subject_type' => Yii::t('app', 'Subject Type'),
            'application_type' => Yii::t('app', 'Application Type'),
            'registration_client_uri' => Yii::t('app', 'Registration Client Uri'),
            'redirect_uris' => Yii::t('app', 'Redirect Uris'),
            'registration_access_token' => Yii::t('app', 'Registration Access Token'),
            'token_endpoint_auth_method' => Yii::t('app', 'Token Endpoint Auth Method'),
            'client_secret_expires_at' => Yii::t('app', 'Client Secret Expires At'),
            'client_id_issued_at' => Yii::t('app', 'Client Id Issued At'),
            'id_token_signed_response_alg' => Yii::t('app', 'Id Token Signed Response Alg'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return AppQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppQuery(get_called_class());
    }
}
