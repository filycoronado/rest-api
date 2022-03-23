<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $name
 * @property string $vin
 * @property int $type
 * @property int|null $miles
 * @property string $in_date
 * @property string|null $out_date
 * @property int|null $sold
 * @property float|null $cost
 * @property float|null $sell
 *
 * @property CarServices[] $carServices
 * @property Sell[] $sells
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'vin', 'type', 'in_date'], 'required'],
            [['type', 'miles', 'sold'], 'integer'],
            [['in_date', 'out_date'], 'safe'],
            [['cost', 'sell'], 'number'],
            [['name', 'vin'], 'string', 'max' => 255],
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
            'vin' => 'Vin',
            'type' => 'Type',
            'miles' => 'Miles',
            'in_date' => 'In Date',
            'out_date' => 'Out Date',
            'sold' => 'Sold',
            'cost' => 'Cost',
            'sell' => 'Sell',
        ];
    }

    /**
     * Gets query for [[CarServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarServices()
    {
        return $this->hasMany(CarServices::className(), ['id_car' => 'id']);
    }

    /**
     * Gets query for [[Sells]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSells()
    {
        return $this->hasMany(Sell::className(), ['id_car' => 'id']);
    }
}
