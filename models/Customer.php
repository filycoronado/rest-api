<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property int $name
 * @property string|null $middle_name
 * @property int $last_name
 * @property string $phone
 * @property string $address
 * @property string $in_date
 * @property int|null $enabled
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'phone', 'address', 'in_date'], 'required'],
            [['name', 'last_name', 'enabled'], 'integer'],
            [['in_date'], 'safe'],
            [['middle_name', 'address'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
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
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'in_date' => 'In Date',
            'enabled' => 'Enabled',
        ];
    }
}
