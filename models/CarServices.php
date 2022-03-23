<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_services".
 *
 * @property int $id
 * @property int $id_car
 * @property int $id_service
 * @property string $in_date
 * @property string|null $out_date
 * @property float $cost
 * @property string $description
 * @property int $enabled
 *
 * @property Car $car
 * @property Services $service
 */
class CarServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_car', 'id_service', 'in_date', 'cost', 'description'], 'required'],
            [['id_car', 'id_service', 'enabled'], 'integer'],
            [['in_date', 'out_date'], 'safe'],
            [['cost'], 'number'],
            [['description'], 'string', 'max' => 150],
            [['id_car'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['id_car' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['id_service' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_car' => 'Id Car',
            'id_service' => 'Id Service',
            'in_date' => 'In Date',
            'out_date' => 'Out Date',
            'cost' => 'Cost',
            'description' => 'Description',
            'enabled' => 'Enabled',
        ];
    }

    /**
     * Gets query for [[Car]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'id_car']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'id_service']);
    }
}
