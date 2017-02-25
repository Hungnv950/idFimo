<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $clientID
 * @property string $clientSecret
 * @property string $name
 * @property string $description
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
            [['clientID', 'clientSecret', 'name', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['clientID', 'name', 'description'], 'string', 'max' => 255],
            [['clientSecret'], 'string', 'max' => 32],
            [['clientID'], 'unique'],
            [['clientSecret'], 'unique'],
            [['description'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'clientID' => Yii::t('app', 'Client ID'),
            'clientSecret' => Yii::t('app', 'Client Secret'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
