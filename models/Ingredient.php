<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 *
 * @property Consist[] $consists
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date_update'], 'required'],
            [['date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата создания',
            'date_update' => 'Date Update',
        ];
    }

    /**
     * Gets query for [[Consists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsists()
    {
        return $this->hasMany(Consist::className(), ['ingr_id' => 'id']);
    }
}
