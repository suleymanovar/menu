<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dish".
 *
 * @property int $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 *
 * @property Consist[] $consists
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date_update'], 'required'],
            [['date_create', 'date_update'], 'safe'],
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
            'name' => 'Название',
            'date_create' => 'Date Create',
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
        return $this->hasMany(Consist::className(), ['dish_id' => 'id']);
    }
	
	
	public function getGetIngr()
	{
		foreach (Consist::find()->where(["dish_id"=>$this->id])->all() as $model)
		{
			$name=Ingredient::find()->where(["id"=>$model->ingr_id])->one()->name;
			$str.=",".$name;
		}
		
		return trim($str, ",");
	}
	
}
