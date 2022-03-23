<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property int $enabled
 *
 * @property CarServices[] $carServices
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['enabled'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'enabled' => 'Enabled',
        ];
    }

    /**
     * Gets query for [[CarServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarServices()
    {
        return $this->hasMany(CarServices::className(), ['id_service' => 'id']);
    }
}
