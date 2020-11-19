<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Ingredient;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="consist-index">
	<?php
	
		echo Select2::widget([
        'data' =>  ArrayHelper::map(Ingredient::find()->all(), 'id', 'name'),
        'name' => 'ing',
        'options' => [
            'placeholder' => 'Выберите',
            'multiple' => true,
			'id'=>'ing'

        ],
		
		'pluginOptions' => [
			'maximumSelectionLength'=>5
				],
			
    ]);
	?>
	</br>
	
	<?= Html::button('<i class="glyphicon glyphicon-ok"></i>  OK', ['class' => 'btn btn-success', 'onclick' => 'received($("#ing").val())']); ?>
   
    <?php Pjax::begin(['id' => 'grid-arrival']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'dish.name',
            
			[
				'label'=>'Ингредиенты',
				'value'=> 'getIngr'
			
			],
            

         
        ],
    ]); ?>

	 <?php Pjax::end(); ?>
</div>
