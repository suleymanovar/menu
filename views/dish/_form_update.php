<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Ingredient;
use yii\grid\GridView;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Dish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
  
     <?= $form->field($con_new, 'ingr_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map(Ingredient::find()->all(), 'id', 'name'),
		'options' => [

        'multiple' => true

			],
    ])->label("Ингредиент"); ?>

	

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
	<?php ActiveForm::end(); ?>
			<?php Pjax::begin(['id' => 'grid-arrival']) ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					'ingr.name',
				   

					[
						'class' => 'yii\grid\ActionColumn',
						'buttons' => [
								'delete' => function ($url, $model) {
										return Html::a('<span class="glyphicon glyphicon-trash"></span>', "#", [
										'onclick' => "deleteConsist($model->id)",
										]);
									}
							]
					],
				],
			]); ?>
   <?php Pjax::end(); ?>

</div>
