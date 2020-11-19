<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consist".
 *
 * @property int $id
 * @property int $dish_id
 * @property int $ingr_id
 * @property string $date_create
 * @property string $date_update
 *
 * @property Dish $dish
 * @property Ingredient $ingr
 */
class Consist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dish_id', 'ingr_id', 'date_create', 'date_update'], 'required'],
            [['dish_id', 'ingr_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'id']],
            [['ingr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_id' => 'Dish ID',
            'ingr_id' => 'Ingr ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }

    /**
     * Gets query for [[Dish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }

    /**
     * Gets query for [[Ingr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngr()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingr_id']);
    }
	
	public function getGetIngr()
	{
		foreach (Consist::find()->where(["dish_id"=>$this->dish_id])->all() as $model)
		{
			$name=Ingredient::find()->where(["id"=>$model->ingr_id])->one()->name;
			$str.=",".$name;
		}
		
		return trim($str, ",");
	}
}
